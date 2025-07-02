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
    display: flex;
    flex-direction: column;
    align-items: center;
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
    width: 100%;
    text-align: center;
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
    box-shadow: 0 2px 8px rgba(161,140,209,0.10);
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
.pagination {
    justify-content: center;
}
.pagination .page-link {
    border: none;
    color: #a18cd1;
    border-radius: 50px;
    margin: 0 0.2rem;
    transition: all 0.2s;
    font-weight: 600;
    background: #fff;
    box-shadow: 0 2px 8px rgba(161,140,209,0.08);
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
    text-align: center;
}
.empty-state i {
    color: #a18cd1;
}
.btn-read {
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    font-weight: bold;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(102,126,234,0.08);
    transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
    display: inline-block;
}
.btn-read:hover, .btn-read:focus {
    background: linear-gradient(90deg, #764ba2 0%, #667eea 100%);
    color: #fff;
    transform: scale(1.05);
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
                    
                </div>
            </div>
    </div>

    <!-- รายการหนังสือ -->
    <div class="row justify-content-center">
        @forelse($borrowedBooks as $item)
            @php $book = $item['book']; @endphp
            <div class="col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                <div class="card book-card w-100">
                    <div class="book-cover">
                        <img src="{{ $book['book_cover_image_url'] ?? 'https://via.placeholder.com/100x150?text=No+Cover' }}" alt="cover" style="width:100px;height:150px;object-fit:cover;">
                    </div>
                    <div class="book-info">
                        <h5 class="book-title">{{ $book['book_name'] ?? '-' }}</h5>
                        <p class="book-author">ผู้เขียน: {{ $book['book_author'] ?? '-' }}</p>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-tag me-1"></i>
                            @if(isset($book['categories'][0]['cate_name']))
                                {{ $book['categories'][0]['cate_name'] }}
                            @else
                                -
                            @endif
                        </p>
                        @if(!empty($book['book_reader_url']))
                            <a href="{{ $book['book_reader_url'] }}" target="_blank" class="btn btn-read w-100">
                                <i class="fas fa-book-open me-1"></i>อ่านหนังสือ
                            </a>
                        @else
                            <span class="btn btn-read w-100 disabled">ไม่มีลิงก์อ่านหนังสือ</span>
                        @endif
                        <div class="small text-muted mt-2">
                            หมดอายุ: {{ \Carbon\Carbon::parse($item['expiresAt'])->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 empty-state">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <div>คุณยังไม่มีหนังสือที่ยืม</div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($borrowedBooks->lastPage() > 1)
    <div class="d-flex justify-content-center mt-4">
        {{ $borrowedBooks->links('pagination::bootstrap-4') }}
    </div>
    @endif
</div>
@endsection