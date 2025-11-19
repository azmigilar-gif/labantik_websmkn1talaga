@extends('admin.layouts.app')
@section('title', 'Detail Kontak')
@section('content')
<div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

    <div class="container mx-auto p-6">
        <div class="max-w-3xl mx-auto bg-white rounded shadow-sm p-6">
            <h2 class="text-2xl font-semibold mb-4">Contact Detail</h2>
            <div class="mb-4"><strong>Address 1:</strong> {{ $contact->address_1 }}</div>
            <div class="mb-4"><strong>Address 2:</strong> {{ $contact->address_2 ?? '-' }}</div>
            <div class="mb-4"><strong>Email:</strong> {{ $contact->email ?? '-' }}</div>
            <div class="mb-4"><strong>No Telp:</strong> {{ $contact->no_telp ?? '-' }}</div>
            <div class="mb-4"><strong>Menu:</strong> {{ $contact->menu?->name ?? '-' }}</div>
            <div class="text-right">
                <a href="{{ route('admin.contacts.edit', $contact->id) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded">Edit</a>
                <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 ml-2 border rounded">Kembali</a>
            </div>
        </div>
    </div>
    </div>
@endsection
