@extends('layout')

@section('title', 'เข้าสู่ระบบ | E-Book System')

@section('head')
<style>
.btn-gradient {
    background: linear-gradient(90deg, #039be5 0%, #40c4ff 100%);
    color: #fff !important;
    border: none;
    border-radius: 50rem;
    padding: 0.5rem 1.5rem;
    font-weight: bold;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(2,136,209,0.15);
    transition: background 0.2s, box-shadow 0.2s;
}
.btn-gradient:hover, .btn-gradient:focus {
    background: linear-gradient(90deg, #0288d1 0%, #039be5 100%);
    color: #fff !important;
    box-shadow: 0 4px 16px rgba(2,136,209,0.25);
}
</style>
@endsection

@section('content')
    <div class="position-relative" style="min-height: 70vh;">
        <!-- ฟอร์มล็อกอิน overlay -->
        <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh; position: relative; z-index:2;">
            <div class="card shadow-lg p-4" style="width: 100%; max-width: 370px; border-radius: 1.5rem;">
                <div class="text-end">
                    <button type="button" class="btn-close" aria-label="Close" onclick="window.location='{{ url('/') }}'"></button>
                </div>
                <h4 class="mb-2 text-center" style="color:#1976d2; font-weight:bold;">ล็อกอินเข้าสู่ระบบ</h4>
                <div class="mb-2 text-center" style="color:#1976d2;">หรือ เข้าระบบด้วยบัญชีอีเมล</div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control rounded-pill" placeholder="Email" required autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control rounded-pill" placeholder="Password" required>
                    </div>
                    <div class="mb-3 text-end">
                        <a href="{{ route('resetpass') }}" style="color:#1976d2; font-weight:500; text-decoration:underline;">ลืมรหัสผ่าน?</a>
                    </div>
                    <button type="submit" class="btn btn-gradient w-100 rounded-pill" style="font-weight:bold; font-size:1.1rem;">ล็อกอินเข้าสู่ระบบ</button>
                </form>
                <div class="mt-3 text-center" style="color:#1976d2;">
                    หากยังไม่มีบัญชี <a href="{{ route('register') }}" style="color:#1976d2; font-weight:bold; text-decoration:underline;">สมัครสมาชิก</a>
                </div>
            </div>
        </div>
    </div>
@endsection