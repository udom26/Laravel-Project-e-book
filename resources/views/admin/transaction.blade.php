@extends('admin.layout-admin')

@section('title', 'ประวัติการยืม-คืนหนังสือ')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>ประวัติการยืม-คืนหนังสือ</h3>
        
    </div>
    <div class="card">
        <div class="card-body p-0">
            <!-- ปุ่มเลือกวัน -->
            <form method="GET" action="{{ route('transaction') }}" class="d-flex justify-content-center align-items-center py-3">
                <label for="dateFilter" class="me-2 mb-0 fw-bold">เลือกวันที่ยืม:</label>
                <input type="date" id="dateFilter" name="date" class="form-control w-auto" value="{{ request('date') }}">
                <button type="submit" class="btn btn-secondary ms-2">ค้นหา</button>
            </form>
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>ชื่อหนังสือ</th>
                        <th>วันที่ยืม</th>
                        <th>วันที่คืน</th>
                        <th>สถานะ</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $i => $transaction)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $transaction['userId']['name'] ?? '-' }}</td>
                            <td>{{ $transaction['bookId']['book_name'] ?? '-' }}</td>
                            <td>
                                @if(isset($transaction['startTime']))
                                    {{ \Carbon\Carbon::parse($transaction['startTime'])->setTimezone('Asia/Bangkok')->format('d/m/Y H:i:s') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                 @if(isset($transaction['expiresAt']))
                                    {{ \Carbon\Carbon::parse($transaction['expiresAt'])->setTimezone('Asia/Bangkok')->format('d/m/Y H:i:s') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if(isset($transaction['isActive']) && $transaction['isActive'] === false)
                                    <span class="badge bg-success">คืนแล้ว</span>
                                @else
                                    <span class="badge bg-warning text-dark">ยังไม่คืน</span>
                                @endif
                            </td>
            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">ไม่มีประวัติการยืม</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection