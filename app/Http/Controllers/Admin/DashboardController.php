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

        $currentDate = Carbon::now();
        $startDate = Carbon::now()->subWeeks(8)->startOfWeek();

        $currentMonth = null;
        $weekInMonth = 0;

        for ($i = 0; $i < 8; $i++) {
            $startOfWeek = $startDate->copy()->addWeeks($i)->startOfWeek();
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            $monthName = $startOfWeek->locale('id')->translatedFormat('F');

            if ($currentMonth !== $monthName) {
                $currentMonth = $monthName;
                $weekInMonth = 1;

                $weeks[] = $monthName;
                $published[] = null;
                $pending[] = null;
            } else {
                $weekInMonth++;
            }

            $weeks[] = "Minggu ke-{$weekInMonth}";

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
