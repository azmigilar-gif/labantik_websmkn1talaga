<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\S_ModelKey;
use App\Models\S_Redirect;
use App\Models\S_Submenu;
use App\Models\S_ViewName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubmenuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            's_menu_id' => 'required|exists:s_menus,id',
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            // 's_view_name_id' => 'nullable|exists:s_view, id',
            // 's_model_key_id' => 'nullable|exists:s_model_key, id',
            // 's_redirect_to_id' => 'nullable|exists:s_redirect, id',
        ]);

        S_Submenu::create([
            'id' => (string) Str::uuid(),
            's_menu_id' => $request->s_menu_id,
            'name' => $request->name,
            'url' => $request->url ?? $request->name . '-page',
            // 's_view_name_id' => $request->s_view_name_id,
            // 's_model_key_id' => $request->s_model_key_id,
            // 's_redirect_to_id' => $request->s_redirect_to_id,
        ]);

        return back()->with('success', 'Submenu berhasil ditambahkan.');
    }

    public function show($id)
    {
        $submenus = S_Submenu::with('menu')->where('s_menu_id', $id)->get();
        $viewName = S_ViewName::all();
        $modelKey = S_ModelKey::all();
        $redirectTo = S_Redirect::all();
        return view('admin.menus.detail', compact('submenus', 'viewName', 'modelKey', 'redirectTo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            // 's_view_name_id' => 'nullable|exists:s_view,id',
            // 's_model_key_id' => 'nullable|exists:s_model_key,id',
            // 's_redirect_to_id' => 'nullable|exists:s_redirect,id',
        ]);

        $submenu = S_Submenu::findOrFail($id);
        $submenu->update([
            'name' => $request->name,
            'url' => $request->url ?? $request->name . '-page',
            's_view_name_id' => $request->s_view_name_id,
            's_model_key_id' => $request->s_model_key_id,
            's_redirect_to_id' => $request->s_redirect_to_id,
        ]);

        return back()->with('success', 'Submenu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $submenu = S_Submenu::findOrFail($id);
        $submenu->delete();

        return back()->with('success', 'Submenu berhasil dihapus.');
    }

    public function addConfiguration(Request $request)
    {
        $request->validate([
            'view_name' => 'nullable|string|max:255',
            'view_slug' => 'nullable|string|max:255|unique:s_view,slug',
            'model_key' => 'required|string|max:255',
            'model_slug' => 'required|string|max:255|unique:s_model_key,slug',
            'redirect_to' => 'nullable|string|max:255',
            'redirect_slug' => 'nullable|string|max:255|unique:s_redirect,slug',
        ]);

        try {
            DB::beginTransaction();
            S_ViewName::create([
                'id' => (string) Str::uuid(),
                'name' => $request->view_name,
                'slug' => $request->view_slug,
            ]);

            S_Redirect::create([
                'id' => (string) Str::uuid(),
                'name' => $request->redirect_to,
                'slug' => $request->redirect_slug,
            ]);

            S_ModelKey::create([
                'id' => (string) Str::uuid(),
                'name' => $request->model_key,
                'slug' => $request->model_slug,
            ]);

            DB::commit();
            return back()->with('success', 'Konfigurasi submenu berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menambahkan konfigurasi submenu: ' . $e->getMessage());
        }
    }
}
