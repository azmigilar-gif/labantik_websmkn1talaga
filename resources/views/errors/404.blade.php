@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<style>
  /* Page Title Styling */
  .page-title {
    color: var(--default-color, #3c4049);
    background-color: var(--background-color, #ffffff);
    position: relative;
    padding-top: 100px;
  }

  .page-title .heading {
    padding: 80px 0;
  }

  .page-title .heading h1 {
    font-size: 38px;
    font-weight: 500;
  }

  .page-title nav {
    background-color: rgba(60, 64, 73, 0.04);
    padding: 20px 0;
  }

  .page-title nav ol {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 16px;
    font-weight: 400;
  }

  .page-title nav ol li+li {
    padding-left: 10px;
  }

  .page-title nav ol li+li::before {
    content: "/";
    display: inline-block;
    padding-right: 10px;
    color: rgba(60, 64, 73, 0.3);
  }

  .page-title nav ol li a {
    color: #64748b;
    text-decoration: none;
    transition: 0.3s;
  }

  .page-title nav ol li a:hover {
    color: var(--accent-color, #175cdd);
  }

  .page-title nav ol li.current {
    color: var(--default-color, #3c4049);
  }

  /* Error 404 Section Styling */
  .error-404 {
    padding: 120px 0;
    min-height: 80vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--surface-color, #ffffff) 0%, rgba(23, 92, 221, 0.03) 100%);
  }

  .error-404 .error-number {
    font-size: clamp(120px, 20vw, 280px);
    font-weight: 300;
    color: rgba(17, 35, 68, 0.85);
    line-height: 0.8;
    margin-bottom: 40px;
    font-family: var(--heading-font, "Montserrat", sans-serif);
    letter-spacing: -0.02em;
  }

  .error-404 .error-title {
    font-size: clamp(32px, 5vw, 48px);
    font-weight: 300;
    color: var(--heading-color, #112344);
    margin-bottom: 32px;
    letter-spacing: -0.01em;
  }

  .error-404 .error-description {
    font-size: 18px;
    line-height: 1.7;
    color: rgba(60, 64, 73, 0.8);
    margin-bottom: 48px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
  }

  .error-404 .error-actions {
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: center;
    margin-bottom: 80px;
  }

  @media (min-width: 576px) {
    .error-404 .error-actions {
      flex-direction: row;
      justify-content: center;
      gap: 24px;
    }
  }

  .error-404 .error-actions .btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 16px 32px;
    background-color: var(--accent-color, #175cdd);
    color: #ffffff;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 400;
    font-size: 16px;
    transition: all 0.3s ease;
    border: 2px solid var(--accent-color, #175cdd);
  }

  .error-404 .error-actions .btn-primary:hover {
    background-color: transparent;
    color: var(--accent-color, #175cdd);
    transform: translateY(-2px);
  }

  .error-404 .error-actions .btn-primary i {
    font-size: 18px;
  }

  .error-404 .error-actions .btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 16px 32px;
    background-color: transparent;
    color: var(--heading-color, #112344);
    border-radius: 8px;
    text-decoration: none;
    font-weight: 400;
    font-size: 16px;
    transition: all 0.3s ease;
    border: 2px solid rgba(60, 64, 73, 0.2);
  }

  .error-404 .error-actions .btn-secondary:hover {
    border-color: var(--accent-color, #175cdd);
    color: var(--accent-color, #175cdd);
    transform: translateY(-2px);
  }

  .error-404 .error-actions .btn-secondary i {
    font-size: 18px;
  }

  .error-404 .helpful-links {
    text-align: center;
  }

  .error-404 .helpful-links h3 {
    font-size: 24px;
    font-weight: 300;
    color: var(--heading-color, #112344);
    margin-bottom: 40px;
  }

  .error-404 .helpful-links .links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    max-width: 800px;
    margin: 0 auto;
  }

  @media (min-width: 768px) {
    .error-404 .helpful-links .links-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  .error-404 .helpful-links .link-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    padding: 32px 20px;
    background-color: var(--surface-color, #ffffff);
    border-radius: 8px;
    text-decoration: none;
    color: var(--default-color, #3c4049);
    transition: all 0.3s ease;
    border: 1px solid rgba(60, 64, 73, 0.1);
  }

  .error-404 .helpful-links .link-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(60, 64, 73, 0.1);
    color: var(--accent-color, #175cdd);
    border-color: rgba(23, 92, 221, 0.3);
  }

  .error-404 .helpful-links .link-item i {
    font-size: 24px;
    color: var(--accent-color, #175cdd);
    transition: all 0.3s ease;
  }

  .error-404 .helpful-links .link-item span {
    font-size: 16px;
    font-weight: 400;
  }
</style>

<!-- Page Title -->
<div class="page-title" data-aos="fade">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">404</h1>
          <p class="mb-0">
            Halaman yang Anda tuju tidak ditemukan atau telah dipindahkan. Gunakan navigasi di bawah ini untuk membantu Anda menemukan informasi yang dicari.
          </p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="current">404</li>
      </ol>
    </div>
  </nav>
</div><!-- End Page Title -->

<!-- Error 404 Section -->
<section id="error-404" class="error-404 section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <div class="error-number" data-aos="zoom-in" data-aos-delay="200">
          404
        </div>

        <h1 class="error-title" data-aos="fade-up" data-aos-delay="300">
          Halaman Tidak Ditemukan
        </h1>

        <p class="error-description" data-aos="fade-up" data-aos-delay="400">
          Halaman yang Anda cari mungkin telah dihapus, mengalami perubahan nama, atau untuk sementara waktu tidak tersedia. Silakan gunakan tombol di bawah ini untuk kembali ke Beranda atau mencari informasi lainnya.
        </p>

        <div class="error-actions" data-aos="fade-up" data-aos-delay="500">
          <a href="{{ url('/') }}" class="btn-primary">
            <i class="bi bi-house"></i>
            Kembali ke Beranda
          </a>
          <a href="{{ url('/') }}#navmenu" class="btn-secondary">
            <i class="bi bi-search"></i>
            Cari di Situs
          </a>
        </div>
      </div>
    </div>

    <!-- Helpful Links Grid -->
    <div class="row justify-content-center mt-5">
      <div class="col-lg-10">
        <div class="helpful-links" data-aos="fade-up" data-aos-delay="600">
          <h3>Mungkin Anda sedang mencari:</h3>
          <div class="links-grid">
            <a href="{{ url('/#section-profil') }}" class="link-item">
              <i class="bi bi-info-circle"></i>
              <span>Profil Sekolah</span>
            </a>
            <a href="{{ url('/#footer') }}" class="link-item">
              <i class="bi bi-telephone"></i>
              <span>Kontak</span>
            </a>
            <a href="{{ url('/#section-konsentrasi') }}" class="link-item">
              <i class="bi bi-grid-3x3-gap"></i>
              <span>Program Keahlian</span>
            </a>
            <a href="{{ url('/#section-berita') }}" class="link-item">
              <i class="bi bi-journal-text"></i>
              <span>Berita Terbaru</span>
            </a>
            <a href="{{ url('/#section-ekskul') }}" class="link-item">
              <i class="bi bi-people"></i>
              <span>Ekstrakurikuler</span>
            </a>
            <a href="{{ url('/#section-visimisi') }}" class="link-item">
              <i class="bi bi-shield-check"></i>
              <span>Visi & Misi</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /Error 404 Section -->
@endsection
