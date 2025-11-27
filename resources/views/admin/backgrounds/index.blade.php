@extends('admin.layouts.app')

@section('title', 'Background')

@section('content')
<div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="mb-4 text-2xl">Manage Background</h2>

            @if(session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 p-3 text-green-800">{{ session('success') }}</div>
            @endif
            @if(session('warning'))
                <div class="mb-4 rounded border border-yellow-200 bg-yellow-50 p-3 text-yellow-800">{{ session('warning') }}</div>
            @endif

            <div class="mb-6">
                <form action="{{ route('admin.background.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="block mb-2 font-medium">Upload Photo</label>
                        <input type="file" name="photo" accept="image/*" required class="block w-full" />
                        @error('photo') <div class="text-red-600 mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="btn bg-custom-500 text-white">Upload</button>
                    </div>
                </form>
            </div>

            <div class="mt-6">
                <h3 class="mb-3">Current Background</h3>
                @if($bgFile)
                    <div class="mb-3">
                        <img src="{{ asset($bgFile) }}" alt="background" style="max-width:100%; height:auto; display:block;" />
                    </div>
                    <form action="{{ route('admin.background.destroy') }}" method="post" onsubmit="return confirm('Hapus background lama?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn border border-red-600 text-red-600">Hapus Background</button>
                    </form>
                @else
                    <div class="text-slate-500">Belum ada background terpasang.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
