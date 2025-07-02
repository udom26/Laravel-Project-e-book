@extends('layout')

@section('title', 'รายละเอียดหนังสือ | E-Book System')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center mb-4">
                <img src="{{ $book['book_cover_image_url'] ?? 'https://via.placeholder.com/250x350?text=Book+Cover' }}" 
                     alt="Book Cover" class="img-fluid rounded shadow" style="max-height:350px;">
            </div>
            <div class="col-md-6">
                <div class="mb-2 text-muted">รูปหน้าปกหนังสือ</div>
                <h2 style="color:#1976d2;">{{ $book['book_name'] ?? 'ชื่อหนังสือ' }}</h2>
                <p class="mb-2"><strong>ผู้แต่ง:</strong> {{ $book['book_author'] ?? '-' }}</p>
                <p class="mb-2"><strong>หมวดหมู่:</strong> 
                    {{ $book['categories'][0]['cate_name'] ?? ($book['category'] ?? '-') }}
                </p>
                <hr>
                @if(!empty($book['book_reader_url']))
                    <a href="{{ $book['book_reader_url'] }}" target="_blank" class="btn btn-read w-100">
                        <i class="fas fa-book-open me-1"></i>อ่านหนังสือ
                    </a>
                @else
                    <div class="alert alert-warning text-center">ไม่พบลิงก์อ่านหนังสือ</div>
                @endif
            </div>
        </div>
    </div>
@endsection