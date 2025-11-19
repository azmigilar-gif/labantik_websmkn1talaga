@extends('admin.layouts.app')
@section('title', 'Ekstrakulikuler')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container mx-auto p-6">
            <div class="mx-auto max-w-4xl rounded bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-2xl font-semibold">Daftar Ekstrakulikuler</h2>
                    <a href="{{ route('admin.extrakulikuler.create') }}"
                        class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 add-employee text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">Tambah
                        Ekstrakulikuler</a>
                </div>

                @if (isset($extracurriculars) && $extracurriculars->count())
                    <table id="rowBorder" class="w-full">
                        <thead>
                            <tr>
                                <th class="p-2 text-left">Nama</th>
                                <th class="p-2 text-left">Foto</th>
                                <th class="p-2 text-left">Menu</th>
                                <th class="p-2 text-left">Status</th>
                                <th class="p-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($extracurriculars as $ex)
                                <tr>
                                    <td class="p-2">{{ $ex->name }}</td>
                                    <td class="p-2">
                                        @if ($ex->photo)
                                            @php
                                                // Build a safe URL for the photo. Possible stored values:
                                                // - full URL (http/https)
                                                // - starts with 'storage/...' (already public path)
                                                // - relative path like 'images/ekstrakulikuler/..' stored on public disk
                                                $photo = $ex->photo;
                                                if (filter_var($photo, FILTER_VALIDATE_URL)) {
                                                    $photoUrl = $photo;
                                                } else {
                                                    // If file was saved directly under public/assets, serve with asset()
                                                    if (
                                                        preg_match('#^assets/#', $photo) ||
                                                        preg_match('#^public/assets/#', $photo)
                                                    ) {
                                                        // normalize possible leading 'public/'
                                                        $p = preg_replace('#^public/#', '', $photo);
                                                        $photoUrl = asset($p);
                                                    } else {
                                                        // serve from storage/app/public via route so it works even without public/storage symlink
                                                        // if photo starts with 'storage/', strip that prefix
                                                        $rel = preg_replace('#^storage/#', '', $photo);
                                                        $photoUrl = route('public.files', ['path' => $rel]);
                                                    }
                                                }
                                            @endphp
                                            <img src="{{ $photoUrl }}" alt="photo" class="h-12"
                                                onerror="this.src='{{ asset('assets/images/default-extrakurikuler.png') }}'">
                                        @endif
                                    </td>
                                    <td class="p-2">{{ $ex->menu?->name ?? '-' }}</td>
                                    <td class="p-2">
                                        @if (($ex->approve ?? 'waiting') === 'waiting')
                                            <span
                                                class="rounded bg-yellow-100 px-2 py-1 text-xs text-yellow-800">Menunggu</span>
                                        @else
                                            <span
                                                class="rounded bg-green-100 px-2 py-1 text-xs text-green-800">Disetujui</span>
                                        @endif
                                    </td>
                                    <td class="p-2">
                                        <a href="{{ route('admin.extrakulikuler.show', $ex->id) }}"
                                            class="mr-2 text-blue-600">Lihat</a>
                                        <a href="{{ route('admin.extrakulikuler.edit', $ex->id) }}"
                                            class="mr-2 text-green-600">Edit</a>
                                        <form action="{{ route('admin.extrakulikuler.destroy', $ex->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Hapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $extracurriculars->links() }}</div>
                @else
                    <div class="py-12 text-center">Belum ada ekstrakulikuler</div>
                @endif
            </div>
        </div>
    </div>
@endsection
