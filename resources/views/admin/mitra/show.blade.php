@extends('admin.layouts.app')
@section('title', $m->name)
@section('content')
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu px-4 pt-[calc(theme('spacing.header')_*_1)]">
        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h1 class="mb-4 text-3xl font-bold">{{ $m->name }}</h1>

                @if ($m->photo)
                    @php
                        $p = $m->photo;
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
                        <img src="{{ $imgUrl }}" alt="{{ $m->name }}" class="max-w-2xl rounded">
                    </div>
                @endif

                <div class="mt-6 flex items-center justify-between border-t pt-4">
                    <a href="{{ route('admin.mitra.index') }}" class="inline-block rounded bg-gray-200 px-4 py-2">Kembali ke
                        Daftar Mitra</a>
                </div>
            </div>
        </div>
    </div>
@endsection
