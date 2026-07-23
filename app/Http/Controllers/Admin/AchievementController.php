<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\S_Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = S_Achievement::latest('date')->simplePaginate(15);

        return view('admin.achievement.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievement.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'date' => 'required|date',
            'winner_name' => 'required|string|max:255',
            'winner_social' => 'nullable|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $dirPath = 'assets/images/achievement/'.date('Y').'/'.date('m').'/'.date('d');
            $publicDir = public_path($dirPath);
            if (! file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $filename = time().'_'.preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$photo->getClientOriginalExtension();
            $photo->move($publicDir, $filename);
            $photoPath = $dirPath.'/'.$filename;
        }

        $a = new S_Achievement;
        $a->id = (string) Str::uuid();
        $a->title = $data['title'];
        $a->category = $data['category'];
        $a->date = $data['date'];
        $a->winner_name = $data['winner_name'];
        $a->winner_social = $data['winner_social'] ?? null;
        $a->description = $data['description'];
        $a->photo = $photoPath;
        $a->created_by = Auth::id();
        $a->save();

        return redirect()->route('admin.achievement.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $a = S_Achievement::findOrFail($id);

        return view('admin.achievement.show', compact('a'));
    }

    public function edit($id)
    {
        $a = S_Achievement::findOrFail($id);

        return view('admin.achievement.edit', compact('a'));
    }

    public function update(Request $request, $id)
    {
        $a = S_Achievement::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'date' => 'required|date',
            'winner_name' => 'required|string|max:255',
            'winner_social' => 'nullable|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = $a->photo;
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($a->photo && file_exists(public_path($a->photo))) {
                @unlink(public_path($a->photo));
            }
            $photo = $request->file('photo');
            $dirPath = 'assets/images/achievement/'.date('Y').'/'.date('m').'/'.date('d');
            $publicDir = public_path($dirPath);
            if (! file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $filename = time().'_'.preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$photo->getClientOriginalExtension();
            $photo->move($publicDir, $filename);
            $photoPath = $dirPath.'/'.$filename;
        }

        $a->title = $data['title'];
        $a->category = $data['category'];
        $a->date = $data['date'];
        $a->winner_name = $data['winner_name'];
        $a->winner_social = $data['winner_social'] ?? null;
        $a->description = $data['description'];
        $a->photo = $photoPath;
        $a->updated_by = Auth::id();
        $a->save();

        return redirect()->route('admin.achievement.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $a = S_Achievement::findOrFail($id);
        if ($a->photo && file_exists(public_path($a->photo))) {
            @unlink(public_path($a->photo));
        }
        $a->delete();

        return redirect()->route('admin.achievement.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
