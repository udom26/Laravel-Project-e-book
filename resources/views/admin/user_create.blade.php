{{-- filepath: c:\xampp\htdocs\ebook\resources\views\admin\user_create.blade.php --}}
@extends('admin.layout-admin')

@section('title', 'เพิ่มผู้ใช้')

@section('content')
<div class="container">
    <h3 class="mb-3">เพิ่มผู้ใช้</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="surname" name="surname">
                </div>
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a href="{{ route('user') }}" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
    </div>
</div>
@endsection