@extends('admin.layout-admin')

@section('title', 'ประวัติการยืม-คืนหนังสือ')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>ประวัติการยืม-คืนหนังสือ</h3>
        <a href="#" class="btn btn-primary">
            <i class="fas fa-plus"></i> เพิ่มรายการ
        </a>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <!-- ปุ่มเลือกวัน -->
            <div class="d-flex justify-content-center align-items-center py-3">
                <label for="dateFilter" class="me-2 mb-0 fw-bold">เลือกวันที่ยืม:</label>
                <input type="date" id="dateFilter" class="form-control w-auto">
            </div>
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>ชื่อหนังสือ</th>
                        <th>วันที่ยืม</th>
                        <th>วันที่คืน</th>
                        <th>สถานะ</th>
                        <th class="text-end">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>user01</td>
                        <td>Harry Potter</td>
                        <td>01/06/2025</td>
                        <td>10/06/2025</td>
                        <td><span class="badge bg-success">คืนแล้ว</span></td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> ดู</a>
                            <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> แก้ไข</a>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> ลบ</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>user02</td>
                        <td>One Piece</td>
                        <td>05/06/2025</td>
                        <td>-</td>
                        <td><span class="badge bg-warning text-dark">ยังไม่คืน</span></td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> ดู</a>
                            <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> แก้ไข</a>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> ลบ</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection