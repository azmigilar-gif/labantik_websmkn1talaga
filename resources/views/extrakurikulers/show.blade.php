@extends('layouts.app')

@section('title', $e->name . ' - SMKN 1 Talaga')

@section('content')
    <section class="py-5" style="background-color: #f8fafc; min-height: 80vh; padding-top: 100px !important;">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        
                        <!-- Breadcrumbs -->
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb" style="font-size: 14px;">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                                <li class="breadcrumb-item active text-primary" aria-current="page" style="font-weight: 600;">Ekstrakurikuler</li>
                                <li class="breadcrumb-item active text-primary" aria-current="page" style="font-weight: 600;">{{ $e->name }}</li>
                            </ol>
                        </nav>

                        <h1 class="text-dark mb-4 pb-3 border-bottom" style="font-weight: 800; font-size: 32px;">
                            {{ $e->name }}
                        </h1>

                        <!-- Photo Section -->
                        @if (!empty($e->photo))
                            @php
                                $p = $e->photo;
                                if (filter_var($p, FILTER_VALIDATE_URL)) {
                                    $imgUrl = $p;
                                } elseif (preg_match('#^assets/#', $p) || preg_match('#^public/assets/#', $p)) {
                                    $imgUrl = asset(preg_replace('#^public/#', '', $p));
                                } else {
                                    $rel = preg_replace('#^storage/#', '', $p);
                                    $imgUrl = route('public.files', ['path' => $rel]);
                                }
                            @endphp
                            <div class="mb-4 overflow-hidden rounded-3 shadow-sm bg-light text-center">
                                <img src="{{ $imgUrl }}" alt="{{ $e->name }}" class="img-fluid" style="max-height: 400px; object-fit: contain;" onerror="this.src='{{ asset('assets/images/default-extrakurikuler.png') }}'">
                            </div>
                        @endif

                        <!-- Description Content -->
                        <div class="text-secondary mt-3" style="font-size: 15px; line-height: 1.8;">
                            @if ($e && $e->description)
                                {!! nl2br(e($e->description)) !!}
                            @else
                                <p class="text-muted italic">Deskripsi belum tersedia untuk kegiatan ekstrakurikuler ini.</p>
                            @endif
                        </div>

                        <!-- Back Button & Meta info -->
                        <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ url('/') }}" class="btn btn-outline-primary px-4" style="border-radius: 6px; font-weight: 600;">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                            </a>
                            <span class="text-muted" style="font-size: 13px;">Diperbarui {{ optional($e->updated_at)->diffForHumans() }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
