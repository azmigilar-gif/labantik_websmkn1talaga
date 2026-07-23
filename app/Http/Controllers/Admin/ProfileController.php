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
        $profiles = S_Profile::latest()->simplePaginate(15);
        $menus = S_Menu::all();

        return view('admin.profiles.index', compact('profiles', 'menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            's_menu_id' => 'required|exists:s_menus,id',
            'content' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);
        $content = trim($data['content'] ?? '');

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $dirPath = 'assets/images/profile/'.date('Y').'/'.date('m').'/'.date('d');
            $publicDir = public_path($dirPath);
            if (! file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $filename = time().'_'.preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$photo->getClientOriginalExtension();
            $photo->move($publicDir, $filename);
            $photoPath = $dirPath.'/'.$filename;
        }

        S_Profile::create([
            'id' => (string) Str::uuid(),
            's_menu_id' => $data['s_menu_id'],
            'content' => $content,
            'photo' => $photoPath,
            'created_by' => Auth::id(),
            'updated_by' => null,
        ]);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile Sekolah Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $profile = S_Profile::findOrFail($id);
        $data = $request->validate([
            's_menu_id' => 'required|exists:s_menus,id',
            'content' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = $profile->photo;
        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                $oldPath = public_path($profile->photo);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $photo = $request->file('photo');
            $dirPath = 'assets/images/profile/'.date('Y').'/'.date('m').'/'.date('d');
            $publicDir = public_path($dirPath);
            if (! file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $filename = time().'_'.preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$photo->getClientOriginalExtension();
            $photo->move($publicDir, $filename);
            $photoPath = $dirPath.'/'.$filename;
        }

        $profile->update([
            's_menu_id' => $data['s_menu_id'],
            'content' => $data['content'],
            'photo' => $photoPath,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile Sekolah Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $profile = S_Profile::findOrFail($id);
        if ($profile->photo) {
            $oldPath = public_path($profile->photo);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Profile Sekolah Berhasil Dihapus!');
    }
}
