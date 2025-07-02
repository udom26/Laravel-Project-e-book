@extends('layout')

@section('title', 'รายละเอียดหนังสือ')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="mb-3">{{ $book['book_name'] }}</h3>
                <p><strong>ผู้แต่ง:</strong> {{ $book['book_author'] }}</p>
                <p><strong>รายละเอียด:</strong> {{ $book['book_description'] }}</p>
                <img src="{{ $book['book_cover_image_url'] ?? 'https://via.placeholder.com/100x150?text=No+Cover' }}" alt="cover" style="width:100px;height:150px;object-fit:cover;">
                @if(!empty($already_borrowed) && $already_borrowed)
                    <div class="alert alert-warning text-center mt-4">
                        คุณมีหนังสือนี้อยู่แล้วในคลัง
                    </div>
                @else
                    <form action="{{ route('book.borrow', $book['_id']) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">ยืนยันการยืม</button>
                    </form>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger text-center mt-3">
                        {{ session('error') }}
                    </div>
                @endif
                <a href="{{ route('mybook') }}" class="btn btn-primary mt-3 w-100">ไปยัง My Book</a>
            </div>
        </div>
    </div>
</div>
<style>
.btn-success {
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: #fff;
    font-weight: bold;
    transition: background 0.2s, box-shadow 0.2s;
}
.btn-success:hover, .btn-success:focus {
    background: linear-gradient(90deg, #764ba2 0%, #667eea 100%);
    color: #fff;
}
</style>
@endsection