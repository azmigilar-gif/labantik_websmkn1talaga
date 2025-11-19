@extends('admin.layouts.app')
@section('title', 'Lihat Deskripsi Keahlian')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-3xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Deskripsi: {{ $core->name }}</h2>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium">Nama Keahlian</label>
                    <div class="rounded border bg-slate-50 p-2">{{ $core->name }}</div>
                </div>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium">Deskripsi</label>
                    <div class="prose max-w-none rounded border bg-white p-4">{!! nl2br(e($core->sDescription->description ?? 'Belum ada deskripsi untuk keahlian ini.')) !!}</div>
                </div>

                <div class="text-right">
                    @if ($core->sDescription)
                        <a href="{{ route('admin.expertise.edit', $core->id) }}"
                            class="inline-block rounded bg-green-600 px-4 py-2 text-white">Edit</a>
                    @else
                        <a href="{{ route('admin.expertise.create', ['id' => $core->id]) }}"
                            class="inline-block rounded bg-indigo-600 px-4 py-2 text-white">Tambah Deskripsi</a>
                    @endif
                    <a href="{{ route('admin.expertise.index') }}"
                        class="ml-2 inline-block rounded border px-4 py-2">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
