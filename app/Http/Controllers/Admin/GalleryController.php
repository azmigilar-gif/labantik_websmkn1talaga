<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $query = Gallery::query()->latest();
        if ($type && in_array($type, [Gallery::TYPE_PHOTO, Gallery::TYPE_VIDEO])) {
            $query->where('type', $type);
        }
        $items = $query->paginate(20);
        return view('admin.galleries.index', compact('items', 'type'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:photo,video',
            'embed_url' => 'required|url',
        ]);
        // For both photo and video we expect an embed URL from social platforms.
        $data['created_by'] = Auth::id();
        $item = Gallery::create($data);

        // Attempt to download a thumbnail (if available) and save locally similar to other controllers
        try {
            $thumb = $item->thumbnail;
            if (!empty($thumb)) {
                $resp = Http::get($thumb);
                if ($resp->successful()) {
                    $dirPath = 'assets/images/galleries/' . date('Y') . '/' . date('m') . '/' . date('d');
                    $publicDir = public_path($dirPath);
                    if (!file_exists($publicDir)) {
                        mkdir($publicDir, 0755, true);
                    }
                    // attempt to determine extension from URL, otherwise fallback to jpg
                    $ext = pathinfo(parse_url($thumb, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                    $filename = time() . '_' . Str::slug($item->id) . '.' . $ext;
                    $fullPath = $publicDir . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($fullPath, $resp->body());
                    // verify file saved and is not empty, otherwise remove and do not set file_path
                    if (file_exists($fullPath) && filesize($fullPath) > 0) {
                        $item->file_path = $dirPath . '/' . $filename;
                        $item->save();
                    } else {
                        if (file_exists($fullPath)) {
                            @unlink($fullPath);
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            // don't block creation if thumbnail download fails
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item created.');
    }

    public function show($id)
    {
        $item = Gallery::findOrFail($id);
        return view('admin.galleries.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Gallery::findOrFail($id);
        return view('admin.galleries.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Gallery::findOrFail($id);
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:photo,video',
            'embed_url' => 'required|url',
        ]);
        // detect whether embed_url changed so we can refresh thumbnail
        $embedChanged = isset($data['embed_url']) && $data['embed_url'] !== $item->embed_url;

        // update embed url and type/title
        $item->update($data);

        if ($embedChanged) {
            // remove old local file if exists
            if ($item->file_path) {
                $oldPublic = public_path($item->file_path);
                if (file_exists($oldPublic)) {
                    @unlink($oldPublic);
                } else {
                    Storage::disk('public')->delete($item->file_path);
                }
                $item->file_path = null;
            }

            // try to download new thumbnail
            try {
                $thumb = $item->thumbnail;
                if (!empty($thumb)) {
                    $resp = Http::get($thumb);
                    if ($resp->successful()) {
                        $dirPath = 'assets/images/galleries/' . date('Y') . '/' . date('m') . '/' . date('d');
                        $publicDir = public_path($dirPath);
                        if (!file_exists($publicDir)) {
                            mkdir($publicDir, 0755, true);
                        }
                        $ext = pathinfo(parse_url($thumb, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                        $filename = time() . '_' . Str::slug($item->id) . '.' . $ext;
                        $fullPath = $publicDir . DIRECTORY_SEPARATOR . $filename;
                        file_put_contents($fullPath, $resp->body());
                        if (file_exists($fullPath) && filesize($fullPath) > 0) {
                            $item->file_path = $dirPath . '/' . $filename;
                            $item->save();
                        } else {
                            if (file_exists($fullPath)) {
                                @unlink($fullPath);
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {
                // ignore download failures
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated.');
    }

    public function destroy($id)
    {
        $item = Gallery::findOrFail($id);
        if ($item->file_path) {
            $publicPath = public_path($item->file_path);
            if (file_exists($publicPath)) {
                @unlink($publicPath);
            } else {
                Storage::disk('public')->delete($item->file_path);
            }
        }
        $item->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Gallery deleted.');
    }
}
