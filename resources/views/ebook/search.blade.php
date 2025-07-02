@extends('layout')

@section('title', 'ค้นหาหนังสือ | E-Book System')

@section('content')
<div class="container py-5">
    <h2 class="text-center section-title">ค้นหาหนังสือที่ต้องการยืม</h2>
    <form method="GET" action="{{ route('book.search') }}" class="mb-4">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-2">
                <input type="text" name="q" class="form-control" placeholder="ค้นหาด้วยชื่อหนังสือหรือผู้แต่ง..." value="{{ request('q') }}">
            </div>
            <div class="col-md-3 mb-2">
                <select name="category_id" class="form-select">
                    <option value="">เลือกหมวดหมู่</option>
                    @foreach($categories as $category)
                        <option value="{{ $category['_id'] }}" {{ request('category_id') == $category['_id'] ? 'selected' : '' }}>
                            {{ $category['cate_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-primary w-100">ค้นหา</button>
            </div>
        </div>
    </form>

    <div class="row">
        @if(!request('q') && !request('category_id'))
            <div class="col-12 text-center text-secondary">
                กรุณาค้นหาหนังสือที่ต้องการยืมก่อน
            </div>
        @else
            @forelse($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="book-card h-100">
                        <div class="book-cover">
                            <img src="{{ $book['book_cover_image_url'] ?? 'https://via.placeholder.com/100x150?text=No+Cover' }}" alt="cover" style="width:100px;height:150px;object-fit:cover;">
                        </div>
                        <div class="book-info">
                            <h5 class="book-title">{{ $book['book_name'] }}</h5>
                            <p class="book-author">โดย {{ $book['book_author'] }}</p>
                            <p class="text-muted small">{{ \Illuminate\Support\Str::limit($book['book_description'], 60) }}</p>
                            <a href="{{ route('book.detail', $book['_id']) }}" class="btn btn-primary">ดูรายละเอียด/ยืมหนังสือ</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-danger">
                    ไม่พบหนังสือตามเงื่อนไขที่ค้นหา
                </div>
            @endforelse
        @endif
    </div>
</div>
@endsection