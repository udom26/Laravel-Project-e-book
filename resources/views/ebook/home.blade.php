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
}
.book-card:hover {
    transform: translateY(-5px);
}
.book-info {
    padding: 1rem;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-top: 1rem;
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
.btn-primary {
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: #fff;
    font-weight: bold;
    box-shadow: 0 2px 8px rgba(102,126,234,0.08);
    transition: background 0.2s, box-shadow 0.2s;
}
.btn-primary:hover, .btn-primary:focus {
    background: linear-gradient(90deg, #764ba2 0%, #667eea 100%);
    color: #fff;
    box-shadow: 0 4px 16px rgba(102,126,234,0.15);
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
        <h2 class="text-center section-title">หนังสือยอดนิยม</h2>
        <div class="row justify-content-center">
            @forelse($suggestions['data'] ?? [] as $book)
                <div class="col-md-3 mb-4 d-flex align-items-stretch">
                    <div class="book-card w-100">
                        <div class="book-cover d-flex align-items-center justify-content-center" style="height: 200px;">
                            @if(!empty($book['book_cover_image_url']))
                                <img src="{{ $book['book_cover_image_url'] }}" alt="{{ $book['book_name'] }}" style="max-height: 100%; max-width: 100%;">
                            @else
                                <i class="fas fa-book fa-3x"></i>
                            @endif
                        </div>
                        <div class="book-info">
                            <h5 class="book-title">{{ $book['book_name'] ?? '-' }}</h5>
                            <p class="book-author">โดย {{ $book['book_author'] ?? '-' }}</p>
                            <p class="text-muted small">{{ $book['book_description'] ?? '' }}</p>
                            <div class="d-grid gap-2 mt-3">
                                    <a href="{{ route('book.detail', $book['_id']) }}" class="btn btn-primary">ดูรายละเอียด/ยืมหนังสือ</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">ไม่มีหนังสือแนะนำในขณะนี้</div>
            @endforelse
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
                    <a href="/search" class="btn btn-light btn-lg mt-3">เริ่มอ่าน</a>
                </div>
            </div>
            <div class="col-md-5 mb-4">
                <div class="category-card secondary">
                    <i class="fas fa-graduation-cap fa-4x mb-3"></i>
                    <h3>การศึกษา</h3>
                    <p>หนังสือความรู้ บทเรียน และเอกสารการศึกษาสำหรับทุกระดับ</p>
                    <a href="/search" class="btn btn-light btn-lg mt-3">เรียนรู้</a>
                </div>
            </div>
        </div>
    </div>
@endsection