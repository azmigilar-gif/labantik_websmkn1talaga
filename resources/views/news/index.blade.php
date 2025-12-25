@extends('layouts.app')

@section('title', 'SMKN 1 Talaga')

@section('content')
    <div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
        <div class="group-data-[sidebar-size=sm]:min-h-sm dark:bg-zink-800 relative min-h-screen bg-slate-50">
            <div
                class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-4 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-4 group-data-[navbar=bordered]:pt-6 group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-6 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">
                <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

                    <!-- Breadcrumb -->
                    <div class="flex flex-col gap-2 py-20 md:flex-row md:items-center print:hidden">
                        <div class="grow">
                            <h5 class="text-16">Index Berita</h5>
                        </div>
                        <ul class="flex shrink-0 items-center gap-2 text-sm font-normal">
                            <li
                                class="before:font-remix dark:text-zink-200 relative before:absolute before:-top-[3px] before:text-[18px] before:text-slate-400 before:content-['\ea54'] ltr:pr-4 ltr:before:-right-1 rtl:pl-4 rtl:before:-left-1">
                                <a href="/" class="dark:text-zink-200 text-slate-400">Landing Page</a>
                            </li>
                            <li class="dark:text-zink-100 text-slate-700">
                                Index Berita
                            </li>
                        </ul>
                    </div>

                    <!-- Filter Dropdown -->
                    <div class="mb-5">
                        <div class="dropdown relative inline-block">
                            <button type="button"
                                class="dropdown-toggle btn border-slate-500 bg-slate-500 text-white hover:bg-slate-600 focus:bg-slate-600 inline-flex items-center gap-2"
                                id="dropdownMenuForm" data-bs-toggle="dropdown">
                                <i data-lucide="filter" class="size-4"></i>
                                <span>Filter Kategori</span>
                                <i data-lucide="chevron-down" class="size-4"></i>
                            </button>

                            <div class="dropdown-menu absolute z-50 mt-1 hidden w-56 rounded-md bg-white shadow-lg border border-slate-200 py-1"
                                aria-labelledby="dropdownMenuForm">
                                <!-- All Categories Option -->
                                <a href="{{ route('news.index') }}"
                                    class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 transition-colors {{ !request('category') ? 'bg-slate-50 font-medium' : '' }}">
                                    <i data-lucide="layout-grid" class="inline-block size-4 mr-2 text-slate-500"></i>
                                    Semua Kategori
                                </a>

                                <div class="border-t border-slate-200 my-1"></div>

                                <!-- Category Options -->
                                @foreach ($categories as $cat)
                                    <a href="{{ route('news.index', ['category' => $cat->id]) }}"
                                        class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 transition-colors {{ request('category') == $cat->id ? 'bg-slate-50 font-medium' : '' }}">
                                        <i data-lucide="tag" class="inline-block size-4 mr-2 text-slate-500"></i>
                                        {{ ucfirst($cat->name) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- News Grid -->
                    <div class="mb-5 grid grid-cols-1 gap-x-5 gap-y-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($news as $item)
                            <a href="{{ route('news.show', $item->id) }}" class="block group">
                                <div
                                    class="flex h-[450px] flex-col overflow-hidden mt-5 rounded-lg bg-white shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

                                    <!-- Image Container -->
                                    <div class="relative h-48 flex-shrink-0 overflow-hidden bg-gray-100">
                                        @php
                                            $firstImgSrc = null;
                                            if (!empty($item->content)) {
                                                if (
                                                    preg_match('/<img[^>]+src="([^">]+)"/i', $item->content, $matches)
                                                ) {
                                                    $firstImgSrc = $matches[1];
                                                }
                                            }
                                        @endphp

                                        <img src="{{ $firstImgSrc ?? asset('assets/images/default-news.png') }}"
                                            alt="{{ $item->title }}"
                                            class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                                            loading="lazy" />
                                    </div>

                                    <!-- Content Container -->
                                    <div class="flex min-h-0 flex-1 flex-col overflow-hidden p-4">

                                        <!-- Title -->
                                        <h3
                                            class="mb-3 h-14 flex-shrink-0 overflow-hidden text-lg font-semibold leading-tight text-gray-900 group-hover:text-slate-700 transition-colors">
                                            <span class="line-clamp-2">{{ $item->title }}</span>
                                        </h3>

                                        <!-- Meta Information -->
                                        <div class="min-h-0 flex-1 overflow-hidden">
                                            <div class="flex flex-col gap-2 text-sm text-gray-600">

                                                <!-- Category -->
                                                @if ($item->category)
                                                    <div class="flex items-start gap-2">
                                                        <i data-lucide="tag"
                                                            class="size-4 flex-shrink-0 text-slate-500 mt-0.5"></i>
                                                        <span
                                                            class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-custom-100 border-custom-200 text-custom-500 dark:bg-custom-500/20 dark:border-custom-500/20">{{ $item->category->name }}</span>
                                                    </div>
                                                @endif

                                                <!-- Date -->
                                                <div class="flex items-start gap-2">
                                                    <i data-lucide="calendar"
                                                        class="size-4 flex-shrink-0 text-slate-500 mt-0.5"></i>
                                                    <span
                                                        class="truncate">{{ $item->created_at->format('l, d F Y') }}</span>
                                                </div>

                                                <!-- Author -->
                                                @if ($item->created_by && $item->createdBy)
                                                    <div class="flex items-start gap-2">
                                                        <i data-lucide="user"
                                                            class="size-4 flex-shrink-0 text-slate-500 mt-0.5"></i>
                                                        <span class="truncate">{{ $item->createdBy->name }}</span>
                                                    </div>
                                                @endif

                                                <!-- Preview -->
                                                <div class="flex items-start gap-2">
                                                    <i data-lucide="file-text"
                                                        class="size-4 flex-shrink-0 text-slate-500 mt-0.5"></i>
                                                    <span class="line-clamp-3 min-w-0 flex-1">
                                                        {{ Str::limit(strip_tags($item->content), 100, '...') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mb-5 flex flex-col items-center md:flex-row">
                        <div class="mb-4 grow md:mb-0">
                            <p class="dark:text-zink-200 text-slate-500">
                                Menampilkan <b>{{ $news->firstItem() }}</b> sampai <b>{{ $news->lastItem() }}</b> dari
                                <b>{{ $news->total() }}</b> hasil
                            </p>
                        </div>
                        <ul class="flex shrink-0 flex-wrap items-center gap-2">

                            <!-- Previous Button -->
                            <li>
                                <a href="{{ $news->previousPageUrl() }}"
                                    class="dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 {{ $news->onFirstPage() ? 'disabled cursor-not-allowed text-slate-400 dark:text-zink-300' : 'cursor-pointer' }} inline-flex h-8 items-center justify-center rounded border border-slate-200 bg-white px-3 text-slate-500 transition-all duration-150 ease-linear">
                                    <i class="mr-1 size-4 rtl:rotate-180" data-lucide="chevron-left"></i>
                                    Prev
                                </a>
                            </li>

                            <!-- Page Numbers -->
                            @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                <li>
                                    <a href="{{ $url }}"
                                        class="dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 {{ $page == $news->currentPage() ? 'active' : '' }} [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 inline-flex size-8 cursor-pointer items-center justify-center rounded border border-slate-200 bg-white text-slate-500 transition-all duration-150 ease-linear [&.active]:text-white dark:[&.active]:text-white">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach

                            <!-- Next Button -->
                            <li>
                                <a href="{{ $news->nextPageUrl() }}"
                                    class="dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 {{ !$news->hasMorePages() ? 'disabled cursor-not-allowed text-slate-400 dark:text-zink-300' : 'cursor-pointer' }} inline-flex h-8 items-center justify-center rounded border border-slate-200 bg-white px-3 text-slate-500 transition-all duration-150 ease-linear">
                                    Next
                                    <i class="ml-1 size-4 rtl:rotate-180" data-lucide="chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
