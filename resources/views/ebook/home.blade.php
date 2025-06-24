@extends('layout')

@section('title', 'หน้าแรก | E-Book System')

@section('head')
<style>
.book-card {
    transition: transform 0.2s, box-shadow 0.2s;
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    height: 100%;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.book-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
.book-cover {
    width: 100%;
    height: 200px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
}
.book-info {
    padding: 1rem;
}
.book-title {
    font-weight: bold;
    color: #333;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}
.book-author {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}
.category-card {
    background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
    color: white;
    border-radius: 1rem;
    padding: 2rem;
    text-align: center;
    transition: transform 0.2s;
}
.category-card:hover {
    transform: translateY(-3px);
}
.category-card.secondary {
    background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
}
.section-title {
    font-weight: bold;
    color: #333;
    margin-bottom: 2rem;
    position: relative;
}
.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-4">ยินดีต้อนรับสู่ระบบ E-Book</h1>
                <p class="lead mb-4">อ่านและค้นหาหนังสือออนไลน์ได้ง่าย ๆ ทุกที่ทุกเวลา</p>
            </div>
        </div>
    </div>

    <!-- หนังสือแนะนำ -->
    <div class="container py-5">
        <h2 class="text-center section-title">หนังสือแนะนำ</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="book-card">
                    <div class="book-cover">
                        <i class="fas fa-book fa-3x"></i>
                    </div>
                    <div class="book-info">
                        <h5 class="book-title">เรื่องเล่าจากภูเขา</h5>
                        <p class="book-author">โดย สมชาย ใจดี</p>
                        <p class="text-muted small">นิยายผจญภัยที่พาคุณไปสู่การเดินทางสุดตื่นเต้น</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="book-card">
                    <div class="book-cover">
                        <i class="fas fa-heart fa-3x"></i>
                    </div>
                    <div class="book-info">
                        <h5 class="book-title">รักในวันฝน</h5>
                        <p class="book-author">โดย สุนิสา รักเรียน</p>
                        <p class="text-muted small">เรื่องราวความรักที่อบอุ่นและน่าติดตาม</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="book-card">
                    <div class="book-cover">
                        <i class="fas fa-rocket fa-3x"></i>
                    </div>
                    <div class="book-info">
                        <h5 class="book-title">การเดินทางสู่ดวงดาว</h5>
                        <p class="book-author">โดย วิทยา นักคิด</p>
                        <p class="text-muted small">นิยายวิทยาศาสตร์ที่จะพาคุณสู่อนาคต</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="book-card">
                    <div class="book-cover">
                        <i class="fas fa-magic fa-3x"></i>
                    </div>
                    <div class="book-info">
                        <h5 class="book-title">เวทมนตร์แห่งป่าใหญ่</h5>
                        <p class="book-author">โดย มายา เวทย์มนตร์</p>
                        <p class="text-muted small">แฟนตาซีสุดมันส์ในโลกแห่งเวทมนตร์</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- หมวดหมู่ -->
    <div class="container py-5">
        <h2 class="text-center section-title">หมวดหมู่ยอดนิยม</h2>
        <div class="row justify-content-center">
            <div class="col-md-5 mb-4">
                <div class="category-card">
                    <i class="fas fa-book-open fa-4x mb-3"></i>
                    <h3>นิยาย</h3>
                    <p>รวมนิยายหลากหลายแนว ทั้งรัก ผจญภัย แฟนตาซี และอื่นๆ อีกมากมาย</p>
                    <a href="#" class="btn btn-light btn-lg mt-3">เริ่มอ่าน</a>
                </div>
            </div>
            <div class="col-md-5 mb-4">
                <div class="category-card secondary">
                    <i class="fas fa-graduation-cap fa-4x mb-3"></i>
                    <h3>การศึกษา</h3>
                    <p>หนังสือความรู้ บทเรียน และเอกสารการศึกษาสำหรับทุกระดับ</p>
                    <a href="#" class="btn btn-light btn-lg mt-3">เรียนรู้</a>
                </div>
            </div>
        </div>
    </div>
@endsection