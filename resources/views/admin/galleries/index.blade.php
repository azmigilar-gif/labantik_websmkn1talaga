@extends('admin.layouts.app')
@section('title', 'Gallery')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">
        <div class="mb-4 flex items-center justify-between">
            <h5 class="text-16">Gallery</h5>
            <div class="flex gap-2">
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">Tambah</a>
                <a href="{{ route('admin.galleries.index') }}?type=photo" class="btn btn-ghost">Photo</a>
                <a href="{{ route('admin.galleries.index') }}?type=video" class="btn btn-ghost">Video</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 gap-4">
            @foreach ($items as $item)
                <div class="card">
                    <div class="card-body flex items-center gap-4">
                        <div class="w-40">
                            @if ($item->embed_html)
                                <div style="aspect-ratio:16/9;">
                                    {!! $item->embed_html !!}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h6 class="mb-1">{{ $item->title ?? '—' }}</h6>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.galleries.show', $item->id) }}" class="btn btn-sm">Lihat</a>
                            <a href="{{ route('admin.galleries.edit', $item->id) }}" class="btn btn-sm btn-outline">Edit</a>
                            <form action="{{ route('admin.galleries.destroy', $item->id) }}" method="post"
                                onsubmit="return confirm('Hapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">{{ $items->withQueryString()->links() }}</div>
    </div>

@endsection
