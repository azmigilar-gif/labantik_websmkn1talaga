@extends('admin.layouts.app')
@section('title', 'Daftar Keahlian')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto w-full rounded bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-2xl font-semibold">Daftar Keahlian</h2>
                    <a href="{{ route('admin.expertise.create') }}"
                        class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 add-employee text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">Tambah
                        Deskripsi</a>
                </div>

                @if (session('success'))
                    <div class="mb-4 rounded bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
                @endif

                @if (session('info'))
                    <div class="mb-4 rounded bg-yellow-50 p-3 text-yellow-700">{{ session('info') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="text-left">
                                <th class="border p-2">Nama Keahlian</th>
                                <th class="border p-2">Slug</th>
                                <th class="border p-2">Deskripsi</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cores as $core)
                                <tr>
                                    <td class="border p-2">{{ $core->name }}</td>
                                    <td class="border p-2">{{ $core->slug ?? '-' }}</td>
                                    <td class="border p-2">{{ $core->sDescription ? 'Ada' : 'Belum' }}</td>
                                    <td class="border p-2">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.expertise.show', $core->id) }}"
                                                class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-green-500 hover:bg-green-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-green-500/20 dark:hover:text-green-500">
                                                <i data-lucide="eye" class="size-4"></i>
                                            </a>
                                            @if ($core->sDescription)
                                                <a href="{{ route('admin.expertise.edit', $core->id) }}"
                                                    class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-green-500 hover:bg-green-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-green-500/20 dark:hover:text-green-500">
                                                    <i data-lucide="pencil" class="size-4"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.expertise.create', ['id' => $core->id]) }}"
                                                    class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-green-500 hover:bg-green-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-green-500/20 dark:hover:text-green-500">
                                                    <i data-lucide="plus" class="size-4"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
