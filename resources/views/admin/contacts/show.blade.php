@extends('admin.layouts.app')
@section('title', 'Detail Kontak')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <!-- Breadcrumb -->
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Detail Kontak</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="{{ route('admin.contacts.index') }}" class="text-slate-400 dark:text-zink-200">Kontak</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Detail
                    </li>
                </ul>
            </div>

            <!-- Card Detail -->
            <div class="card">
                <div class="card-body">

                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-2">
                        <!-- Alamat 1 -->
                        <div class="flex items-start gap-3 p-4 rounded-md bg-slate-50 dark:bg-zink-600">
                            <div
                                class="flex items-center justify-center size-10 rounded-md bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                                <i data-lucide="map-pin" class="size-5"></i>
                            </div>
                            <div class="flex-1">
                                <p class="mb-1 text-sm text-slate-500 dark:text-zink-300">Alamat 1</p>
                                <h6 class="text-15 font-medium text-slate-700 dark:text-zink-100">
                                    {{ $contact->address_1 ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        <!-- Alamat 2 -->
                        <div class="flex items-start gap-3 p-4 rounded-md bg-slate-50 dark:bg-zink-600">
                            <div
                                class="flex items-center justify-center size-10 rounded-md bg-blue-100 text-blue-500 dark:bg-blue-500/20">
                                <i data-lucide="map-pin" class="size-5"></i>
                            </div>
                            <div class="flex-1">
                                <p class="mb-1 text-sm text-slate-500 dark:text-zink-300">Alamat 2</p>
                                <h6 class="text-15 font-medium text-slate-700 dark:text-zink-100">
                                    {{ $contact->address_2 ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-3 p-4 rounded-md bg-slate-50 dark:bg-zink-600">
                            <div
                                class="flex items-center justify-center size-10 rounded-md bg-green-100 text-green-500 dark:bg-green-500/20">
                                <i data-lucide="mail" class="size-5"></i>
                            </div>
                            <div class="flex-1">
                                <p class="mb-1 text-sm text-slate-500 dark:text-zink-300">Email</p>
                                <h6 class="text-15 font-medium text-slate-700 dark:text-zink-100">
                                    {{ $contact->email ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        <!-- No Telp -->
                        <div class="flex items-start gap-3 p-4 rounded-md bg-slate-50 dark:bg-zink-600">
                            <div
                                class="flex items-center justify-center size-10 rounded-md bg-orange-100 text-orange-500 dark:bg-orange-500/20">
                                <i data-lucide="phone" class="size-5"></i>
                            </div>
                            <div class="flex-1">
                                <p class="mb-1 text-sm text-slate-500 dark:text-zink-300">No Telp</p>
                                <h6 class="text-15 font-medium text-slate-700 dark:text-zink-100">
                                    {{ $contact->no_telp ?? '-' }}
                                </h6>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons (Bottom) -->
                    <div class="flex justify-end gap-2 mt-6 pt-5  border-slate-200 dark:border-zink-500">
                        <a href="{{ route('admin.contacts.index') }}"
                            class="text-slate-500 btn bg-slate-200 border-slate-200 hover:text-slate-600 hover:bg-slate-300 hover:border-slate-300 focus:text-slate-600 focus:bg-slate-300 focus:border-slate-300 focus:ring focus:ring-slate-100 active:text-slate-600 active:bg-slate-300 active:border-slate-300 active:ring active:ring-slate-100 dark:bg-zink-600 dark:hover:bg-zink-500 dark:border-zink-600 dark:hover:border-zink-500 dark:text-zink-200 dark:ring-zink-400/50">
                            <i data-lucide="arrow-left" class="inline-block size-4 mr-1"></i>
                            Kembali
                        </a>
                        <a href="{{ route('admin.contacts.edit', $contact->id) }}"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                            <i data-lucide="pencil" class="inline-block size-4 mr-1"></i>
                            Edit Kontak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
