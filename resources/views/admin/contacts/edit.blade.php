@extends('admin.layouts.app')
@section('title', 'Edit Kontak')
@section('content')
<div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

    <div class="container mx-auto p-6">
        <div class="max-w-4xl mx-auto bg-white rounded shadow-sm p-6">
            <h2 class="text-2xl font-semibold mb-6">Edit Kontak</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 md:col-span-6">
                        <label class="block text-sm font-medium mb-2">Address 1</label>
                        <input type="text" name="address_1" value="{{ old('address_1', $contact->address_1) }}"
                            class="block w-full rounded border-gray-200 shadow-sm p-3" required>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="block text-sm font-medium mb-2">Address 2 (opsional)</label>
                        <input type="text" name="address_2" value="{{ old('address_2', $contact->address_2) }}"
                            class="block w-full rounded border-gray-200 shadow-sm p-3">
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $contact->email) }}"
                            class="block w-full rounded border-gray-200 shadow-sm p-3">
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="block text-sm font-medium mb-2">No Telp</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp', $contact->no_telp) }}"
                            class="block w-full rounded border-gray-200 shadow-sm p-3">
                    </div>

                    <div class="col-span-12 md:col-span-4">
                        <label class="block text-sm font-medium mb-2">Menu</label>
                        <select name="s_menu_id" class="block w-full rounded border-gray-200 shadow-sm p-3">
                            <option value="">Pilih Menu</option>
                            @if (!empty($menus))
                                @foreach ($menus as $m)
                                    <option value="{{ $m->id }}"
                                        {{ $contact->s_menu_id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-span-12 text-right mt-4">
                        <button class="inline-block px-4 py-2 bg-blue-600 text-white rounded" type="submit">Simpan</button>
                        <a href="{{ route('admin.contacts.index') }}" class="inline-block px-4 py-2 ml-2 border rounded">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
