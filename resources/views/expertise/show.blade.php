@extends('layouts.app')

@section('title', $core->name . ' - SMKN 1 Talaga')

@section('content')
    <section class="py-5" style="background-color: #f8fafc; min-height: 80vh; padding-top: 100px !important;">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        
                        <!-- Breadcrumbs -->
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb" style="font-size: 14px;">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                                <li class="breadcrumb-item active text-primary" aria-current="page" style="font-weight: 600;">Program Keahlian</li>
                                <li class="breadcrumb-item active text-primary" aria-current="page" style="font-weight: 600;">{{ $core->name }}</li>
                            </ol>
                        </nav>

                        <h1 class="text-dark mb-2" style="font-weight: 800; font-size: 32px;">
                            {{ $core->name }}
                        </h1>
                        <p class="text-muted mb-4" style="font-size: 14px; font-weight: 500;">Slug: {{ $core->slug }}</p>

                        <!-- Description Content -->
                        <div class="text-secondary mt-3" style="font-size: 15px; line-height: 1.8;">
                            @if ($s && $s->description)
                                {!! nl2br(e($s->description)) !!}
                            @else
                                <p class="text-muted italic">Deskripsi belum tersedia untuk kompetensi keahlian ini.</p>
                            @endif
                        </div>

                        <!-- Back Button -->
                        <div class="mt-5 pt-3 border-top">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-primary px-4" style="border-radius: 6px; font-weight: 600;">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
