@extends('admin.layouts.app')
@section('title', 'Daftar Keahlian')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Keahlian</h5>
                </div>
                <ul class="flex shrink-0 items-center gap-2 text-sm font-normal">
                    <li
                        class="before:font-remix dark:text-zink-200 relative before:absolute before:-top-[3px] before:text-[18px] before:text-slate-400 before:content-['\ea54'] ltr:pr-4 ltr:before:-right-1 rtl:pl-4 rtl:before:-left-1">
                        <a href="#!" class="dark:text-zink-200 text-slate-400">Akademik & Kesiswaan</a>
                    </li>
                    <li class="dark:text-zink-100 text-slate-700">
                        Keahlian
                    </li>
                </ul>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('info'))
                <div class="mb-6 rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-yellow-800">{{ session('info') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 flex items-center justify-between gap-2">
                            <h2 class="text-lg font-semibold text-slate-800 dark:text-zink-100">Daftar Keahlian</h2>
                            <a href="{{ route('admin.expertise.create') }}" class="btn bg-custom-500 border-custom-500 text-white hover:text-white hover:bg-custom-600 hover:border-custom-600">
                                Tambah Deskripsi
                            </a>
                        </div>

                        @if (isset($cores) && $cores->count() > 0)
                            <table id="rowBorder" class="w-full">
                                <thead>
                                    <tr>
                                        <th class="p-2 text-left">Nama Keahlian</th>
                                        <th class="p-2 text-left">Slug</th>
                                        <th class="p-2 text-left">Deskripsi</th>
                                        <th class="p-2 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="dark:divide-zink-500 divide-y divide-slate-200">
                                    @foreach ($cores as $core)
                                        <tr>
                                            <td class="p-2">{{ $core->name }}</td>
                                            <td class="p-2">{{ $core->slug ?? '-' }}</td>
                                            <td class="p-2">
                                                @if ($core->sDescription)
                                                    <span class="rounded bg-green-100 px-2 py-1 text-xs text-green-800 dark:bg-green-500/20 dark:text-green-400">Ada</span>
                                                @else
                                                    <span class="rounded bg-yellow-100 px-2 py-1 text-xs text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400">Belum Ada</span>
                                                @endif
                                            </td>
                                            <td class="p-2">
                                                <div class="flex gap-2">
                                                    <a href="{{ route('admin.expertise.show', $core->id) }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-green-500 hover:bg-green-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-green-500/20 dark:hover:text-green-500">
                                                        <i data-lucide="eye" class="size-4"></i>
                                                    </a>
                                                    @if ($core->sDescription)
                                                        <a href="{{ route('admin.expertise.edit', $core->id) }}"
                                                            class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
                                                            <i data-lucide="pencil" class="size-4"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.expertise.create', ['id' => $core->id]) }}"
                                                            class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
                                                            <i data-lucide="plus" class="size-4"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="py-12 text-center text-slate-500 dark:text-zink-200">
                                <i data-lucide="award" class="mx-auto size-12 text-slate-300 dark:text-zink-500 mb-3"></i>
                                <p class="font-medium">Belum ada data keahlian yang terdaftar.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
