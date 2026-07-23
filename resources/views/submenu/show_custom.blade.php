@extends('layouts.app')

@section('title', $submenu->name . ' - SMKN 1 Talaga')

@section('content')
    <section class="py-5" style="background-color: #f8fafc; min-height: 70vh; padding-top: 100px !important;">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        
                        <!-- Breadcrumbs -->
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb" style="font-size: 14px;">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                                <li class="breadcrumb-item active text-muted" aria-current="page">{{ $submenu->menu->name ?? 'Menu' }}</li>
                                <li class="breadcrumb-item active text-primary" aria-current="page" style="font-weight: 600;">{{ $submenu->name }}</li>
                            </ol>
                        </nav>

                        <h1 class="mb-4 pb-3 border-bottom text-dark" style="font-weight: 800; font-size: 32px;">
                            {{ $submenu->name }}
                        </h1>

                        <!-- Custom Styling for Content -->
                        <style>
                            .custom-page-content h1, .custom-page-content h2, .custom-page-content h3 {
                                font-weight: 700;
                                color: #0f172a;
                                margin-top: 1.5rem;
                                margin-bottom: 0.75rem;
                            }
                            .custom-page-content h1 { font-size: 24px; }
                            .custom-page-content h2 { font-size: 20px; }
                            .custom-page-content h3 { font-size: 18px; }
                            
                            .custom-page-content p {
                                margin-bottom: 1.25rem;
                                line-height: 1.8;
                                font-size: 16px;
                                color: #475569;
                            }
                            .custom-page-content ul, .custom-page-content ol {
                                margin-left: 1.5rem;
                                margin-bottom: 1.25rem;
                                color: #475569;
                            }
                            .custom-page-content li { margin-bottom: 0.35rem; }
                            
                            .custom-page-content img {
                                max-width: 100%;
                                height: auto;
                                border-radius: 8px;
                                margin: 1.5rem auto;
                                display: block;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                            }
                            .custom-page-content a {
                                color: #0d6efd;
                                text-decoration: underline;
                            }
                            .custom-page-content a:hover {
                                color: #0a58ca;
                            }
                        </style>

                        <div class="custom-page-content ql-editor" style="padding: 0;">
                            @if(!empty($submenu->content))
                                {!! $submenu->content !!}
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-file-earmark-text text-muted" style="font-size: 48px;"></i>
                                    <p class="text-muted italic mt-2">Halaman ini belum memiliki konten.</p>
                                </div>
                            @endif
                        </div>

                        @push('scripts')
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
                            <script src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
                            <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
                        @endpush

                        <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ url('/') }}" class="btn btn-outline-primary px-4" style="border-radius: 6px; font-weight: 600;">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                            </a>
                            <span class="text-muted" style="font-size: 13px;">Diperbarui {{ optional($submenu->updated_at)->diffForHumans() }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
