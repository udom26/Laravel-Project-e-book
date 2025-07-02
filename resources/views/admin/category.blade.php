@extends('admin.layout-admin')

@section('title', 'จัดการหมวดหมู่หนังสือ')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>จัดการหมวดหมู่หนังสือ</h3>
        <!-- ปุ่มเปิด modal เพิ่มหมวดหมู่ -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus"></i> เพิ่มหมวดหมู่
        </button>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อหมวดหมู่</th>
                        <th>URL : รูปภาพหมวดหมู่</th>
                        <th class="text-end">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category['cate_name'] }}</td>
                        <td>{{ $category['cate_cover_url'] ?? '' }}</td>
                       
                        <td class="text-end">
                            <!-- ปุ่มแก้ไข -->
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category['_id'] }}">
                                <i class="fas fa-edit"></i> แก้ไข
                            </button>
                            <!-- ปุ่มลบ -->
                            <form action="{{ route('category.destroy', $category['_id']) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('ยืนยันการลบหมวดหมู่นี้?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    <i class="fas fa-trash"></i> ลบ
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal แก้ไขหมวดหมู่ -->
                    <div class="modal fade" id="editCategoryModal{{ $category['_id'] }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category['_id'] }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <form method="POST" action="{{ route('category.update', $category['_id']) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCategoryModalLabel{{ $category['_id'] }}">แก้ไขหมวดหมู่</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="cate_name_edit_{{ $category['_id'] }}" class="form-label">ชื่อหมวดหมู่</label>
                                        <input type="text" class="form-control" id="cate_name_edit_{{ $category['_id'] }}" name="cate_name" value="{{ $category['cate_name'] }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cate_cover_url_edit_{{ $category['_id'] }}" class="form-label">URL รูปภาพหมวดหมู่</label>
                                        <input type="text" class="form-control" id="cate_cover_url_edit_{{ $category['_id'] }}" name="cate_cover_url" value="{{ $category['cate_cover_url'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">ไม่มีข้อมูลหมวดหมู่</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal เพิ่มหมวดหมู่ -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('category.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">เพิ่มหมวดหมู่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="cate_name" class="form-label">ชื่อหมวดหมู่</label>
                    <input type="text" class="form-control" id="cate_name" name="cate_name" required>
                </div>
                <div class="mb-3">
                    <label for="cate_cover_url" class="form-label">URL รูปภาพหมวดหมู่</label>
                    <input type="text" class="form-control" id="cate_cover_url" name="cate_cover_url" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </div>
    </form>
  </div>
</div>

@endsection