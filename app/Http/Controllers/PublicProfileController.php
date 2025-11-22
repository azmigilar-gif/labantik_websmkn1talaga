<?php

namespace App\Http\Controllers;

use App\Models\S_Profile;
use App\Models\S_Menu;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show($id)
    {
        $menus = S_Menu::latest()->get();
        $profile = S_Profile::with('menu')->findOrFail($id);
        return view('profiles.show', compact('profile', 'menus'));
    }
}
