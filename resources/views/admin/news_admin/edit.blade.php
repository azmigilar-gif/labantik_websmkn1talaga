@extends('admin.layouts.app')
@section('title', 'Edit Berita')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Edit Berita</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Kategori</label>

                            <select name="s_category_id" class="block w-full rounded border-gray-200 p-3 shadow-sm">
                                <option value="">Pilih Kategori</option>
                                @if (!empty($categories))
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->name }}"
                                            {{ old('s_category_id', $news->s_category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}</option>
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
                                            {{ old('s_menu_id', $news->s_menu_id) == $m->id ? 'selected' : '' }}>
                                            {{ $m->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">(Tidak ada menu)</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-span-12 md:col-span-8">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" name="title" value="{{ old('title', $news->title) }}"
                                class="block w-full rounded border-gray-200 p-3 shadow-sm"
                                placeholder="Tentukan judul di sini">
                        </div>

                        <div class="col-span-12">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Konten</label>
                            <textarea id="editor" name="content"
                                class="ckeditor-classic block min-h-[300px] w-full rounded border border-gray-200 p-4 text-slate-800"
                                placeholder="Mulai tulis di sini...">{{ old('content', $news->content) }}</textarea>
                        </div>

                    </div>

                    <div class="col-span-12 mt-4 text-right">
                        <button class="inline-block rounded bg-blue-600 px-4 py-2 text-white" type="submit"
                            style="background: rgb(110, 110, 255); color:white;">Simpan</button>
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
                        handlers: {
                            'image': imageHandler
                        }
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
                    var url = document.getElementById('ck-upload-url') ? document.getElementById(
                        'ck-upload-url').textContent.trim() : '{{ route('admin.news.upload.image') }}';
                    xhr.open('POST', url, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                try {
                                    var resp = JSON.parse(xhr.responseText);
                                    if (resp && resp.url) {
                                        var range = quill.getSelection(true);
                                        quill.insertEmbed(range.index, 'image', resp.url);
                                        // move cursor after image
                                        quill.setSelection(range.index + 1);
                                    } else {
                                        alert('Upload failed: invalid response');
                                    }
                                } catch (e) {
                                    alert('Upload failed: invalid JSON');
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

            // On form submit, copy quill HTML to textarea so it's submitted
            var form = textarea.closest('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    textarea.value = quill.root.innerHTML;
                });
            }
        });
    </script>
    <div id="ck-upload-url" class="hidden">{{ route('admin.news.upload.image') }}</div>
@endpush
