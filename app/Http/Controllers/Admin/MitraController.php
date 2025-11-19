<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\S_Mitra;
use App\Models\S_Menu as Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = S_Mitra::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.mitra.index', compact('mitras'));
    }

    public function create()
    {
        $menus = Menu::orderBy('name')->get();
        return view('admin.mitra.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:4096',
            's_menu_id' => 'nullable|string|max:255',
        ]);

        $menuId = null;
        if (!empty($data['s_menu_id']) && preg_match('/^[0-9a-fA-F\-]{36}$/', $data['s_menu_id']) && Menu::where('id', $data['s_menu_id'])->exists()) {
            $menuId = $data['s_menu_id'];
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $dirPath = 'assets/images/mitra/' . date('Y') . '/' . date('m') . '/' . date('d');
            $publicDir = public_path($dirPath);
            if (!file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $photo->getClientOriginalExtension();
            $photo->move($publicDir, $filename);
            $photoPath = $dirPath . '/' . $filename;
        }

        $m = new S_Mitra();
        $m->id = (string) Str::uuid();
        $m->name = $data['name'];
        $m->photo = $photoPath;
        $m->created_by = Auth::id();
        if ($menuId) $m->s_menu_id = $menuId;
        $m->save();

        return redirect()->route('admin.mitra.index')->with('success', 'Mitra berhasil dibuat.');
    }

    public function edit($id)
    {
        $m = S_Mitra::findOrFail($id);
        $menus = Menu::orderBy('name')->get();
        return view('admin.mitra.edit', compact('m', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $m = S_Mitra::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:4096',
            's_menu_id' => 'nullable|string|max:255',
        ]);

        if (!empty($data['s_menu_id']) && preg_match('/^[0-9a-fA-F\-]{36}$/', $data['s_menu_id']) && Menu::where('id', $data['s_menu_id'])->exists()) {
            $m->s_menu_id = $data['s_menu_id'];
        }

        if ($request->hasFile('photo')) {
            if ($m->photo) {
                $oldPath = public_path($m->photo);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                } else {
                    Storage::disk('public')->delete($m->photo);
                }
            }
            $photo = $request->file('photo');
            $dirPath = 'assets/images/mitra/' . date('Y') . '/' . date('m') . '/' . date('d');
            $publicDir = public_path($dirPath);
            if (!file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $photo->getClientOriginalExtension();
            $photo->move($publicDir, $filename);
            $m->photo = $dirPath . '/' . $filename;
        }

        $m->name = $data['name'];
        $m->updated_by = Auth::id();
        $m->save();

        return redirect()->route('admin.mitra.index')->with('success', 'Mitra berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $m = S_Mitra::findOrFail($id);
        if ($m->photo) {
            $oldPath = public_path($m->photo);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            } else {
                Storage::disk('public')->delete($m->photo);
            }
        }
        $m->delete();

        return redirect()->route('admin.mitra.index')->with('success', 'Mitra dihapus.');
    }

    public function show($id)
    {
        $m = S_Mitra::findOrFail($id);
        return view('admin.mitra.show', compact('m'));
    }
}
