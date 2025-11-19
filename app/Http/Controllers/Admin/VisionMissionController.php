<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\S_Menu;
use App\Models\S_VisionMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VisionMissionController extends Controller
{
    public function index()
    {
        $visionMissions = S_VisionMission::latest()->paginate();
        $menus = S_Menu::all();
        return view('admin.visionmissions.index', compact('visionMissions', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            's_menu_id' => 'required|exists:s_menus,id',
            'vision' => 'required|string',
            'mission' => 'required|regex:/^\s*\d+\.\s.+/m'
        ]);

        S_VisionMission::create([
            'id' => (string) Str::uuid(),
            's_menu_id' => $request->s_menu_id,
            'vision' => $request->vision,
            'mission' => $request->mission,
            'created_by' => Auth::id(),
            'updated_by' => null,
        ]);

        return redirect()->route('admin.visionmissions.index')->with('success', 'Visi & Misi Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $visionMission = S_VisionMission::findOrFail($id);
        $request->validate([
            's_menu_id' => 'required|exists:s_menus,id',
            'vision' => 'required|string',
            'mission' => 'required|regex:/^\s*\d+\.\s.+/m'
        ]);

        $visionMission->update($request->all());

        return redirect()->route('admin.visionmissions.index')->with('success', 'Visi & Misi Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $visionMission = S_VisionMission::findOrFail($id);

        $visionMission->delete();

        return redirect()->route('admin.visionmissions.index')->with('success', 'Visi & Misi Berhasil Dihapus!');
    }
}
