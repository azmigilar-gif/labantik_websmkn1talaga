@extends('admin.layouts.app')
@section('title', 'Edit Deskripsi Keahlian')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-3xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Edit Deskripsi: {{ $core->name }}</h2>

                @if ($errors->any())
                    <div class="mb-4 rounded bg-red-50 p-3 text-red-700">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.expertise.update', $core->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium">Nama Keahlian</label>
                        <div class="rounded border bg-slate-50 p-2">{{ $core->name }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium">Deskripsi</label>
                        <textarea name="description" rows="8" required class="w-full rounded border p-2">{{ old('description', $core->sDescription->description ?? '') }}</textarea>
                    </div>

                    <div class="text-right">
                        <button class="inline-block rounded bg-blue-600 px-4 py-2 text-white" type="submit"
                            style="background: rgb(110, 110, 255);
                    color:white;">Simpan</button>
                        <a href="{{ route('admin.expertise.index') }}"
                            class="ml-2 inline-block rounded border px-4 py-2">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
