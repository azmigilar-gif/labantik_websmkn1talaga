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
                                            <div class="w-[90%] md:w-[35rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                <div
                                                    class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                                    <h5 class="text-16" id="addEmployeeLabel">Tambah Sub Menu (Menu: {{ $m->name }})</h5>
                                                    <button data-modal-close="addSubmenuModal{{ $m->id }}" class="text-slate-400 hover:text-red-500">
                                                        <i data-lucide="x" class="size-5"></i>
                                                    </button>
                                                </div>
                                                <div class="max-h-[calc(theme('height.screen')_-_180px)] p-6 overflow-y-auto">
                                                    <form class="create-submenu-form"
                                                        action="{{ route('admin.submenus.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="s_menu_id" value="{{ $m->id }}">
                                                        
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <div>
                                                                 <label class="inline-block mb-2 text-base font-medium">Nama Sub Menu</label>
                                                                 <input type="text" name="name"
                                                                     class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700 placeholder:text-slate-400"
                                                                     placeholder="Masukkan Nama Sub Menu" required>
                                                            </div>
                                                            <div>
                                                                 <label class="inline-block mb-2 text-base font-medium">Tipe Sub Menu</label>
                                                                 <select name="type" id="type-select-add-{{ $m->id }}" onchange="toggleAddSubmenuFields('{{ $m->id }}')"
                                                                     class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700">
                                                                     <option value="custom">Halaman Kustom (Tulis Konten)</option>
                                                                     <option value="url">Link Eksternal / Redirect</option>
                                                                     <option value="module">Modul Bawaan Sistem</option>
                                                                 </select>
                                                            </div>
                                                        </div>

                                                        <!-- Tipe: Halaman Kustom -->
                                                        <div id="custom-section-add-{{ $m->id }}" class="mt-4 type-section-add-{{ $m->id }}">
                                                            <div class="mb-3">
                                                                <label class="inline-block mb-2 text-base font-medium">URL Slug (Opsional)</label>
                                                                <input type="text" name="url"
                                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700 placeholder:text-slate-400"
                                                                    placeholder="Contoh: sejarah-sekolah (kosongkan untuk generate otomatis)">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="inline-block mb-2 text-base font-medium">Konten Halaman</label>
                                                                <textarea name="content" id="quill-textarea-add-{{ $m->id }}" class="submenu-quill-textarea hidden"></textarea>
                                                            </div>
                                                        </div>

                                                        <!-- Tipe: Link Eksternal -->
                                                        <div id="url-section-add-{{ $m->id }}" class="mt-4 type-section-add-{{ $m->id }}" style="display: none;">
                                                            <label class="inline-block mb-2 text-base font-medium">Link URL Tujuan</label>
                                                            <input type="text" name="external_url"
                                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700 placeholder:text-slate-400"
                                                                placeholder="Masukkan URL (Contoh: https://google.com atau /news)">
                                                        </div>

                                                        <!-- Tipe: Modul Bawaan -->
                                                        <div id="module-section-add-{{ $m->id }}" class="mt-4 type-section-add-{{ $m->id }}" style="display: none;">
                                                            <label class="inline-block mb-2 text-base font-medium">Pilih Halaman / Modul</label>
                                                            <select name="module_name"
                                                                class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700">
                                                                <option value="news">Daftar Berita Sekolah (Public News)</option>
                                                                <option value="gallery">Galeri Foto Kegiatan (Public Gallery)</option>
                                                                <option value="profil">Profil Sekolah (Home - Bagian Profil)</option>
                                                                <option value="visi-misi">Visi & Misi (Home - Bagian Visi Misi)</option>
                                                                <option value="expertise">Kompetensi Keahlian (Home - Bagian Jurusan)</option>
                                                                <option value="ekskul">Ekstrakurikuler (Home - Bagian Ekskul)</option>
                                                                <option value="contact">Hubungi Kami (Home - Bagian Kontak)</option>
                                                            </select>
                                                        </div>

                                                        <div class="flex justify-end gap-2 mt-6 pt-4 border-t dark:border-zink-500">
                                                            <button type="button" data-modal-close="addSubmenuModal{{ $m->id }}"
                                                                class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10">Batal</button>
                                                            <button type="submit"
                                                                class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Simpan Sub Menu</button>
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

@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        // Konfigurasi toolbar Quill
        var toolbarOptions = [
            [{ 'font': [] }, { 'size': [] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'script': 'sub'}, { 'script': 'super' }],
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }, 'blockquote', 'code-block'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'direction': 'rtl' }],
            [{ 'align': [] }],
            ['link', 'image', 'video', 'formula'],
            ['clean']
        ];

        // Fungsi untuk inisialisasi Quill editor
        function initQuillEditor(textareaId, containerId) {
            var textarea = document.getElementById(textareaId);
            if (!textarea || textarea.dataset.quillInitialized) return null;

            var quillContainer = document.createElement('div');
            quillContainer.id = containerId;
            quillContainer.style.height = '200px';
            textarea.parentNode.insertBefore(quillContainer, textarea);
            textarea.style.display = 'none';

            var quill = new Quill('#' + containerId, {
                modules: {
                    toolbar: {
                        container: toolbarOptions,
                        handlers: {
                            image: function() {
                                imageHandler(quill);
                            }
                        }
                    }
                },
                theme: 'snow'
            });

            if (textarea.value) {
                quill.root.innerHTML = textarea.value;
            }

            quill.on('text-change', function() {
                textarea.value = quill.root.innerHTML;
            });

            var form = textarea.closest('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    textarea.value = quill.root.innerHTML;
                });
            }

            textarea.dataset.quillInitialized = 'true';
            return quill;
        }

        // Image handler
        function imageHandler(quill) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = function() {
                var file = input.files[0];
                if (!file) return;

                var formData = new FormData();
                formData.append('upload', file);

                var xhr = new XMLHttpRequest();
                var url = '{{ route('admin.news.upload.image') }}';
                xhr.open('POST', url, true);
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            try {
                                var resp = JSON.parse(xhr.responseText);
                                if (resp && resp.url) {
                                    var width = prompt('Masukkan lebar gambar (pixel):\n\nContoh: 300, 400, 500', '300');
                                    if (width !== null && width.trim() !== '') {
                                        width = parseInt(width);
                                        if (!isNaN(width) && width > 0) {
                                            var range = quill.getSelection(true);
                                            quill.insertEmbed(range.index, 'image', resp.url);
                                            var imgElement = quill.root.querySelector('img[src="' + resp.url + '"]');
                                            if (imgElement) {
                                                imgElement.style.width = width + 'px';
                                                imgElement.style.maxWidth = '100%';
                                                imgElement.style.height = 'auto';
                                            }
                                            quill.setSelection(range.index + 1);
                                        } else {
                                            alert('Lebar harus berupa angka positif!');
                                        }
                                    }
                                } else {
                                    alert('Upload failed: invalid response');
                                }
                            } catch (e) {
                                alert('Upload failed: ' + e.message);
                            }
                        } else {
                            alert('Upload failed: ' + xhr.status);
                        }
                    }
                };

                xhr.onerror = function() {
                    alert('Upload failed due to network error');
                };
                xhr.send(formData);
            };
        }

        // Toggle Fields
        function toggleAddSubmenuFields(menuId) {
            const selectEl = document.getElementById('type-select-add-' + menuId);
            if (!selectEl) return;
            const type = selectEl.value;

            // Hide all sections in this modal
            document.getElementById('custom-section-add-' + menuId).style.display = 'none';
            document.getElementById('url-section-add-' + menuId).style.display = 'none';
            document.getElementById('module-section-add-' + menuId).style.display = 'none';

            // Show selected section
            if (type === 'custom') {
                document.getElementById('custom-section-add-' + menuId).style.display = 'block';
                // Initialize Quill when section is shown if not already initialized
                const textarea = document.getElementById('quill-textarea-add-' + menuId);
                if (textarea && !textarea.dataset.quillInitialized) {
                    initQuillEditor('quill-textarea-add-' + menuId, 'quill-container-add-' + menuId);
                }
            } else if (type === 'url') {
                document.getElementById('url-section-add-' + menuId).style.display = 'block';
            } else if (type === 'module') {
                document.getElementById('module-section-add-' + menuId).style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Quill for the default custom section of all modals when open
            document.body.addEventListener('click', function(e) {
                var trigger = e.target.closest('[data-modal-target^="addSubmenuModal"]');
                if (trigger) {
                    var modalId = trigger.getAttribute('data-modal-target');
                    setTimeout(function() {
                        var modal = document.getElementById(modalId);
                        if (modal) {
                            var menuId = modalId.replace('addSubmenuModal', '');
                            toggleAddSubmenuFields(menuId);
                        }
                    }, 300);
                }
            });
        });
    </script>
@endpush
