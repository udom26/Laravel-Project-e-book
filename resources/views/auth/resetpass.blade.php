@extends('layout')

@section('title', 'รีเซ็ตรหัสผ่าน | E-Book System')

@section('head')
<style>
body {
    background: linear-gradient(120deg, #f8fafc 0%, #e0e7ff 100%);
}
.btn-gradient {
    background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%);
    color: #fff !important;
    border: none;
    border-radius: 50rem;
    padding: 0.5rem 1.5rem;
    font-weight: bold;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(161,140,209,0.15);
    transition: background 0.2s, box-shadow 0.2s;
}
.btn-gradient:hover, .btn-gradient:focus {
    background: linear-gradient(90deg, #fbc2eb 0%, #a18cd1 100%);
    color: #fff !important;
    box-shadow: 0 4px 16px rgba(161,140,209,0.25);
}
.card {
    border-radius: 1.5rem;
    border: 1px solid #e0e7ff;
    box-shadow: 0 4px 24px 0 rgba(161,140,209,0.15);
}
.form-control {
    border-radius: 50rem;
    border: 1.5px solid #a18cd1;
    background: #fff;
    color: #a18cd1;
    font-weight: 500;
    font-size: 1rem;
    transition: border-color 0.2s;
}
.form-control:focus {
    border-color: #fbc2eb;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(161,140,209,0.08);
}
h4, .mb-3.text-center {
    color: #a18cd1 !important;
}
</style>
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh; position: relative; z-index:2;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 370px; border-radius: 1.5rem;">
            <div class="text-end">
                <button type="button" class="btn-close" aria-label="Close" onclick="window.location='{{ url('/') }}'"></button>
            </div>
            <h4 class="mb-3 text-center">รีเซ็ตรหัสผ่าน</h4>
            <div class="mb-3 text-center">
                กรอกอีเมลของคุณเพื่อรับลิงก์รีเซ็ตรหัสผ่าน
            </div>
            <form method="POST" action="#">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control rounded-pill" placeholder="อีเมล" required autofocus>
                </div>
                <button type="submit" class="btn btn-gradient w-100 rounded-pill" style=" font-weight:bold;">ส่งลิงก์รีเซ็ตรหัสผ่าน</button>
            </form>
        </div>
    </div>
@endsection