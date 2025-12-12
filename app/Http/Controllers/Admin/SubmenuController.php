<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\S_Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubmenuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            's_menu_id' => 'required|exists:s_menus,id',
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        S_Submenu::create([
            'id' => (string) Str::uuid(),
            's_menu_id' => $request->s_menu_id,
            'name' => $request->name,
            'url' => $request->name . '-page',
        ]);

        return back()->with('success', 'Submenu berhasil ditambahkan.');
    }

    public function show($id)
    {
        $submenus = S_Submenu::with('menu')->where('s_menu_id', $id)->get();
        return view('admin.menus.detail', compact('submenus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        $submenu = S_Submenu::findOrFail($id);
        $submenu->update([
            'name' => $request->name,
            'url' => $request->name . '-page',
        ]);

        return back()->with('success', 'Submenu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $submenu = S_Submenu::findOrFail($id);
        $submenu->delete();

        return back()->with('success', 'Submenu berhasil dihapus.');
    }
}
