@extends('layouts.app')

@section('title', $news->title ?? 'Berita')

@section('content')

    <section class="py-32">
        <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
            <div class="grid grid-cols-1 gap-10 gap-x-5 lg:grid-cols-12">

                <!-- Konten Utama Berita (Kiri) -->
                <main class="lg:col-span-8">
                    <div class="mb-4 text-sm text-slate-500">
                        @if ($news->category || $news->categories)
                            <span class="rounded bg-sky-100 px-2 py-1 text-sky-600">
                                {{ $news->category->name ?? ($news->categories->name ?? 'Tanpa Kategori') }}
                            </span>
                        @endif
                        <span class="ml-2">{{ $news->created_at->translatedFormat('d F Y') }} ·
                            {{ $news->created_at->diffForHumans() }} · {{ $news->createdBy?->name ?? '-' }}</span>
                    </div>

                    <h1 class="dark:text-zink-100 mb-6 text-3xl font-bold text-slate-800">{{ $news->title }}</h1>

                    @if (!empty($news->photo))
                        @php
                            $p = $news->photo;
                            if (filter_var($p, FILTER_VALIDATE_URL)) {
                                $imgUrl = $p;
                            } elseif (preg_match('#^assets/#', $p) || preg_match('#^public/assets/#', $p)) {
                                $imgUrl = asset(preg_replace('#^public/#', '', $p));
                            } else {
                                $rel = preg_replace('#^storage/#', '', $p);
                                $imgUrl = route('public.files', ['path' => $rel]);
                            }
                        @endphp
                        <div class="mb-6">
                            <img src="{{ $imgUrl }}" alt="{{ $news->title }}" class="w-full rounded"
                                onerror="this.src='{{ asset('assets/images/default-news.png') }}'">
                        </div>
                    @endif

                    <div class="prose dark:text-zink-200 max-w-none text-slate-700">
                        {!! $news->content !!}
                    </div>
                </main>

                <!-- Sidebar Kanan: Kategori -->
                <aside class="hidden lg:block lg:col-span-4">
                    <div class="sticky top-24">
                        <!-- Kategori -->
                        <div
                            class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm dark:border-zink-600 dark:bg-zink-800">
                            <div
                                class="border-b border-slate-200 bg-slate-50 px-6 py-4 dark:border-zink-600 dark:bg-zink-700">
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-zink-100">Kategori</h3>
                            </div>
                            <div class="p-4">
                                <div class="space-y-1">
                                    @php
                                        $categories = \App\Models\S_Categories::withCount([
                                            'news' => function ($query) {
                                                $query->where('approve', 'approve'); // atau where('status', 'approved') sesuai struktur database Anda
                                            },
                                        ])->get();
                                    @endphp

                                    @foreach ($categories as $cat)
                                        <a href="{{ route('news.index', ['category' => $cat->slug ?? $cat->id]) }}"
                                            class="flex items-center justify-between rounded-lg px-4 py-3 text-sm text-slate-600 transition hover:bg-sky-50 hover:text-sky-600 dark:text-zink-200 dark:hover:bg-zink-700 {{ request('category') == ($cat->slug ?? $cat->id) ? 'bg-sky-50 font-medium text-sky-600' : '' }}">
                                            <span>{{ $cat->name }}</span>
                                            <span
                                                class="ml-2 rounded-full bg-slate-100 px-2.5 py-0.5 text-xs text-slate-600 dark:bg-zink-600 dark:text-zink-300">
                                                {{ $cat->news_count }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
            <hr>
            <!-- Berita Terbaru (Full Width Below Content) -->
            <div class="mt-16">
                <div class="mb-8 flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-zink-100">Berita Terbaru</h2>
                </div>

                @php
                    $latestNews = \App\Models\S_News::where('id', '!=', $news->id)
                        ->where('approve', 'approve')
                        ->latest()
                        ->take(5)
                        ->get();
                @endphp

                @if ($latestNews->count() > 0)
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
                        @foreach ($latestNews as $item)
                            <a href="{{ route('news.show', $item->slug ?? $item->id) }}"
                                class="group block overflow-hidden rounded-lg border border-slate-200 bg-white transition hover:border-sky-300 hover:shadow-lg dark:border-zink-600 dark:bg-zink-800 dark:hover:border-sky-500">
                                @php
                                    $firstImgSrc = null;
                                    if (!empty($item->content)) {
                                        if (preg_match('/<img[^>]+src="([^">]+)"/i', $item->content, $matches)) {
                                            $firstImgSrc = $matches[1];
                                        }
                                    }
                                @endphp
                                <div class="aspect-video w-full overflow-hidden">
                                    <img src="{{ $firstImgSrc }}" alt="{{ $item->title }}"
                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                        onerror="this.src='{{ asset('assets/images/default-news.png') }}'">
                                </div>

                                <div class="p-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-zink-400">
                                        <i data-lucide="calendar" class="h-3 w-3"></i>
                                        <span>{{ $item->created_at->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <h2
                                        class="mt-2 line-clamp-2 text-sm font-semibold leading-snug text-slate-800 group-hover:text-sky-600 dark:text-zink-100 dark:group-hover:text-sky-400">
                                        {{ Str::limit(strip_tags($item->content), 50, '...') }}
                                    </h2>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div
                        class="rounded-lg border border-slate-200 bg-white p-12 text-center dark:border-zink-600 dark:bg-zink-800">
                        <p class="text-slate-500 dark:text-zink-400">Tidak ada berita terbaru</p>
                    </div>
                @endif
            </div>

            <!-- Berita Lainnya Button -->
            <div class="mt-8 flex justify-center">
                <a href="{{ route('news.index') }}"
                    class="dark:bg-zink-700 inline-flex items-center gap-2 rounded border border-slate-500 bg-white px-6 py-3 text-slate-500 hover:border-slate-600 hover:bg-slate-600 hover:text-white focus:border-slate-600 focus:bg-slate-600 focus:text-white focus:ring focus:ring-slate-100 active:border-slate-600 active:bg-slate-600 active:text-white active:ring active:ring-slate-100 dark:ring-slate-400/20 dark:hover:bg-slate-500 dark:focus:bg-slate-500">
                    <span>Berita Lainnya</span>
                    <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>
            </div>
        </div>
    </section>

@endsection
