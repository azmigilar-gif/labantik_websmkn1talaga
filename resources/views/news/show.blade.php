@extends('layouts.app')

@section('title', $news->title ?? 'Berita')

@section('content')

    <section class="py-32">
        <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
            <div class="mx-auto xl:max-w-3xl">
                <div class="mb-4 text-sm text-slate-500">
                    @if ($news->category || $news->categories)
                        <span class="rounded bg-sky-100 px-2 py-1 text-sky-600">
                            {{ $news->category->name ?? ($news->categories->name ?? 'Tanpa Kategori') }}
                        </span>
                    @endif
                    <span class="ml-2">{{ $news->created_at->format('d M Y') }} ·
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

                <div class="mt-4 flex justify-end">
                    <a href="{{ $backUrl ?? route('news.index') }}"
                        class="dark:bg-zink-700 inline-flex items-center gap-2 rounded border border-slate-500 bg-white px-4 py-2 text-slate-500 hover:border-slate-600 hover:bg-slate-600 hover:text-white focus:border-slate-600 focus:bg-slate-600 focus:text-white focus:ring focus:ring-slate-100 active:border-slate-600 active:bg-slate-600 active:text-white active:ring active:ring-slate-100 dark:ring-slate-400/20 dark:hover:bg-slate-500 dark:focus:bg-slate-500">
                        <span>Berita Lainnya</span>
                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
