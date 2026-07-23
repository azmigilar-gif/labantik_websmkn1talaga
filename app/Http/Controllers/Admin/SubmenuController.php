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
            'type' => 'required|in:custom,module,url',
            'content' => 'nullable|string',
            'external_url' => 'nullable|string',
            'module_name' => 'nullable|string',
        ]);

        // Generate dynamic URL slug from name if not provided
        $urlSlug = $request->url;
        if (empty($urlSlug)) {
            $urlSlug = Str::slug($request->name);
        }

        S_Submenu::create([
            'id' => (string) Str::uuid(),
            's_menu_id' => $request->s_menu_id,
            'name' => $request->name,
            'url' => $urlSlug,
            'type' => $request->type,
            'content' => $request->content,
            'external_url' => $request->external_url,
            'module_name' => $request->module_name,
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
            'type' => 'required|in:custom,module,url',
            'content' => 'nullable|string',
            'external_url' => 'nullable|string',
            'module_name' => 'nullable|string',
        ]);

        $urlSlug = $request->url;
        if (empty($urlSlug)) {
            $urlSlug = Str::slug($request->name);
        }

        $submenu = S_Submenu::findOrFail($id);
        $submenu->update([
            'name' => $request->name,
            'url' => $urlSlug,
            'type' => $request->type,
            'content' => $request->content,
            'external_url' => $request->external_url,
            'module_name' => $request->module_name,
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
