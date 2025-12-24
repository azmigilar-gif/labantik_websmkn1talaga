<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\S_menu;
use App\Models\S_Tags as Tag;
use App\Models\S_NewsLogs as NewsLog;

class ReportController extends Controller
{
    public function index()
    {
        $menus = S_Menu::latest()->get();
        return view('report.index', compact('menus'));
    }

    /**
     * Return JSON of tags and the number of distinct news that use each tag.
     * Response format: [{ product: 'TagName', nomor: 12 }, ...]
     */
    public function tagCounts(Request $request)
    {
        // Ambil data berita dengan tag berdasarkan tanggal created_at
        $logs = NewsLog::with('tag')
            ->select(
                DB::raw('DATE(created_at) as date'),
                's_tags_id',
                DB::raw('COUNT(DISTINCT s_news_id) as cnt')
            )
            ->whereHas('news', function ($query) {
                $query->where('approve', 'approve');
            })
            ->whereNotNull('s_tags_id')
            ->groupBy(DB::raw('DATE(created_at)'), 's_tags_id')
            ->orderBy('date', 'desc')
            ->get();

        // Group by date
        $grouped = $logs->groupBy('date')->map(function ($items, $date) {
            $tags = $items->map(function ($item) {
                return [
                    'product' => $item->tag->name ?? 'Unknown',
                    'nomor' => (int) $item->cnt,
                ];
            })->values();

            return [
                'date' => $date,
                'tags' => $tags,
            ];
        })->values();

        return response()->json($grouped);
    }
}
