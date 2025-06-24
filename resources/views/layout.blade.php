<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Book System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f8fafc 0%, #e0e7ff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%);
            box-shadow: 0 2px 8px rgba(161,140,209,0.08);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.7rem;
            letter-spacing: 1px;
            color: #fff !important;
            text-shadow: 0 2px 8px rgba(161,140,209,0.15);
        }
        .search-bar {
            width: 350px;
            max-width: 100%;
            border-radius: 2rem;
            border: 1px solid #e0e7ff;
            background: #fff;
        }
        .btn-login,
        .btn-register {
            border-radius: 50rem;
            padding: 0.5rem 1.5rem;
            font-weight: bold;
            font-size: 1rem;
            min-width: 130px;
            text-align: center;
        }
        .btn-login {
            border: 2px solid #a18cd1;
            color: #a18cd1 !important;
            background: #fff;
            box-shadow: 0 2px 8px rgba(161,140,209,0.12);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        .btn-login:hover, .btn-login:focus {
            background: #a18cd1;
            color: #fff !important;
            box-shadow: 0 4px 16px rgba(161,140,209,0.18);
        }
        .btn-register {
            background: linear-gradient(90deg, #fbc2eb 0%, #a6c1ee 100%);
            color: #fff !important;
            border: none;
            box-shadow: 0 2px 8px rgba(161,140,209,0.15);
            transition: transform 0.1s, box-shadow 0.1s, background 0.2s;
        }
        .btn-register:hover, .btn-register:focus {
            background: linear-gradient(90deg, #a6c1ee 0%, #fbc2eb 100%);
            color: #fff !important;
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 4px 16px rgba(161,140,209,0.25);
        }
        .btn-profile {
            border-radius: 50rem;
            padding: 0.5rem 1.5rem;
            font-weight: bold;
            border: 2px solid #fff;
            color: #fff !important;
            background: transparent;
            transition: background 0.2s, color 0.2s;
        }
        .btn-profile:hover, .btn-profile:focus {
            background: #fff;
            color: #a18cd1 !important;
        }
        .container.py-4 {
            flex: 1 0 auto;
        }
        footer {
            background: linear-gradient(90deg, #fbc2eb 0%, #a6c1ee 100%);
            color: #6c757d;
            width: 100%;
            margin-top: auto;
            padding: 40px 0 0 0;
            border-top: 1px solid #dee2e6;
        }
        .footer-section h5 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        .footer-section ul li {
            margin-bottom: 8px;
        }
        .footer-section ul li a {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-section ul li a:hover {
            color: #a18cd1;
        }
        .footer-bottom {
            background: #e0e7ff;
            padding: 15px 0;
            margin-top: 30px;
            border-top: 1px solid #dee2e6;
            margin-bottom: 0;
        }
        .footer-bottom .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .footer-bottom .btn {
            margin: 0 5px;
            padding: 5px 15px;
            font-size: 14px;
            border-radius: 20px;
        }
        .form-control {
            border-radius: 1.5rem;
        }
        .rounded-pill {
            border-radius: 50rem !important;
        }
        @media (max-width: 600px) {
            .search-bar {
                width: 100%;
            }
            .navbar-brand {
                font-size: 1.2rem;
            }
            .footer-bottom .container {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
    @yield('head')
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">E-Book</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex ms-auto me-3" role="search" action="{{ url('/') }}" method="get">
                    <input class="form-control me-2 search-bar" type="search" name="q" placeholder="ค้นหาหนังสือ..." aria-label="Search">
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center ms-auto">
                    @if(session('user_email'))
                        <!-- แสดงเมื่อล็อกอินแล้ว -->
                        <li class="nav-item dropdown">
                            <button class="btn btn-profile dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-1"></i>
                                {{ session('user_name') }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li class="dropdown-header">
                                    <div class="d-flex flex-column">
                                        <strong>{{ session('user_name') }} {{ session('user_surname') }}</strong>
                                        <small class="text-muted">{{ session('user_email') }}</small>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="profile"><i class="fas fa-user me-2"></i>โปรไฟล์</a></li>
                                <li><a class="dropdown-item" href="mybook"><i class="fas fa-book me-2"></i>หนังสือของฉัน</a></li>
                                <li><a class="dropdown-item" href="/"><i class="fas fa-home me-2"></i>กลับหน้าหลัก</a></li>
                                @if(in_array('admin', session('user_roles', [])))
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-cogs me-2"></i>ไปหน้าแอดมิน</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
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
                    @else
                        <!-- แสดงเมื่อยังไม่ล็อกอิน -->
                        <li class="nav-item me-2">
                            <a class="btn btn-login" href="{{ route('login') }}">เข้าสู่ระบบ</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-register" href="{{ route('register') }}">สมัครสมาชิก</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 footer-section">
                    <h5>เลือกหมวดหมู่</h5>
                    <ul>
                        <li><a href="#">นิยาย</a></li>
                        <li><a href="#">การ์ตูน</a></li>
                        <li><a href="#">นิตยสาร</a></li>
                        <li><a href="#">ทั่วไป</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-section">
                    <h5>บริการช่วยเหลือ</h5>
                    <ul>
                        <li><a href="#">สมัครสมาชิกใหม่</a></li>
                        <li><a href="#">วิธีการใช้งาน</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-section">
                    <h5>เกี่ยวกับเรา</h5>
                    <ul>
                        <li><a href="#">ข่าวสารและล่าสุดกิจกรรม</a></li>
                        <li><a href="#">ติดต่อเรา</a></li>
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-section">
                    <h5>ข้อมูลเพิ่มเติม</h5>
                    <ul>
                        <li><a href="#">นโยบายความเป็นส่วนตัว</a></li>
                        <li><a href="#">เงื่อนไขการใช้งาน</a></li>
                        <li><a href="#">แผนผังเว็บไซต์</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <span>© 2025 E-Book System. All rights reserved.</span>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-primary btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-info btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>