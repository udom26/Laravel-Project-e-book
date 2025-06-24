@extends('layout')

@section('title', 'สมัครสมาชิก | E-Book System')

@section('head')
<style>
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
    <!-- ฟอร์มสมัครสมาชิก overlay -->
    <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh; position: relative; z-index:2;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 370px; border-radius: 1.5rem;">
            <div class="text-end">
                <button type="button" class="btn-close" aria-label="Close" onclick="window.location='{{ url('/') }}'"></button>
            </div>
            <h4 class="mb-3 text-center">สมัครสมาชิก</h4>
            
            {{-- แสดง error หรือ success message --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('auth.register') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="ชื่อ" required autofocus value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <input type="text" name="surname" class="form-control" placeholder="นามสกุล" required value="{{ old('surname') }}">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="อีเมล" required value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
                </div>
                <button type="submit" class="btn btn-gradient w-100">สมัครสมาชิก</button>
            </form>
        </div>
    </div>
@endsection