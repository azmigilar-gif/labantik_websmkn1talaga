@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4">
  <div class="col-md-4">
    <div class="card shadow">
      <div class="card-body text-center">
        <h5 class="card-title">👨‍🎓 Total Siswa</h5>
        <p class="card-text display-6">520</p>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow">
      <div class="card-body text-center">
        <h5 class="card-title">📚 Program Keahlian</h5>
        <p class="card-text display-6">5</p>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow">
      <div class="card-body text-center">
        <h5 class="card-title">📸 Galeri</h5>
        <p class="card-text display-6">32</p>
      </div>
    </div>
  </div>
</div>
@endsection
