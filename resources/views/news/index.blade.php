@extends('layouts.app')

@section('title', 'Index Berita - SMKN 1 Talaga')

@section('content')
    <section class="py-5" style="background-color: #f8fafc; min-height: 80vh; padding-top: 140px !important;">
        <div class="container my-5">
            
            <!-- Breadcrumbs -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h1 style="font-weight: 800; font-size: 28px; color: #0f172a; margin: 0;">Index Berita</h1>
                </div>
                <div class="col-md-6 text-md-end">
                    <nav aria-label="breadcrumb" class="d-inline-block">
                        <ol class="breadcrumb m-0" style="font-size: 14px;">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page" style="font-weight: 600;">Berita</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Filter Dropdown -->
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle px-3 py-2" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: 600; border-radius: 6px;">
                        <i class="bi bi-funnel-fill me-1"></i> Filter Kategori
                    </button>
                    <ul class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton" style="border-radius: 8px;">
                        <li>
                            <a class="dropdown-item py-2 {{ !request('category') ? 'active bg-primary' : '' }}" href="{{ route('news.index') }}">
                                <i class="bi bi-grid-fill me-2"></i> Semua Kategori
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        @foreach ($categories as $cat)
                            <li>
                                <a class="dropdown-item py-2 {{ request('category') == $cat->id ? 'active bg-primary' : '' }}" href="{{ route('news.index', ['category' => $cat->id]) }}">
                                    <i class="bi bi-tag-fill me-2"></i> {{ ucfirst($cat->name) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="text-muted" style="font-size: 14px;">
                    Menampilkan <b>{{ $news->firstItem() ?? 0 }}</b> sampai <b>{{ $news->lastItem() ?? 0 }}</b> dari <b>{{ $news->total() ?? 0 }}</b> berita
                </div>
            </div>

            <!-- News Grid -->
            <div class="row g-4">
                @if($news->count() === 0)
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-newspaper text-muted" style="font-size: 64px;"></i>
                        <p class="text-muted mt-3 italic" style="font-size: 16px;">Belum ada berita yang diterbitkan untuk kategori ini.</p>
                    </div>
                @else
                    @foreach ($news as $item)
                     @php
                            $newsPhoto = null;
                            if (!empty($item->photo)) {
                                $p = $item->photo;
                                if (filter_var($p, FILTER_VALIDATE_URL)) {
                                    $newsPhoto = $p;
                                } elseif (preg_match('#^assets/#', $p) || preg_match('#^public/assets/#', $p)) {
                                    $newsPhoto = asset(preg_replace('#^public/#', '', $p));
                                } else {
                                    $rel = preg_replace('#^storage/#', '', $p);
                                    $newsPhoto = route('public.files', ['path' => $rel]);
                                }
                            } else {
                                if (!empty($item->content) && preg_match('/<img[^>]+src="([^">]+)"/i', $item->content, $matches)) {
                                    $newsPhoto = $matches[1];
                                } else {
                                    $newsPhoto = asset('assets/images/default-news.png');
                                }
                            }

                            // Clean editor markup/spaces for a proper preview
                            $cleanedContent = strip_tags($item->content);
                            $cleanedContent = html_entity_decode($cleanedContent);
                            $cleanedContent = str_replace(["\xc2\xa0", '&nbsp;'], ' ', $cleanedContent);
                            $cleanedContent = preg_replace('/\s+/', ' ', $cleanedContent);
                            $cleanedContent = trim($cleanedContent);
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 border shadow-sm rounded-4 overflow-hidden bg-white d-flex flex-column justify-content-between" style="transition: transform 0.3s ease;">
                                <div>
                                    <div class="position-relative" style="height: 200px; overflow: hidden;">
                                        <img src="{{ $newsPhoto }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover hover-scale" style="transition: all 0.5s;" onerror="this.src='{{ asset('assets/images/default-news.png') }}'">
                                    </div>
                                    <div class="p-4">
                                        <div class="d-flex align-items-center text-muted mb-2 gap-3" style="font-size: 12px;">
                                            <div>
                                                <i class="bi bi-calendar3 me-1 text-primary"></i>
                                                <span>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                            </div>
                                            @if ($item->created_by && $item->createdBy)
                                                <div>
                                                    <i class="bi bi-person-fill me-1 text-primary"></i>
                                                    <span>{{ $item->createdBy->name }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        @if ($item->category)
                                            <div class="mb-2">
                                                <span class="badge bg-primary text-white" style="font-size: 10px; padding: 4px 8px;">
                                                    {{ $item->category->name }}
                                                </span>
                                            </div>
                                        @endif
                                        <h5 class="line-clamp-2" style="font-size: 16px; font-weight: 700; color: #0f172a; line-height: 1.4; margin-bottom: 10px;">
                                            {{ $item->title }}
                                        </h5>
                                        <p class="text-muted line-clamp-3 mb-0" style="font-size: 13px; line-height: 1.6;">
                                            {{ Str::limit($cleanedContent, 120, '...') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="px-4 pb-4 mt-auto">
                                    <a href="{{ route('news.show', $item->id) }}" class="btn btn-outline-primary btn-sm w-100 py-2" style="border-radius: 6px; font-weight: 600;">
                                        Baca Artikel
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            @if($news->lastPage() > 1)
                <div class="d-flex justify-content-center mt-5">
                    <nav aria-label="Page navigation">
                        <ul class="pagination shadow-sm m-0" style="border-radius: 8px; overflow: hidden;">
                            <li class="page-item {{ $news->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link py-2.5 px-3" href="{{ $news->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true"><i class="bi bi-chevron-left"></i> Prev</span>
                                </a>
                            </li>
                            @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $news->currentPage() ? 'active' : '' }}">
                                    <a class="page-link py-2.5 px-3" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ !$news->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link py-2.5 px-3" href="{{ $news->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">Next <i class="bi bi-chevron-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif

        </div>
    </section>

    <style>
        .hover-scale:hover {
            transform: scale(1.08);
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
