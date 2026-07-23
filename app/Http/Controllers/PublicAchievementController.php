<?php

namespace App\Http\Controllers;

use App\Models\S_Achievement;
use App\Models\S_Menu;
use Illuminate\Http\Request;

class PublicAchievementController extends Controller
{
    public function index(Request $request)
    {
        $menus = S_Menu::latest()->get();

        $query = S_Achievement::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $achievements = $query->latest('date')->paginate(12)->withQueryString();

        return view('achievement.index', compact('achievements', 'menus'));
    }

    public function show($id)
    {
        $achievement = S_Achievement::findOrFail($id);
        $menus = S_Menu::latest()->get();

        return view('achievement.show', compact('achievement', 'menus'));
    }
}
