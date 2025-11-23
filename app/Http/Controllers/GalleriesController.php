<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\S_Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleriesController extends Controller
{
    public function index()
    {
        $menus = S_Menu::latest()->get();

        $galleries = Gallery::latest()->paginate(6);

        return view('galleries.index', compact('galleries', 'menus'));
    }
    public function show($id)
    {

        $galleries = Gallery::findOrFail($id);

        // provide menus for navbar (landing page uses this as well)
        $menus = S_Menu::latest()->get();

        // determine a deterministic back URL:
        // - if user came from any /news path (index or paginated), return to news.index
        // - if user came from root (/) or root with hash (landing), return to landing (/)
        // - otherwise, attempt to use previous URL if internal; fallback to news.index
        $previous = url()->previous();
        $backUrl = route('galleries.index');

        if ($previous) {
            $prevPath = parse_url($previous, PHP_URL_PATH) ?: '/';

            // came from news listing (or other news pages)
            if (Str::startsWith($prevPath, '/galleries')) {
                $backUrl = route('galleries.index');
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

        return view('galleries.show', compact('galleries', 'menus', 'backUrl'));
    }
}

