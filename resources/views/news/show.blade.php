@extends('layouts.app')

@section('title', ($news->title ?? 'Berita') . ' - SMKN 1 Talaga')

@section('content')
    <section class="py-5" style="background-color: #f8fafc; min-height: 80vh; padding-top: 140px !important;">
        <div class="container my-5">
            <div class="row g-4 px-2 px-sm-3 px-lg-0">
                
                <!-- Main News Content (Left) -->
                <main class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        
                        <!-- Category & Meta -->
                        <div class="d-flex align-items-center text-muted mb-3 flex-wrap gap-2" style="font-size: 13px;">
                            @if ($news->category)
                                <span class="badge bg-primary px-2.5 py-1.5 font-weight-bold" style="font-size: 11px;">
                                    {{ $news->category->name }}
                                </span>
                            @endif
                            <span class="ms-1">
                                <i class="bi bi-calendar3 me-1"></i> {{ $news->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                            </span>
                            <span>•</span>
                            <span>
                                <i class="bi bi-person-fill me-1"></i> {{ $news->createdBy?->name ?? 'Admin' }}
                            </span>
                        </div>

                        <h1 class="text-dark mb-4" style="font-weight: 800; font-size: 32px; line-height: 1.3;">
                            {{ $news->title }}
                        </h1>

                        <!-- Photo -->
                        @if (!empty($news->photo))
                            @php
                                $p = $news->photo;
                                if (filter_var($p, FILTER_VALIDATE_URL)) {
                                    $imgUrl = $p;
                                } elseif (preg_match('#^assets/#', $p) || preg_match('#^public/assets/#', $p)) {
                                    $imgUrl = asset(preg_replace('#^public/#', '', $p));
                                } else {
                                    $rel = preg_replace('#^storage/#', '', $p);
                                    $imgUrl = route('public.files', ['path' => $rel]);
                                }
                            @endphp
                            <div class="mb-4 overflow-hidden rounded-4 shadow-sm">
                                <img src="{{ $imgUrl }}" alt="{{ $news->title }}" class="img-fluid w-100 object-fit-cover" style="max-height: 450px;" onerror="this.src='{{ asset('assets/images/default-news.png') }}'">
                            </div>
                        @endif

                        <!-- Rich Text Content Custom Styling -->
                        <style>
                            .rich-content h1, .rich-content h2, .rich-content h3 {
                                font-weight: 700;
                                color: #0f172a;
                                margin-top: 1.5rem;
                                margin-bottom: 0.75rem;
                            }
                            .rich-content h1 { font-size: 24px; }
                            .rich-content h2 { font-size: 20px; }
                            .rich-content h3 { font-size: 18px; }
                            
                            .rich-content p {
                                margin-bottom: 1.25rem;
                                line-height: 1.8;
                                font-size: 16px;
                                color: #475569;
                            }
                            .rich-content ul, .rich-content ol {
                                margin-left: 1.5rem;
                                margin-bottom: 1.25rem;
                                color: #475569;
                            }
                            .rich-content li { margin-bottom: 0.35rem; }
                            
                            .rich-content img {
                                max-width: 100%;
                                height: auto;
                                border-radius: 8px;
                                margin: 1.5rem auto;
                                display: block;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                            }
                        </style>

                        <!-- Content -->
                        <div class="rich-content ql-editor" style="padding: 0;">
                            {!! $news->content !!}
                        </div>

                        @push('scripts')
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
                            <script src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
                            <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
                        @endpush

                    </div>
                </main>

                <!-- Sidebar Widgets (Right) -->
                <aside class="col-lg-4 d-none d-lg-block">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 sticky-top" style="top: 150px; z-index: 990;">
                            <h5 class="mb-3 pb-2 border-bottom text-dark" style="font-weight: 700;">Cari Berita</h5>
                            <form action="{{ route('news.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Tulis kata kunci..." style="border-radius: 8px 0 0 8px; font-size: 14px; border-color: #cbd5e1;" value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit" style="border-radius: 0 8px 8px 0; padding: 0 16px;">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories Widget -->
                        <div class="mb-4">
                            <h5 class="mb-3 pb-2 border-bottom text-dark" style="font-weight: 700;">Kategori Berita</h5>
                            <div class="d-flex flex-column gap-2">
                                @php
                                    $categories = \App\Models\S_Categories::withCount([
                                        'news' => function ($query) {
                                            $query->where('approve', 'approve');
                                        },
                                    ])->orderBy('news_count', 'desc')->get();
                                @endphp

                                @foreach ($categories as $cat)
                                    <a href="{{ route('news.index', ['category' => $cat->id]) }}" class="d-flex justify-content-between align-items-center py-2 px-3 rounded-3 text-decoration-none sidebar-item" style="font-size: 14px; font-weight: 500; transition: all 0.2s; border: 1px solid #f1f5f9; background-color: #ffffff;">
                                        <span><i class="bi bi-folder2 text-primary me-2"></i>{{ $cat->name }}</span>
                                        <span class="badge rounded-pill" style="font-size: 11px; padding: 4px 8px;">{{ $cat->news_count }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Program Keahlian Widget -->
                        <div class="mb-4">
                            <h5 class="mb-3 pb-2 border-bottom text-dark" style="font-weight: 700;">Program Keahlian</h5>
                            <div class="d-flex flex-column gap-2">
                                @php
                                    $sidebarConcs = \DB::table('core_expertise_concentrations')->orderBy('name')->get();
                                @endphp
                                @foreach ($sidebarConcs as $conc)
                                    <a href="{{ route('expertise.show', $conc->slug) }}" class="d-flex align-items-center py-2 px-3 rounded-3 text-decoration-none sidebar-item" style="font-size: 13px; font-weight: 500; transition: all 0.2s; border: 1px solid #f1f5f9; background-color: #ffffff;">
                                        <i class="bi bi-mortarboard text-primary me-2"></i>
                                        <span>{{ $conc->name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tags Widget -->
                        <div>
                            <h5 class="mb-3 pb-2 border-bottom text-dark" style="font-weight: 700;">Tag Populer</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $tags = \App\Models\S_Tags::all();
                                @endphp
                                @forelse ($tags as $tag)
                                    <a href="{{ route('news.index', ['tag' => $tag->id]) }}" class="badge-tag d-inline-block text-decoration-none text-muted py-1 px-3 border rounded-pill" style="font-size: 12px; font-weight: 500; background-color: #f8fafc; border-color: #e2e8f0; transition: all 0.2s;">
                                        #{{ $tag->name }}
                                    </a>
                                @empty
                                    <span class="text-muted italic" style="font-size: 13px;">Belum ada tag.</span>
                                @endforelse
                            </div>
                        </div>

                    </aside>
                </div>

            <!-- Latest News Grid (Below Detail) -->
            <div class="mt-5 pt-5 border-top">
                <h3 class="mb-4 text-dark" style="font-weight: 800;">Berita Terbaru Lainnya</h3>

                @php
                    $latestNews = \App\Models\S_News::where('id', '!=', $news->id)
                        ->where('approve', 'approve')
                        ->latest()
                        ->take(4)
                        ->get();
                @endphp

                @if ($latestNews->count() > 0)
                    <div class="row g-4 px-2 px-sm-3 px-lg-0">
                        @foreach ($latestNews as $item)
                            @php
                                $latestPhoto = null;
                                if (!empty($item->photo)) {
                                    $p = $item->photo;
                                    if (filter_var($p, FILTER_VALIDATE_URL)) {
                                        $latestPhoto = $p;
                                    } elseif (preg_match('#^assets/#', $p) || preg_match('#^public/assets/#', $p)) {
                                        $latestPhoto = asset(preg_replace('#^public/#', '', $p));
                                    } else {
                                        $rel = preg_replace('#^storage/#', '', $p);
                                        $latestPhoto = route('public.files', ['path' => $rel]);
                                    }
                                } else {
                                    if (!empty($item->content) && preg_match('/<img[^>]+src="([^">]+)"/i', $item->content, $matches)) {
                                        $latestPhoto = $matches[1];
                                    } else {
                                        $latestPhoto = asset('assets/images/default-news.png');
                                    }
                                }
                            @endphp
                            <div class="col-lg-3 col-md-6">
                                <div class="card h-100 border shadow-sm rounded-4 overflow-hidden bg-white d-flex flex-column justify-content-between" style="transition: transform 0.3s ease;">
                                    <div>
                                        <div class="position-relative" style="height: 150px; overflow: hidden;">
                                            <img src="{{ $latestPhoto }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover hover-scale" style="transition: all 0.5s;" onerror="this.src='{{ asset('assets/images/default-news.png') }}'">
                                        </div>
                                        <div class="p-3">
                                            <div class="text-muted mb-1" style="font-size: 11px;">
                                                <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->locale('id')->isoFormat('D MMM YYYY') }}
                                            </div>
                                            <h6 class="line-clamp-2" style="font-size: 13px; font-weight: 700; color: #0f172a; line-height: 1.4; margin: 0;">
                                                {{ Str::limit(strip_tags($item->title), 50, '...') }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="px-3 pb-3 mt-auto">
                                        <a href="{{ route('news.show', $item->id) }}" class="btn btn-outline-primary btn-sm w-100 py-1.5" style="border-radius: 6px; font-weight: 600; font-size: 12px;">
                                            Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-4 bg-light rounded text-center text-muted">
                        Tidak ada berita terbaru lainnya.
                    </div>
                @endif

                <div class="text-center mt-5">
                    <a href="{{ route('news.index') }}" class="btn btn-primary px-4 py-2.5" style="border-radius: 8px; font-weight: 600;">
                        Lihat Semua Berita <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <style>
        .hover-scale:hover {
            transform: scale(1.08);
        }
        .hover-light:hover {
            background-color: #e2e8f0 !important;
            color: #0d6efd !important;
        }
        .sidebar-item {
            color: #475569 !important;
        }
        .sidebar-item:hover {
            background-color: rgba(13, 110, 253, 0.04) !important;
            border-color: rgba(13, 110, 253, 0.25) !important;
            color: #0d6efd !important;
            transform: translateX(4px);
        }
        .sidebar-item .badge {
            background-color: #e2e8f0 !important;
            color: #475569 !important;
            transition: all 0.2s;
        }
        .sidebar-item:hover .badge {
            background-color: #0d6efd !important;
            color: #ffffff !important;
        }
        .badge-tag:hover {
            background-color: #0d6efd !important;
            color: #ffffff !important;
            border-color: #0d6efd !important;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
