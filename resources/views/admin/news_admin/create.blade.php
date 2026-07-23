@extends('admin.layouts.app')
@section('title', 'Buat Berita')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Tulis Artikel</h2>

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan validasi</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-inside list-disc space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Kategori</label>

                            <select name="s_category_id"
                                class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                <option value="">Pilih Kategori</option>
                                @if (!empty($categories))
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->name }}"
                                            {{ old('s_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">(Tidak ada kategori)</option>
                                @endif
                            </select>
                            @error('s_category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Menu</label>
                            <select name="s_menu_id"
                                class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
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
                            @error('s_menu_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Tags</label>

                            <select
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                id="choices-multiple-default" name="s_tag_id[]" multiple="">
                                @foreach ($tags as $item)
                                    <option value="{{ $item->id }}"
                                        {{ collect(old('s_tag_id'))->contains($item->id) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('s_tag_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-semibold text-gray-700">Topik Artikel (AI)</label>

                            <div class="relative flex items-center gap-2">
                                <input type="text" id="ai-topic"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Contoh: Prestasi Juara LKS Tingkat Provinsi">

                                <button type="button" id="btn-ai-generate"
                                    class="flex h-11 items-center gap-2 rounded-lg bg-custom-600 px-4 text-sm font-medium text-white hover:bg-custom-700 disabled:opacity-60">
                                    <i data-lucide="wand" class="h-4 w-4"></i>
                                    Generate
                                </button>
                            </div>

                            <div id="ai-topic-loader" class="mt-2 hidden flex items-center gap-2 text-sm text-custom-600">
                                <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a12 12 0 00-12 12h4z"></path>
                                </svg>
                                <span>AI sedang menyusun artikel...</span>
                            </div>
                        </div>



                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Tentukan judul di sini">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-12">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Konten</label>
                            <textarea id="editor" name="content"
                                class="ckeditor-classic block min-h-[300px] w-full rounded border border-gray-200 p-4 text-slate-800"
                                placeholder="Mulai tulis di sini..."><h3>Menjadi Generasi Unggul Bersama SMKN 1 Talaga</h3>
<p><br data-cke-filler="true"></p>

<p>SMKN 1 Talaga adalah tempat di mana ilmu, karakter, dan kreativitas bertemu. Di sekolah
    ini, setiap siswa tidak hanya
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

                    </div>

                    <div class="col-span-12 mt-4 text-right">
                        <button class="inline-block rounded bg-blue-600 px-4 py-2 text-white" type="submit"
                            style="background: rgb(110, 110, 255);
                    color:white;">Simpan</button>
                        <a href="{{ route('admin.news.index') }}"
                            class="ml-2 inline-block rounded border px-4 py-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Choices.js for tag select
            const tagSelect = document.getElementById('choices-multiple-default');

            const choicesInstance = new Choices(tagSelect, {
                removeItemButton: true,
                searchEnabled: true,
                searchChoices: true,
                searchPlaceholderValue: 'Cari atau ketik tag baru...',
                noResultsText: 'Tidak ada hasil. Tekan Enter untuk menambah.',
                noChoicesText: 'Tidak ada pilihan',
                itemSelectText: 'Klik untuk pilih',
                maxItemCount: -1,

                // KUNCI UTAMA: Setting ini memungkinkan penambahan item baru
                addItems: true,
                addChoices: true,
                editItems: false,
                duplicateItemsAllowed: false,
                delimiter: ',',
                paste: true,
                searchResultLimit: 10,
                shouldSort: false,

                // Custom validation untuk tag baru
                addItemFilter: function(value) {
                    // Minimal 2 karakter
                    if (!value || value.trim().length < 2) {
                        return false;
                    }

                    // Cek duplikat (case insensitive)
                    const normalizedValue = value.trim().toLowerCase();
                    const items = choicesInstance.getValue(true); // Get selected values

                    // Check in selected items
                    const isDuplicate = items.some(item => {
                        const itemLabel = choicesInstance._store.choices.find(c => c.value ==
                            item);
                        return itemLabel && itemLabel.label.toLowerCase() === normalizedValue;
                    });

                    return !isDuplicate;
                },

                // Fungsi untuk menampilkan pesan saat mengetik
                addItemText: (value) => {
                    return `Tekan <b>Enter</b> untuk menambah tag: "${value}"`;
                },
            });

            // Event handler untuk menambah tag baru saat Enter
            tagSelect.addEventListener('addItem', function(event) {
                const addedValue = event.detail.value;
                const addedLabel = event.detail.label;

                // Jika value adalah string (bukan ID dari database), tandai sebagai tag baru
                if (isNaN(addedValue)) {
                    console.log('Tag baru ditambahkan:', addedLabel);

                    // Optional: Bisa tambahkan indikator visual untuk tag baru
                    setTimeout(() => {
                        const items = document.querySelectorAll('.choices__item');
                        items.forEach(item => {
                            if (item.dataset.value === addedValue) {
                                item.style.backgroundColor =
                                    '#10b981'; // Green for new tags
                                item.title = 'Tag baru (akan dibuat saat save)';
                            }
                        });
                    }, 100);
                }
            });

            // Fetch tags dari server saat user mencari
            let searchTimeout;
            tagSelect.addEventListener('search', function(e) {
                clearTimeout(searchTimeout);
                const searchText = e.detail.value;

                if (searchText && searchText.length > 1) {
                    searchTimeout = setTimeout(function() {
                        fetch('{{ route('admin.news.fetch-tags') }}?search=' + encodeURIComponent(
                                searchText))
                            .then(response => response.json())
                            .then(data => {
                                // Get currently selected values
                                const selectedValues = choicesInstance.getValue(true);

                                // Clear existing choices
                                choicesInstance.clearChoices();

                                // Add fetched tags as choices
                                if (data && data.length > 0) {
                                    const choices = data.map(tag => ({
                                        value: tag.id.toString(),
                                        label: tag.label,
                                        selected: false,
                                        disabled: false
                                    }));

                                    choicesInstance.setChoices(choices, 'value', 'label', true);
                                }
                            })
                            .catch(err => console.error('Error fetching tags:', err));
                    }, 300);
                }
            });

            // AI Generate Button
            const btnGenerate = document.getElementById('btn-ai-generate');
            const loader = document.getElementById('ai-topic-loader');

            if (btnGenerate) {
                btnGenerate.addEventListener('click', async function() {
                    const topic = document.getElementById('ai-topic').value.trim();

                    if (!topic) {
                        alert('Topik artikel belum diisi.');
                        return;
                    }

                    loader.classList.remove('hidden');
                    btnGenerate.disabled = true;

                    try {
                        const res = await fetch('/api/ai/ask', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                prompt: `Buatkan artikel gaya narasi majalah/berita sekolah lengkap, judulnya jelas, pembagian pembukaan, isi dan penutupnya harus rapi dan berparagraf dengan topik: "${topic}".

                                    FORMAT OUTPUT WAJIB:
                                    1. Setiap paragraf HARUS berada di dalam <p>...</p> dan TIDAK BOLEH ADA <p></p> kosong.
                                    2. JIKA ingin memberi jarak(enter)antar paragraf, gunakan <br> setiap setelah </p>.
                                    3. Gunakan tag <b>...</b> untuk menebalkan teks. DILARANG menggunakan **, __, markdown, atau simbol lain.
                                    4. DILARANG menggunakan html atau blok kode apa pun.
                                    5. Gunakan hanya tag: <p>, <br>, <b>, <ul>, <li>.
                                    6. Output HARUS langsung berupa HTML bersih tanpa penjelasan, tanpa komentar, tanpa teks tambahan.
                                    7. Setiap output harus menjelaskan/berfokus pada smkn 1 talaga.
                                    8. Gunakan <b> dan list <li> jika ada bagian yang perlu menggunakan elemen tersebut.`
                            })
                        });

                        const data = await res.json();

                        if (!data.result) {
                            alert('AI gagal menghasilkan artikel.');
                            return;
                        }

                        const quill = Quill.find(document.getElementById('quill-editor'));
                        quill.setText('');
                        quill.clipboard.dangerouslyPasteHTML(data.result);

                    } catch (e) {
                        alert('Terjadi kesalahan: ' + e.message);
                    } finally {
                        loader.classList.add('hidden');
                        btnGenerate.disabled = false;
                    }
                });
            }

            // Quill Editor Setup
            var textarea = document.getElementById('editor');
            var quillContainer = document.createElement('div');
            quillContainer.id = 'quill-editor';
            quillContainer.style.height = '500px';
            textarea.parentNode.insertBefore(quillContainer, textarea);
            textarea.style.display = 'none';

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

            var quill = new Quill('#quill-editor', {
                modules: {
                    toolbar: {
                        container: toolbarOptions,
                        handlers: {}
                    }
                },
                theme: 'snow'
            });

            if (textarea.value) {
                quill.root.innerHTML = textarea.value;
            }

            function imageHandler() {
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
                    xhr.open('POST', '{{ route('admin.news.upload.image') }}', true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status >= 200 && xhr.status < 300) {
                            try {
                                var resp = JSON.parse(xhr.responseText);
                                if (resp && resp.url) {
                                    var width = prompt(
                                        'Masukkan lebar gambar (pixel):\n\nContoh: 300, 400, 500', '300'
                                    );
                                    if (width !== null && width.trim() !== '') {
                                        width = parseInt(width);
                                        if (!isNaN(width) && width > 0) {
                                            var range = quill.getSelection(true);
                                            quill.insertEmbed(range.index, 'image', resp.url);
                                            var imgElement = quill.root.querySelector('img[src="' + resp
                                                .url + '"]');
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
                                }
                            } catch (e) {
                                alert('Upload failed: ' + e.message);
                            }
                        }
                    };

                    xhr.send(formData);
                };
            }

            quill.getModule('toolbar').addHandler('image', imageHandler);

            var form = textarea.closest('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    textarea.value = quill.root.innerHTML;
                });
            }
        });
    </script>
@endpush
