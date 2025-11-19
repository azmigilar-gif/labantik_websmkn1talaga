@extends('admin.layouts.app')
@section('title', 'Buat Berita')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Tulis Artikel</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Kategori</label>

                            <select name="s_category_id" class="block w-full rounded border-gray-200 p-3 shadow-sm">
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
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Menu</label>
                            <select name="s_menu_id" class="block w-full rounded border-gray-200 p-3 shadow-sm">
                                <option value="">Pilih Menu</option>
                                @if (!empty($menus))
                                    @foreach ($menus as $m)
                                        <option value="{{ $m->id }}"
                                            {{ old('s_menu_id') == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">(Tidak ada menu)</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-span-12 md:col-span-8">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" name="title" class="block w-full rounded border-gray-200 p-3 shadow-sm"
                                placeholder="Tentukan judul di sini">
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
                        <a href="{{ route('admin.news.index') }}" class="ml-2 inline-block rounded border px-4 py-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <!-- Quill editor (free, no jQuery). Custom image upload handler that posts to your news.upload.image route -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create editor container and hide original textarea visually
            var textarea = document.getElementById('editor');
            // create a div to host quill and insert it before textarea
            var quillContainer = document.createElement('div');
            quillContainer.id = 'quill-editor';
            quillContainer.style.height = '500px';
            textarea.parentNode.insertBefore(quillContainer, textarea);
            textarea.style.display = 'none';

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

            var quill = new Quill('#quill-editor', {
                modules: {
                    toolbar: {
                        container: toolbarOptions,
                        handlers: {}
                    }
                },
                theme: 'snow'
            });

            // If textarea already has content, load into quill
            if (textarea.value) {
                quill.root.innerHTML = textarea.value;
            }

            // Image handler: open file input, upload to server, insert image URL
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
                    var url = '{{ route('admin.news.upload.image') }}';
                    xhr.open('POST', url, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                try {
                                    var resp = JSON.parse(xhr.responseText);
                                    if (resp && resp.url) {
                                        // Ask user for image width in pixels
                                        var width = prompt(
                                            'Masukkan lebar gambar (pixel):\n\nContoh: 300, 400, 500',
                                            '300');

                                        if (width !== null && width.trim() !== '') {
                                            // Validate that it's a number
                                            width = parseInt(width);
                                            if (!isNaN(width) && width > 0) {
                                                var range = quill.getSelection(true);
                                                // Insert image with width style
                                                quill.insertEmbed(range.index, 'image', resp.url);
                                                // Get the inserted image and set its style
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
                                    } else {
                                        alert('Upload failed: invalid response');
                                    }
                                } catch (e) {
                                    alert('Upload failed: ' + e.message);
                                }
                            } else if (xhr.status === 401 || xhr.status === 403) {
                                alert('Upload failed: authentication error');
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

            // Attach the image handler to the toolbar
            quill.getModule('toolbar').addHandler('image', imageHandler);

            // On form submit, copy quill HTML to textarea so it's submitted
            var form = textarea.closest('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    textarea.value = quill.root.innerHTML;
                });
            }
        });
    </script>
@endpush
