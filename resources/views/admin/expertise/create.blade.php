@extends('admin.layouts.app')
@section('title', 'Tambah Deskripsi Jurusan')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-3xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Tambah Deskripsi Jurusan</h2>

                @if (session('success'))
                    <div class="mb-4 rounded bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded bg-red-50 p-3 text-red-700">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($cores->isEmpty())
                    <div class="text-sm text-slate-500">Semua jurusan sudah memiliki deskripsi.</div>
                @else
                    <form action="{{ route('admin.expertise.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="mb-2 block text-sm font-medium">Pilih Jurusan (yang belum punya deskripsi)</label>
                            <select name="id_concentrations" required class="w-full rounded border p-2">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($cores as $c)
                                    <option value="{{ $c->id }}"
                                        {{ isset($selected) && $selected == $c->id ? 'selected' : '' }}>{{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="editor" class="mb-2 block text-sm font-medium text-gray-700">
                                Deskripsi Keahlian
                            </label>
                            <textarea id="editor" name="description"
                                class="ckeditor-classic block min-h-[300px] w-full rounded border border-gray-200 p-4 text-slate-800"
                                placeholder="Mulai tulis di sini...">{{ old('description', $expertise->description ?? '') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="text-right">
                            <a href="{{ route('admin.expertise.index') }}">Kembali</a>
                            <button type="submit"
                                class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 add-employee text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">Simpan</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @push('scripts')
        <!-- Quill editor (free, no jQuery). Custom image upload handler that posts to your expertise.upload.image route -->
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
                    }, {
                        'header': 3
                    }, {
                        'header': 4
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
                        var url = '{{ route('admin.expertise.upload.image') }}';
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
@endsection
