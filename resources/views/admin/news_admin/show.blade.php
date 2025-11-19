@extends('admin.layouts.app')
@section('title', $news->title)
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h1 class="mb-4 text-3xl font-bold">{{ $news->title }}</h1>

                <div class="mb-4 text-sm text-gray-600">
                    <span>Kategori: {{ $news->category->name }}</span> |
                    <span>Tanggal: {{ $news->created_at->format('d M Y') }}</span>
                </div>

                <div class="prose max-w-none">
                    {!! $news->content !!}
                </div>

                <div class="mt-6 flex items-center justify-between border-t pt-4">
                    <a href="{{ route('admin.news.index') }}" style="background: gray; color white"
                        class="inline-block rounded bg-gray-200 px-4 py-2 hover:bg-gray-300">
                        Berita Lainnya
                    </a>

                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-600">Dibuat oleh: {{ $news->createdBy?->name ?? '-' }}</div>

                        @auth
                            @if (auth()->user()->email === 'superadmin@smkn1talaga.sch.id')
                                <form method="POST" action="{{ route('admin.news.approve', $news->id) }}"
                                    class="flex items-center gap-2">
                                    @csrf
                                    <select name="status" class="rounded border px-2 py-1 text-sm">
                                        <option value="waiting"
                                            {{ ($news->approve ?? 'waiting') === 'waiting' ? 'selected' : '' }}>Menunggu
                                        </option>
                                        <option value="approve"
                                            {{ ($news->approve ?? 'waiting') === 'approve' ? 'selected' : '' }}>Setujui</option>
                                    </select>
                                    <button type="submit" class="bg-custom-500 rounded px-3 py-1 text-sm text-white">Ubah
                                        Status</button>
                                </form>
                            @else
                                @if (($news->approve ?? 'waiting') !== 'approve')
                                    <span class="rounded bg-yellow-100 px-3 py-1 text-sm text-yellow-800">Menunggu
                                        Persetujuan</span>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
