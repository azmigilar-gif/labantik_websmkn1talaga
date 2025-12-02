<?php

namespace App\Http\Controllers;

use App\Models\S_Extrakulikuler;
use App\Models\S_Menu;
use Illuminate\Http\Request;

class ExtracuricullarsController extends Controller
{
    public function show($id)
    {
        $menus = S_Menu::latest()->get();

        // load s_expertise_concentration record if exists
        $e = S_Extrakulikuler::where('id', $id)->first();

        return view('extrakurikulers.show', compact('e', 'menus'));
    }
}
