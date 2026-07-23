@extends('admin.layouts.app')
@section('title', 'Tambah Prestasi')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold text-slate-800">Tambah Prestasi</h2>
                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
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

                <form action="{{ route('admin.achievement.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-6">
                        <!-- Judul Prestasi / Lomba -->
                        <div class="col-span-12 md:col-span-8">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Judul Prestasi / Lomba</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-input w-full border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Contoh: Juara 1 LKS Tingkat Provinsi" required>
                        </div>

                        <!-- Kategori -->
                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Kategori</label>
                            <select name="category" 
                                class="form-select w-full border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Akademik" {{ old('category') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="Non-Akademik" {{ old('category') == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                <option value="Olahraga" {{ old('category') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                <option value="Seni" {{ old('category') == 'Seni' ? 'selected' : '' }}>Seni</option>
                            </select>
                        </div>

                        <!-- Nama Pemenang -->
                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Nama Pemenang / Perwakilan</label>
                            <input type="text" name="winner_name" value="{{ old('winner_name') }}"
                                class="form-input w-full border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Nama siswa atau tim pemenang" required>
                        </div>

                        <!-- Sosmed Pemenang -->
                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Media Sosial Pemenang</label>
                            <input type="text" name="winner_social" value="{{ old('winner_social') }}"
                                class="form-input w-full border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Contoh: https://instagram.com/username">
                        </div>

                        <!-- Tanggal -->
                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Tanggal Pencapaian</label>
                            <input type="date" name="date" value="{{ old('date') }}"
                                class="form-input w-full border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800" required>
                        </div>

                        <!-- Foto Dokumentasi -->
                        <div class="col-span-12 md:col-span-6">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Foto Dokumentasi</label>
                            <input type="file" name="photo" accept="image/*" data-cropper="true" data-aspect-ratio="4/3"
                                class="form-input w-full border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                            <span class="text-xs text-slate-500 mt-1 block">Rekomendasi ukuran: 800 x 600 px (Rasio 4:3) agar tidak terpotong. Maksimal ukuran file: 2 MB</span>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-span-12 mb-6">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Deskripsi Lengkap Prestasi</label>
                            <textarea id="editor" name="description" class="block w-full p-4 min-h-[200px] border border-slate-200 rounded"
                                placeholder="Deskripsi singkat" style="display:none;">{{ old('description') }}</textarea>
                            <div id="quill-editor" style="min-height:200px; background:#fff; border: 1px solid #e2e8f0; border-radius: 6px;"></div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-span-12 text-right mt-8 pt-4 pb-12" style="clear: both;">
                            <button type="submit"
                                class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 text-white font-semibold px-5 py-2.5 rounded">Simpan</button>
                            <a href="{{ route('admin.achievement.index') }}"
                                class="ml-2 inline-block rounded border border-slate-200 px-5 py-2.5 text-slate-500 hover:bg-slate-50 text-sm font-medium">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var textarea = document.getElementById('editor');
            if (!textarea) return;

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
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            if (textarea.value) quill.root.innerHTML = textarea.value;

            var form = textarea.closest('form');
            if (form) {
                form.addEventListener('submit', function() {
                    textarea.value = quill.root.innerHTML;
                });
            }
        });
    </script>
@endpush
