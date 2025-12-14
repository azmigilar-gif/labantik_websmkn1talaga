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
use App\Models\Gallery;
use App\Models\S_Submenu;
use App\Support\SubmenuData;


class LandingPageController extends Controller
{
    public function index()
    {
        $menus = S_Menu::latest()->get();


        $visionmissions = S_VisionMission::with('menu')->get();
        $profiles = S_Profile::with('menu')->get();
        // Only fetch news that have been approved for public display
        $news = S_News::with('category')->where('approve', 'approve')->latest()->paginate(9);
        $expertiseConcentrations = CoreExpertiseConcentration::all();

        $expertiseConcentrations->each(function ($item) {
            $item->menu = 'section-konsentrasi';
        });


        $extrakurikulers = S_Extrakulikuler::where('approve', 'approve')->get();
        $mitras = S_Mitra::orderBy('created_at', 'desc')->get();
        $contacts = S_Contact::all();

        // Recent galleries for landing page (show latest 6)
        $galleries = Gallery::latest()->get();
        return view('landing', compact('menus',  'visionmissions', 'profiles', 'news', 'expertiseConcentrations', 'extrakurikulers', 'mitras', 'contacts', 'galleries'));
    }


    public function show($url)
    {
        $menus = S_Menu::latest()->get();
        $submenu = S_Submenu::with('viewName', 'modelKey', 'redirectTo')
            ->where('url', $url)
            ->firstOrFail();

        // 1. Redirect kalau ada
        if ($submenu->redirectTo && !empty($submenu->redirectTo->slug)) {
            return redirect($submenu->redirectTo->slug);
        }

        // 2. Ambil data (kalau perlu)
        $data = null;
        if ($submenu->modelKey && !empty($submenu->modelKey->slug)) {
            $map = SubmenuData::map();

            if (isset($map[$submenu->modelKey->slug])) {
                $modelClass = $map[$submenu->modelKey->slug];
                $data = $modelClass::all();
            }
        }

        // 3. Render view
        if (!$submenu->viewName || empty($submenu->viewName->slug)) {
            abort(404, 'View name tidak ditemukan untuk submenu ini.');
        }

        $viewPath = $submenu->viewName->slug;

        if (!view()->exists($viewPath)) {
            abort(404, "View '{$viewPath}' tidak ditemukan di resources/views/");
        }

        return view($viewPath, compact('submenu', 'data', 'menus'));
    }
}
