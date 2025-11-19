@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold mb-4">Dashboard Admin</h2>

        <div class="row g-4">

            <!-- Card Total Siswa -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-people-fill fs-1 text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Total Siswa</h5>
                            <p class="fs-4 fw-bold">1.250</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Total Guru -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-person-badge-fill fs-1 text-success"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Total Guru</h5>
                            <p class="fs-4 fw-bold">80</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Program Keahlian -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-layers-fill fs-1 text-warning"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Program Keahlian</h5>
                            <p class="fs-4 fw-bold">5 Jurusan</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Section Recent Activity -->
        <div class="mt-5">
            <h4 class="mb-3">Aktivitas Terbaru</h4>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">✔️ Pendaftaran siswa baru dibuka</li>
                        <li class="list-group-item">📅 Rapat wali kelas pada 15 Mei 2025</li>
                        <li class="list-group-item">📢 Pengumuman kelulusan akan dilakukan online</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
