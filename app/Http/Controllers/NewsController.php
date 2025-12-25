<?php

namespace App\Http\Controllers;

use App\Models\S_Categories;
use App\Models\S_News;
use App\Models\S_Menu;
use Illuminate\Support\Str;
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
