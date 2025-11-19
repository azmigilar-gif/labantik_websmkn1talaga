@extends('layouts.app')

@section('title', 'SMKN 1 Talaga')

@section('content')
    <div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
        <div class="group-data-[sidebar-size=sm]:min-h-sm dark:bg-zink-800 relative min-h-screen bg-slate-50">
            <div
                class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-4 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-4 group-data-[navbar=bordered]:pt-6 group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-6 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">
                <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

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
                    <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-12">
                        <div class="dropdown relative">
                            <button type="button" class="dropdown-toggle btn border-slate-500 bg-slate-500 text-white"
                                id="dropdownMenuForm" data-bs-toggle="dropdown">
                                Filter <i data-lucide="sliders-horizontal" class="ml-1 inline-block size-4"></i>
                            </button>

                            <ul class="dropdown-menu absolute z-50 mt-1 hidden min-w-max rounded-md bg-white p-4 shadow-md"
                                aria-labelledby="dropdownMenuForm">

                                <form action="{{ route('news.index') }}" method="GET">
                                    <div class="mb-3">
                                        <label class="mb-2 inline-block text-base font-medium">Kategori</label>
                                        <select name="category" class="form-input border-slate-200 focus:border-slate-500">
                                            <option value="">Semua</option>

                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ request('category') == $cat->id ? 'selected' : '' }}>
                                                    {{ ucfirst($cat->name) }}
                                                </option>
                                            @endforeach
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

                    <div class="mb-5 grid grid-cols-1 gap-x-5 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-7">
                        @foreach ($news as $item)
                            <a href="{{ route('news.show', $item->id) }}"
                                class="card cursor-pointer transition-shadow duration-300 hover:shadow-lg">
                                <div class="card-body">
                                    <div class="group/gallery relative overflow-hidden rounded-md">
                                        @php
                                            $firstImgSrc = null;

                                            if (!empty($item->content)) {
                                                if (
                                                    preg_match('/<img[^>]+src="([^">]+)"/i', $item->content, $matches)
                                                ) {
                                                    $firstImgSrc = $matches[1]; // hanya ambil URL src
                                                }
                                            }
                                        @endphp

                                        <img src="{{ $firstImgSrc ?? asset('assets/images/default-news.png') }}"
                                            alt="news-image" class="h-48 w-full rounded-md object-cover">

                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-0 transition-all duration-300 ease-linear group-hover/gallery:opacity-50">
                                        </div>
                                        <div
                                            class="absolute bottom-0 left-3 right-3 opacity-0 transition-all duration-300 ease-linear group-hover/gallery:bottom-3 group-hover/gallery:opacity-100">
                                            <h5 class="font-normal text-white">{{ $item->title }}</h5>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <!-- Header: Created at (kiri) dan Name (kanan) -->
                                        <div
                                            class="dark:text-zink-200 mb-2 flex items-start justify-between text-xs text-slate-500">
                                            <p>{{ $item->created_at->diffForHumans() }}</p>
                                            <p>
                                                @if ($item->created_by)
                                                    {{ '@' . $item->createdBy->name }}
                                                @endif
                                            </p>
                                        </div>

                                        <!-- Description di tengah -->
                                        <div class="px-4">
                                            <p
                                                class="dark:text-zink-300 mb-3 text-justify text-sm leading-relaxed text-slate-600">
                                                {{ Str::limit(strip_tags($item->content), 100, '...') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mb-5 flex flex-col items-center md:flex-row">
                        <div class="mb-4 grow md:mb-0">
                            <p class="dark:text-zink-200 text-slate-500">
                                Showing <b>{{ $news->firstItem() }}</b> to <b>{{ $news->lastItem() }}</b> of
                                <b>{{ $news->total() }}</b> Results
                            </p>
                        </div>
                        <ul class="flex shrink-0 flex-wrap items-center gap-2">
                            {{-- Previous Button --}}
                            <li>
                                <a href="{{ $news->previousPageUrl() }}"
                                    class="dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 {{ $news->onFirstPage() ? 'disabled cursor-not-allowed text-slate-400 dark:text-zink-300' : 'cursor-pointer' }} inline-flex h-8 items-center justify-center rounded border border-slate-200 bg-white px-3 text-slate-500 transition-all duration-150 ease-linear">
                                    <i class="mr-1 size-4 rtl:rotate-180" data-lucide="chevron-left"></i> Prev
                                </a>
                            </li>

                            {{-- Page Numbers --}}
                            @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                <li>
                                    <a href="{{ $url }}"
                                        class="dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 {{ $page == $news->currentPage() ? 'active' : '' }} [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 inline-flex size-8 cursor-pointer items-center justify-center rounded border border-slate-200 bg-white text-slate-500 transition-all duration-150 ease-linear [&.active]:text-white dark:[&.active]:text-white">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach

                            {{-- Next Button --}}
                            <li>
                                <a href="{{ $news->nextPageUrl() }}"
                                    class="dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 {{ !$news->hasMorePages() ? 'disabled cursor-not-allowed text-slate-400 dark:text-zink-300' : 'cursor-pointer' }} inline-flex h-8 items-center justify-center rounded border border-slate-200 bg-white px-3 text-slate-500 transition-all duration-150 ease-linear">
                                    Next <i class="ml-1 size-4 rtl:rotate-180" data-lucide="chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
    </div>
@endsection
