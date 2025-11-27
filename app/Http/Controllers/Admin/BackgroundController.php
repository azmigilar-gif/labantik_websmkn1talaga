<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BackgroundController extends Controller
{
    public function index()
    {
        // find existing background file in public assets
        $dir = public_path('assets/images');
        $bgFile = null;
        foreach (['jpg','jpeg','png','webp'] as $ext) {
            $path = $dir . DIRECTORY_SEPARATOR . 'background.' . $ext;
            if (file_exists($path)) {
                $bgFile = 'assets/images/background.' . $ext;
                break;
            }
        }

        return view('admin.backgrounds.index', ['bgFile' => $bgFile]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:5120', // max 5MB
        ]);

        $file = $request->file('photo');
        $ext = Str::lower($file->getClientOriginalExtension());
        if (!in_array($ext, ['jpg','jpeg','png','webp'])) {
            $ext = 'jpg';
        }

        $dir = public_path('assets/images');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // remove previous background.* files
        foreach (['jpg','jpeg','png','webp'] as $e) {
            $old = $dir . DIRECTORY_SEPARATOR . 'background.' . $e;
            if (file_exists($old)) {
                @unlink($old);
            }
        }

        $target = $dir . DIRECTORY_SEPARATOR . 'background.' . $ext;
        $file->move($dir, 'background.' . $ext);

        return redirect()->route('admin.background.index')->with('success', 'Background uploaded successfully.');
    }

    public function destroy(Request $request)
    {
        $dir = public_path('assets/images');
        $deleted = false;
        foreach (['jpg','jpeg','png','webp'] as $e) {
            $old = $dir . DIRECTORY_SEPARATOR . 'background.' . $e;
            if (file_exists($old)) {
                @unlink($old);
                $deleted = true;
            }
        }

        if ($deleted) {
            return redirect()->route('admin.background.index')->with('success', 'Background removed.');
        }
        return redirect()->route('admin.background.index')->with('warning', 'No background to remove.');
    }
}


