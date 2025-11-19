<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\S_Menu;
use App\Models\S_Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = S_Profile::latest()->paginate();
        $menus = S_Menu::all();
        return view('admin.profiles.index', compact('profiles', 'menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            's_menu_id' => 'required|exists:s_menus,id',
            'content' => 'required|string',
        ]);
        $content = trim(string: $data['content'] ?? '');


        S_Profile::create([
            'id' => (string) Str::uuid(),
            's_menu_id' => $data['s_menu_id'],
            'content' => $content,
            'created_by' => Auth::id(),
            'updated_by' => null,
        ]);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile Sekolah Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $profile = S_Profile::findOrFail($id);
        $request->validate([
            's_menu_id' => 'required|exists:s_menus,id',
            'content' => 'required|string',
        ]);

        $profile->update($request->all());

        return redirect()->route('admin.profiles.index')->with('success', 'Profile Sekolah Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $profile = S_Profile::findOrFail($id);

        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Profile Sekolah Berhasil Dihapus!');
    }
}
