@extends('admin.layouts.app')
@section('title', 'Index Menu')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Dashboard</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="{{ route('admin.menus.index') }}" class="text-slate-400 dark:text-zink-200">Menu</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Detail Sub Menu
                    </li>
                </ul>
            </div>

            <div class="card mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <a href="{{ route('admin.menus.index') }}" type="button"
                                class="text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/20 add-employee"><i
                                    data-lucide="arrow-left-from-line" class="inline-block size-4"></i> <span
                                    class="align-middle">Kembali</span></a>
                        </div>

                        @if (isset($submenus) && $submenus->count())
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
                                    @foreach ($submenus as $m)
                                        <tr>
                                            <td class="p-2">{{ $loop->iteration }}</td>
                                            <td class="p-2">{{ $m->name ?? '-' }}</td>
                                            <td class="p-2">
                                                {{ $m->created_at ? $m->created_at->translatedFormat('d F Y') : '-' }}
                                            </td>
                                            <td class="p-2">
                                                <div class="flex gap-2">
                                                    <a href="#!"
                                                        data-modal-target="editSubmenusModal{{ $m->id }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                            data-lucide="pencil" class="size-4"></i></a>
                                                    <a href="#!" data-modal-target="deleteModal{{ $m->id }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 remove-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                            data-lucide="trash-2" class="size-4"></i></a>

                                            </td>
                                        </tr>
                                        <div id="addsubmenusModal{{ $m->id }}" modal-center=""
                                            class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
                                            <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                <div
                                                    class="flex items-center justify-beSTEen p-4 border-b dark:border-zink-500">
                                                    <h5 class="text-16" id="addEmployeeLabel">Tambah Sub Menu</h5>
                                                </div>
                                                <div
                                                    class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                                    <form class="update-form" action="{{ route('admin.submenus.store') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="s_menu_id" value="{{ $m->id }}">
                                                        <div>
                                                            <label for="phoneNumberInput"
                                                                class="inline-block mb-2 text-base font-medium">Nama
                                                                Sub Menu</label>
                                                            <input type="text" name="name"
                                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                                placeholder="Masukkan Nama Sub Menu" required="">
                                                        </div>
                                                        <div class="flex justify-end gap-2 mt-4">
                                                            <button type="reset" id="close-modal"
                                                                data-modal-close="addsubmenusModal{{ $m->id }}"
                                                                class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                                                            <button type="submit" id="addNew"
                                                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Simpan
                                                                Sub Menu</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!--end add Employee-->
                                        <div id="editSubmenusModal{{ $m->id }}" modal-center=""
                                            class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                             <div class="w-[90%] md:w-[35rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                 <div
                                                     class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                                     <h5 class="text-16" id="addEmployeeLabel">Edit Sub Menu</h5>
                                                     <button data-modal-close="editSubmenusModal{{ $m->id }}" class="text-slate-400 hover:text-red-500">
                                                         <i data-lucide="x" class="size-5"></i>
                                                     </button>
                                                 </div>
                                                 <div class="max-h-[calc(theme('height.screen')_-_180px)] p-6 overflow-y-auto">
                                                     <form class="update-submenu-form"
                                                         action="{{ route('admin.submenus.update', $m->id) }}"
                                                         method="POST">
                                                         @csrf
                                                         @method('PUT')
                                                         <input type="hidden" name="s_menu_id" value="{{ $m->s_menu_id }}">

                                                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                             <div>
                                                                 <label class="inline-block mb-2 text-base font-medium">Nama Sub Menu</label>
                                                                 <input type="text" name="name"
                                                                     value="{{ $m->name }}"
                                                                     class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700"
                                                                     placeholder="Masukkan Nama Sub Menu" required>
                                                             </div>
                                                             <div>
                                                                 <label class="inline-block mb-2 text-base font-medium">Tipe Sub Menu</label>
                                                                 <select name="type" id="type-select-edit-{{ $m->id }}" onchange="toggleEditSubmenuFields('{{ $m->id }}')"
                                                                     class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700">
                                                                     <option value="custom" {{ ($m->type ?? 'custom') == 'custom' ? 'selected' : '' }}>Halaman Kustom (Tulis Konten)</option>
                                                                     <option value="url" {{ ($m->type ?? '') == 'url' ? 'selected' : '' }}>Link Eksternal / Redirect</option>
                                                                     <option value="module" {{ ($m->type ?? '') == 'module' ? 'selected' : '' }}>Modul Bawaan Sistem</option>
                                                                 </select>
                                                             </div>
                                                         </div>

                                                         <!-- Tipe: Halaman Kustom -->
                                                         <div id="custom-section-edit-{{ $m->id }}" class="mt-4 type-section-edit-{{ $m->id }}">
                                                             <div class="mb-3">
                                                                 <label class="inline-block mb-2 text-base font-medium">URL Slug</label>
                                                                 <input type="text" name="url" value="{{ $m->url }}"
                                                                     class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700"
                                                                     placeholder="Contoh: sejarah-sekolah">
                                                             </div>
                                                             <div class="mb-3">
                                                                 <label class="inline-block mb-2 text-base font-medium">Konten Halaman</label>
                                                                 <textarea name="content" id="quill-textarea-edit-{{ $m->id }}" class="submenu-quill-textarea hidden">{{ $m->content }}</textarea>
                                                             </div>
                                                         </div>

                                                         <!-- Tipe: Link Eksternal -->
                                                         <div id="url-section-edit-{{ $m->id }}" class="mt-4 type-section-edit-{{ $m->id }}" style="display: none;">
                                                             <label class="inline-block mb-2 text-base font-medium">Link URL Tujuan</label>
                                                             <input type="text" name="external_url" value="{{ $m->external_url }}"
                                                                 class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700 placeholder:text-slate-400"
                                                                 placeholder="Masukkan URL (Contoh: https://google.com atau /news)">
                                                         </div>

                                                         <!-- Tipe: Modul Bawaan -->
                                                         <div id="module-section-edit-{{ $m->id }}" class="mt-4 type-section-edit-{{ $m->id }}" style="display: none;">
                                                             <label class="inline-block mb-2 text-base font-medium">Pilih Halaman / Modul</label>
                                                             <select name="module_name"
                                                                 class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:text-zink-100 dark:bg-zink-700">
                                                                 <option value="news" {{ $m->module_name == 'news' ? 'selected' : '' }}>Daftar Berita Sekolah (Public News)</option>
                                                                 <option value="gallery" {{ $m->module_name == 'gallery' ? 'selected' : '' }}>Galeri Foto Kegiatan (Public Gallery)</option>
                                                                 <option value="profil" {{ $m->module_name == 'profil' ? 'selected' : '' }}>Profil Sekolah (Home - Bagian Profil)</option>
                                                                 <option value="visi-misi" {{ $m->module_name == 'visi-misi' ? 'selected' : '' }}>Visi & Misi (Home - Bagian Visi Misi)</option>
                                                                 <option value="expertise" {{ $m->module_name == 'expertise' ? 'selected' : '' }}>Kompetensi Keahlian (Home - Bagian Jurusan)</option>
                                                                 <option value="ekskul" {{ $m->module_name == 'ekskul' ? 'selected' : '' }}>Ekstrakurikuler (Home - Bagian Ekskul)</option>
                                                                 <option value="contact" {{ $m->module_name == 'contact' ? 'selected' : '' }}>Hubungi Kami (Home - Bagian Kontak)</option>
                                                             </select>
                                                         </div>

                                                         <div class="flex justify-end gap-2 mt-6 pt-4 border-t dark:border-zink-500">
                                                             <button type="button" data-modal-close="editSubmenusModal{{ $m->id }}"
                                                                 class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10">Batal</button>
                                                             <button type="submit"
                                                                 class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update Sub Menu</button>
                                                         </div>
                                                     </form>
                                                 </div>
                                             </div>
                                         </div><!--end edit Employee-->

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
                                                                action="{{ route('admin.submenus.destroy', $m->id) }}"
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
                            <form class="create-form" id="create-form" action="{{ route('admin.submenus.store') }}"
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
                                        <input type="text" id="slugInput" name="slug"
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
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        // Konfigurasi toolbar Quill
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'header': 1 }, { 'header': 2 }],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            [{ 'align': [] }],
            ['link', 'image'],
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
        function toggleEditSubmenuFields(submenuId) {
            const selectEl = document.getElementById('type-select-edit-' + submenuId);
            if (!selectEl) return;
            const type = selectEl.value;

            // Hide all sections in this modal
            document.getElementById('custom-section-edit-' + submenuId).style.display = 'none';
            document.getElementById('url-section-edit-' + submenuId).style.display = 'none';
            document.getElementById('module-section-edit-' + submenuId).style.display = 'none';

            // Show selected section
            if (type === 'custom') {
                document.getElementById('custom-section-edit-' + submenuId).style.display = 'block';
                // Initialize Quill when section is shown if not already initialized
                const textarea = document.getElementById('quill-textarea-edit-' + submenuId);
                if (textarea && !textarea.dataset.quillInitialized) {
                    initQuillEditor('quill-textarea-edit-' + submenuId, 'quill-container-edit-' + submenuId);
                }
            } else if (type === 'url') {
                document.getElementById('url-section-edit-' + submenuId).style.display = 'block';
            } else if (type === 'module') {
                document.getElementById('module-section-edit-' + submenuId).style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Quill for the default custom section of edit modal when opened
            document.body.addEventListener('click', function(e) {
                var trigger = e.target.closest('[data-modal-target^="editSubmenusModal"]');
                if (trigger) {
                    var modalId = trigger.getAttribute('data-modal-target');
                    setTimeout(function() {
                        var modal = document.getElementById(modalId);
                        if (modal) {
                            var submenuId = modalId.replace('editSubmenusModal', '');
                            toggleEditSubmenuFields(submenuId);
                        }
                    }, 300);
                }
            });
        });
    </script>
@endpush
