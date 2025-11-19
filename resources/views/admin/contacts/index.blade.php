@extends('admin.layouts.app')
@section('title', 'Index Contacts')
@section('content')
<div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

    <div class="container mx-auto p-6">
        <div class="max-w-4xl mx-auto bg-white rounded shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold">Daftar Kontak</h2>
                <a href="{{ route('admin.contacts.create') }}" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 add-employee">Tambah Kontak</a>
            </div>

            @if (isset($contacts) && $contacts->count())
                <table id="rowBorder" class="w-full">
                    <thead>
                        <tr>
                            <th class="p-2 text-left">Address 1</th>
                            <th class="p-2 text-left">Address 2</th>
                            <th class="p-2 text-left">Email</th>
                            <th class="p-2 text-left">No Telp</th>
                            <th class="p-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($contacts as $c)
                            <tr>
                                <td class="p-2">{{ $c->address_1 }}</td>
                                <td class="p-2">{{ $c->address_2 ?? '-' }}</td>
                                <td class="p-2">{{ $c->email ?? '-' }}</td>
                                <td class="p-2">{{ $c->no_telp ?? '-' }}</td>
                                <td class="p-2">
                                    <a href="{{ route('admin.contacts.show', $c->id) }}" class="text-blue-600 mr-2">Lihat</a>
                                    <a href="{{ route('admin.contacts.edit', $c->id) }}" class="text-green-600 mr-2">Edit</a>
                                    <form action="{{ route('admin.contacts.destroy', $c->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Hapus kontak ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $contacts->links() }}</div>
            @else
                <div class="py-12 text-center">Belum ada kontak</div>
            @endif
        </div>
    </div>
</div>
@endsection
