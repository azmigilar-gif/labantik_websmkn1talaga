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
            <div class="card">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 flex items-center justify-end gap-2">
                            <button data-modal-target="largeModal" type="button"
                                class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:focus:ring-custom-400/20 text-white transition-all duration-200 ease-linear hover:text-white focus:text-white focus:ring active:text-white active:ring">Kategori</button>
                            <div id="largeModal" modal-center=""
                                class="z-drawer show fixed left-2/4 flex hidden -translate-x-2/4 -translate-y-2/4 flex-col transition-all duration-300 ease-in-out">
                                <div
                                    class="dark:bg-zink-600 flex h-full w-screen flex-col rounded-md bg-white shadow md:w-[40rem]">
                                    <div
                                        class="dark:border-zink-500 flex items-center justify-between border-b border-slate-200 p-4">
                                        <button id="btn-open-add-category" data-modal-target="defaultModal" type="button"
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
                                                    <form id="category-form" action="{{ route('admin.categories.store') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" id="form-method"
                                                            value="POST">
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
                                                <div
                                                    class="dark:border-zink-500 mt-auto flex items-center justify-between border-t border-slate-200 p-4">
                                                    <h5 class="text-16">Modal Footer</h5>
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
                                            <table class="w-full text-left">
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
                                                                    <button type="button" data-modal-target="defaultModal"
                                                                        data-id="{{ $category->id }}"
                                                                        data-name="{{ $category->name }}"
                                                                        class="btn-edit-category hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500 flex size-8 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-all duration-200 ease-linear">
                                                                        <i data-lucide="pencil" class="size-4"></i>
                                                                    </button>
                                                                    <button type="button"
                                                                        class="hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500 flex size-8 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-all duration-200 ease-linear">
                                                                        <i data-lucide="trash-2" class="size-4"></i>
                                                                    </button>
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

                        @if (isset($news) && $news->count())
                            <table id="rowBorder" class="w-full">
                                <thead>
                                    <tr>
                                        <th class="p-2 text-left">Judul</th>
                                        <th class="p-2 text-left">Kategori</th>
                                        <th class="p-2 text-left">Dipublikasi</th>
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
                                            <td class="p-2">{{ $n->is_published ? 'Ya' : 'Tidak' }}</td>
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
                                                <a href="{{ route('admin.news.show', $n->id) }}"
                                                    class="mr-2 text-sm text-blue-600">Lihat</a>
                                                <a href="{{ route('admin.news.edit', $n->id) }}"
                                                    class="mr-2 text-sm text-green-600">Edit</a>
                                                <form action="{{ route('admin.news.destroy', $n->id) }}" method="POST"
                                                    class="inline-block" onsubmit="return confirm('Hapus berita ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm text-red-600">Hapus</button>
                                                </form>
                                            </td>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoriesBaseUrl = "{{ url('categories') }}";
            const categoriesStoreUrl = "{{ route('admin.categories.store') }}";

            // Edit buttons: populate modal and switch form to update
            document.querySelectorAll('.btn-edit-category').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const name = this.dataset.name || '';
                    const nameInput = document.getElementById('name');
                    const idInput = document.getElementById('category-id');
                    const form = document.getElementById('category-form');
                    const methodInput = document.getElementById('form-method');
                    const title = document.getElementById('defaultModalTitle');
                    const submitBtn = document.getElementById('category-submit-btn');

                    if (nameInput) nameInput.value = name;
                    if (idInput) idInput.value = id;
                    if (form) form.action = categoriesBaseUrl + '/' + id;
                    if (methodInput) methodInput.value = 'PUT';
                    if (title) title.textContent = 'Edit Kategori';
                    if (submitBtn) submitBtn.textContent = 'Perbarui';
                });
            });

            // Add button: reset modal to create mode
            const addBtn = document.getElementById('btn-open-add-category');
            if (addBtn) {
                addBtn.addEventListener('click', function() {
                    const nameInput = document.getElementById('name');
                    const idInput = document.getElementById('category-id');
                    const form = document.getElementById('category-form');
                    const methodInput = document.getElementById('form-method');
                    const title = document.getElementById('defaultModalTitle');
                    const submitBtn = document.getElementById('category-submit-btn');

                    if (nameInput) nameInput.value = '';
                    if (idInput) idInput.value = '';
                    if (form) form.action = categoriesStoreUrl;
                    if (methodInput) methodInput.value = 'POST';
                    if (title) title.textContent = 'Tambah Kategori';
                    if (submitBtn) submitBtn.textContent = 'Simpan';
                });
            }
        });
    </script>

@endsection
