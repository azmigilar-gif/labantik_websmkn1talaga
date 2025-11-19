<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoreExpertiseConcentration;
use App\Models\S_ExpertiseConcentration;
use App\Models\S_Menu;

class ExpertiseController extends Controller
{
    /**
     * Display the description for a program (by slug).
     */
    public function show($slug)
    {
        $menus = S_Menu::latest()->get();

        $core = CoreExpertiseConcentration::where('slug', $slug)->firstOrFail();

        // load s_expertise_concentration record if exists
        $s = S_ExpertiseConcentration::where('id_concentrations', $core->id)->first();

        return view('expertise.show', compact('core', 's', 'menus'));
    }
}
