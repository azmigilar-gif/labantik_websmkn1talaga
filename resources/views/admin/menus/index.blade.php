@extends('admin.layouts.app')
@section('title', 'Index Menu')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            @if (session('success'))
                <div
                    class="mt-5 rounded-md bg-green-50 p-4 text-sm text-green-700 border border-green-200 flex items-center justify-between">
                    <div class="flex items-center">
                        <i data-lucide="check-circle" class="mr-2 h-5 w-5 flex-shrink-0 text-green-400"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none';"
                        class="ml-4 rounded-md bg-green-100 p-1 text-green-500 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <i data-lucide="x" class="h-4 w-4"></i>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div
                    class="mt-5 rounded-md bg-red-50 p-4 text-sm text-red-700 border border-red-200 flex items-center justify-between">
                    <div class="flex items-center">
                        <i data-lucide="alert-circle" class="mr-2 h-5 w-5 flex-shrink-0 text-red-400"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none';"
                        class="ml-4 rounded-md bg-red-100 p-1 text-red-500 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <i data-lucide="x" class="h-4 w-4"></i>
                    </button>
                </div>
            @endif
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Dashboard</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Menu
                    </li>
                </ul>
            </div>


            {{-- 🟢 TEKS DI ATAS NAVBAR --}}
            <div class="text-center mt-5 mb-3">
                <h2 class="text-2xl font-semibold text-slate-800 dark:text-zink-100">
                    Preview Menu
                </h2>
                <p class="text-gray-500 dark:text-zink-300 text-sm">
                    Berikut tampilan navigasi utama website sekolah.
                </p>
            </div>

            <div class="bg-white dark:bg-zink-700 border-b border-slate-200 dark:border-zink-500 shadow-md">
                <nav class="container mx-auto h-20 px-4 2xl:max-w-[87.5rem]" id="navbar-preview">
                    <div class="flex items-center w-full h-full">
                        <!-- Logo - Fixed Width -->
                        <div class="shrink-0" style="width: 180px;">
                            <a href="#!">
                                <img src="{{ asset('assets/images/logosmk.png') }}" alt=""
                                    class="block h-12 dark:hidden">
                                <img src="{{ asset('assets/images/logosmk.png') }}" alt=""
                                    class="hidden h-12 dark:block">
                            </a>
                        </div>

                        <!-- Menu - Centered -->
                        <div class="flex-1 flex justify-center">
                            <ul class="flex items-center">
                                <li>
                                    <a href="javascript:void(0)"
                                        class="nav-link-preview text-15 hover:text-custom-500 block px-4 py-2.5 font-medium text-slate-800 transition-all duration-300 ease-linear md:inline-block md:px-3 md:py-0.5 dark:text-zinc-200">Home</a>
                                </li>

                                @php
                                    // Definisikan urutan menu yang diinginkan
                                    $menuOrder = [
                                        'Profil Sekolah',
                                        'Berita',
                                        'Program Keahlian',
                                        'Ekstrakurikuler',
                                        'Kontak',
                                    ];

                                    // Pisahkan menu berdasarkan urutan
                                    $orderedMenus = [];
                                    $otherMenus = [];

                                    foreach ($menus as $m) {
                                        $position = array_search($m->name, $menuOrder);
                                        if ($position !== false) {
                                            $orderedMenus[$position] = $m;
                                        } else {
                                            $otherMenus[] = $m;
                                        }
                                    }

                                    // Sort ordered menus berdasarkan key
                                    ksort($orderedMenus);

                                    // Gabungkan: ordered menus + other menus
                                    $sortedMenus = array_merge($orderedMenus, $otherMenus);
                                @endphp

                                {{-- Tampilkan semua menu dengan urutan yang benar --}}
                                @foreach ($sortedMenus as $m)
                                    <li class="dropdown-preview relative">
                                        @if ($m->submenus && $m->submenus->count() > 0)
                                            <!-- Menu dengan Submenu (Split Dropdown Button) -->
                                            <div class="flex items-center justify-start gap-0">
                                                @php
                                                    // Cek apakah slug dimulai dengan http:// atau https://
                                                    $isExternalLink = preg_match('/^https?:\/\//', $m->slug);
                                                    $menuUrl = $isExternalLink ? $m->slug : 'javascript:void(0)';
                                                @endphp

                                                <a href="{{ $menuUrl }}"
                                                    @if ($isExternalLink) target="_blank" rel="noopener noreferrer" @endif
                                                    class="nav-link-preview text-15 hover:text-custom-500 dark:hover:text-custom-500 block px-4 py-2.5 font-medium text-slate-800 transition-all duration-300 ease-linear md:inline-block md:px-3 md:py-0.5 dark:text-zinc-200">
                                                    {{ $m->name }}
                                                </a>
                                                <button type="button"
                                                    class="dropdown-toggle-preview hover:text-custom-500 dark:hover:text-custom-500 mr-2 flex items-center justify-center p-0 text-slate-800 transition-all duration-300 md:h-auto md:px-0 md:py-0.5 dark:text-zinc-200">
                                                    <i data-lucide="chevron-down" class="inline-block size-4"></i>
                                                </button>
                                            </div>

                                            <!-- Dropdown Menu -->
                                            <ul
                                                class="dropdown-menu-preview absolute z-[1000] mt-2 hidden min-w-[10rem] list-none rounded-md bg-white py-2 text-left shadow-lg dark:bg-zinc-600">
                                                @foreach ($m->submenus as $submenu)
                                                    <li>
                                                        @php
                                                            // Cek apakah URL submenu adalah external link
                                                            $isSubmenuExternal = preg_match(
                                                                '/^https?:\/\//',
                                                                $submenu->url,
                                                            );
                                                            $submenuUrl = $isSubmenuExternal
                                                                ? $submenu->url
                                                                : 'javascript:void(0)';
                                                        @endphp

                                                        <a href="{{ $submenuUrl }}"
                                                            @if ($isSubmenuExternal) target="_blank" rel="noopener noreferrer" @endif
                                                            class="dropdown-item hover:text-custom-500 dark:hover:text-custom-500 block whitespace-nowrap bg-transparent px-4 py-2 font-normal text-slate-600 hover:bg-slate-100 dark:text-zinc-100 dark:hover:bg-zinc-500">
                                                            {{ $submenu->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <!-- Menu Biasa (Tanpa Submenu) -->
                                            @php
                                                // Cek apakah slug dimulai dengan http:// atau https://
                                                $isExternalLink = preg_match('/^https?:\/\//', $m->slug);
                                                $menuUrl = $isExternalLink ? $m->slug : 'javascript:void(0)';
                                            @endphp

                                            <a href="{{ $menuUrl }}"
                                                @if ($isExternalLink) target="_blank" rel="noopener noreferrer" @endif
                                                class="nav-link-preview text-15 hover:text-custom-500 dark:hover:text-custom-500 block px-4 py-2.5 font-medium text-slate-800 transition-all duration-300 ease-linear md:inline-block md:px-3 md:py-0.5 dark:text-zinc-200">
                                                {{ $m->name }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Right Section - Fixed Width (sama dengan logo) -->
                        <div class="flex items-center justify-end" style="width: 180px;">
                            <!-- Placeholder untuk keseimbangan visual -->
                            <div class="w-full"></div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="card mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4 gap-3">
                            <a href="#!" data-modal-target="addMenuModal" type="button"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 add-employee"><i
                                    data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Tambah
                                    Menu</span></a>
                            <a href="#!" data-modal-target="addLinkModal" type="button"
                                class="text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-custom-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:border-custom-600 active:ring active:ring-sky-100 dark:ring-sky-400/20 add-employee"><i
                                    data-lucide="link" class="inline-block size-4"></i> <span class="align-middle">Tambah
                                    Konfigurasi Submenu</span></a>
                        </div>


                        @if (isset($menus) && $menus->count())
                            <table id="rowBorder" class="w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left p-2">No</th>
                                        <th class="text-left p-2">Nama</th>
                                        <th class="text-left p-2">Dibuat</th>
                                        <th class="text-left p-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                                    @foreach ($menus as $m)
                                        <tr>
                                            <td class="p-2">{{ $loop->iteration }}</td>
                                            <td class="p-2">{{ $m->name ?? '-' }}</td>
                                            <td class="p-2">
                                                {{ $m->created_at ? $m->created_at->translatedFormat('d F Y') : '-' }}
                                            </td>
                                            <td class="p-2">
                                                <div class="flex gap-2">
                                                    @if ($m->submenus && $m->submenus->count() > 0)
                                                        <a href="{{ route('admin.submenus.show', $m->id) }}"
                                                            class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                                data-lucide="eye" class="size-4"></i>
                                                        </a>
                                                    @endif

                                                    <a href="#!"
                                                        data-modal-target="addSubmenuModal{{ $m->id }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                            data-lucide="plus" class="size-4"></i></a>
                                                    <a href="#!"
                                                        data-modal-target="editMenuModal{{ $m->id }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                            data-lucide="pencil" class="size-4"></i></a>
                                                    <a href="#!" data-modal-target="deleteModal{{ $m->id }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 remove-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                            data-lucide="trash-2" class="size-4"></i></a>

                                            </td>
                                        </tr>
                                        <div id="addSubmenuModal{{ $m->id }}" modal-center=""
                                            class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
                                            <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                <div
                                                    class="flex items-center justify-beSTEen p-4 border-b dark:border-zink-500">
                                                    <h5 class="text-16" id="addEmployeeLabel">Tambah Sub Menu</h5>
                                                </div>
                                                <div
                                                    class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                                    <form class="update-form"
                                                        action="{{ route('admin.submenus.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="s_menu_id"
                                                            value="{{ $m->id }}">
                                                        <div>
                                                            <label for="phoneNumberInput"
                                                                class="inline-block mb-2 text-base font-medium">Nama
                                                                Sub Menu</label>
                                                            <input type="text" name="name"
                                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                                placeholder="Masukkan Nama Sub Menu" required="">
                                                        </div>
                                                        <div class="mt-3">
                                                            <label for="phoneNumberInput"
                                                                class="inline-block mb-2 text-base font-medium">URL</label>
                                                            <input type="text" name="url"
                                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                                placeholder="Masukkan URL Sub Menu">
                                                        </div>
                                                        <div class="mt-3">
                                                            <label for="phoneNumberInput"
                                                                class="inline-block mb-2 text-base font-medium">Nama
                                                                Nama Model Key</label>
                                                            <select
                                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                                data-choices="" name="s_model_key_id"
                                                                id="choices-single-default">
                                                                <option value="">Pilih Nama Model Key</option>
                                                                @foreach ($modelKey as $model)
                                                                    <option value="{{ $model->id }}">
                                                                        {{ $model->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mt-3">
                                                            <label for="phoneNumberInput"
                                                                class="inline-block mb-2 text-base font-medium">Nama
                                                                Nama View</label>
                                                            <select
                                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                                data-choices="" name="s_view_name_id"
                                                                id="choices-single-default">
                                                                <option value="">Pilih Nama View</option>
                                                                @foreach ($viewName as $view)
                                                                    <option value="{{ $view->id }}">
                                                                        {{ $view->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mt-3">
                                                            <label for="phoneNumberInput"
                                                                class="inline-block mb-2 text-base font-medium">Nama
                                                                Nama Redirect Ke</label>
                                                            <select
                                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                                data-choices="" name="s_redirect_to_id"
                                                                id="choices-single-default">
                                                                <option value="">Pilih Nama Redirect Ke</option>
                                                                @foreach ($redirectTo as $red)
                                                                    <option value="{{ $red->id }}">
                                                                        {{ $red->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="flex justify-end gap-2 mt-4">
                                                            <button type="reset" id="close-modal"
                                                                data-modal-close="addSubmenuModal{{ $m->id }}"
                                                                class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                                                            <button type="submit" id="addNew"
                                                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Simpan
                                                                Sub Menu</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!--end add Employee-->

                                        <div id="editMenuModal{{ $m->id }}" modal-center=""
                                            class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
                                            <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                <div
                                                    class="flex items-center justify-beSTEen p-4 border-b dark:border-zink-500">
                                                    <h5 class="text-16" id="addEmployeeLabel">Tambah Menu</h5>
                                                </div>
                                                <div
                                                    class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                                    <form class="update-form"
                                                        action="{{ route('admin.menus.update', $m->id) }}"
                                                        method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                                            <div class="xl:col-span-6">
                                                                <label for="phoneNumberInput"
                                                                    class="inline-block mb-2 text-base font-medium">Nama
                                                                    Menu</label>
                                                                <input type="text" id="nameInput{{ $m->id }}"
                                                                    name="name" value="{{ old('name', $m->name) }}"
                                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                                    placeholder="Masukkan Nama Menu" required="">
                                                            </div>
                                                            <div class="xl:col-span-6">
                                                                <label for="slugInput"
                                                                    class="inline-block mb-2 text-base font-medium">Slug</label>
                                                                <input type="text" id="slugInput{{ $m->id }}"
                                                                    name="slug" value="{{ old('slug', $m->slug) }}"
                                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                                    placeholder="Masukkan Slug" required>
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-end gap-2 mt-4">
                                                            <button type="reset" id="close-modal"
                                                                data-modal-close="editMenuModal{{ $m->id }}"
                                                                class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                                                            <button type="submit" id="addNew"
                                                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Update
                                                                Menu</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!--end add Employee-->

                                        <div id="deleteModal{{ $m->id }}" modal-center=""
                                            class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                            <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                <div
                                                    class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                                    <img src="data:image/png;base64,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"
                                                        alt="" class="block h-12 mx-auto">
                                                    <div class="mt-5 text-center">
                                                        <h5 class="mb-1">Are you sure?</h5>
                                                        <p class="text-slate-500 dark:text-zink-200">Are you certain you
                                                            want to delete this menu ({{ $m->name }})?</p>
                                                        <div class="flex justify-center gap-2 mt-6">
                                                            <form class="delete-form"
                                                                action="{{ route('admin.menus.destroy', $m->id) }}"
                                                                method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="reset"
                                                                    data-modal-close="deleteModal{{ $m->id }}"
                                                                    class="bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-600 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">Cancel</button>
                                                                <button type="submit" id="delete-record"
                                                                    class="text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">Yes,
                                                                    Hapus!</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end delete modal-->
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-4">
                                {{ $menus->links() }}
                            </div>
                        @else
                            <!-- Empty state -->
                            <div class="py-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4" width="80"
                                    height="80" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" y1="15" x2="12" y2="3" />
                                </svg>
                                <h3 class="text-lg font-semibold mb-2">Belum ada menu</h3>
                                <p class="text-sm text-slate-500 mb-4">Belum ada menu yang dibuat. Klik tombol "Tambah
                                    Menu" untuk membuat menu baru.</p>
                            </div>
                        @endif
                    </div>
                </div><!--end card-->
                <div id="addMenuModal" modal-center=""
                    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
                    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                        <div class="flex items-center justify-beSTEen p-4 border-b dark:border-zink-500">
                            <h5 class="text-16" id="addEmployeeLabel">Tambah Menu</h5>
                        </div>
                        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                            <form class="create-form" id="create-form" action="{{ route('admin.menus.store') }}"
                                method="POST">
                                @csrf
                                <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                    <div class="xl:col-span-6">
                                        <label for="phoneNumberInput" class="inline-block mb-2 text-base font-medium">Nama
                                            Menu</label>
                                        <input type="text" name="name"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Masukkan Nama Menu" required="">
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="slugInput"
                                            class="inline-block mb-2 text-base font-medium">Slug</label>
                                        <input type="text" id="slugInput" name="slug" value="section-"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Masukkan Slug" required>
                                    </div>
                                </div>
                                <div class="flex justify-end gap-2 mt-4">
                                    <button type="reset" id="close-modal" data-modal-close="addMenuModal"
                                        class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                                    <button type="submit" id="addNew"
                                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Tambah
                                        Menu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--end add Employee-->
                <div id="addLinkModal" modal-center=""
                    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600">
                        <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                            <h5 class="text-16" id="addEmployeeLabel">Tambah Konfigurasi Submenu</h5>
                            <button data-modal-close="addLinkModal"
                                class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                                <i class="ri-close-line text-xl"></i>
                            </button>
                        </div>

                        <!-- Step Indicators -->
                        <div class="bg-slate-50 dark:bg-zink-700 px-6 py-4 border-b dark:border-zink-500">
                            <div class="flex items-center justify-between">
                                <!-- Step 1 -->
                                <div class="flex flex-col items-center flex-1">
                                    <div class="step-circle active w-10 h-10 rounded-full border-2 flex items-center justify-center font-bold text-sm bg-custom-500 text-white border-custom-500"
                                        data-step="1">
                                        1
                                    </div>
                                    <p class="text-xs mt-1 font-medium text-slate-700 dark:text-zink-200">Model Key</p>
                                </div>

                                <!-- Line 1 -->
                                <div class="flex-1 h-0.5 bg-slate-300 dark:bg-zink-500 step-line mx-2" data-line="1">
                                </div>

                                <!-- Step 2 -->
                                <div class="flex flex-col items-center flex-1">
                                    <div class="step-circle w-10 h-10 rounded-full border-2 border-slate-300 dark:border-zink-500 bg-white dark:bg-zink-600 flex items-center justify-center font-bold text-sm text-slate-400"
                                        data-step="2">
                                        2
                                    </div>
                                    <p class="text-xs mt-1 font-medium text-slate-700 dark:text-zink-200">Nama View</p>
                                </div>

                                <!-- Line 2 -->
                                <div class="flex-1 h-0.5 bg-slate-300 dark:bg-zink-500 step-line mx-2" data-line="2">
                                </div>

                                <!-- Step 3 -->
                                <div class="flex flex-col items-center flex-1">
                                    <div class="step-circle w-10 h-10 rounded-full border-2 border-slate-300 dark:border-zink-500 bg-white dark:bg-zink-600 flex items-center justify-center font-bold text-sm text-slate-400"
                                        data-step="3">
                                        3
                                    </div>
                                    <p class="text-xs mt-1 font-medium text-slate-700 dark:text-zink-200">Redirect</p>
                                </div>
                            </div>
                        </div>

                        <div class="max-h-[calc(theme('height.screen')_-_280px)] p-4 overflow-y-auto">
                            <form class="create-form" id="create-form"
                                action="{{ route('admin.submenu.addConfiguration') }}" method="POST">
                                @csrf

                                <!-- Step 1: Model Key -->
                                <div class="form-step active" data-step="1">
                                    <h6 class="mb-4 text-15 font-semibold text-slate-700 dark:text-zink-100">Langkah 1:
                                        Model Key & Slug</h6>
                                    <div class="grid grid-cols-1 gap-4">
                                        <div class="xl:col-span-6">
                                            <label class="inline-block mb-2 text-base font-medium">Model Key</label>
                                            <input type="text" name="model_key" id="model_key"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Masukkan Model Key" required>
                                        </div>
                                        <div class="xl:col-span-6">
                                            <label class="inline-block mb-2 text-base font-medium">Slug Model</label>
                                            <input type="text" name="model_slug" id="model_slug"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Masukkan Slug Model" required>
                                            <small class="text-slate-500 dark:text-zink-300">Contoh:
                                                model-key-example</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Nama View -->
                                <div class="form-step" data-step="2" style="display: none;">
                                    <h6 class="mb-4 text-15 font-semibold text-slate-700 dark:text-zink-100">Langkah 2:
                                        Nama View & Slug</h6>
                                    <div class="grid grid-cols-1 gap-4">
                                        <div class="xl:col-span-6">
                                            <label class="inline-block mb-2 text-base font-medium">Nama View</label>
                                            <input type="text" name="view_name" id="view_name"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Masukkan Nama View" required>
                                        </div>
                                        <div class="xl:col-span-6">
                                            <label class="inline-block mb-2 text-base font-medium">Slug View</label>
                                            <input type="text" name="view_slug" id="view_slug"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Masukkan Slug View" required>
                                            <small class="text-slate-500 dark:text-zink-300">Contoh:
                                                view-name-example</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Redirect -->
                                <div class="form-step" data-step="3" style="display: none;">
                                    <h6 class="mb-4 text-15 font-semibold text-slate-700 dark:text-zink-100">Langkah 3:
                                        Redirect & Slug</h6>
                                    <div class="grid grid-cols-1 gap-4">
                                        <div class="xl:col-span-6">
                                            <label class="inline-block mb-2 text-base font-medium">Redirect Ke</label>
                                            <input type="text" name="redirect_to" id="redirect_to"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Masukkan Redirect Ke" required>
                                            <small class="text-slate-500 dark:text-zink-300">Contoh: /example/example atau
                                                /example</small>
                                        </div>
                                        <div class="xl:col-span-6">
                                            <label class="inline-block mb-2 text-base font-medium">Slug Redirect</label>
                                            <input type="text" name="redirect_slug" id="redirect_slug"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Masukkan Slug Redirect" required>
                                            <small class="text-slate-500 dark:text-zink-300">Contoh:
                                                redirect-example</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="flex justify-between gap-2 mt-4">
                                    <button type="button" id="prevBtn"
                                        class="text-slate-500 bg-white btn hover:text-slate-700 hover:bg-slate-100 focus:text-slate-700 focus:bg-slate-100 dark:bg-zink-700 dark:text-zink-200 dark:hover:bg-zink-600 border border-slate-300 dark:border-zink-500"
                                        style="display: none;">
                                        Kembali
                                    </button>
                                    <div class="flex gap-2 ml-auto">
                                        <button type="button" id="close-modal" data-modal-close="addLinkModal"
                                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">
                                            Cancel
                                        </button>
                                        <button type="button" id="nextBtn"
                                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            Selanjutnya
                                        </button>
                                        <button type="submit" id="submitBtn"
                                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                                            style="display: none;">
                                            Tambah Konfigurasi Submenu
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <style>
        .form-step {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .step-circle {
            transition: all 0.3s ease;
        }

        .step-circle.active {
            background-color: #8b5cf6 !important;
            color: white !important;
            border-color: #8b5cf6 !important;
        }

        .step-circle.completed {
            background-color: #10b981 !important;
            color: white !important;
            border-color: #10b981 !important;
        }

        .step-line {
            transition: background-color 0.3s ease;
        }

        .step-line.completed {
            background-color: #10b981 !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 3;

            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const submitBtn = document.getElementById('submitBtn');
            const wizardForm = document.querySelector('#addLinkModal form'); // ← Spesifik ke form wizard

            function showStep(step) {
                // Hide all steps
                document.querySelectorAll('.form-step').forEach(s => {
                    s.style.display = 'none';
                });

                // Show current step
                document.querySelector(`.form-step[data-step="${step}"]`).style.display = 'block';

                // Update step indicators
                for (let i = 1; i <= totalSteps; i++) {
                    const circle = document.querySelector(`.step-circle[data-step="${i}"]`);
                    const line = document.querySelector(`.step-line[data-line="${i}"]`);

                    circle.classList.remove('active', 'completed');
                    circle.style.backgroundColor = '';
                    circle.style.color = '';
                    circle.style.borderColor = '';

                    if (i < step) {
                        circle.classList.add('completed');
                        if (line) line.classList.add('completed');
                    } else if (i === step) {
                        circle.classList.add('active');
                    } else {
                        if (line) line.classList.remove('completed');
                    }
                }

                // Update buttons
                prevBtn.style.display = step === 1 ? 'none' : 'inline-block';
                nextBtn.style.display = step === totalSteps ? 'none' : 'inline-block';
                submitBtn.style.display = step === totalSteps ? 'inline-block' : 'none';
            }

            function validateStep(step) {
                const stepElement = document.querySelector(`.form-step[data-step="${step}"]`);
                const inputs = stepElement.querySelectorAll('input[required]');

                for (let input of inputs) {
                    if (!input.value.trim()) {
                        input.focus();
                        alert('Mohon lengkapi semua field yang wajib diisi');
                        return false;
                    }
                }
                return true;
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    if (validateStep(currentStep)) {
                        if (currentStep < totalSteps) {
                            currentStep++;
                            showStep(currentStep);
                        }
                    }
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            }

            // ← HANYA VALIDASI FORM WIZARD, BUKAN SEMUA FORM
            if (wizardForm) {
                wizardForm.addEventListener('submit', function(e) {
                    if (!validateStep(currentStep)) {
                        e.preventDefault();
                    }
                });
            }

            // Reset wizard when modal closes
            document.querySelectorAll('[data-modal-close="addLinkModal"]').forEach(btn => {
                btn.addEventListener('click', function() {
                    currentStep = 1;
                    showStep(currentStep);
                    if (wizardForm) wizardForm.reset();
                });
            });

            // Initialize
            showStep(currentStep);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown handler untuk preview navbar
            const dropdownsPreview = document.querySelectorAll('.dropdown-preview');

            dropdownsPreview.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle-preview');
                const menu = dropdown.querySelector('.dropdown-menu-preview');

                if (toggle && menu) {
                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Close dropdown lain
                        document.querySelectorAll('.dropdown-menu-preview').forEach(m => {
                            if (m !== menu) {
                                m.classList.add('hidden');
                            }
                        });

                        // Toggle current dropdown
                        const isHidden = menu.classList.contains('hidden');
                        menu.classList.toggle('hidden');

                        // Posisi ke kiri
                        if (isHidden) {
                            menu.style.left = 'auto';
                            menu.style.right = '0';
                            menu.style.transform = 'none';
                        }
                    });
                }
            });

            // Close dropdown saat klik di luar
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown-preview')) {
                    document.querySelectorAll('.dropdown-menu-preview').forEach(menu => {
                        menu.classList.add('hidden');
                    });
                }
            });
        });
    </script>
@endsection
