<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard') | SMKN 1 Talaga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            min-height: 100vh;
            background: #0d47a1;
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #1565c0;
        }

        .topbar {
            background-color: #f8f9fa;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>

    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar d-flex flex-column">
            <div class="text-center py-4">
                <img src="https://smkn1talaga-mjl.net/img/logosmk.png" alt="Logo" height="50">
                <h5 class="text-white mt-2">SMKN 1 Talaga</h5>
            </div>
            <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
            <a href="#">📚 Data Siswa</a>
            <a href="#">📁 Data Program</a>
            <a href="#">📸 Galeri</a>
            <a href="#">⚙️ Pengaturan</a>
            
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Dashboard</h5>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        👤 {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">🚪 Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>


            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>