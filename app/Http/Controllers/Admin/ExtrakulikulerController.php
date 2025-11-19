<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\S_Extrakulikuler;
use App\Models\S_Menu as Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExtrakulikulerController extends Controller
{
    public function index()
    {
        // sort waiting (pending approval) first, then newest within each group
        $extracurriculars = S_Extrakulikuler::with('menu')
            ->orderByRaw("FIELD(approve, 'waiting', 'approve') ASC")
            ->orderBy('created_at', 'desc')
            ->simplePaginate(15);
        return view('admin.extrakulikuler.index', compact('extracurriculars'));
    }

    public function create()
    {
        $menus = Menu::orderBy('name')->get();
        return view('admin.extrakulikuler.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            's_menu_id' => 'nullable|string|max:255',
        ]);

        $menuId = null;
        if (!empty($data['s_menu_id']) && preg_match('/^[0-9a-fA-F\-]{36}$/', $data['s_menu_id']) && Menu::where('id', $data['s_menu_id'])->exists()) {
            $menuId = $data['s_menu_id'];
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $dirPath = 'assets/images/ekstrakulikuler/' . date('Y') . '/' . date('m') . '/' . date('d');
            $publicDir = public_path($dirPath);
            if (!file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $photo->getClientOriginalExtension();
            $photo->move($publicDir, $filename);
            $photoPath = $dirPath . '/' . $filename;
        }

        $ex = new S_Extrakulikuler();
        $ex->id = (string) Str::uuid();
        $ex->name = $data['name'];
        $ex->photo = $photoPath;
        $ex->description = $data['description'] ?? null;
    $ex->s_menu_id = $menuId;
    // use created_by to match the migration and model (created_by / updated_by)
    $ex->created_by = Auth::id();
        $ex->save();

        return redirect()->route('admin.extrakulikuler.index')->with('success', 'Ekstrakulikuler berhasil dibuat.');
    }

    public function edit($id)
    {
        $ex = S_Extrakulikuler::findOrFail($id);
        $menus = Menu::orderBy('name')->get();
        return view('admin.extrakulikuler.edit', compact('ex', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $ex = S_Extrakulikuler::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            's_menu_id' => 'nullable|string|max:255',
        ]);

        if (!empty($data['s_menu_id']) && preg_match('/^[0-9a-fA-F\-]{36}$/', $data['s_menu_id']) && Menu::where('id', $data['s_menu_id'])->exists()) {
            $ex->s_menu_id = $data['s_menu_id'];
        }

        if ($request->hasFile('photo')) {
            // delete old photo from public if exists
            if ($ex->photo) {
                $oldPath = public_path($ex->photo);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $photo = $request->file('photo');
            $dirPath = 'assets/images/ekstrakulikuler/' . date('Y') . '/' . date('m') . '/' . date('d');
            $publicDir = public_path($dirPath);
            if (!file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $photo->getClientOriginalExtension();
            $photo->move($publicDir, $filename);
            $ex->photo = $dirPath . '/' . $filename;
        }

    $ex->name = $data['name'];
    $ex->description = $data['description'] ?? null;
    // set updated_by when editing
    $ex->updated_by = Auth::id();
    $ex->save();

        return redirect()->route('admin.extrakulikuler.index')->with('success', 'Ekstrakulikuler berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ex = S_Extrakulikuler::findOrFail($id);
        if ($ex->photo) {
            $oldPath = public_path($ex->photo);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            } else {
                // fallback: if stored in storage disk, try deleting there
                Storage::disk('public')->delete($ex->photo);
            }
        }
        $ex->delete();

        return redirect()->route('admin.extrakulikuler.index')->with('success', 'Ekstrakulikuler dihapus.');
    }

    /**
     * Display the specified ekstrakulikuler (show view with approval controls).
     */
    public function show($id)
    {
        $ex = S_Extrakulikuler::findOrFail($id);
        return view('admin.extrakulikuler.show', compact('ex'));
    }

    /**
     * Approve or set status for an ekstrakulikuler. Only superadmin may change the status.
     */
    public function approve(Request $request, $id)
    {
        $ex = S_Extrakulikuler::findOrFail($id);

        // Simple guard: only allow superadmin email to change approval status
        $user = Auth::user();
        if (!$user || $user->email !== 'superadmin@smkn1talaga.sch.id') {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'status' => 'required|in:waiting,approve',
        ]);

        $ex->approve = $data['status'];
        $ex->updated_by = Auth::id();
        $ex->save();

        return redirect()->back()->with('success', 'Status ekstrakulikuler berhasil diperbarui.');
    }
}
