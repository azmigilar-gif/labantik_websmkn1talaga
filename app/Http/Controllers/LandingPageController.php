<?php

namespace App\Http\Controllers;

use App\Models\CoreExpertiseConcentration;
use App\Models\S_Contact;
use App\Models\S_Extrakulikuler;
use App\Models\S_Mitra;
use App\Models\S_Menu;
use App\Models\S_News;
use App\Models\S_Profile;
use App\Models\S_VisionMission;

class LandingPageController extends Controller
{
    public function index()
    {
        $menus = S_Menu::latest()->get();

        $visionmissions = S_VisionMission::with('menu')->get();
        $profiles = S_Profile::with('menu')->get();
    // Only fetch news that have been approved for public display
    $news = S_News::with('categories')->where('approve', 'approve')->latest()->paginate(5);
        $expertiseConcentrations = CoreExpertiseConcentration::all();

        $expertiseConcentrations->each(function ($item) {
            $item->menu = 'section-konsentrasi';
        });


        $extrakurikulers = S_Extrakulikuler::where('approve', 'approve')->get();
        $mitras = S_Mitra::orderBy('created_at', 'desc')->get();
        $contacts = S_Contact::all();
        return view('landing', compact('menus',  'visionmissions', 'profiles', 'news', 'expertiseConcentrations', 'extrakurikulers', 'mitras', 'contacts'));
    }
}
