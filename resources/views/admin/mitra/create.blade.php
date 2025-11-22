@extends('admin.layouts.app')
@section('title', 'Tambah Mitra')
@section('content')
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu px-4 pt-[calc(theme('spacing.header')_*_1)]">
        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-2xl font-semibold">Tambah Mitra Industri</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.mitra.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-8">
                            <label class="mb-2 block text-sm font-medium">Nama</label>
                            <input type="text" name="name" class="block w-full rounded border-gray-200 p-3 shadow-sm"
                                placeholder="Nama mitra">
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label class="mb-2 block text-sm font-medium">Foto</label>
                            <input type="file" name="photo" accept="image/*">
                        </div>

                        <div class="col-span-12 mt-4 text-right">
                                                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 add-employee">Simpan</button>

                            <a href="{{ route('admin.mitra.index') }}"
                                class="ml-2 inline-block rounded border px-4 py-2">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
