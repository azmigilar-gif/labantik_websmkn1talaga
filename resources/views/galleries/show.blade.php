@extends('layouts.app')

@section('title', $galleries->title ?? 'Galeri')

@section('content')
    <section class="py-32">
        <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
            <div class="mx-auto xl:max-w-4xl">
                {{-- Header Info - Centered --}}
                <div class="mb-4 text-center text-sm text-slate-500">
                    @if ($galleries->type)
                        <span
                            class="{{ $galleries->type == 'photo' ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-600' }} rounded px-2 py-1">
                            {{ $galleries->type == 'photo' ? 'Foto' : 'Video' }}
                        </span>
                    @endif
                    <span class="ml-2">
                        {{ $galleries->created_at->format('d M Y') }} ·
                        {{ $galleries->created_at->diffForHumans() }}
                        @if ($galleries->createdBy)
                            · {{ $galleries->createdBy->name }}
                        @endif
                    </span>
                </div>

                {{-- Title - Centered --}}
                <h1 class="dark:text-zink-100 mb-8 text-center text-3xl font-bold text-slate-800">{{ $galleries->title }}
                </h1>

                {{-- Embed Content --}}
                <div class="mb-8 flex justify-center">
                    @if ($galleries->embed_html)
                        @if ($galleries->type == 'photo')
                            {{-- Instagram Embed - Centered --}}
                            <div class="mx-auto w-full max-w-lg">
                                <div class="flex items-center justify-center">
                                    {!! $galleries->embed_html !!}
                                </div>
                            </div>
                        @elseif ($galleries->type == 'video')
                            {{-- YouTube Embed - Centered with max width --}}
                            <div class="mx-auto w-full max-w-4xl">
                                <div class="relative w-full" style="padding-bottom: 56.25%;">
                                    <div class="absolute inset-0">
                                        {!! $galleries->embed_html !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @elseif ($galleries->file_path)
                        {{-- Uploaded Image - Centered --}}
                        <div class="flex justify-center">
                            <img src="{{ asset('storage/' . $galleries->file_path) }}" alt="{{ $galleries->title }}"
                                class="h-auto max-w-full rounded-lg shadow-lg">
                        </div>
                    @else
                        {{-- No Content --}}
                        <div class="flex w-full justify-center py-12">
                            <div class="text-center">
                                <i data-lucide="image-off" class="mx-auto mb-4 h-16 w-16 text-slate-400"></i>
                                <p class="text-slate-500">Konten tidak tersedia</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Description - Centered --}}
                @if ($galleries->description)
                    <div class="prose dark:text-zink-200 mx-auto mb-6 max-w-none text-center text-slate-700">
                        <h3 class="mb-3 text-xl font-semibold">Deskripsi</h3>
                        <p class="mx-auto max-w-3xl text-justify">{{ $galleries->description }}</p>
                    </div>
                @endif

                {{-- Caption - Centered --}}
                @if ($galleries->caption)
                    <div class="prose dark:text-zink-200 mb-6 max-w-none text-center text-slate-700">
                        <p class="italic text-slate-600">{{ $galleries->caption }}</p>
                    </div>
                @endif

                {{-- Back Button - Centered --}}
                <div class="mt-8 flex justify-center">
                    <a href="{{ $backUrl ?? route('galleries.index') }}"
                        class="dark:bg-zink-700 inline-flex items-center gap-2 rounded border border-slate-500 bg-white px-6 py-3 text-slate-500 transition-all duration-200 hover:border-slate-600 hover:bg-slate-600 hover:text-white focus:border-slate-600 focus:bg-slate-600 focus:text-white focus:ring focus:ring-slate-100 active:border-slate-600 active:bg-slate-600 active:text-white active:ring active:ring-slate-100 dark:ring-slate-400/20 dark:hover:bg-slate-500 dark:focus:bg-slate-500">
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        <span>Kembali ke Galeri</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Custom CSS untuk Instagram Embed --}}
    <style>
        /* Center Instagram embed */
        .instagram-media {
            margin: 0 auto !important;
        }

        /* Ensure blockquote is centered */
        blockquote.instagram-media {
            margin: 0 auto !important;
            max-width: 540px !important;
        }
    </style>
@endsection
