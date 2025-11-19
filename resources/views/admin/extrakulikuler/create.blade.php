@extends('admin.layouts.app')
@section('title', 'Buat Ekstrakulikuler')
@section('content')
<div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

    <div class="container mx-auto p-6">
        <div class="max-w-4xl mx-auto bg-white rounded shadow-sm p-6">
            <h2 class="text-2xl font-semibold mb-6">Tambah Ekstrakulikuler</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.extrakulikuler.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 md:col-span-4">
                        <label class="block text-sm font-medium mb-2">Menu</label>
                        <select name="s_menu_id" class="block w-full rounded border-gray-200 shadow-sm p-3">
                            <option value="">Pilih Menu</option>
                            @if (!empty($menus))
                                @foreach ($menus as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            @else
                                <option value="">(Tidak ada menu)</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-span-12 md:col-span-8">
                        <label class="block text-sm font-medium mb-2">Nama</label>
                        <input type="text" name="name" class="block w-full rounded border-gray-200 shadow-sm p-3"
                            placeholder="Nama ekstrakulikuler">
                    </div>

                    <div class="col-span-12">
                        <label class="block text-sm font-medium mb-2">Deskripsi</label>
                        <textarea name="description" class="block w-full p-4 min-h-[200px] border border-gray-200 rounded"
                            placeholder="Deskripsi singkat">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="block text-sm font-medium mb-2">Foto</label>
                        <input type="file" name="photo" accept="image/*">
                    </div>

                    <div class="col-span-12 text-right mt-4">
                        <button class="inline-block px-4 py-2 bg-blue-600 text-white rounded" style="background:blue;" type="submit">Simpan</button>
                        <a href="{{ route('admin.extrakulikuler.index') }}"
                            class="inline-block px-4 py-2 ml-2 border rounded">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
