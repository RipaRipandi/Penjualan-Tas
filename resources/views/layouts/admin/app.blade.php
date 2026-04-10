<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Penjualan Tas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f0f2f5; }
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            transition: all 0.3s;
        }
        .sidebar .brand {
            padding: 20px;
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            letter-spacing: 1px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            font-size: 14px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .sidebar .nav-link i { width: 20px; margin-right: 8px; }
        .sidebar .nav-section {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            padding: 12px 20px 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .main-content {
            margin-left: 240px;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            padding: 12px 24px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .topbar .page-title { font-weight: 600; font-size: 18px; color: #1a1a2e; }
        .stat-card {
            border: none;
            border-radius: 12px;
            padding: 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .stat-card .icon {
            font-size: 48px;
            opacity: 0.2;
            position: absolute;
            right: 16px;
            bottom: 8px;
        }
        .stat-card .number { font-size: 32px; font-weight: 700; }
        .stat-card .label { font-size: 13px; opacity: 0.85; }
        .content-card {
            background: #fff;
            border-radius: 12px;
            border: none;
            box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        }
        .table th { font-size: 13px; text-transform: uppercase; color: #6c757d; font-weight: 600; }
        .badge-status { font-size: 12px; padding: 5px 10px; border-radius: 20px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="brand">
            <i class="fa fa-store me-2"></i> TAS STORE
        </div>

        <div class="pt-3">
            <div class="nav-section">Main</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-chart-pie"></i> Dashboard
            </a>

            <div class="nav-section">Manajemen</div>

            <a href="{{ route('admin.produk.index') }}"
               class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                <i class="fa fa-box"></i> Produk
            </a>

            <a href="{{ route('admin.user.index') }}"
               class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <i class="fa fa-users"></i> Users
            </a>

            <a href="{{ route('admin.transaksi.index') }}"
               class="nav-link {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
                <i class="fa fa-receipt"></i> Transaksi
            </a>

            <a href="{{ route('admin.laporan.index') }}"
            class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <i class="fa fa-chart-bar"></i> Laporan
            </a>

            <div class="nav-section">Lainnya</div>

            <a href="{{ url('/') }}" class="nav-link">
                <i class="fa fa-globe"></i> Lihat Website
            </a>

            <form action="{{ route('logout') }}" method="POST" class="mx-2 mt-1">
                @csrf
                <button class="nav-link border-0 bg-transparent w-100 text-start text-danger">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main-content">

        <!-- TOPBAR -->
        <div class="topbar">
            <span class="page-title">@yield('page-title', 'Dashboard')</span>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted" style="font-size:14px;">
                    <i class="fa fa-user-circle me-1"></i>
                    {{ Auth::user()->nama ?? 'Admin' }}
                </span>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>