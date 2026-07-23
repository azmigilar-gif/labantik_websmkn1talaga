@extends('admin.layouts.app')
@section('title', 'Edit Berita')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Edit Berita</h2>

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
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Kategori</label>

                            <select name="s_category_id"
                                class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
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
                                            {{ old('s_menu_id', $news->s_menu_id) == $m->id ? 'selected' : '' }}>
                                            {{ $m->name }}</option>
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
                            <label class="mb-2 block text-sm font-medium text-gray-700">Tag</label>

                            <select
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                id="choices-multiple-default" name="s_tag_id[]" multiple="">
                                @foreach ($tags as $item)
                                    <option value="{{ $item->id }}"
                                        {{ collect(old('s_tag_id', $news->tags->pluck('id')))->contains($item->id) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('s_tag_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" name="title" value="{{ old('title', $news->title) }}"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Tentukan judul di sini">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-12">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Konten</label>
                            <textarea id="editor" name="content"
                                class="ckeditor-classic block min-h-[300px] w-full rounded {{ $errors->has('content') ? 'border-red-500' : 'border-gray-200' }} border p-4 text-slate-800"
                                placeholder="Mulai tulis di sini...">{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="col-span-12 mt-4 text-right">
                        <button class="inline-block rounded bg-blue-600 px-4 py-2 text-white" type="submit"
                            style="background: rgb(110, 110, 255); color:white;">Simpan</button>
                        <a href="{{ route('admin.news.index') }}"
                            class="ml-2 inline-block rounded border px-4 py-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <!-- Choices.js library for tag input -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Quill editor (free, no jQuery). Custom image upload handler that posts to your news.upload.image route -->
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
                addItems: true,
                addChoices: true,
                editItems: false,
                duplicateItemsAllowed: false,
                delimiter: ',',
                paste: true,
                searchResultLimit: 10,
                shouldSort: false,

                addItemFilter: function(value) {
                    if (!value || value.trim().length < 2) {
                        return false;
                    }

                    const normalizedValue = value.trim().toLowerCase();
                    const items = choicesInstance.getValue(true);

                    const isDuplicate = items.some(item => {
                        const itemLabel = choicesInstance._store.choices.find(c => c.value ==
                            item);
                        return itemLabel && itemLabel.label.toLowerCase() === normalizedValue;
                    });

                    return !isDuplicate;
                },

                addItemText: (value) => {
                    return `Tekan <b>Enter</b> untuk menambah tag: "${value}"`;
                },
            });

            tagSelect.addEventListener('addItem', function(event) {
                const addedValue = event.detail.value;
                const addedLabel = event.detail.label;

                if (isNaN(addedValue)) {
                    console.log('Tag baru ditambahkan:', addedLabel);

                    setTimeout(() => {
                        const items = document.querySelectorAll('.choices__item');
                        items.forEach(item => {
                            if (item.dataset.value === addedValue) {
                                item.style.backgroundColor = '#10b981';
                                item.title = 'Tag baru (akan dibuat saat save)';
                            }
                        });
                    }, 100);
                }
            });

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
                                const selectedValues = choicesInstance.getValue(true);
                                choicesInstance.clearChoices();

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
            // Create editor container and hide original textarea visually
            var textarea = document.getElementById('editor');
            // create a div to host quill and insert it before textarea
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
                            'ck-upload-url').textContent.trim() :
                        '{{ route('admin.news.upload.image') }}';
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
