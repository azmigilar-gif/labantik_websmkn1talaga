<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\S_Extrakulikuler;
use App\Models\S_Menu;
use App\Models\S_ModelKey;
use App\Models\S_News;
use App\Models\S_Redirect;
use App\Models\S_Submenu;
use App\Models\S_ViewName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = S_Menu::with('submenus')->latest()->paginate();
        $viewName = S_ViewName::all();
        $modelKey = S_ModelKey::all();
        $redirectTo = S_Redirect::all();
        $submenus = S_Submenu::all();
        return view('admin.menus.index', compact('menus', 'submenus', 'viewName', 'modelKey', 'redirectTo'));
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
        try {
            DB::beginTransaction();

            $menu = S_Menu::findOrFail($id);

            // Hapus semua data terkait
            S_Extrakulikuler::where('s_menu_id', $menu->id)->delete();
            S_News::where('s_menu_id', $menu->id)->delete();

            $menu->delete();

            DB::commit();

            return redirect()->route('admin.menus.index')->with('success', 'Menu Berhasil Dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.menus.index')->with('error', 'Gagal menghapus menu: ' . $e->getMessage());
        }
    }
}
