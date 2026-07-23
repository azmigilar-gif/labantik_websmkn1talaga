@extends('admin.layouts.app')
@section('title', 'Index Profile Sekolah')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Dashboard</h5>
                </div>
                <ul class="flex shrink-0 items-center gap-2 text-sm font-normal">
                    <li
                        class="before:font-remix dark:text-zink-200 relative before:absolute before:-top-[3px] before:text-[18px] before:text-slate-400 before:content-['\ea54'] ltr:pr-4 ltr:before:-right-1 rtl:pl-4 rtl:before:-left-1">
                        <a href="#!" class="dark:text-zink-200 text-slate-400">Dashboard</a>
                    </li>
                    <li class="dark:text-zink-100 text-slate-700">
                        Profile Sekolah
                    </li>
                </ul>
            </div>

            <div class="card mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 flex items-center justify-between">
                            <a href="#!" data-modal-target="addProfileModal" type="button"
                                class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 add-employee text-white hover:text-white focus:text-white focus:ring active:text-white active:ring"><i
                                    data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Tambah
                                    Profile Sekolah</span></a>
                        </div>

                        @if (isset($profiles) && $profiles->count())
                            <table id="rowBorder" class="w-full">
                                <thead>
                                    <tr>
                                        <th class="p-2 text-left">No</th>
                                        <th class="p-2 text-left">Foto</th>
                                        <th class="p-2 text-left">Profile Sekolah</th>
                                        <th class="p-2 text-left">Dibuat oleh</th>
                                        <th class="p-2 text-left">Diupdate oleh</th>
                                        <th class="p-2 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="dark:divide-zink-500 divide-y divide-slate-200">
                                    @foreach ($profiles as $p)
                                        <tr>
                                            <td class="p-2">{{ $loop->iteration }}</td>
                                            <td class="p-2">
                                                @if($p->photo)
                                                    <img src="{{ asset($p->photo) }}" alt="" class="h-10 w-10 object-cover rounded shadow-sm">
                                                @else
                                                    <span class="text-slate-400 italic" style="font-size: 11px;">(Tidak ada foto)</span>
                                                @endif
                                            </td>
                                            <td class="p-2 whitespace-pre-wrap">
                                                {!! Str::limit(strip_tags($p->content), 90, '...') ?? '-' !!}
                                            </td>
                                            <td class="p-2">{{ $p->createdBy->name ?? '-' }}</td>
                                            <td class="p-2">{{ $p->updatedBy->name ?? '-' }}</td>
                                            <td class="p-2">
                                                <div class="flex gap-2">
                                                    <a href="#!"
                                                        data-modal-target="editProfileModal{{ $p->id }}"
                                                        class="edit-item-btn hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500 flex size-8 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-all duration-200 ease-linear"><i
                                                            data-lucide="pencil" class="size-4"></i></a>
                                                    <a href="#!" data-modal-target="deleteModal{{ $p->id }}"
                                                        class="remove-item-btn hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500 flex size-8 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-all duration-200 ease-linear"><i
                                                            data-lucide="trash-2" class="size-4"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <div id="editProfileModal{{ $p->id }}" modal-center=""
                                            class="z-drawer show fixed left-2/4 flex hidden -translate-x-2/4 -translate-y-2/4 flex-col transition-all duration-300 ease-in-out">
                                            <div class="dark:bg-zink-600 w-screen rounded-md bg-white shadow md:w-[40rem]">
                                                <div
                                                    class="dark:border-zink-500 flex items-center justify-between border-b p-4">
                                                    <h5 class="text-16 font-medium" id="editVisiMisiLabel">Edit Profile
                                                        Sekolah
                                                    </h5>
                                                </div>

                                                <div
                                                    class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                                    <form id="edit-form"
                                                        action="{{ route('admin.profiles.update', $p->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="xl:col-span-6">
                                                            <label for="edit_s_menu_id"
                                                                class="mb-2 inline-block text-base font-medium">Menu</label>
                                                            <select
                                                                class="form-input dark:border-zink-500 focus:border-custom-500 dark:disabled:bg-zink-600 dark:disabled:border-zink-500 dark:disabled:text-zink-200 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 dark:placeholder:text-zink-200 border-slate-200 placeholder:text-slate-400 focus:outline-none disabled:border-slate-300 disabled:bg-slate-100 disabled:text-slate-500"
                                                                name="s_menu_id" id="edit_s_menu_id" required>
                                                                <option value="">Pilih Menu</option>
                                                                @foreach ($menus as $m)
                                                                    <option value="{{ $m->id }}"
                                                                        {{ $p->s_menu_id == $m->id ? 'selected' : '' }}>
                                                                        {{ $m->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mt-3 xl:col-span-6">
                                                            <label for="edit_photo_{{ $p->id }}" class="mb-2 inline-block text-base font-medium">Foto Profil/Thumbnail</label>
                                                            @if($p->photo)
                                                                <div class="mb-2">
                                                                    <img src="{{ asset($p->photo) }}" alt="Foto Profil" class="h-20 rounded shadow-sm">
                                                                </div>
                                                            @endif
                                                            <input type="file" id="edit_photo_{{ $p->id }}" name="photo" class="form-input dark:border-zink-500 focus:border-custom-500 border-slate-200" accept="image/*">
                                                            <span class="text-xs text-slate-500 mt-1 block">Maksimal ukuran file: 2 MB</span>
                                                        </div>

                                                        <!-- Ganti bagian textarea di modal edit -->
                                                        <div class="mt-3 xl:col-span-6">
                                                            <label for="edit_content_{{ $p->id }}"
                                                                class="mb-2 inline-block text-base font-medium">Profile
                                                                Sekolah</label>
                                                            <textarea rows="5" id="edit_content_{{ $p->id }}" name="content"
                                                                class="block min-h-[300px] w-full rounded border border-gray-200 p-4 text-slate-800"
                                                                placeholder="Masukkan Profile Sekolah" required>{{ old('content', $p->content) }}</textarea>
                                                        </div>

                                                        <div class="mt-4 flex justify-end gap-2">
                                                            <button type="button" id="close-edit-modal"
                                                                data-modal-close="editProfileModal{{ $p->id }}"
                                                                class="btn dark:bg-zink-600 bg-white text-red-500 hover:bg-red-100 hover:text-red-500 focus:bg-red-100 focus:text-red-500 active:bg-red-100 active:text-red-500 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">
                                                                Batal
                                                            </button>
                                                            <button type="submit"
                                                                class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">
                                                                Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="deleteModal{{ $p->id }}" modal-center=""
                                            class="z-drawer show fixed left-2/4 flex hidden -translate-x-2/4 -translate-y-2/4 flex-col transition-all duration-300 ease-in-out">
                                            <div class="dark:bg-zink-600 w-screen rounded-md bg-white shadow md:w-[25rem]">
                                                <div
                                                    class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                                    <img src="data:image/png;base64,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"
                                                        alt="" class="mx-auto block h-12">
                                                    <div class="mt-5 text-center">
                                                        <h5 class="mb-1">Are you sure?</h5>
                                                        <p class="dark:text-zink-200 text-slate-500">Are you certain you
                                                            want to delete this data?</p>
                                                        <div class="mt-6 flex justify-center gap-2">
                                                            <form class="delete-form"
                                                                action="{{ route('admin.profiles.destroy', $p->id) }}"
                                                                method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="reset"
                                                                    data-modal-close="deleteModal{{ $p->id }}"
                                                                    class="btn dark:bg-zink-600 bg-white text-slate-500 hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 active:bg-slate-100 active:text-slate-500 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">Cancel</button>
                                                                <button type="submit" id="delete-record"
                                                                    class="btn dark:ring-custom-400/20 border-red-500 bg-red-500 text-white hover:border-red-600 hover:bg-red-600 hover:text-white focus:border-red-600 focus:bg-red-600 focus:text-white focus:ring focus:ring-red-100 active:border-red-600 active:bg-red-600 active:text-white active:ring active:ring-red-100">Yes,
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
                                {{ $profiles->links() }}
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
                                <h3 class="mb-2 text-lg font-semibold">Belum ada Profile Sekolah</h3>
                                <p class="mb-4 text-sm text-slate-500">Belum ada Profile Sekolah yang dibuat. Klik tombol
                                    "Tambah
                                    Profile Sekolah" untuk membuat Profile Sekolah baru.</p>
                            </div>
                        @endif
                    </div>
                </div><!--end card-->
                <div id="addProfileModal" modal-center=""
                    class="z-drawer show fixed left-2/4 flex hidden -translate-x-2/4 -translate-y-2/4 flex-col transition-all duration-300 ease-in-out">
                    <div class="dark:bg-zink-800 w-screen rounded-md bg-white shadow md:w-[40rem]">
                        <div class="justify-beSTEen dark:border-zink-500 flex items-center border-b p-4">
                            <h5 class="text-16" id="addEmployeeLabel">Tambah Profile Sekolah</h5>
                        </div>
                        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                            <form class="create-form" id="create-form" action="{{ route('admin.profiles.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="xl:col-span-6">
                                    <label for="menus" class="mb-2 inline-block text-base font-medium">Menu</label>
                                    <select
                                        class="form-input dark:border-zink-500 focus:border-custom-500 dark:disabled:bg-zink-600 dark:disabled:border-zink-500 dark:disabled:text-zink-200 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 dark:placeholder:text-zink-200 border-slate-200 placeholder:text-slate-400 focus:outline-none disabled:border-slate-300 disabled:bg-slate-100 disabled:text-slate-500"
                                        data-choices="" name="s_menu_id" id="choices-single-default">
                                        <option value="">Pilih Menu</option>
                                        @if (!empty($menus))
                                            @foreach ($menus as $m)
                                                <option value="{{ $m->id }}"
                                                    {{ old('s_menu_id') == $m->id ? 'selected' : '' }}>{{ $m->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">(Tidak ada menu)</option>
                                        @endif
                                    </select>
                                </div>
 
                                <div class="mt-3 xl:col-span-6">
                                    <label for="add_photo" class="mb-2 inline-block text-base font-medium">Foto Profil/Thumbnail</label>
                                    <input type="file" id="add_photo" name="photo" class="form-input dark:border-zink-500 focus:border-custom-500 border-slate-200" accept="image/*">
                                    <span class="text-xs text-slate-500 mt-1 block">Maksimal ukuran file: 2 MB</span>
                                </div>
                                <div class="xl:col-span-6">
                                    <label for="slugInput" class="mb-2 inline-block text-base font-medium">Profile
                                        Sekolah</label>
                                    <textarea id="editor" name="content"
                                        class="block min-h-[300px] w-full rounded border border-gray-200 p-4 text-slate-800"
                                        placeholder="Mulai tulis di sini..."><h3>Menjadi Generasi Unggul Bersama SMKN 1 Talaga</h3>
<p><br data-cke-filler="true"></p>

<p>SMKN 1 Talaga adalah tempat di mana ilmu, karakter, dan kreativitas bertemu. Di sekolah
    ini, setiap siswa tidak hanyaaa
    diajarkan untuk memahami teori, tetapi juga untuk menerapkannya dalam dunia nyata
    melalui berbagai kegiatan praktik dan
    proyek nyata.</p>
<p><br data-cke-filler="true"></p>

<h4>Pendidikan yang Berkarakter dan Berdaya Saing</h4>
<p>SMKN 1 Talaga berkomitmen membentuk peserta didik yang tidak hanya cerdas secara
    akademik, tetapi juga memiliki
    kepribadian yang kuat, disiplin, dan berjiwa wirausaha. Melalui program keahlian yang
    beragam, siswa dilatih untuk siap
    menghadapi dunia industri maupun berwirausaha mandiri.</p>
<p><br data-cke-filler="true"></p>

<h4>Kolaborasi dan Kreativitas</h4>
<p>Setiap kegiatan di SMKN 1 Talaga mendorong kolaborasi dan kreativitas siswa, baik dalam
    bidang teknologi, seni, maupun
    kewirausahaan. Dengan semangat gotong royong dan inovasi, siswa belajar bagaimana
    menjadi bagian dari solusi di era
    digital ini.</p>
<p><br data-cke-filler="true"></p>

<ul>
    <li>Menumbuhkan semangat belajar dan berkarya</li>
    <li>Meningkatkan keterampilan sesuai bidang keahlian</li>
    <li>Mempersiapkan lulusan yang siap kerja dan berkarakter</li>
</ul></textarea>
                                </div>
                                <div class="mt-4 flex justify-end gap-2">
                                    <button type="reset" id="close-modal" data-modal-close="addProfileModal"
                                        class="btn dark:bg-zink-600 bg-white text-red-500 hover:bg-red-100 hover:text-red-500 focus:bg-red-100 focus:text-red-500 active:bg-red-100 active:text-red-500 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                                    <button type="submit" id="addNew"
                                        class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">Tambah
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
            [{
                'header': 1
            }, {
                'header': 2
            }],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'align': []
            }],
            ['link', 'image'],
            ['clean']
        ];

        // Fungsi untuk inisialisasi Quill editor
        function initQuillEditor(textareaId, containerId) {
            var textarea = document.getElementById(textareaId);
            if (!textarea || textarea.dataset.quillInitialized) return null;

            var quillContainer = document.createElement('div');
            quillContainer.id = containerId;
            quillContainer.style.height = '500px';
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

            // Load konten dari textarea ke Quill
            if (textarea.value) {
                quill.root.innerHTML = textarea.value;
            }

            // Update textarea saat konten Quill berubah
            quill.on('text-change', function() {
                textarea.value = quill.root.innerHTML;
            });

            // Update textarea sebelum form submit
            var form = textarea.closest('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    textarea.value = quill.root.innerHTML;
                });
            }

            textarea.dataset.quillInitialized = 'true';
            return quill;
        }

        // Image handler untuk upload gambar
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
                                    var width = prompt(
                                        'Masukkan lebar gambar (pixel):\n\nContoh: 300, 400, 500',
                                        '300');

                                    if (width !== null && width.trim() !== '') {
                                        width = parseInt(width);
                                        if (!isNaN(width) && width > 0) {
                                            var range = quill.getSelection(true);
                                            quill.insertEmbed(range.index, 'image', resp.url);
                                            var imgElement = quill.root.querySelector('img[src="' +
                                                resp.url + '"]');
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

        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi editor untuk form tambah
            initQuillEditor('editor', 'quill-editor-add');

            // Inisialisasi editor untuk form edit saat modal dibuka
            document.body.addEventListener('click', function(e) {
                var trigger = e.target.closest('[data-modal-target^="editProfileModal"]');
                if (trigger) {
                    var modalId = trigger.getAttribute('data-modal-target');
                    setTimeout(function() {
                        var modal = document.getElementById(modalId);
                        if (modal) {
                            var textarea = modal.querySelector('textarea[name="content"]');
                            if (textarea && !textarea.dataset.quillInitialized) {
                                var uniqueId = 'quill-editor-edit-' + modalId;
                                initQuillEditor(textarea.id, uniqueId);
                            }
                        }
                    }, 300);
                }
            });
        });
    </script>
@endpush
