<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        /* Navbar */
        .navbar {
            background: #3b7ddd;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            
        }
        .navbar-brand {
            font-weight: 600;
            color: #fff !important;
        }
        .nav-link {
            color: #f8f9fa !important;
            font-size: 1.25rem;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: #3b7ddd;
        }
        .sidebar h6 {
            color: #e0e0e0;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .sidebar .nav-link {
            color: #f8f9fa;
            font-weight: 500;
            border-radius: 6px;
            margin: 4px 0;
            padding: 0.6rem 1rem;
            transition: 0.2s;
            font-size: 1.25rem;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #5a8dee; /* lighter hover */
            color: #fff;
        }

        /* Content */
        .content {
            padding: 2rem;
        }

        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }
        .card-header {
            background: #3b7ddd;
            color: #fff;
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
        }
    </style>

    @stack('styles')
</head>
<body>
          <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-hotel me-2 mx-3"></i> Admin Panel
            </a>
            <div class="d-flex">
                <span class="text-white me-3">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <ul class="nav flex-column mt-3">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guests.index') }}" class="nav-link {{ request()->is('guests*') ? 'active' : '' }}">
                            <i class="fas fa-users me-2"></i> Guests
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-bar me-2"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content -->
            <main class="col-md-9 col-lg-10 content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
