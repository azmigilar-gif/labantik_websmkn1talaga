@extends('admin.layouts.app')
@section('title', 'Edit Mitra')
@section('content')
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu px-4 pt-[calc(theme('spacing.header')_*_1)]">
        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Edit Mitra</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.mitra.update', $m->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-8">
                            <label class="mb-2 block text-sm font-medium">Nama</label>
                            <input type="text" name="name" value="{{ old('name', $m->name) }}"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Nama mitra">
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium">Foto</label>
                             <input type="file"
                                class="cursor-pointer form-file form-file-sm border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                name="photo" accept="image/*" data-cropper="true" data-aspect-ratio="3/2">
                            <span class="text-xs text-slate-500 mt-1 block">Rekomendasi ukuran: 600 x 400 px (Rasio 3:2) agar logo presisi. Maksimal ukuran file: 2 MB</span>
                        </div>

                        <div class="col-span-12 mt-4 text-right">
                            <button class="inline-block rounded bg-blue-600 px-4 py-2 text-white"
                                type="submit">Simpan</button>
                            <a href="{{ route('admin.mitra.index') }}"
                                class="ml-2 inline-block rounded border px-4 py-2">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
