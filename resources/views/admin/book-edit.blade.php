{{-- filepath: resources/views/admin/book-edit.blade.php --}}
@extends('admin.layout-admin')

@section('title', 'แก้ไขหนังสือ')

@section('content')
<div class="container">
    <h3>แก้ไขหนังสือ</h3>
    <form method="POST" action="{{ route('book.update', $book['_id']) }}">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="form-label">ชื่อหนังสือ</label>
            <input type="text" name="book_name" class="form-control" value="{{ $book['book_name'] ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ผู้แต่ง</label>
            <input type="text" name="book_author" class="form-control" value="{{ $book['book_author'] ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">รายละเอียด</label>
            <textarea name="book_description" class="form-control" required>{{ $book['book_description'] ?? '' }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">URL รูปหน้าปก</label>
            <input type="text" name="book_cover_image_url" class="form-control" value="{{ $book['book_cover_image_url'] ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">URL หนังสือ (Reader)</label>
            <input type="text" name="book_reader_url" class="form-control" value="{{ $book['book_reader_url'] ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">หมวดหมู่</label>
            @php
                $bookCategoryIds = collect($book['categories'] ?? [])->pluck('_id')->toArray();
            @endphp
            @foreach($categories as $category)
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="categories[]"
                        id="cate_{{ $category['_id'] }}"
                        value="{{ $category['_id'] }}"
                        {{ in_array($category['_id'], $bookCategoryIds) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="cate_{{ $category['_id'] }}">
                        {{ $category['cate_name'] }}
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="{{ route('book') }}" class="btn btn-secondary">ยกเลิก</a>
    </form>
</div>
@endsection