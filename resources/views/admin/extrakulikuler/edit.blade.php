@extends('admin.layouts.app')
@section('title', 'Edit Ekstrakulikuler')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Edit Ekstrakulikuler</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.extrakulikuler.update', $ex->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium">Menu</label>
                            <select name="s_menu_id" class="block w-full rounded border-gray-200 p-3 shadow-sm">
                                <option value="">Pilih Menu</option>
                                @if (!empty($menus))
                                    @foreach ($menus as $m)
                                        <option value="{{ $m->id }}"
                                            {{ $ex->s_menu_id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">(Tidak ada menu)</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-span-12 md:col-span-8">
                            <label class="mb-2 block text-sm font-medium">Nama</label>
                            <input type="text" name="name" value="{{ old('name', $ex->name) }}"
                                class="block w-full rounded border-gray-200 p-3 shadow-sm"
                                placeholder="Nama ekstrakulikuler">
                        </div>

                        <div class="col-span-12">
                            <label class="mb-2 block text-sm font-medium">Deskripsi</label>
                            <textarea name="description" class="block min-h-[200px] w-full rounded border border-gray-200 p-4"
                                placeholder="Deskripsi singkat">{{ old('description', $ex->description) }}</textarea>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium">Foto</label>
                            <input type="file" name="photo" accept="image/*">
                        </div>

                        <div class="col-span-12 mt-4 text-right">
                            <button class="inline-block rounded bg-blue-600 px-4 py-2 text-white" style="background:blue;"
                                type="submit">Simpan</button>
                            <a href="{{ route('admin.extrakulikuler.index') }}"
                                class="ml-2 inline-block rounded border px-4 py-2">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
