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

        $news = $newsQuery->latest()->paginate(10)->withQueryString();

        return view('news.index', compact('news', 'menus', 'categories'));
    }



    /**
     * Display the specified resource.
     *
     * @param  mixed  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {

        $news = S_News::findOrFail($id);

        // provide menus for navbar (landing page uses this as well)
        $menus = S_Menu::latest()->get();

        // determine a deterministic back URL:
        // - if user came from any /news path (index or paginated), return to news.index
        // - if user came from root (/) or root with hash (landing), return to landing (/)
        // - otherwise, attempt to use previous URL if internal; fallback to news.index
        $previous = url()->previous();
        $backUrl = route('news.index');

        if ($previous) {
            $prevPath = parse_url($previous, PHP_URL_PATH) ?: '/';

            // came from news listing (or other news pages)
            if (Str::startsWith($prevPath, '/news')) {
                $backUrl = route('news.index');
            }
            // came from site root / (landing page)
            elseif ($prevPath === '/' || Str::startsWith($previous, url('/') . '#')) {
                $backUrl = url('/');
            }
            // internal other page -> allow returning there (but avoid looping to same show)
            else {
                $appHost = parse_url(config('app.url') ?: request()->getSchemeAndHttpHost(), PHP_URL_HOST);
                $prevHost = parse_url($previous, PHP_URL_HOST);
                $currentPath = '/' . trim(request()->path(), '/');
                if (($prevHost === $appHost || is_null($prevHost)) && trim($prevPath, '/') !== trim($currentPath, '/')) {
                    $backUrl = $previous;
                }
            }
        }

        return view('news.show', compact('news', 'menus', 'backUrl'));
    }
}
