@extends('admin.layouts.app')
@section('title', 'Edit Deskripsi Keahlian')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-3xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Edit Deskripsi: {{ $cores->name }}</h2>

                @if ($errors->any())
                    <div class="mb-4 rounded bg-red-50 p-3 text-red-700">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.expertise.update', $cores->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium">Nama Keahlian</label>
                        <div class="rounded border bg-slate-50 p-2">{{ $cores->name }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium">Deskripsi</label>
                        <textarea id="editor" name="description" required class="w-full rounded border p-2" style="display:none;">{{ old('description', $cores->sDescription->description ?? '') }}</textarea>
                        <div id="quill-editor" style="min-height:300px; background:#fff;"></div>
                    </div>

                    <div class="text-right">
                        <button class="inline-block rounded bg-blue-600 px-4 py-2 text-white" type="submit"
                            style="background: rgb(110, 110, 255);
                    color:white;">Simpan</button>
                        <a href="{{ route('admin.expertise.index') }}"
                            class="ml-2 inline-block rounded border px-4 py-2">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Quill editor for edit page -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var textarea = document.getElementById('editor');
            if (!textarea) return;

            var quillContainer = document.getElementById('quill-editor');
            if (!quillContainer) {
                quillContainer = document.createElement('div');
                quillContainer.id = 'quill-editor';
                quillContainer.style.minHeight = '300px';
                textarea.parentNode.insertBefore(quillContainer, textarea.nextSibling);
            }

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
                modules: { toolbar: { container: toolbarOptions, handlers: {} } },
                theme: 'snow'
            });

            // Load existing content into quill
            if (textarea.value) {
                quill.root.innerHTML = textarea.value;
            }

            // Image upload handler
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

            quill.getModule('toolbar').addHandler('image', imageHandler);

            var form = textarea.closest('form');
            if (form) {
                form.addEventListener('submit', function() {
                    textarea.value = quill.root.innerHTML;
                });
            }
        });
    </script>
@endpush
