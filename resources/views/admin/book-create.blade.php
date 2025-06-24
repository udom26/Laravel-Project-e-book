@extends('admin.layout-admin')

@section('title', 'เพิ่มหนังสือ')

@section('content')
<div class="container">
    <h3>เพิ่มหนังสือ</h3>
    <form method="POST" action="{{ route('book.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">ชื่อหนังสือ</label>
            <input type="text" name="book_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ผู้แต่ง</label>
            <input type="text" name="book_author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">รายละเอียด</label>
            <textarea name="book_description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">URL รูปหน้าปก</label>
            <input type="text" name="book_cover_image_url" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">URL หนังสือ (Reader)</label>
            <input type="text" name="book_reader_url" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">หมวดหมู่</label>
            <select name="categories[]" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category['_id'] }}"
                        {{ request('category_id') == $category['_id'] ? 'selected' : '' }}>
                        {{ $category['cate_name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="{{ route('book') }}" class="btn btn-secondary">ยกเลิก</a>
    </form>
</div>
@endsection