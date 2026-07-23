@extends('layouts.app')

@section('title', 'Index Prestasi Sekolah - SMKN 1 Talaga')

@section('content')
    <section class="py-5" style="background-color: #f8fafc; min-height: 80vh; padding-top: 140px !important;">
        <div class="container my-5">
            
            <!-- Breadcrumbs -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h1 style="font-weight: 800; font-size: 28px; color: #0f172a; margin: 0;">Prestasi Siswa & Sekolah</h1>
                </div>
                <div class="col-md-6 text-md-end">
                    <nav aria-label="breadcrumb" class="d-inline-block">
                        <ol class="breadcrumb m-0" style="font-size: 14px;">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page" style="font-weight: 600;">Prestasi</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle px-4 py-2 shadow-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: 600; border-radius: 6px;">
                        <i class="bi bi-funnel-fill me-1"></i> Filter Kategori
                    </button>
                    <ul class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton" style="border-radius: 8px;">
                        <li>
                            <a class="dropdown-item py-2 {{ !request('category') ? 'active bg-primary' : '' }}" href="{{ route('public.achievements.index') }}">
                                <i class="bi bi-grid-fill me-2"></i> Semua Kategori
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        @foreach (['Akademik', 'Non-Akademik', 'Olahraga', 'Seni'] as $cat)
                            <li>
                                <a class="dropdown-item py-2 {{ request('category') == $cat ? 'active bg-primary' : '' }}" href="{{ route('public.achievements.index', ['category' => $cat]) }}">
                                    <i class="bi bi-tag-fill me-2"></i> {{ $cat }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="text-muted" style="font-size: 14px;">
                    Menampilkan <b>{{ $achievements->firstItem() ?? 0 }}</b> sampai <b>{{ $achievements->lastItem() ?? 0 }}</b> dari <b>{{ $achievements->total() ?? 0 }}</b> prestasi
                </div>
            </div>

            <!-- Grid Kartu Prestasi -->
            <div class="row g-4">
                @if($achievements->count() === 0)
                    <div class="col-12">
                        <div class="text-center py-5 bg-white rounded-4 shadow-sm border" style="border: 1px solid #e2e8f0 !important; padding: 60px 20px !important;">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mb-4" style="background-color: rgba(13, 110, 253, 0.1); width: 80px; height: 80px;">
                                <i class="bi bi-award text-primary" style="font-size: 36px;"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-2" style="font-size: 20px;">Belum Ada Data Prestasi</h3>
                            <p class="text-muted mx-auto" style="max-width: 400px; font-size: 14px; line-height: 1.6;">
                                Saat ini belum ada data prestasi yang terdaftar untuk kategori ini. Ikuti terus pembaruan informasi dari kami!
                            </p>
                        </div>
                    </div>
                @else
                    @foreach ($achievements as $a)
                        @php
                            $photoUrl = $a->photo ? asset($a->photo) : asset('assets/images/default-news.png');
                            $catBadge = 'bg-primary';
                            if ($a->category == 'Non-Akademik') $catBadge = 'bg-purple';
                            elseif ($a->category == 'Olahraga') $catBadge = 'bg-warning text-dark';
                            elseif ($a->category == 'Seni') $catBadge = 'bg-info text-white';
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 border shadow-sm rounded-4 overflow-hidden bg-white d-flex flex-column justify-content-between" style="transition: transform 0.3s ease; border: 1px solid #e2e8f0 !important;">
                                <div>
                                    <div class="position-relative" style="height: 220px; overflow: hidden;">
                                        <img src="{{ $photoUrl }}" alt="{{ $a->title }}" class="w-100 h-100 object-fit-cover" style="transition: all 0.5s;">
                                        <span class="position-absolute top-3 start-3 badge {{ $catBadge }} px-3 py-2 shadow-sm" style="font-size: 11px; border-radius: 6px; top: 12px; left: 12px; z-index: 10;">
                                            {{ $a->category }}
                                        </span>
                                    </div>
                                    <div class="p-4">
                                        <div class="d-flex align-items-center text-muted mb-2 gap-3" style="font-size: 12px;">
                                            <div>
                                                <i class="bi bi-calendar3 me-1 text-primary"></i>
                                                <span>{{ \Carbon\Carbon::parse($a->date)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-3" style="font-weight: 700; font-size: 18px; color: #0f172a; line-height: 1.4;">
                                            {{ $a->title }}
                                        </h4>
                                        <div class="d-flex align-items-center gap-2 p-2 rounded bg-light mb-3">
                                            <i class="bi bi-person-fill text-primary" style="font-size: 16px;"></i>
                                            <div style="font-size: 13px;">
                                                <div class="text-muted" style="font-size: 11px;">Pemenang</div>
                                                <div class="fw-bold text-dark">{{ $a->winner_name }}</div>
                                            </div>
                                            @if($a->winner_social)
                                                <a href="{{ $a->winner_social }}" target="_blank" class="ms-auto text-primary" title="Sosial Media Pemenang">
                                                    <i class="bi bi-instagram" style="font-size: 18px;"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <p class="text-muted" style="font-size: 14px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; height: 66px;">
                                            {{ strip_tags($a->description) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="px-4 pb-4 bg-transparent border-0">
                                    <hr class="mt-0 mb-3 text-muted">
                                    <a href="{{ route('public.achievements.show', $a->id) }}" class="btn btn-outline-primary w-100 rounded-3" style="font-weight: 600; font-size: 14px; padding: 10px 0;">
                                        Lihat Detail Prestasi <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Paginasi -->
            @if ($achievements->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $achievements->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
