@extends('admin.layouts.app')
@section('title', 'Buat Kontak')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Tambah Kontak</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.contacts.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium">Address 1</label>
                            <input type="text" name="address_1"
                                class="block w-full rounded border-gray-200 p-3 shadow-sm" required>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium">Address 2 (opsional)</label>
                            <input type="text" name="address_2"
                                class="block w-full rounded border-gray-200 p-3 shadow-sm">
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium">Email</label>
                            <input type="email" name="email" class="block w-full rounded border-gray-200 p-3 shadow-sm">
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium">No Telp</label>
                            <input type="text" name="no_telp" class="block w-full rounded border-gray-200 p-3 shadow-sm">
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium">Menu</label>
                            <select name="s_menu_id" class="block w-full rounded border-gray-200 p-3 shadow-sm">
                                <option value="">Pilih Menu</option>
                                @if (!empty($menus))
                                    @foreach ($menus as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-span-12 mt-4 text-right">
                            <button
                                class="text-custom-500 btn bg-custom-100 hover:bg-custom-600 focus:bg-custom-600 focus:ring-custom-100 active:bg-custom-600 active:ring-custom-100 dark:bg-custom-500/20 dark:text-custom-500 dark:hover:bg-custom-500 dark:focus:bg-custom-500 dark:active:bg-custom-500 dark:ring-custom-400/20 inline-block px-4 py-2 hover:text-white focus:text-white focus:ring active:text-white active:ring dark:hover:text-white dark:focus:text-white dark:active:text-white"
                                type="submit">Simpan</button>
                            <a href="{{ route('admin.contacts.index') }}"
                                class="ml-2 inline-block rounded border px-4 py-2">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
