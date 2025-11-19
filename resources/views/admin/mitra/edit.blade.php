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
                                class="block w-full rounded border-gray-200 p-3 shadow-sm" placeholder="Nama mitra">
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium">Foto</label>
                            <input type="file" name="photo" accept="image/*">
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
