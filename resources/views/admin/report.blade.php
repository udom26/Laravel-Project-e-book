@extends('admin.layout-admin')

@section('title', 'รายงานสถิติการยืม-คืนหนังสือ')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>รายงานสถิติการยืม-คืนหนังสือ</h3>
        <a href="#" class="btn btn-success">
            <i class="fas fa-file-export"></i> ส่งออกรายงาน
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3">สรุปยอดรวม</h5>
            <div class="row text-center">
                <div class="col-md-3 mb-3">
                    <div class="border rounded py-3 bg-light">
                        <div class="fs-4 fw-bold">20</div>
                        <div>จำนวนการยืมทั้งหมด</div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="border rounded py-3 bg-light">
                        <div class="fs-4 fw-bold">5</div>
                        <div>จำนวนที่ยังไม่คืน</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <h5 class="p-3">รายการหนังสือที่ถูกยืมมากที่สุด</h5>
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อหนังสือ</th>
                        <th>หมวดหมู่</th>
                        <th>จำนวนครั้งที่ถูกยืม</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Harry Potter</td>
                        <td>นิยาย</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>One Piece</td>
                        <td>การ์ตูน</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>ฟิสิกส์เบื้องต้น</td>
                        <td>วิทยาศาสตร์</td>
                        <td>6</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection