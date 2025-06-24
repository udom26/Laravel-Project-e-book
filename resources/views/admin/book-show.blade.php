{{-- filepath: resources/views/admin/book-show.blade.php --}}
@extends('admin.layout-admin')

@section('title', 'รายละเอียดหนังสือ')

@section('content')
<div class="container">
    <h3>รายละเอียดหนังสือ</h3>
    <div class="card">
        <div class="card-body">
            <p><strong>ชื่อหนังสือ:</strong> {{ $book['book_name'] ?? '-' }}</p>
            <p><strong>ผู้แต่ง:</strong> {{ $book['book_author'] ?? '-' }}</p>
            <p><strong>รายละเอียด:</strong> {{ $book['book_description'] ?? '-' }}</p>
            <p><strong>รูปหน้าปก:</strong>
                @if(!empty($book['book_cover_image_url']))
                    <a href="{{ $book['book_cover_image_url'] }}" target="_blank">{{ $book['book_cover_image_url'] }}</a>
                @else
                    -
                @endif
            </p>
            <p><strong>URL หนังสือ:</strong>
                @if(!empty($book['book_reader_url']))
                    <a href="{{ $book['book_reader_url'] }}" target="_blank">อ่าน</a>
                @else
                    -
                @endif
            </p>
            <p><strong>หมวดหมู่:</strong>
                @if(isset($book['categories']) && is_array($book['categories']))
                    @foreach($book['categories'] as $cate)
                        <span class="badge bg-secondary">{{ $cate['cate_name'] }}</span>
                    @endforeach
                @else
                    -
                @endif
            </p>
            <a href="{{ route('book') }}" class="btn btn-secondary">กลับ</a>
        </div>
    </div>
</div>
@endsection