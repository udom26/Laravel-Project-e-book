{{-- filepath: c:\xampp\htdocs\ebook\resources\views\admin\user_edit.blade.php --}}
@extends('admin.layout-admin')

@section('title', 'แก้ไขผู้ใช้')

@section('content')
<div class="container">
    <h3 class="mb-3">แก้ไขผู้ใช้</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.update', $user['id'] ?? $user['_id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="surname" name="surname" value="{{ $user['surname'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">บทบาท</label>
                    @php
                        $userRoles = $user['roles'] ?? [];
                    @endphp
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" id="role_admin" value="admin" {{ in_array('admin', $userRoles) ? 'checked' : '' }}>
                        <label class="form-check-label" for="role_admin">แอดมิน</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" id="role_user" value="user" {{ in_array('user', $userRoles) ? 'checked' : '' }}>
                        <label class="form-check-label" for="role_user">ผู้ใช้</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a href="{{ route('user') }}" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
    </div>
</div>
@endsection