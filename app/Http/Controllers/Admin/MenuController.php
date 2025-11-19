<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\S_Extrakulikuler;
use App\Models\S_Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = S_Menu::latest()->paginate();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:s_menus'
        ]);

        S_Menu::create([
            'id' => (string) Str::uuid(),
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $menu = S_Menu::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:' . S_Menu::class . ',slug,' . $menu->id
        ]);

        $menu->update($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $menu = S_Menu::findOrFail($id);

        S_Extrakulikuler::where('s_menu_id', $menu->id)->update(['s_menu_id' => null]);

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu Berhasil Dihapus!');
    }
}
