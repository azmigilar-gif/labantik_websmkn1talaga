<?php

namespace App\Http\Controllers;

use App\Models\CoreExpertiseConcentration;
use App\Models\Gallery;
use App\Models\S_Achievement;
use App\Models\S_Contact;
use App\Models\S_Extrakulikuler;
use App\Models\S_Menu;
use App\Models\S_Mitra;
use App\Models\S_News;
use App\Models\S_Profile;
use App\Models\S_Submenu;
use App\Models\S_VisionMission;

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

        // Latest achievements
        $achievements = S_Achievement::latest('date')->take(6)->get();

        // Dynamic Hero Settings & Badge Texts
        $heroSettings = \App\Models\S_HeroSetting::getSettings();

        // Dynamic stats from DB
        $latestAcademicYear = \App\Models\RefStudentAcademicYear::max('academic_year');
        $studentCount = $latestAcademicYear ? \App\Models\RefStudentAcademicYear::where('academic_year', $latestAcademicYear)->count() : 0;
        if ($studentCount === 0) {
            $studentCount = 1500; // fallback
        }

        $employeeCount = \App\Models\CoreEmployee::count();
        if ($employeeCount === 0) {
            $employeeCount = 80; // fallback
        }

        $mitraCount = S_Mitra::count();
        if ($mitraCount === 0) {
            $mitraCount = 30; // fallback
        }

        return view('landing', compact('menus', 'visionmissions', 'profiles', 'news', 'expertiseConcentrations', 'extrakurikulers', 'mitras', 'contacts', 'galleries', 'achievements', 'heroSettings', 'studentCount', 'employeeCount', 'mitraCount'));
    }

    public function show($url)
    {
        $menus = S_Menu::latest()->get();
        $submenu = S_Submenu::where('url', $url)
            ->firstOrFail();

        // 1. Redirect untuk tipe Link Eksternal (URL)
        if ($submenu->type === 'url' && ! empty($submenu->external_url)) {
            return redirect($submenu->external_url);
        }

        // 2. Redirect untuk tipe Modul Bawaan (Module)
        if ($submenu->type === 'module') {
            switch ($submenu->module_name) {
                case 'news':
                    return redirect()->route('news.index');
                case 'gallery':
                    return redirect()->route('galleries.index');
                case 'profil':
                    return redirect('/#section-profil');
                case 'visi-misi':
                    return redirect('/#section-visimisi');
                case 'expertise':
                    return redirect('/#section-konsentrasi');
                case 'ekskul':
                    return redirect('/#section-ekskul');
                case 'contact':
                    return redirect('/#section-kontak');
                default:
                    return redirect('/');
            }
        }

        // 3. Render untuk tipe Halaman Kustom (Custom Content)
        if ($submenu->type === 'custom' || ! empty($submenu->content)) {
            return view('submenu.show_custom', compact('submenu', 'menus'));
        }

        abort(404, 'Halaman tidak ditemukan.');
    }
}
