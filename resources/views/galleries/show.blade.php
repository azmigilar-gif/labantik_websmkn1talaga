@extends('layouts.app')

@section('title', ($galleries->title ?? 'Galeri') . ' - SMKN 1 Talaga')

@section('content')
    <section class="py-5" style="background-color: #f8fafc; min-height: 80vh; padding-top: 100px !important;">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white text-center">
                        
                        <!-- Header Meta -->
                        <div class="d-flex justify-content-center align-items-center text-muted mb-3 gap-2" style="font-size: 13px;">
                            @if ($galleries->type)
                                <span class="badge {{ $galleries->type == 'photo' ? 'bg-primary' : 'bg-danger' }} px-2.5 py-1.5 font-weight-bold" style="font-size: 11px;">
                                    {{ $galleries->type == 'photo' ? 'Foto' : 'Video' }}
                                </span>
                            @endif
                            <span>•</span>
                            <span>{{ $galleries->created_at->format('d M Y') }} ({{ $galleries->created_at->diffForHumans() }})</span>
                            @if ($galleries->createdBy)
                                <span>•</span>
                                <span>Oleh {{ $galleries->createdBy->name }}</span>
                            @endif
                        </div>

                        <h1 class="text-dark mb-4" style="font-weight: 800; font-size: 28px;">
                            {{ $galleries->title }}
                        </h1>

                        <!-- Media Display Box -->
                        <div class="mb-4 d-flex justify-content-center overflow-hidden rounded-3 shadow-sm bg-light">
                            @if ($galleries->embed_html)
                                @if ($galleries->type == 'photo')
                                    <div class="p-2 w-100 d-flex justify-content-center">
                                        {!! $galleries->embed_html !!}
                                    </div>
                                @elseif ($galleries->type == 'video')
                                    <div class="ratio ratio-16x9 w-100">
                                        {!! preg_replace('/width="\d+"/', 'width="100%"', preg_replace('/height="\d+"/', 'height="100%"', $galleries->embed_html)) !!}
                                    </div>
                                @endif
                            @elseif ($galleries->file_path)
                                <img src="{{ asset('storage/' . $galleries->file_path) }}" alt="{{ $galleries->title }}" class="img-fluid rounded shadow-sm" style="max-height: 500px;">
                            @else
                                <div class="py-5 text-muted">
                                    <i class="bi bi-image-alt text-muted" style="font-size: 48px;"></i>
                                    <p class="m-0 mt-2">Media tidak tersedia.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Description & Caption -->
                        @if ($galleries->description)
                            <div class="bg-light p-3 rounded-3 text-start mb-3">
                                <strong class="d-block mb-1 text-dark" style="font-size: 14px;">Deskripsi:</strong>
                                <p class="text-muted m-0" style="font-size: 14px; line-height: 1.6;">{{ $galleries->description }}</p>
                            </div>
                        @endif

                        @if ($galleries->caption)
                            <p class="text-muted italic mb-4" style="font-size: 13px;">"{{ $galleries->caption }}"</p>
                        @endif

                        <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ $backUrl ?? route('galleries.index') }}" class="btn btn-outline-primary px-4" style="border-radius: 6px; font-weight: 600;">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Galeri
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
