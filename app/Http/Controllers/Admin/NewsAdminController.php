<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\S_News;
use App\Models\S_Categories as Category;
use App\Models\S_Menu as Menu;
use App\Models\S_Tags as Tag;
use App\Models\S_NewsLogs as NewsLog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NewsAdminController extends Controller
{
    /**
     * Handle image upload from CKEditor
     */
    public function uploadImage(Request $request)
    {
        // Ensure user is authenticated (uploads should be protected)
        if (!Auth::check()) {
            Log::warning('news.uploadImage unauthenticated attempt', ['ip' => $request->ip()]);
            return response()->json(['error' => ['message' => 'Unauthenticated']], 401);
        }

        // CKEditor sends the file under the 'upload' field. Accept several fallbacks.
        $candidateFields = ['upload', 'image', 'file', 'files', 'files[]'];
        $fileField = null;
        foreach ($candidateFields as $f) {
            if ($request->hasFile($f)) {
                $fileField = $f;
                break;
            }
        }
        if (!$fileField) {
            Log::warning('news.uploadImage no file field present', ['input' => array_keys($request->all())]);
            return response()->json(['error' => ['message' => 'No image uploaded']], 400);
        }

        $image = $request->file($fileField);
        if (!$image->isValid()) {
            Log::error('news.uploadImage invalid upload', ['error' => $image->getErrorMessage()]);
            return response()->json(['error' => ['message' => 'Uploaded file is not valid']], 400);
        }

        try {
            // generate safe unique filename
            $safeName = preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '_' . $safeName . '.' . $extension;

            // Store uploads directly under public/assets so they are served as /assets/...
            $dirPath = 'assets/images/news/' . date('Y') . '/' . date('m') . '/' . date('d');
            $publicDir = public_path($dirPath);
            if (!file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $image->move($publicDir, $filename);
            $path = $dirPath . '/' . $filename;

            // Build a URL that points to public assets
            $url = asset($path);
            Log::info('news.uploadImage stored', ['path' => $path, 'url' => $url, 'user' => Auth::id()]);

            // also write a small debug marker file so we can see uploads even if laravel.log is not configured
            try {
                $marker = storage_path('app/public/images/news/_upload_debug.log');
                file_put_contents($marker, date('Y-m-d H:i:s') . " - stored: $path -> $url by user " . Auth::id() . "\n", FILE_APPEND);
            } catch (\Exception $e) {
                // ignore marker write errors
            }

            // CKEditor 5 SimpleUploadAdapter expects JSON with `url` key. Some integrations also look for `default`.
            // Return 200 for broader compatibility.
            return response()->json(['url' => $url, 'default' => $url]);
        } catch (\Exception $e) {
            Log::error('news.uploadImage exception', ['message' => $e->getMessage()]);
            return response()->json(['error' => ['message' => 'Failed to store uploaded image']], 500);
        }
    }
    //
    public function index()
    {
        // get news, ensure waiting (pending approval) items appear first, then approved ones,
        // Query news dengan kondisi role
        $query = S_News::with('category')
            ->orderByRaw("FIELD(approve, 'waiting', 'approve') ASC")
            ->orderBy('created_at', 'desc');

        // Jika bukan superadmin, hanya tampilkan news miliknya sendiri
        if (Auth::user()->email !== 'superadmin@smkn1talaga.sch.id') {
            $query->where('created_by', Auth::id());
        }

        $news = $query->simplePaginate(15);

        // get categories for the modal table
        $categories = Category::with('createdBy')->orderBy('name')->get();
        $tags = Tag::all();
        return view('admin.news_admin.index', compact('tags', 'news', 'categories'));
    }
    public function create()
    {
        // load categories, menus, and tags for the form
        $categories = Category::orderBy('name')->get();
        $menus = Menu::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.news_admin.create', compact('categories', 'menus', 'tags'));
    }

    /**
     * Store a newly created news item.
     */
    public function store(Request $request)
    {
        // Validate request data

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            's_tag_id' => 'required|array|min:1',
            's_tag_id.*' => 'string|exists:s_tags,id',
            's_category_id' => 'required|string|max:255',
            's_menu_id' => 'required|string|max:255',
            'is_published' => 'nullable|boolean',
        ]);


        try {
            // TAMBAH: Convert comma-separated string to array
            if ($request->has('s_tag_id')) {
                $tags = $request->input('s_tag_id');

                // Jika s_tag_id adalah string (bukan array), split by comma
                if (is_string($tags)) {
                    $tags = array_map('trim', explode(',', $tags));
                    $request->merge(['s_tag_id' => array_filter($tags)]);
                } elseif (is_array($tags)) {
                    // Jika sudah array, pastikan tidak ada yang kosong
                    $tags = array_filter(array_map('trim', $tags));
                    $request->merge(['s_tag_id' => $tags]);
                }
            }

            // ===== TAMBAH LOGGING DI SINI =====
            Log::info('=== DEBUG TAGS INPUT ===');
            Log::info('Original Input:', ['input' => $request->input('s_tag_id')]);
            Log::info('Is Array?', ['is_array' => is_array($request->input('s_tag_id'))]);
            Log::info('Count:', ['count' => is_array($request->input('s_tag_id')) ? count($request->input('s_tag_id')) : 0]);
            Log::info('Values:', ['values' => $request->input('s_tag_id')]);
            // ===== END LOGGING =====



            // ===== TAMBAH LOGGING SETELAH VALIDASI =====
            Log::info('=== AFTER VALIDATION ===');
            Log::info('Validated Tags:', ['tags' => $data['s_tag_id']]);
            Log::info('Count:', ['count' => count($data['s_tag_id'])]);

            Log::debug('news.store input', $request->all());

            // Start database transaction
            DB::beginTransaction();

            // Resolve or create category
            $categoryId = null;
            if (!empty($data['s_category_id'])) {
                $catInput = trim($data['s_category_id']);
                if (preg_match('/^[0-9a-fA-F\-]{36}$/', $catInput) && Category::where('id', $catInput)->exists()) {
                    $categoryId = $catInput;
                } else {
                    $cat = Category::whereRaw('LOWER(name) = ?', [strtolower($catInput)])->first();
                    if (!$cat) {
                        $cat = new Category();
                        $cat->id = (string) Str::uuid();
                        $cat->name = $catInput;
                        $cat->user_id = Auth::id();
                        $cat->save();
                    }
                    $categoryId = $cat->id;
                }
            }

            // Resolve or create menu
            $menuId = null;
            if (!empty($data['s_menu_id'])) {
                $menuInput = trim($data['s_menu_id']);
                if (preg_match('/^[0-9a-fA-F\-]{36}$/', $menuInput) && Menu::where('id', $menuInput)->exists()) {
                    $menuId = $menuInput;
                } else {
                    $menu = Menu::whereRaw('LOWER(name) = ?', [strtolower($menuInput)])->first();
                    if (!$menu) {
                        $menu = new Menu();
                        $menu->id = (string) Str::uuid();
                        $menu->name = $menuInput;
                        $menu->user_id = Auth::id();
                        $menu->save();
                    }
                    $menuId = $menu->id;
                }
            }

            // Create news record
            $newsId = (string) Str::uuid();
            $content = trim($data['content'] ?? '');

            $news = new S_News();
            $news->id = $newsId;
            $news->title = $data['title'];
            $news->content = $content;
            $news->s_category_id = $categoryId;
            $news->s_menu_id = $menuId;
            $news->created_by = Auth::id();
            $news->is_published = $request->boolean('is_published');
            $news->save();

            // Process tags and create news_logs entries - loop setiap tag
            if (!empty($request->s_tag_id) && is_array($request->s_tag_id)) {
                foreach ($request->s_tag_id as $tagInput) {
                    $tagInput = trim($tagInput);

                    if (empty($tagInput)) {
                        continue;
                    }

                    // Check if tag exists by ID
                    if (preg_match('/^[0-9a-fA-F\-]{36}$/', $tagInput)) {
                        $tag = Tag::where('id', $tagInput)->first();
                        if (!$tag) {
                            throw new \Exception("Tag dengan ID {$tagInput} tidak ditemukan");
                        }
                        $tagId = $tagInput;
                    } else {
                        // Find by name case-insensitive or create jika belum exist
                        $tag = Tag::whereRaw('LOWER(name) = ?', [strtolower($tagInput)])->first();
                        if (!$tag) {
                            // CREATE tag baru
                            $tag = new Tag();
                            $tag->id = (string) Str::uuid();
                            $tag->name = $tagInput;
                            $tag->save();
                        }
                        $tagId = $tag->id;
                    }

                    // CREATE news_log entry (PERBAIKAN DI SINI)
                    $newsLog = new NewsLog();
                    $newsLog->id = (string) Str::uuid();
                    $newsLog->s_news_id = $newsId;  // ← UBAH: Link ke news yang baru dibuat
                    $newsLog->s_tags_id = $tagId;
                    $newsLog->save();
                }
            }

            // Commit transaction
            DB::commit();

            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dibuat.');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            Log::error('news.store failed', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Gagal membuat berita: ' . $e->getMessage())->withInput();
        }
    }
    public function edit($id)
    {
        $news = S_News::findOrFail($id);
        // load categories, menus, and tags for the form
        $categories = Category::orderBy('name')->get();
        $menus = Menu::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.news_admin.edit', compact('news', 'categories', 'menus', 'tags'));
    }

    /**
     * Update the specified news item.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'nullable|string',
                's_category_id' => 'required|string|max:255',
                's_menu_id' => 'required|string|max:255',
                's_tag_id' => 'required|array|min:1',
                's_tag_id.*' => 'string|max:255',
                'is_published' => 'sometimes|boolean',
            ]);

            // Start database transaction
            DB::beginTransaction();

            $news = S_News::findOrFail($id);

            // Resolve or create category
            $categoryId = null;
            if (!empty($data['s_category_id'])) {
                $catInput = trim($data['s_category_id']);
                if (preg_match('/^[0-9a-fA-F\-]{36}$/', $catInput) && Category::where('id', $catInput)->exists()) {
                    $categoryId = $catInput;
                } else {
                    $cat = Category::whereRaw('LOWER(name) = ?', [strtolower($catInput)])->first();
                    if (!$cat) {
                        $cat = new Category();
                        $cat->id = (string) Str::uuid();
                        $cat->name = $catInput;
                        $cat->user_id = Auth::id();
                        $cat->save();
                    }
                    $categoryId = $cat->id;
                }
            }

            // Resolve or create menu
            $menuId = null;
            if (!empty($data['s_menu_id'])) {
                $menuInput = trim($data['s_menu_id']);
                if (preg_match('/^[0-9a-fA-F\-]{36}$/', $menuInput) && Menu::where('id', $menuInput)->exists()) {
                    $menuId = $menuInput;
                } else {
                    $menu = Menu::whereRaw('LOWER(name) = ?', [strtolower($menuInput)])->first();
                    if (!$menu) {
                        $menu = new Menu();
                        $menu->id = (string) Str::uuid();
                        $menu->name = $menuInput;
                        $menu->user_id = Auth::id();
                        $menu->save();
                    }
                    $menuId = $menu->id;
                }
            }

            // Update news record
            $news->title = $data['title'];
            $news->content = $data['content'] ?? null;
            $news->s_category_id = $categoryId;
            $news->s_menu_id = $menuId;
            $news->is_published = $request->has('is_published') && $request->boolean('is_published');
            $news->updated_by = Auth::id();
            $news->save();

            // Delete old news_logs entries for this news
            NewsLog::where('s_news_id', $news->id)->delete();

            // Process tags and create news_logs entries - loop setiap tag
            if (!empty($data['s_tag_id']) && is_array($data['s_tag_id'])) {
                foreach ($data['s_tag_id'] as $tagInput) {
                    $tagInput = trim($tagInput);

                    if (empty($tagInput)) {
                        continue;
                    }

                    // Check if tag exists by ID
                    if (preg_match('/^[0-9a-fA-F\-]{36}$/', $tagInput)) {
                        $tag = Tag::where('id', $tagInput)->first();
                        if (!$tag) {
                            throw new \Exception("Tag dengan ID {$tagInput} tidak ditemukan");
                        }
                        $tagId = $tagInput;
                    } else {
                        // Find by name case-insensitive or create jika belum exist
                        $tag = Tag::whereRaw('LOWER(name) = ?', [strtolower($tagInput)])->first();
                        if (!$tag) {
                            // CREATE tag baru
                            $tag = new Tag();
                            $tag->id = (string) Str::uuid();
                            $tag->name = $tagInput;
                            $tag->save();
                        }
                        $tagId = $tag->id;
                    }

                    // CREATE news_log entry dengan tag_id hasil dari create/resolve
                    $newsLog = new NewsLog();
                    $newsLog->id = (string) Str::uuid();
                    $newsLog->s_news_id = $news->id;
                    $newsLog->s_tags_id = $tagId;
                    $newsLog->save();
                }
            }

            // Commit transaction
            DB::commit();

            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            Log::error('news.update failed', ['id' => $id, 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Gagal memperbarui berita: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified news item from storage.
     */
    public function destroy($id)
    {
        $news = S_News::findOrFail($id);

        try {
            $news->delete();
            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('news.destroy failed', ['id' => $id, 'message' => $e->getMessage()]);
            return redirect()->route('admin.news.index')->with('error', 'Gagal menghapus berita.');
        }
    }

    /**
     * Display the specified news item.
     */
    public function show($id)
    {
        $news = S_News::findOrFail($id);
        return view('admin.news_admin.show', compact('news'));
    }

    /**
     * Approve or set status for a news item. Only superadmin may change the status.
     */

    public function approve(Request $request, $id)
    {
        $news = S_News::findOrFail($id);

        // Simple guard: only allow superadmin email to change approval status
        $user = Auth::user();
        if (!$user || $user->email !== 'superadmin@smkn1talaga.sch.id') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah status approval.');
        }

        $data = $request->validate([
            'approve' => 'required|in:waiting,approve', // Ganti 'approved' jadi 'approve'
        ]);

        $news->approve = $data['approve'];
        $news->updated_by = Auth::id();
        $news->save();

        $message = $data['approve'] == 'approve'
            ? 'Berita berhasil di-approve!'
            : 'Status berhasil diubah menjadi waiting!';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Fetch tags for autocomplete (API endpoint)
     */
    public function fetchTags(Request $request)
    {
        $search = $request->input('search', '');

        $tags = Tag::where('name', 'LIKE', "%{$search}%")
            ->orderBy('name')
            ->limit(10)
            ->get()
            ->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'value' => $tag->id,
                    'label' => $tag->name,
                ];
            });

        return response()->json($tags);
    }
}
