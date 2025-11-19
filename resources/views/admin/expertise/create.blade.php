@extends('admin.layouts.app')
@section('title', 'Tambah Deskripsi Jurusan')
@section('content')
<div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-3xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Tambah Deskripsi Jurusan</h2>

                @if(session('success'))
                    <div class="mb-4 rounded bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded bg-red-50 p-3 text-red-700">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($cores->isEmpty())
                    <div class="text-sm text-slate-500">Semua jurusan sudah memiliki deskripsi.</div>
                @else
                    <form action="{{ route('admin.expertise.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Pilih Jurusan (yang belum punya deskripsi)</label>
                            <select name="id_concentrations" required class="w-full rounded border p-2">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($cores as $c)
                                    <option value="{{ $c->id }}" {{ isset($selected) && $selected == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Deskripsi</label>
                            <textarea name="description" rows="6" required class="w-full rounded border p-2"></textarea>
                        </div>

                        <div class="text-right">
                            <a href="{{route('admin.expertise.index') }}">Kembali</a>
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 add-employee">Simpan</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
