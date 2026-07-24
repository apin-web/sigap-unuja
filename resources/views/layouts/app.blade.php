<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Dashboard') - SIGAP UNUJA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background-color: #f4f6f9;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #0d6efd;
            color: white;
            flex-shrink: 0;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 4px;
            font-weight: 500;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.2);
        }
        .content-area {
            flex-grow: 1;
            padding: 25px;
            overflow-x: hidden;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- SIDEBAR -->
        <div class="sidebar p-3 d-flex flex-column">
            <a href="#" class="d-flex align-items-center mb-3 me-md-auto text-white text-decoration-none fs-4 fw-bold p-2">
                SIGAP UNUJA
            </a>
            <hr class="text-white opacity-25">
            
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/reports" class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text me-2"></i> Laporan Mahasiswa
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/alerts" class="nav-link {{ request()->is('alerts*') ? 'active' : '' }}">
                        <i class="bi bi-megaphone me-2"></i> Informasi / Pengumuman
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="/users" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Kelola Akun
                    </a>
                </li>
            </ul>

            <hr class="text-white opacity-25">
            <div class="px-2 text-white-50 small">
                Admin Panel v1.0
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <div class="content-area">
            <h3 class="mb-4 text-dark fw-bold">@yield('page-title')</h3>
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>