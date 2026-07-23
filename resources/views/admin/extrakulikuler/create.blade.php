@extends('admin.layouts.app')
@section('title', 'Buat Ekstrakulikuler')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="container mx-auto p-6">
            <div class="max-w-4xl mx-auto bg-white rounded shadow-sm p-6">
                <h2 class="text-2xl font-semibold mb-6">Tambah Ekstrakulikuler</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.extrakulikuler.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-4">
                            <label class="block text-sm font-medium mb-2">Menu</label>
                            <select name="s_menu_id"
                                class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                <option value="">Pilih Menu</option>
                                @if (!empty($menus))
                                    @foreach ($menus as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">(Tidak ada menu)</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-span-12 md:col-span-8">
                            <label class="block text-sm font-medium mb-2">Nama</label>
                            <input type="text" name="name"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Nama ekstrakulikuler">
                        </div>

                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-2">Deskripsi</label>
                            <textarea id="editor" name="description" class="block w-full p-4 min-h-[200px] border border-gray-200 rounded"
                                placeholder="Deskripsi singkat" style="display:none;">{{ old('description') }}</textarea>
                            <div id="quill-editor" style="min-height:200px; background:#fff;"></div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="block text-sm font-medium mb-2">Foto</label>
                            <input type="file" name="photo" accept="image/*">
                            <span class="text-xs text-slate-500 mt-1 block">Maksimal ukuran file: 2 MB</span>
                        </div>

                        <div class="col-span-12 text-right mt-4">
                            <button class="inline-block px-4 py-2 bg-blue-600 text-white rounded" style="background:blue;"
                                type="submit">Simpan</button>
                            <a href="{{ route('admin.extrakulikuler.index') }}"
                                class="inline-block px-4 py-2 ml-2 border rounded">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var textarea = document.getElementById('editor');
            if (!textarea) return;

            var quill = new Quill('#quill-editor', {
                modules: {
                    toolbar: [
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
                        ['link', 'image'],
                        ['clean']
                    ]
                },
                theme: 'snow'
            });

            if (textarea.value) quill.root.innerHTML = textarea.value;

            var form = textarea.closest('form');
            if (form) form.addEventListener('submit', function() {
                textarea.value = quill.root.innerHTML;
            });
        });
    </script>
@endpush
