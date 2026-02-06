@extends('admin.layouts.app')
@section('title', 'Index Berita')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Datatable</h5>
                </div>
                <ul class="flex shrink-0 items-center gap-2 text-sm font-normal">
                    <li
                        class="before:font-remix dark:text-zink-200 relative before:absolute before:-top-[3px] before:text-[18px] before:text-slate-400 before:content-['\ea54'] ltr:pr-4 ltr:before:-right-1 rtl:pl-4 rtl:before:-left-1">
                        <a href="#!" class="dark:text-zink-200 text-slate-400">Tables</a>
                    </li>
                    <li class="dark:text-zink-100 text-slate-700">
                        Datatable
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

            @if (session('error'))
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 flex items-center justify-end gap-2">
                            <button data-modal-target="tagsModal" type="button"
                                class="btn bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring-sky-100 active:bg-sky-600 active:border-sky-600 active:ring-sky-100 dark:focus:ring-sky-400/20 text-white transition-all duration-200 ease-linear hover:text-white focus:text-white focus:ring active:text-white active:ring">
                                Tags
                            </button>
                            <div id="tagsModal" modal-center=""
                                class="z-drawer show fixed left-2/4 flex hidden -translate-x-2/4 -translate-y-2/4 flex-col transition-all duration-300 ease-in-out">
                                <div
                                    class="dark:bg-zink-600 flex h-full w-screen flex-col rounded-md bg-white shadow md:w-[40rem]">
                                    <div
                                        class="dark:border-zink-500 flex items-center justify-between border-b border-slate-200 p-4">
                                        <button id="btn-open-add-category" data-modal-target="defaultAddModal"
                                            type="button"
                                            class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">Tambah
                                            Tags</button>
                                        <div id="defaultAddModal" modal-center=""
                                            class="z-drawer show fixed left-2/4 flex hidden -translate-x-2/4 -translate-y-2/4 flex-col transition-all duration-300 ease-in-out">
                                            <div
                                                class="dark:bg-zink-600 flex h-full w-screen flex-col rounded-md bg-white shadow md:w-[30rem]">
                                                <div
                                                    class="dark:border-zink-500 flex items-center justify-between border-b border-slate-200 p-4">
                                                    <h5 id="defaultAddModalTitle" class="text-16">Tambah Tag</h5>
                                                    <button data-modal-close="defaultAddModal"
                                                        class="dark:text-zink-200 text-slate-500 transition-all duration-200 ease-linear hover:text-red-500 dark:hover:text-red-500">
                                                        <i data-lucide="x" class="size-5"></i>
                                                    </button>
                                                </div>
                                                <div
                                                    class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                                    <form id="tag-form" action="{{ route('admin.tags.store') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" id="tag-form-method" name="_method"
                                                            value="POST">
                                                        <input type="hidden" id="tag-id" name="id" value="">

                                                        <div class="mb-4">
                                                            <label for="tag_name"
                                                                class="dark:text-zink-200 mb-2 block text-sm font-medium text-slate-700">
                                                                Nama Tag
                                                            </label>
                                                            <input type="text" id="tag_name" name="name" required
                                                                class="focus:ring-custom-500 dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 w-full rounded-md border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2"
                                                                placeholder="Masukkan nama tag">
                                                        </div>

                                                        <button type="submit" id="tag-submit-btn"
                                                            class="bg-custom-500 hover:bg-custom-600 focus:ring-custom-500 dark:focus:ring-custom-400/20 rounded-md px-4 py-2 text-white focus:outline-none focus:ring-2">
                                                            Simpan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <button data-modal-close="tagsModal"
                                            class="dark:text-zink-200 text-slate-500 transition-all duration-200 ease-linear hover:text-red-500 dark:hover:text-red-500"><i
                                                data-lucide="x" class="size-5"></i></button>
                                    </div>
                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                        <h5 class="text-16 mb-3">Daftar Tag</h5>
                                        <div class="relative overflow-x-auto">
                                            <table class="w-full text-left" id="rowBorder">
                                                <thead class="dark:bg-zink-600 bg-slate-100">
                                                    <tr>
                                                        <th class="px-4 py-3 font-semibold">No</th>
                                                        <th class="px-4 py-3 font-semibold">Nama Kategori</th>
                                                        <th class="px-4 py-3 font-semibold">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="dark:divide-zink-500 divide-y divide-slate-200">
                                                    @forelse ($tags ?? [] as $index => $tag)
                                                        <tr>
                                                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                                                            <td class="px-4 py-3">{{ $tag->name }}</td>
                                                            <td class="px-4 py-3">
                                                                <div class="flex gap-2">

                                                                    <button type="button"
                                                                        data-modal-target="defaultAddModal"
                                                                        data-id="{{ $tag->id }}"
                                                                        data-name="{{ $tag->name }}"
                                                                        class="btn-edit-tag hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500 flex size-8 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-all duration-200 ease-linear">
                                                                        <i data-lucide="pencil" class="size-4"></i>
                                                                    </button>
                                                                    <button type="button"
                                                                        data-modal-target="deleteCatModal{{ $tag->id }}"
                                                                        class="hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500 flex size-8 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-all duration-200 ease-linear">
                                                                        <i data-lucide="trash-2" class="size-4"></i>
                                                                    </button>
                                                                    <div id="deleteTagModal{{ $tag->id }}"
                                                                        modal-center=""
                                                                        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                                                        <div
                                                                            class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                                            <div
                                                                                class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                                                                <img src="data:image/png;base64,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"
                                                                                    alt=""
                                                                                    class="block h-12 mx-auto">
                                                                                <div class="mt-5 text-center">
                                                                                    <h5 class="mb-1">Are you sure?</h5>
                                                                                    <p
                                                                                        class="text-slate-500 dark:text-zink-200">
                                                                                        Are you certain
                                                                                        you
                                                                                        want to delete this data?</p>
                                                                                    <div
                                                                                        class="flex justify-center gap-2 mt-6">
                                                                                        <form class="delete-form"
                                                                                            action="{{ route('admin.tags.destroy', $tag->id) }}"
                                                                                            method="post">
                                                                                            @method('DELETE')
                                                                                            @csrf
                                                                                            <button type="reset"
                                                                                                data-modal-close="deleteTagModal{{ $tag->id }}"
                                                                                                class="bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-600 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">Cancel</button>
                                                                                            <button type="submit"
                                                                                                id="delete-record"
                                                                                                class="text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">Yes,
                                                                                                Delete!</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4"
                                                                class="dark:text-zink-200 px-4 py-3 text-center text-slate-500">
                                                                Belum ada kategori yang ditambahkan
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button data-modal-target="largeModal" type="button"
                                class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:focus:ring-custom-400/20 text-white transition-all duration-200 ease-linear hover:text-white focus:text-white focus:ring active:text-white active:ring">
                                Kategori
                            </button>
                            <div id="largeModal" modal-center=""
                                class="z-drawer show fixed left-2/4 flex hidden -translate-x-2/4 -translate-y-2/4 flex-col transition-all duration-300 ease-in-out">
                                <div
                                    class="dark:bg-zink-600 flex h-full w-screen flex-col rounded-md bg-white shadow md:w-[40rem]">
                                    <div
                                        class="dark:border-zink-500 flex items-center justify-between border-b border-slate-200 p-4">
                                        <button id="btn-open-add-category" data-modal-target="defaultModal"
                                            type="button"
                                            class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">Tambah
                                            Kategori</button>
                                        <div id="defaultModal" modal-center=""
                                            class="z-drawer show fixed left-2/4 flex hidden -translate-x-2/4 -translate-y-2/4 flex-col transition-all duration-300 ease-in-out">
                                            <div
                                                class="dark:bg-zink-600 flex h-full w-screen flex-col rounded-md bg-white shadow md:w-[30rem]">
                                                <div
                                                    class="dark:border-zink-500 flex items-center justify-between border-b border-slate-200 p-4">
                                                    <h5 id="defaultModalTitle" class="text-16">Tambah Kategori</h5>
                                                    <button data-modal-close="defaultModal"
                                                        class="dark:text-zink-200 text-slate-500 transition-all duration-200 ease-linear hover:text-red-500 dark:hover:text-red-500"><i
                                                            data-lucide="x" class="size-5"></i></button>
                                                </div>
                                                <div
                                                    class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                                    <form id="category-form"
                                                        action="{{ route('admin.categories.store') }}" method="POST">
                                                        @csrf

                                                        <input type="hidden" name="id" id="category-id"
                                                            value="">
                                                        <div class="mb-4">
                                                            <label for="category_name"
                                                                class="dark:text-zink-200 mb-2 block text-sm font-medium text-slate-700">Nama
                                                                Kategori</label>
                                                            <input type="text" id="name" name="name"
                                                                class="focus:ring-custom-500 dark:bg-zink-700 dark:border-zink-500 dark:text-zink-200 w-full rounded-md border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2"
                                                                placeholder="Masukkan nama kategori">
                                                        </div>
                                                        <button type="submit" id="category-submit-btn"
                                                            class="bg-custom-500 hover:bg-custom-600 focus:ring-custom-500 dark:focus:ring-custom-400/20 rounded-md px-4 py-2 text-white focus:outline-none focus:ring-2">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button data-modal-close="largeModal"
                                            class="dark:text-zink-200 text-slate-500 transition-all duration-200 ease-linear hover:text-red-500 dark:hover:text-red-500"><i
                                                data-lucide="x" class="size-5"></i></button>
                                    </div>
                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                        <h5 class="text-16 mb-3">Daftar Kategori</h5>
                                        <div class="relative overflow-x-auto">
                                            <table class="w-full text-left" id="rowBorder">
                                                <thead class="dark:bg-zink-600 bg-slate-100">
                                                    <tr>
                                                        <th class="px-4 py-3 font-semibold">No</th>
                                                        <th class="px-4 py-3 font-semibold">Nama Kategori</th>
                                                        <th class="px-4 py-3 font-semibold">Dibuat Oleh</th>
                                                        <th class="px-4 py-3 font-semibold">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="dark:divide-zink-500 divide-y divide-slate-200">
                                                    @forelse ($categories ?? [] as $index => $category)
                                                        <tr>
                                                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                                                            <td class="px-4 py-3">{{ $category->name }}</td>
                                                            <td class="px-4 py-3">{{ $category->createdBy?->name ?? '-' }}
                                                            </td>
                                                            <td class="px-4 py-3">
                                                                <div class="flex gap-2">

                                                                    <button type="button"
                                                                        data-modal-target="defaultModal"
                                                                        data-id="{{ $category->id }}"
                                                                        data-name="{{ $category->name }}"
                                                                        class="btn-edit-category hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500 flex size-8 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-all duration-200 ease-linear">
                                                                        <i data-lucide="pencil" class="size-4"></i>
                                                                    </button>
                                                                    <button type="button"
                                                                        data-modal-target="deleteCatModal{{ $category->id }}"
                                                                        class="hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500 flex size-8 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-all duration-200 ease-linear">
                                                                        <i data-lucide="trash-2" class="size-4"></i>
                                                                    </button>
                                                                    <div id="deleteCatModal{{ $category->id }}"
                                                                        modal-center=""
                                                                        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                                                        <div
                                                                            class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                                            <div
                                                                                class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                                                                <img src="data:image/png;base64,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"
                                                                                    alt=""
                                                                                    class="block h-12 mx-auto">
                                                                                <div class="mt-5 text-center">
                                                                                    <h5 class="mb-1">Are you sure?</h5>
                                                                                    <p
                                                                                        class="text-slate-500 dark:text-zink-200">
                                                                                        Are you certain
                                                                                        you
                                                                                        want to delete this data?</p>
                                                                                    <div
                                                                                        class="flex justify-center gap-2 mt-6">
                                                                                        <form class="delete-form"
                                                                                            action="{{ route('admin.categories.destroy', $category->id) }}"
                                                                                            method="post">
                                                                                            @method('DELETE')
                                                                                            @csrf
                                                                                            <button type="reset"
                                                                                                data-modal-close="deleteCatModal{{ $category->id }}"
                                                                                                class="bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-600 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">Cancel</button>
                                                                                            <button type="submit"
                                                                                                id="delete-record"
                                                                                                class="text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">Yes,
                                                                                                Delete!</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4"
                                                                class="dark:text-zink-200 px-4 py-3 text-center text-slate-500">
                                                                Belum ada kategori yang ditambahkan
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <a href="{{ route('admin.news.create') }}" class="btn btn-primary"
                                style="background: rgb(111, 111, 255);
                            color:aliceblue">Tambah
                                Berita</a>
                        </div>

                        @if (isset($news) && $news->count() > 0)
                            <table id="rowBorder" class="w-full">
                                <thead>
                                    <tr>
                                        <th class="p-2 text-left">Judul</th>
                                        <th class="p-2 text-left">Kategori</th>
                                        <th class="p-2 text-left">Tag</th>
                                        <th class="p-2 text-left">Dibuat</th>
                                        <th class="p-2 text-left">Status</th>
                                        <th class="p-2 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="dark:divide-zink-500 divide-y divide-slate-200">
                                    @foreach ($news as $n)
                                        <tr>
                                            <td class="p-2">{{ $n->title }}</td>
                                            <td class="p-2">{{ $n->category?->name ?? '-' }}</td>
                                            <td class="p-2">
                                                @if ($n->tags && $n->tags->count())
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach ($n->tags as $tag)
                                                            <span
                                                                class="inline-block rounded bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">
                                                                {{ $tag->name }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-slate-500">-</span>
                                                @endif
                                            </td>
                                            <td class="p-2">
                                                {{ $n->created_at ? $n->created_at->format('Y-m-d H:i') : '-' }}</td>
                                            <td class="p-2">
                                                @php $status = $n->approve ?? 'waiting'; @endphp
                                                @if ($status === 'waiting')
                                                    <span
                                                        class="inline-block rounded bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-800">Menunggu</span>
                                                @elseif($status === 'approve')
                                                    <span
                                                        class="inline-block rounded bg-green-100 px-3 py-1 text-sm font-medium text-green-800">Disetujui</span>
                                                @else
                                                    <span
                                                        class="inline-block rounded bg-slate-100 px-3 py-1 text-sm font-medium text-slate-800">{{ $status }}</span>
                                                @endif
                                            </td>
                                            <td class="p-2">

                                                <div class="flex gap-2">
                                                    @auth
                                                        @if (auth()->user()->email === 'superadmin@smkn1talaga.sch.id')
                                                            <a href="#!"
                                                                data-modal-target="editStatusNewsModal{{ $n->id }}"
                                                                class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                                    data-lucide="check-check" class="size-4"></i></a>
                                                        @endif
                                                    @endauth
                                                    <a href="{{ route('admin.news.show', $n->id) }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-green-500 hover:bg-green-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-green-500/20 dark:hover:text-green-500">
                                                        <i data-lucide="eye" class="size-4"></i></a>
                                                    <a href="{{ route('admin.news.edit', $n->id) }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 remove-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                            data-lucide="pencil" class="size-4"></i></a>
                                                    <a href="#!" data-modal-target="deleteModal{{ $n->id }}"
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 remove-item-btn bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-red-500/20 dark:hover:text-red-500">
                                                        <i data-lucide="trash-2" class="size-4"></i></a>
                                                </div>
                                            </td>
                                            <div id="editStatusNewsModal{{ $n->id }}" modal-center=""
                                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                                <div
                                                    class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                    <div
                                                        class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                                        <div
                                                            class="flex items-center justify-center size-12 mx-auto rounded-full bg-custom-100 dark:bg-custom-500/20">
                                                            <i data-lucide="check-check"
                                                                class="size-6 text-custom-500"></i>
                                                        </div>
                                                        <div class="mt-5 text-center">
                                                            <h5 class="mb-1">Change Status</h5>
                                                            <p class="text-slate-500 dark:text-zink-200">
                                                                Are you sure you want to change the status of this news?
                                                            </p>
                                                            <p class="mt-2 text-sm font-medium">
                                                                Current Status:
                                                                <span
                                                                    class="px-2 py-1 rounded {{ $n->approve == 'approve' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                                                    {{ ucfirst($n->approve) }}
                                                                </span>
                                                            </p>
                                                            <div class="flex justify-center gap-2 mt-6">
                                                                <form action="{{ route('admin.news.approve', $n->id) }}"
                                                                    method="POST">
                                                                    @csrf

                                                                    <!-- Input hidden untuk mengirim status baru -->
                                                                    <input type="hidden" name="approve"
                                                                        value="{{ $n->approve == 'waiting' ? 'approve' : 'waiting' }}">

                                                                    <button type="button"
                                                                        data-modal-close="editStatusNewsModal{{ $n->id }}"
                                                                        class="bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-600 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">
                                                                        Cancel
                                                                    </button>

                                                                    <button type="submit"
                                                                        class="text-white btn {{ $n->approve == 'waiting' ? 'bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100' : 'bg-yellow-500 border-yellow-500 hover:bg-yellow-600 hover:border-yellow-600 focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100' }} hover:text-white focus:text-white active:text-white active:ring dark:ring-custom-400/20">
                                                                        @if ($n->approve == 'waiting')
                                                                            Yes, Approve!
                                                                        @else
                                                                            Yes, Set to Waiting!
                                                                        @endif
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="deleteModal{{ $n->id }}" modal-center=""
                                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                                <div
                                                    class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                    <div
                                                        class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                                        <img src="data:image/png;base64,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"
                                                            alt="" class="block h-12 mx-auto">
                                                        <div class="mt-5 text-center">
                                                            <h5 class="mb-1">Are you sure?</h5>
                                                            <p class="text-slate-500 dark:text-zink-200">Are you certain
                                                                you
                                                                want to delete this data?</p>
                                                            <div class="flex justify-center gap-2 mt-6">
                                                                <form class="delete-form"
                                                                    action="{{ route('admin.news.destroy', $n->id) }}"
                                                                    method="post">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="reset"
                                                                        data-modal-close="deleteModal{{ $n->id }}"
                                                                        class="bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-600 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">Cancel</button>
                                                                    <button type="submit" id="delete-record"
                                                                        class="text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">Yes,
                                                                        Delete!</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-4">
                                {{ $news->links() }}
                            </div>
                        @else
                            <!-- Empty state -->
                            <div class="py-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4" width="80"
                                    height="80" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" y1="15" x2="12" y2="3" />
                                </svg>
                                <h3 class="mb-2 text-lg font-semibold">Belum ada berita</h3>
                                <p class="mb-4 text-sm text-slate-500">Belum ada berita yang dibuat. Klik tombol "Tambah
                                    Berita" untuk membuat berita baru.</p>
                                <a href="{{ route('admin.news.create') }}"
                                    class="inline-block rounded bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">Tambah
                                    Berita</a>
                            </div>
                        @endif
                    </div>
                </div><!--end card-->
            </div>
        </div>
    </div>

@endsection
