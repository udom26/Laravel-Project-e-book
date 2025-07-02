@extends('admin.layout-admin')

@section('title', 'จัดการหนังสือ')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>จัดการหนังสือ</h3>
        <a id="addBookBtn" href="{{ route('book.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> เพิ่มหนังสือ
        </a>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <!-- ปุ่มเลือกหมวดหมู่ (ถ้าต้องการ filter) -->
            <div class="d-flex justify-content-center align-items-center py-3 flex-column">
                <label for="categoryFilter" class="mb-2 fw-bold text-center">เลือกหมวดหมู่:</label>
                <select id="categoryFilter" name="category_id" class="form-select w-auto">
                    <option value="">แสดงทุกหมวดหมู่</option>
                    @foreach($categories as $category)
                        <option value="{{ $category['_id'] }}" {{ request('category_id') == $category['_id'] ? 'selected' : '' }}>
                            {{ $category['cate_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อหนังสือ</th>
                        <th>ผู้แต่ง</th>
                        <th>รายละเอียด</th>
                        <th>รูปหน้าปก</th>
                        <th>URL:หนังสือ</th>
                        <th>หมวดหมู่</th>
                        <th class="text-end">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $book['book_name'] ?? '-' }}</td>
                            <td>{{ $book['book_author'] ?? '-' }}</td>
                            <td>{{ $book['book_description'] ?? '-' }}</td>
                            <td>
                                @if(!empty($book['book_cover_image_url']))
                                    <img src="{{ $book['book_cover_image_url'] }}" alt="cover" width="50">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if(!empty($book['book_reader_url']))
                                    <a href="{{ $book['book_reader_url'] }}" target="_blank">อ่าน</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if(isset($book['categories']) && is_array($book['categories']))
                                    @foreach($book['categories'] as $cate)
                                        <span class="badge bg-secondary">{{ $cate['cate_name'] ?? '-' }}</span>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('book.show', $book['_id']) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> ดู
                                </a>
                                <a href="{{ route('book.edit', $book['_id']) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>
                                <form action="{{ route('book.destroy', $book['_id']) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('ยืนยันการลบหนังสือนี้?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">ไม่พบหนังสือ</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if(isset($meta) && $meta['totalpage'] > 1)
                <div class="d-flex justify-content-center align-items-center my-3">
                    {{-- ปุ่มก่อนหน้า --}}
                    @if($meta['currentpage'] > 1)
                        <a href="{{ request()->fullUrlWithQuery(['page' => $meta['currentpage'] - 1]) }}"
                           class="btn btn-outline-primary me-2">
                            &laquo; ก่อนหน้า
                        </a>
                    @endif

                    {{-- ลูปเลขหน้า --}}
                    @for($i = 1; $i <= $meta['totalpage']; $i++)
                        <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                           class="btn btn-sm mx-1 {{ $meta['currentpage'] == $i ? 'btn-primary text-white' : 'btn-outline-primary' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    {{-- ปุ่มถัดไป --}}
                    @if($meta['currentpage'] < $meta['totalpage'])
                        <a href="{{ request()->fullUrlWithQuery(['page' => $meta['currentpage'] + 1]) }}"
                           class="btn btn-outline-primary ms-2">
                            ถัดไป &raquo;
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryFilter = document.getElementById('categoryFilter');
    categoryFilter.addEventListener('change', function () {
        let cateId = this.value;
        let url = "{{ route('book') }}";
        if (cateId) {
            window.location.href = url + '?category_id=' + cateId;
        } else {
            window.location.href = url;
        }
    });
});
</script>
@endsection