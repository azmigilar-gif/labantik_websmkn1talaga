@extends('layouts.app')

@section('title', 'Galeri - SMKN 1 Talaga')

@section('content')
    <section class="py-5" style="background-color: #f8fafc; min-height: 80vh; padding-top: 100px !important;">
        <div class="container my-5">
            
            <!-- Breadcrumbs -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h1 style="font-weight: 800; font-size: 28px; color: #0f172a; margin: 0;">Galeri Sekolah</h1>
                </div>
                <div class="col-md-6 text-md-end">
                    <nav aria-label="breadcrumb" class="d-inline-block">
                        <ol class="breadcrumb m-0" style="font-size: 14px;">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page" style="font-weight: 600;">Galeri</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle px-3 py-2" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: 600; border-radius: 6px;">
                        <i class="bi bi-funnel-fill me-1"></i> Tipe Galeri
                    </button>
                    <ul class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton" style="border-radius: 8px;">
                        <li>
                            <a class="dropdown-item py-2 {{ !request('type') ? 'active bg-primary' : '' }}" href="{{ route('galleries.index') }}">
                                Semua Media
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item py-2 {{ request('type') == 'photo' ? 'active bg-primary' : '' }}" href="{{ route('galleries.index', ['type' => 'photo']) }}">
                                <i class="bi bi-image me-2"></i> Foto
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 {{ request('type') == 'video' ? 'active bg-primary' : '' }}" href="{{ route('galleries.index', ['type' => 'video']) }}">
                                <i class="bi bi-play-circle me-2"></i> Video
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="row g-4">
                @forelse ($galleries as $item)
                    @php
                        $mediaUrl = null;
                        if (!empty($item->file_path)) {
                            $mediaUrl = asset($item->file_path);
                        } elseif ($item->embed_html && preg_match('/src="([^"]+)"/i', $item->embed_html, $matches)) {
                            $mediaUrl = $matches[1];
                        } else {
                            $mediaUrl = asset('assets/images/default-news.png');
                        }
                    @endphp
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white" style="transition: all 0.3s ease;">
                            <div class="position-relative overflow-hidden" style="aspect-ratio: 1/1;">
                                @if ($item->type == 'photo')
                                    <a href="{{ $mediaUrl }}" class="glightbox" data-gallery="gallery-all" data-title="{{ $item->title }}">
                                        <img src="{{ $mediaUrl }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover hover-scale" style="transition: all 0.5s;" onerror="this.src='{{ asset('assets/images/default-news.png') }}'">
                                    </a>
                                @else
                                    <div class="w-100 h-100 position-relative">
                                        @if($item->embed_html)
                                            {!! preg_replace('/width="\d+"/', 'width="100%"', preg_replace('/height="\d+"/', 'height="100%"', $item->embed_html)) !!}
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="p-3">
                                <h6 class="text-dark mb-1 text-truncate" style="font-weight: 700;">{{ $item->title }}</h6>
                                <p class="text-muted text-truncate mb-2" style="font-size: 12px;">{{ $item->description }}</p>
                                <div class="text-muted mb-2" style="font-size: 11px;">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->format('d M Y') }}
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge {{ $item->type == 'photo' ? 'bg-primary' : 'bg-danger' }}" style="font-size: 10px; padding: 3px 8px;">
                                        {{ $item->type == 'photo' ? 'Foto' : 'Video' }}
                                    </span>
                                    @if(Route::has('galleries.show'))
                                        <a href="{{ route('galleries.show', $item->id) }}" class="text-primary text-decoration-none font-weight-bold" style="font-size: 12px;">Detail <i class="bi bi-arrow-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-images text-muted" style="font-size: 64px;"></i>
                        <p class="text-muted mt-3 italic" style="font-size: 16px;">Belum ada media di galeri saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(method_exists($galleries, 'lastPage') && $galleries->lastPage() > 1)
                <div class="d-flex justify-content-center mt-5">
                    <nav aria-label="Page navigation">
                        <ul class="pagination shadow-sm m-0" style="border-radius: 8px; overflow: hidden;">
                            <li class="page-item {{ $galleries->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link py-2.5 px-3" href="{{ $galleries->previousPageUrl() }}">Prev</a>
                            </li>
                            @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $galleries->currentPage() ? 'active' : '' }}">
                                    <a class="page-link py-2.5 px-3" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ !$galleries->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link py-2.5 px-3" href="{{ $galleries->nextPageUrl() }}">Next</a>
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
    </style>
@endsection
