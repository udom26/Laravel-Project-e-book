{{-- filepath: resources/views/admin/layout-admin.blade.php --}}
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin | E-Book System')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- AdminLTE Theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .main-header { background: #fff; border-bottom: 1px solid #dee2e6; }
        .main-sidebar { background: #343a40 !important; }
        .brand-link { background: #23272b !important; color: #fff !important; font-size: 1.2em; font-weight: bold; }
        .content-wrapper { background: #f4f6f9; min-height: 100vh; }
        .main-footer { background: #fff; border-top: 1px solid #dee2e6; color: #495057; text-align: center; }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: #007bff !important;
            color: #fff !important;
            font-weight: bold;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link {
            color: #c2c7d0 !important;
            font-size: 1.07em;
            border-radius: 4px;
            margin: 2px 6px;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            background: #495057 !important;
            color: #fff !important;
        }
    </style>
    @yield('head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('/') }}" class="nav-link active">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"></i> เมนู
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ url('/') }}">
                            <i class="fas fa-home"></i> ดูฟังก์ชันของผู้ใช้
                        </a>
                    </li>
                    <li>
                         <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
                                        </button>
                                    </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link text-center">
            <span class="brand-text font-weight-light">E-Book Admin</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link{{ request()->routeIs('dashboard') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>แดชบอร์ด</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link{{ request()->routeIs('category') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>หมวดหมู่หนังสือ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('book') }}" class="nav-link{{ request()->routeIs('book') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>จัดการหนังสือ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user') }}" class="nav-link{{ request()->routeIs('user') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>จัดการผู้ใช้</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaction') }}" class="nav-link{{ request()->routeIs('transaction') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-exchange-alt"></i>
                            <p>ประวัติการยืม-คืน</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- Content -->
    <div class="content-wrapper">
        <section class="content pt-4">
            @yield('content')
        </section>
    </div>
    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} E-Book System.</strong>
        All rights reserved.
    </footer>
</div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@yield('scripts')
</body>
</html>