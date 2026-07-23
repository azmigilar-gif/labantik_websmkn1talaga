@extends('admin.layouts.app')
@section('title', 'Edit Hero & Badges')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Pengaturan Hero & Badges</h5>
                </div>
                <ul class="flex shrink-0 items-center gap-2 text-sm font-normal">
                    <li
                        class="before:font-remix dark:text-zink-200 relative before:absolute before:-top-[3px] before:text-[18px] before:text-slate-400 before:content-['\ea54'] ltr:pr-4 ltr:before:-right-1 rtl:pl-4 rtl:before:-left-1">
                        <a href="#!" class="dark:text-zink-200 text-slate-400">Pengaturan</a>
                    </li>
                    <li class="dark:text-zink-100 text-slate-700">
                        Hero & Badges
                    </li>
                </ul>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.hero-settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                    
                    <!-- Left Column: Hero Title & Description -->
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-15 font-semibold text-slate-800 dark:text-zink-100">Hero Header Texts</h6>
                            
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-slate-700 dark:text-zink-200">Hero Title / Judul Utama</label>
                                <input type="text" name="hero_title" value="{{ old('hero_title', $settings->hero_title) }}" required 
                                    class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                @error('hero_title')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-slate-700 dark:text-zink-200">Hero Description / Deskripsi</label>
                                <textarea name="hero_description" rows="5" required 
                                    class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100">{{ old('hero_description', $settings->hero_description) }}</textarea>
                                @error('hero_description')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6 class="mt-6 mb-4 text-15 font-semibold text-slate-800 dark:text-zink-100">Trust Badges (Header Kecil)</h6>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-slate-500 dark:text-zink-300">Trust Badge 1</label>
                                    <input type="text" name="trust_badge_1" value="{{ old('trust_badge_1', $settings->trust_badge_1) }}" required 
                                        class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                </div>
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-slate-500 dark:text-zink-300">Trust Badge 2</label>
                                    <input type="text" name="trust_badge_2" value="{{ old('trust_badge_2', $settings->trust_badge_2) }}" required 
                                        class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                </div>
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-slate-500 dark:text-zink-300">Trust Badge 3</label>
                                    <input type="text" name="trust_badge_3" value="{{ old('trust_badge_3', $settings->trust_badge_3) }}" required 
                                        class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Floating Badges -->
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-15 font-semibold text-slate-800 dark:text-zink-100">Floating Card Badges (Pada Gambar Hero)</h6>
                            
                            <!-- Badge 1 (PPDB) -->
                            <div class="mb-6 p-4 rounded border border-slate-100 bg-slate-50/50 dark:border-zink-500 dark:bg-zink-600/30">
                                <div class="mb-3 flex items-center gap-2">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-success/10 text-success text-xs font-semibold">1</span>
                                    <h6 class="text-sm font-semibold m-0 text-slate-700 dark:text-zink-200">Floating Badge 1 (Kiri Bawah Hero)</h6>
                                </div>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="block mb-1 text-xs text-slate-500">Judul (Title)</label>
                                        <input type="text" name="badge_1_title" value="{{ old('badge_1_title', $settings->badge_1_title) }}" required 
                                            class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs text-slate-500">Subjudul (Subtitle)</label>
                                        <input type="text" name="badge_1_subtitle" value="{{ old('badge_1_subtitle', $settings->badge_1_subtitle) }}" required 
                                            class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                    </div>
                                </div>
                            </div>

                            <!-- Badge 2 (Terserap) -->
                            <div class="mb-6 p-4 rounded border border-slate-100 bg-slate-50/50 dark:border-zink-500 dark:bg-zink-600/30">
                                <div class="mb-3 flex items-center gap-2">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-custom/10 text-custom-500 text-xs font-semibold">2</span>
                                    <h6 class="text-sm font-semibold m-0 text-slate-700 dark:text-zink-200">Floating Badge 2 (Kanan Atas Hero)</h6>
                                </div>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="block mb-1 text-xs text-slate-500">Judul (Title)</label>
                                        <input type="text" name="badge_2_title" value="{{ old('badge_2_title', $settings->badge_2_title) }}" required 
                                            class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs text-slate-500">Subjudul (Subtitle)</label>
                                        <input type="text" name="badge_2_subtitle" value="{{ old('badge_2_subtitle', $settings->badge_2_subtitle) }}" required 
                                            class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                    </div>
                                </div>
                            </div>

                            <!-- Badge 3 (Bina Karakter) -->
                            <div class="p-4 rounded border border-slate-100 bg-slate-50/50 dark:border-zink-500 dark:bg-zink-600/30">
                                <div class="mb-3 flex items-center gap-2">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-500/10 text-blue-500 text-xs font-semibold">3</span>
                                    <h6 class="text-sm font-semibold m-0 text-slate-700 dark:text-zink-200">Floating Badge 3 (Pada Gambar Profil)</h6>
                                </div>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="block mb-1 text-xs text-slate-500">Judul (Title)</label>
                                        <input type="text" name="badge_3_title" value="{{ old('badge_3_title', $settings->badge_3_title) }}" required 
                                            class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs text-slate-500">Subjudul (Subtitle)</label>
                                        <input type="text" name="badge_3_subtitle" value="{{ old('badge_3_subtitle', $settings->badge_3_subtitle) }}" required 
                                            class="form-input w-full rounded border border-slate-200 dark:border-zink-500 bg-white dark:bg-zink-600 px-3 py-2 text-slate-800 dark:text-zink-100" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600">
                        <i class="ri-save-line mr-1 align-middle"></i> Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
