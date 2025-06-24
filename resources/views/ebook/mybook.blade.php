@extends('layout')

@section('title', 'หนังสือของฉัน | E-Book System')

@section('head')
<style>
body {
    background: linear-gradient(120deg, #f8fafc 0%, #e0e7ff 100%);
}
.page-header {
    padding: 2rem 0;
    margin-bottom: 2rem;
    color: #a18cd1;
    background: none;
}
.book-card {
    transition: transform 0.2s, box-shadow 0.2s;
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    height: 100%;
    background: #fff;
    box-shadow: 0 4px 24px 0 rgba(161,140,209,0.12);
}
.book-card:hover {
    transform: translateY(-5px) scale(1.03);
    box-shadow: 0 8px 25px rgba(161,140,209,0.18);
}
.book-cover {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.5rem;
    font-weight: bold;
}
.book-info {
    padding: 1rem;
}
.book-title {
    font-weight: bold;
    color: #a18cd1;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.book-author {
    color: #6c757d;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
}
.page-header h2 {
    color: #a18cd1;
    font-weight: 700;
    letter-spacing: 1px;
}
.search-section {
    max-width: 800px;
    margin: 0 auto;
    padding: 0;
}
.search-form .form-control,
.search-form .form-select {
    background: #fff;
    border: 1.5px solid #a18cd1;
    border-radius: 50px;
    box-shadow: none;
    padding: 0.75rem 1.25rem;
    color: #a18cd1;
    height: 45px;
    text-align: center;
    font-family: 'Sarabun', 'Prompt', 'Kanit', sans-serif;
    font-size: 15px;
    font-weight: 500;
    transition: border-color 0.2s;
}
.search-form .form-control:focus,
.search-form .form-select:focus {
    border-color: #fbc2eb;
    outline: none;
}
.search-form .form-control::placeholder {
    color: #a18cd1;
    text-align: center;
    font-family: 'Sarabun', 'Prompt', 'Kanit', sans-serif;
}
.search-form .btn {
    background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 0.75rem 1.25rem;
    font-weight: bold;
    transition: all 0.2s;
    height: 45px;
    white-space: nowrap;
    font-family: 'Sarabun', 'Prompt', 'Kanit', sans-serif;
    font-size: 15px;
    font-weight: 500;
}
.search-form .btn:hover {
    background: linear-gradient(90deg, #fbc2eb 0%, #a18cd1 100%);
    color: #fff;
    transform: scale(1.04);
}
.search-container {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    justify-content: center;
}
.search-input-wrapper {
    flex: 1;
    max-width: 400px;
}
.search-select-wrapper {
    min-width: 120px;
}
.search-btn-wrapper {
    min-width: 100px;
}
.pagination .page-link {
    border: none;
    color: #a18cd1;
    border-radius: 50px;
    margin: 0 0.2rem;
    transition: all 0.2s;
    font-weight: 600;
}
.pagination .page-item.active .page-link {
    background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%);
    border: none;
    color: #fff;
    box-shadow: 0 2px 8px rgba(161,140,209,0.18);
}
.pagination .page-link:hover {
    background: #fbc2eb;
    color: #fff;
    transform: translateY(-1px);
}
.empty-state {
    background: #fff;
    border-radius: 1rem;
    padding: 3rem;
    box-shadow: 0 2px 8px rgba(161,140,209,0.08);
}
.empty-state i {
    color: #a18cd1;
}
</style>
@endsection

@section('content')
<div class="container py-4">
    <!-- หัวข้อและการค้นหา -->
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-12 text-center">
                    <h2 class="mb-2">
                        <i class="fas fa-book me-2"></i>หนังสือของฉัน
                    </h2>
                    <p class="mb-0">จัดการและอ่านหนังสือที่คุณซื้อแล้ว</p>
                </div>
            </div>
            
            <!-- ฟอร์มค้นหา -->
            <div class="search-section">
                <form class="search-form" role="search">
                    <div class="search-container">
                        <div class="search-select-wrapper">
                            <select class="form-select" name="search_type">
                                <option value="all" {{ request('search_type') == 'all' ? 'selected' : '' }}>หมวดหมู่</option>
                                <option value="title" {{ request('search_type') == 'title' ? 'selected' : '' }}>ชื่อหนังสือ</option>
                                <option value="author" {{ request('search_type') == 'author' ? 'selected' : '' }}>ผู้แต่ง</option>
                                <option value="category" {{ request('search_type') == 'category' ? 'selected' : '' }}>หมวดหมู่</option>
                            </select>
                        </div>
                        <div class="search-input-wrapper">
                            <input class="form-control" type="search" name="search" placeholder="ค้นหาหนังสือ..." aria-label="Search" value="{{ request('search') }}">
                        </div>
                        <div class="search-btn-wrapper">
                            <button class="btn w-100" type="submit">
                                <i class="fas fa-search me-1"></i>ค้นหา
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- รายการหนังสือ -->
    <div class="row">
        @for($i = 1; $i <= 4; $i++)
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card book-card">
                <div class="book-cover">
                    <i class="fas fa-book fa-2x"></i>
                </div>
                <div class="book-info">
                    <h5 class="book-title">หนังสือเล่มที่ {{ $i }}</h5>
                    <p class="book-author">ผู้เขียน: นักเขียนคนที่ {{ $i }}</p>
                    <p class="text-muted small mb-2">
                        <i class="fas fa-tag me-1"></i>
                        {{ $i <= 2 ? 'นวนิยาย' : ($i <= 4 ? 'การศึกษา' : 'ธุรกิจ') }}
                    </p>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">ก่อนหน้า</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">ถัดไป</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection