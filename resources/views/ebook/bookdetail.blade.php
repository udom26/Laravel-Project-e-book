@extends('layout')

@section('title', 'รายละเอียดหนังสือ | E-Book System')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center mb-4">
                <img src="{{ $book->cover ?? 'https://via.placeholder.com/250x350?text=Book+Cover' }}" 
                     alt="Book Cover" class="img-fluid rounded shadow" style="max-height:350px;">
            </div>
            <div class="col-md-6">
                <h2 style="color:#1976d2;">{{ $book->title ?? 'ชื่อหนังสือ' }}</h2>
                <p class="mb-2"><strong>ผู้แต่ง:</strong> {{ $book->author ?? '-' }}</p>
                <p class="mb-2"><strong>หมวดหมู่:</strong> {{ $book->category ?? '-' }}</p>
                <p class="mb-2"><strong>ปีที่พิมพ์:</strong> {{ $book->year ?? '-' }}</p>
                <hr>
                <p>{{ $book->description ?? 'ไม่มีรายละเอียดหนังสือ' }}</p>
                <a href="#" class="btn btn-gradient rounded-pill mt-3">ยืมหนังสือ</a>
            </div>
        </div>
    </div>
@endsection