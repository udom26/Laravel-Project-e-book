@extends('layout')

@section('title', 'แก้ไขโปรไฟล์ | E-Book System')

@section('head')
<style>
body {
    background: linear-gradient(120deg, #f8fafc 0%, #e0e7ff 100%);
}
.profile-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem 0;
}
.profile-card {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 4px 24px 0 rgba(161,140,209,0.15);
    overflow: hidden;
    border: 1px solid #e0e7ff;
}
.profile-header {
    background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%);
    color: #fff;
    padding: 2.5rem 2rem 1.5rem 2rem;
    text-align: center;
    border-bottom: 1px solid #e0e7ff;
}
.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    border: 4px solid #fff;
    box-shadow: 0 2px 12px rgba(161,140,209,0.12);
}
.profile-avatar i {
    color: #fff; /* เปลี่ยนจาก #a18cd1 เป็น #fff */
}
.profile-body {
    padding: 2rem;
    background: linear-gradient(120deg, #f8fafc 0%, #e0e7ff 100%);
}
.form-group {
    margin-bottom: 1.5rem;
}
.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    display: block;
}
.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e0e7ff;
    border-radius: 1rem;
    font-size: 1rem;
    transition: all 0.3s;
    background: #fff;
}
.form-control:focus {
    outline: none;
    border-color: #a18cd1;
    box-shadow: 0 0 0 0.2rem rgba(161,140,209,0.12);
}
.btn-group {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}
.btn {
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 1rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-primary {
    background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%);
    color: #fff;
    border: none;
}
.btn-primary:hover {
    background: linear-gradient(90deg, #fbc2eb 0%, #a18cd1 100%);
    color: #fff;
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 4px 15px rgba(161,140,209,0.18);
}
.btn-secondary {
    background: #e0e7ff;
    color: #6c757d;
}
.btn-secondary:hover {
    background: #a6c1ee;
    color: #fff;
    transform: translateY(-2px);
}
.btn-danger {
    background: #dc3545;
    color: white;
}
.btn-danger:hover {
    background: #c82333;
    transform: translateY(-2px);
}
.change-password-section {
    border-top: 1px solid #e0e7ff;
    margin-top: 2rem;
    padding-top: 2rem;
    background: transparent;
}
.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #a18cd1;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.alert {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
}
.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
.text-muted {
    color: #6c757d !important;
    font-size: 0.875rem;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="profile-container">
        <!-- Profile Card -->
        <div class="profile-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user fa-4x"></i>
                </div>
                <h2>แก้ไขโปรไฟล์</h2>
                <p>จัดการข้อมูลส่วนตัวของคุณ</p>
            </div>

            <!-- Profile Body -->
            <div class="profile-body">
                <!-- Profile Form -->
                <form>
                    <div class="row">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-user"></i> ชื่อ
                                </label>
                                <input type="text" class="form-control" value="{{ session('user_name') }}" placeholder="กรอกชื่อ">
                            </div>
                        </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i> อีเมล
                        </label>
                        <input type="email" class="form-control" value="{{ session('user_email') }}" readonly>
                        <small class="text-muted">ไม่สามารถแก้ไขอีเมลได้</small>
                    </div>
                    <!-- Save Button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-save"></i> บันทึกการเปลี่ยนแปลง
                        </button>
                        <a href="#" class="btn btn-secondary">
                            <i class="fas fa-times"></i> ยกเลิก
                        </a>
                    </div>
                </form>

                <!-- Change Password Section -->
                <div class="change-password-section">
                    <h3 class="section-title">
                        <i class="fas fa-lock"></i> เปลี่ยนรหัสผ่าน
                    </h3>

                    <form>
                        <!-- Current Password -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-key"></i> รหัสผ่านปัจจุบัน
                            </label>
                            <input type="password" class="form-control" placeholder="กรอกรหัสผ่านปัจจุบัน">
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock"></i> รหัสผ่านใหม่
                            </label>
                            <input type="password" class="form-control" placeholder="กรอกรหัสผ่านใหม่">
                            <small class="text-muted">รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร</small>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock"></i> ยืนยันรหัสผ่านใหม่
                            </label>
                            <input type="password" class="form-control" placeholder="กรอกรหัสผ่านใหม่อีกครั้ง">
                        </div>

                        <!-- Change Password Button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
</script>
@endsection