@extends('admin.layouts.app')
@section('title', 'Gallery')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">
        <div class="mb-4 flex items-center justify-between">
            <h5 class="text-16">Gallery</h5>

        </div>

        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <!-- Filter Buttons -->
        <div class="mb-4 flex gap-2">
            <button
                class="filter-btn text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                data-filter="all">Semua</button>
            <button
                class="filter-btn text-white btn bg-custom-400 border-custom-400 hover:text-white hover:bg-custom-500 hover:border-custom-500 focus:text-white focus:bg-custom-500 focus:border-custom-500 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-500 active:border-custom-500 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                data-filter="photo">Foto</button>
            <button
                class="filter-btn text-white btn bg-custom-400 border-custom-400 hover:text-white hover:bg-custom-500 hover:border-custom-500 focus:text-white focus:bg-custom-500 focus:border-custom-500 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-500 active:border-custom-500 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                data-filter="video">Video</button>
        </div>

        <div class="grid grid-cols-1 gap-4">

            <div class="card">
                <div class="mb-4 flex items-center justify-end gap-2 px-4 pt-4">
                    <a href="{{ route('admin.galleries.create') }}"
                        class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 add-employee text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">Tambah</a>

                </div>
                @foreach ($items as $item)
                    <div class="card-body gallery-item" data-type="{{ $item->type }}">


                        <div class="card-body flex flex-col gap-4 md:flex-row md:items-center">
                            <div class="w-full max-w-xs md:w-40 shrink-0">

                                @if ($item->embed_html)
                                    <div class="aspect-video overflow-hidden rounded">
                                        <div class="max-w-full" style="transform: scale(0.8); transform-origin: top left;">
                                            {!! $item->embed_html !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h6 class="mb-1 break-words">{{ $item->title ?? '—' }}</h6>
                            </div>
                            <div class="flex flex-wrap gap-2 shrink-0">
    <a href="{{ route('admin.galleries.show', $item->id) }}"
        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
        <i data-lucide="eye" class="size-4"></i>
    </a>
    <a href="{{ route('admin.galleries.edit', $item->id) }}"
        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-orange-500 hover:bg-orange-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-orange-500/20 dark:hover:text-orange-500">
        <i data-lucide="pencil" class="size-4"></i>
    </a>
    <form action="{{ route('admin.galleries.destroy', $item->id) }}" method="post"
        class="inline-block"
        onsubmit="return confirm('Hapus item ini?')">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-red-500/20 dark:hover:text-red-500">
            <i data-lucide="trash-2" class="size-4"></i>
        </button>
    </form>
</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-4">{{ $items->withQueryString()->links() }}</div>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');

                // Update button states
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-custom-500', 'border-custom-500',
                        'hover:bg-custom-600', 'hover:border-custom-600');
                    btn.classList.add('bg-custom-400', 'border-custom-400',
                        'hover:bg-custom-500', 'hover:border-custom-500');
                });

                this.classList.remove('bg-custom-400', 'border-custom-400', 'hover:bg-custom-500',
                    'hover:border-custom-500');
                this.classList.add('bg-custom-500', 'border-custom-500',
                    'hover:bg-custom-600', 'hover:border-custom-600');

                // Filter items
                galleryItems.forEach(item => {
                    if (filterValue === 'all') {
                        item.classList.remove('hidden');
                    } else {
                        const itemType = item.getAttribute('data-type');
                        if (itemType === filterValue) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    }
                });
            });
        });
    });
</script>
