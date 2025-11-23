@extends('layouts.app')

@section('title', 'Galeri - SMKN 1 Talaga')

@section('content')
    <div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
        <div class="group-data-[sidebar-size=sm]:min-h-sm dark:bg-zink-800 relative min-h-screen bg-slate-50">
            <div
                class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-4 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-4 group-data-[navbar=bordered]:pt-6 group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-6 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">
                <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

                    <div class="flex flex-col gap-2 py-20 md:flex-row md:items-center print:hidden">
                        <div class="grow">
                            <h5 class="text-16">Galeri</h5>
                        </div>
                        <ul class="flex shrink-0 items-center gap-2 text-sm font-normal">
                            <li
                                class="before:font-remix dark:text-zink-200 relative before:absolute before:-top-[3px] before:text-[18px] before:text-slate-400 before:content-['\ea54'] ltr:pr-4 ltr:before:-right-1 rtl:pl-4 rtl:before:-left-1">
                                <a href="/" class="dark:text-zink-200 text-slate-400">Landing Page</a>
                            </li>
                            <li class="dark:text-zink-100 text-slate-700">
                                Galeri
                            </li>
                        </ul>
                    </div>

                    {{-- Filter Section --}}
                    <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-12">
                        <div class="dropdown relative">
                            <button type="button" class="dropdown-toggle btn border-slate-500 bg-slate-500 text-white"
                                id="dropdownMenuForm" data-bs-toggle="dropdown">
                                Filter <i data-lucide="sliders-horizontal" class="ml-1 inline-block size-4"></i>
                            </button>

                            <ul class="dropdown-menu absolute z-50 mt-1 hidden min-w-max rounded-md bg-white p-4 shadow-md"
                                aria-labelledby="dropdownMenuForm">
                                <form action="{{ route('galleries.index') }}" method="GET">
                                    <div class="mb-3">
                                        <label class="mb-2 inline-block text-base font-medium">Tipe</label>
                                        <select name="type" class="form-input border-slate-200 focus:border-slate-500">
                                            <option value="">Semua</option>
                                            <option value="photo" {{ request('type') == 'photo' ? 'selected' : '' }}>
                                                Foto
                                            </option>
                                            <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>
                                                Video
                                            </option>
                                        </select>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit"
                                            class="btn bg-green-500 px-3 py-1 text-white hover:bg-green-600">
                                            Terapkan <i data-lucide="move-right" class="ml-1 inline-block size-3"></i>
                                        </button>
                                    </div>
                                </form>
                            </ul>
                        </div>
                    </div>

                    {{-- Gallery Grid --}}
                    <div class="mb-5 grid grid-cols-1 gap-x-5 gap-y-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @forelse ($galleries as $item)
                            <a href="{{ route('galleries.show', $item->id) }}"
                                class="card cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                                <div class="card-body p-0">
                                    <div class="group/gallery relative overflow-hidden rounded-t-md bg-slate-100">

                                        {{-- Render actual embed as preview --}}
                                        @if ($item->embed_html)
                                            @if ($item->type == 'photo')
                                                {{-- Instagram Preview --}}
                                                <div class="relative"
                                                    style="aspect-ratio:1/1; overflow:hidden; pointer-events: none;">
                                                    <div style="transform: scale(1); transform-origin: center;">
                                                        {!! $item->embed_html !!}
                                                    </div>
                                                    {{-- Overlay untuk klik --}}
                                                    <div class="absolute inset-0 z-10"></div>
                                                </div>
                                            @elseif ($item->type == 'video')
                                                {{-- YouTube Preview --}}
                                                @php
                                                    $host = parse_url($item->embed_url, PHP_URL_HOST) ?: '';
                                                    $host = preg_replace('/^www\./', '', strtolower($host));

                                                    if (
                                                        str_contains($host, 'youtube') ||
                                                        str_contains($host, 'youtu.be')
                                                    ) {
                                                        if (
                                                            preg_match(
                                                                '/youtu\.be\/([^\?&\/]+)/i',
                                                                $item->embed_url,
                                                                $m,
                                                            )
                                                        ) {
                                                            $videoId = $m[1];
                                                        } elseif (
                                                            preg_match('/[\?&]v=([^\?&\/]+)/i', $item->embed_url, $m)
                                                        ) {
                                                            $videoId = $m[1];
                                                        } elseif (
                                                            preg_match('/embed\/([^\?&\/]+)/i', $item->embed_url, $m)
                                                        ) {
                                                            $videoId = $m[1];
                                                        } else {
                                                            $videoId = null;
                                                        }
                                                    } else {
                                                        $videoId = null;
                                                    }
                                                @endphp

                                                <div class="relative" style="aspect-ratio:16/9; overflow:hidden;">
                                                    @if ($videoId)
                                                        <img src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg"
                                                            alt="{{ $item->title }}" class="h-full w-full object-cover"
                                                            onerror="this.src='https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg'">
                                                        {{-- Play Button Overlay --}}
                                                        <div
                                                            class="absolute inset-0 flex items-center justify-center bg-black/20 transition-all group-hover/gallery:bg-black/40">
                                                            <div
                                                                class="rounded-full bg-red-600 p-4 transition-transform group-hover/gallery:scale-110">
                                                                <i data-lucide="play"
                                                                    class="h-8 w-8 fill-white text-white"></i>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <img src="{{ asset('assets/images/default-news.png') }}"
                                                            alt="{{ $item->title }}" class="h-full w-full object-cover">
                                                    @endif
                                                </div>
                                            @endif
                                        @else
                                            {{-- Default Image --}}
                                            <div class="relative" style="aspect-ratio:16/9; overflow:hidden;">
                                                <img src="{{ asset('assets/images/default-news.png') }}"
                                                    alt="{{ $item->title }}" class="h-full w-full object-cover">
                                            </div>
                                        @endif

                                        {{-- Hover Overlay --}}
                                        <div
                                            class="absolute inset-0 z-20 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent opacity-0 transition-all duration-300 ease-linear group-hover/gallery:opacity-100">
                                        </div>
                                        <div
                                            class="absolute bottom-0 left-3 right-3 z-30 pb-3 opacity-0 transition-all duration-300 ease-linear group-hover/gallery:opacity-100">
                                            <h5 class="line-clamp-2 text-sm font-medium text-white">{{ $item->title }}
                                            </h5>
                                        </div>

                                        {{-- Type Badge --}}
                                        <div class="absolute right-3 top-3 z-30">
                                            @if ($item->type == 'photo')
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full bg-blue-500 px-2.5 py-1 text-xs font-medium text-white shadow-lg">
                                                    <i data-lucide="image" class="h-3 w-3"></i> Foto
                                                </span>
                                            @elseif ($item->type == 'video')
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full bg-red-500 px-2.5 py-1 text-xs font-medium text-white shadow-lg">
                                                    <i data-lucide="video" class="h-3 w-3"></i> Video
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Card Content --}}
                                    <div class="p-4">
                                        <div
                                            class="dark:text-zink-200 mb-2 flex items-start justify-between text-xs text-slate-500">
                                            <p>{{ $item->created_at->diffForHumans() }}</p>
                                            @if ($item->created_by)
                                                <p class="text-right">{{ '@' . ($item->createdBy->name ?? 'Unknown') }}</p>
                                            @endif
                                        </div>

                                        <h6
                                            class="dark:text-zink-100 mb-2 line-clamp-2 text-base font-semibold text-slate-800">
                                            {{ $item->title }}
                                        </h6>

                                        @if ($item->description)
                                            <p
                                                class="dark:text-zink-300 line-clamp-2 text-sm leading-relaxed text-slate-600">
                                                {{ Str::limit(strip_tags($item->description), 80, '...') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full py-12 text-center">
                                <i data-lucide="image-off" class="mx-auto mb-4 h-16 w-16 text-slate-400"></i>
                                <p class="text-slate-500">Tidak ada galeri yang tersedia</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if ($galleries->hasPages())
                        <div class="mb-5 flex flex-col items-center md:flex-row">
                            <div class="mb-4 grow md:mb-0">
                                <p class="dark:text-zink-200 text-slate-500">
                                    Showing <b>{{ $galleries->firstItem() }}</b> to <b>{{ $galleries->lastItem() }}</b>
                                    of
                                    <b>{{ $galleries->total() }}</b> Results
                                </p>
                            </div>
                            <ul class="flex shrink-0 flex-wrap items-center gap-2">
                                {{-- Previous Button --}}
                                <li>
                                    <a href="{{ $galleries->previousPageUrl() }}"
                                        class="dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 {{ $galleries->onFirstPage() ? 'disabled cursor-not-allowed text-slate-400 dark:text-zink-300' : 'cursor-pointer' }} inline-flex h-8 items-center justify-center rounded border border-slate-200 bg-white px-3 text-slate-500 transition-all duration-150 ease-linear">
                                        <i class="mr-1 size-4 rtl:rotate-180" data-lucide="chevron-left"></i> Prev
                                    </a>
                                </li>

                                {{-- Page Numbers --}}
                                @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                                    <li>
                                        <a href="{{ $url }}"
                                            class="dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 {{ $page == $galleries->currentPage() ? 'active' : '' }} [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 inline-flex size-8 cursor-pointer items-center justify-center rounded border border-slate-200 bg-white text-slate-500 transition-all duration-150 ease-linear [&.active]:text-white dark:[&.active]:text-white">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endforeach

                                {{-- Next Button --}}
                                <li>
                                    <a href="{{ $galleries->nextPageUrl() }}"
                                        class="dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 {{ !$galleries->hasMorePages() ? 'disabled cursor-not-allowed text-slate-400 dark:text-zink-300' : 'cursor-pointer' }} inline-flex h-8 items-center justify-center rounded border border-slate-200 bg-white px-3 text-slate-500 transition-all duration-150 ease-linear">
                                        Next <i class="ml-1 size-4 rtl:rotate-180" data-lucide="chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
    </div>
@endsection
