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

                    <div class="mb-5 grid grid-cols-1 gap-x-5 gap-y-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($news as $item)
                            <a href="{{ route('news.show', $item->id) }}"
                                class="block">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                    <!-- Image Container -->
                                    <div class="relative">
                                        @php
                                            $firstImgSrc = null;
                                            if (!empty($item->content)) {
                                                if (preg_match('/<img[^>]+src="([^">]+)"/i', $item->content, $matches)) {
                                                    $firstImgSrc = $matches[1];
                                                }
                                            }
                                        @endphp

                                        <img
                                            src="{{ $firstImgSrc ?? asset('assets/images/default-news.png') }}"
                                            alt="{{ $item->title }}"
                                            class="w-full h-48 object-cover"
                                        />

                                        @if($item->category)
                                            <span class="absolute top-3 right-3 bg-gray-800 text-white text-xs font-medium px-3 py-1 rounded">
                                                {{ $item->category->name }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Content Container -->
                                    <div class="p-4">
                                        <!-- Title -->
                                        <h3 class="text-gray-900 font-semibold text-lg mb-3 leading-tight line-clamp-2">
                                            {{ $item->title }}
                                        </h3>

                                        <!-- Meta Information -->
                                        <table class="text-sm text-gray-600 w-full">
                                            <tbody>
                                                <!-- Date -->
                                                <tr>
                                                    <td class="text-cyan-500 pr-2 align-top w-6">📅</td>
                                                    <td class="pb-2">{{ $item->created_at->format('l, d F Y') }}</td>
                                                </tr>

                                                <!-- Author -->
                                                @if($item->created_by && $item->createdBy)
                                                <tr>
                                                    <td class="text-cyan-500 pr-2 align-top w-6">👤</td>
                                                    <td class="pb-2">{{ $item->createdBy->name }}</td>
                                                </tr>
                                                @endif

                                                <!-- Preview -->
                                                <tr>
                                                    <td class="text-cyan-500 pr-2 align-top w-6">📄</td>
                                                    <td class="line-clamp-2">{{ Str::limit(strip_tags($item->content), 80, '...') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
