<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\S_menu;

class ReportController extends Controller
{
    public function index(){

        $menus = S_Menu::latest()->get();
        return view("report.index", compact('menus'));
    }
    //
}
