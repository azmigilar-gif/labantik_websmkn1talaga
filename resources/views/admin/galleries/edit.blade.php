@extends('admin.layouts.app')
@section('title', 'Edit Gallery')
@section('content')
<div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">
        <h5 class="mb-4">Edit Gallery</h5>
        <form action="{{ route('admin.galleries.update', $item->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="photo" {{ $item->type === 'photo' ? 'selected' : '' }}>Photo</option>
                        <option value="video" {{ $item->type === 'video' ? 'selected' : '' }}>Video</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title', $item->title) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">Existing embed</label>
                    @if($item->embed_url)
                        <div style="aspect-ratio:16/9;">
                            <iframe src="{{ $item->embed_url }}" frameborder="0" allowfullscreen class="w-full h-full"></iframe>
                        </div>
                    @endif
                </div>
                <div>
                    <label class="form-label">Embed URL (social post)</label>
                    <input type="text" name="embed_url" value="{{ old('embed_url', $item->embed_url) }}" placeholder="https://..." class="form-input" required>
                    <p class="text-sm text-slate-400">Provide the social post URL. Caption will be taken from the embedded post.</p>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-ghost">Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
