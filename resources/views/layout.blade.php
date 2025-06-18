<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Book System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #ffffff 0%, #ffffff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #1e88e5 0%, #29b6f6 100%);
            box-shadow: 0 2px 8px rgba(33,150,243,0.08);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.7rem;
            letter-spacing: 1px;
            color: #fff !important;
        }
        .search-bar {
            width: 350px;
            max-width: 100%;
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
            border: 2px solid #0288d1;
            color: #0288d1 !important;
            background: #fff;
            box-shadow: 0 2px 8px rgba(2,136,209,0.12);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        .btn-login:hover, .btn-login:focus {
            background: #0288d1;
            color: #fff !important;
            box-shadow: 0 4px 16px rgba(2,136,209,0.18);
        }
        .btn-register {
            background: linear-gradient(90deg, #039be5 0%, #40c4ff 100%);
            color: #fff !important;
            border: none;
            box-shadow: 0 2px 8px rgba(2,136,209,0.15);
            transition: transform 0.1s, box-shadow 0.1s, background 0.2s;
        }
        .btn-register:hover, .btn-register:focus {
            background: linear-gradient(90deg, #0288d1 0%, #039be5 100%);
            color: #fff !important;
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 4px 16px rgba(2,136,209,0.25);
        }
        .container.py-4 {
            flex: 1 0 auto;
        }
        footer {
            background: #039be5;
            color: #fff;
            width: 100%;
            margin-top: auto;
            padding: 18px 0 10px 0;
            text-align: center;
            font-size: 1em;
            letter-spacing: 0.5px;
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
        }
    </style>
    @yield('head')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">E-Book</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex ms-auto me-3" role="search" action="{{ url('/') }}" method="get">
                    <input class="form-control me-2 search-bar" type="search" name="q" placeholder="ค้นหาหนังสือ..." aria-label="Search">
                    <!-- ลบปุ่มค้นหาออก -->
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center ms-auto">
                    <li class="nav-item me-2">
                        <a class="btn btn-login" href="{{ route('login') }}">เข้าสู่ระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-register" href="{{ route('register') }}">สมัครสมาชิก</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>