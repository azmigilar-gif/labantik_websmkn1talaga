@extends('layouts.app')

@section('title', $achievement->title . ' - SMKN 1 Talaga')

@section('content')
    <section class="py-5" style="background-color: #f8fafc; min-height: 80vh; padding-top: 140px !important;">
        <div class="container my-5">
            <div class="row g-4">
                
                <!-- Main Content (Left) -->
                <main class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white" style="border: 1px solid #e2e8f0 !important;">
                        
                        <!-- Category & Meta -->
                        <div class="d-flex align-items-center text-muted mb-3 flex-wrap gap-2" style="font-size: 13px;">
                            @php
                                $catBadge = 'bg-primary';
                                if ($achievement->category == 'Non-Akademik') $catBadge = 'bg-purple';
                                elseif ($achievement->category == 'Olahraga') $catBadge = 'bg-warning text-dark';
                                elseif ($achievement->category == 'Seni') $catBadge = 'bg-info text-white';
                            @endphp
                            <span class="badge {{ $catBadge }} px-2.5 py-1.5 font-weight-bold" style="font-size: 11px; border-radius: 4px;">
                                {{ $achievement->category }}
                            </span>
                            <span class="ms-1">
                                <i class="bi bi-calendar3 me-1 text-primary"></i> {{ \Carbon\Carbon::parse($achievement->date)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </span>
                        </div>

                        <h1 class="text-dark mb-4" style="font-weight: 800; font-size: 30px; line-height: 1.3;">
                            {{ $achievement->title }}
                        </h1>

                        <!-- Photo -->
                        @if (!empty($achievement->photo))
                            <div class="mb-4 overflow-hidden rounded-4 shadow-sm border">
                                <img src="{{ asset($achievement->photo) }}" alt="{{ $achievement->title }}" class="img-fluid w-100 object-fit-cover" style="max-height: 450px;">
                            </div>
                        @endif

                        <!-- Description -->
                        <div class="text-slate-700" style="line-height: 1.8; font-size: 16px; color: #475569;">
                            <p style="white-space: pre-line;">{{ $achievement->description }}</p>
                        </div>

                        <hr class="my-4 text-muted">
                        <a href="{{ route('public.achievements.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 6px; font-weight: 600;">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Prestasi
                        </a>
                    </div>
                </main>

                <!-- Sidebar Details (Right) -->
                <aside class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 sticky-top" style="top: 150px; z-index: 990; border: 1px solid #e2e8f0 !important;">
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="bg-primary-subtle text-primary p-3 rounded-4">
                                <i class="bi bi-person-badge-fill" style="font-size: 24px;"></i>
                            </div>
                            <div>
                                <span class="text-muted d-block" style="font-size: 12px;">Nama Perwakilan / Siswa</span>
                                <span class="fw-bold text-dark" style="font-size: 16px;">{{ $achievement->winner_name }}</span>
                            </div>
                        </div>

                        <!-- Kategori Lomba -->
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="bg-info-subtle text-info p-3 rounded-4">
                                <i class="bi bi-award" style="font-size: 24px;"></i>
                            </div>
                            <div>
                                <span class="text-muted d-block" style="font-size: 12px;">Bidang Lomba</span>
                                <span class="fw-bold text-dark" style="font-size: 16px;">{{ $achievement->category }}</span>
                            </div>
                        </div>

                        <!-- Media Sosial -->
                        @if($achievement->winner_social)
                            <div class="d-flex align-items-start gap-3 mb-4">
                                <div class="bg-danger-subtle text-danger p-3 rounded-4">
                                    <i class="bi bi-instagram" style="font-size: 24px;"></i>
                                </div>
                                <div>
                                    <span class="text-muted d-block" style="font-size: 12px;">Media Sosial</span>
                                    <a href="{{ $achievement->winner_social }}" target="_blank" class="fw-bold text-primary text-decoration-none" style="font-size: 15px;">
                                        Kunjungi Profil <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 12px;"></i>
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>
                </aside>

            </div>
        </div>
    </section>
@endsection
