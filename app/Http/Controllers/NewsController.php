<?php

namespace App\Http\Controllers;

use App\Models\S_Categories;
use App\Models\S_Menu;
use App\Models\S_News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $menus = S_Menu::latest()->get();

        // Ambil semua kategori dari tabel S_Categories
        $categories = S_Categories::select('id', 'name')->get();

        // Query dasar
        $newsQuery = S_News::where('approve', 'approve');

        // Filter kategori jika dipilih
        if ($request->filled('category')) {
            $newsQuery->where('s_category_id', $request->category);
        }

        // Filter pencarian kata kunci jika diisi
        if ($request->filled('search')) {
            $search = $request->search;
            $newsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter tag jika dipilih
        if ($request->filled('tag')) {
            $tagId = $request->tag;
            $newsQuery->whereHas('tags', function ($q) use ($tagId) {
                $q->where('s_tags.id', $tagId);
            });
        }

        $news = $newsQuery->latest()->paginate(12)->withQueryString();

        return view('news.index', compact('news', 'menus', 'categories'));
    }

    public function show($id)
    {

        $news = S_News::findOrFail($id);

        // provide menus for navbar (landing page uses this as well)
        $menus = S_Menu::latest()->get();

        return view('news.show', compact('news', 'menus'));
    }
}
