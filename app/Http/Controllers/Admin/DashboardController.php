<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\S_News;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $weeksData = $this->getNewsStatisticsByWeek();
        $countNews = S_News::count();
        $countNewsPending = S_News::where('approve', 'waiting')->count();
        $countNewsApprove = S_News::where('approve', 'approve')->count();
        $countExtrakurikuler = \App\Models\S_Extrakulikuler::count();
        $countMitra = \App\Models\S_Mitra::count();
        $countGallery = \App\Models\Gallery::count();
        $countMenu = \App\Models\S_Menu::count();

        // Core school entities
        $countStudents = \App\Models\RefStudent::whereHas('academicYears', function ($query) {
            $query->where('status', 'Active');
        })->count();
        $countEmployees = \App\Models\CoreEmployee::count();
        $countConcentrations = \App\Models\CoreExpertiseConcentration::count();

        return view('admin.dashboard', compact(
            'weeksData',
            'countNews',
            'countNewsApprove',
            'countNewsPending',
            'countExtrakurikuler',
            'countMitra',
            'countGallery',
            'countMenu',
            'countStudents',
            'countEmployees',
            'countConcentrations'
        ));
    }

    private function getNewsStatisticsByWeek()
    {
        $weeks = [];
        $published = [];
        $pending = [];

        // Start 7 weeks ago (so total is 8 weeks including the current week)
        $startDate = Carbon::now()->subWeeks(7)->startOfWeek();

        for ($i = 0; $i < 8; $i++) {
            $startOfWeek = $startDate->copy()->addWeeks($i)->startOfWeek();
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            // Format date range: e.g., "20 Jul - 26 Jul"
            $label = $startOfWeek->locale('id')->translatedFormat('d M') . ' - ' . $endOfWeek->locale('id')->translatedFormat('d M');
            $weeks[] = $label;

            $publishingCount = S_News::where('approve', 'approve')
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->count();

            $pendingCount = S_News::where('approve', 'waiting')
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->count();

            $published[] = $publishingCount;
            $pending[] = $pendingCount;
        }

        return [
            'weeks' => $weeks,
            'published' => $published,
            'pending' => $pending,
        ];
    }
}
