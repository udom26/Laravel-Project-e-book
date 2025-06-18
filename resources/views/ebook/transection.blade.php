@extends('layout')

@section('title', 'ประวัติการยืมหนังสือ | E-Book System')

@section('content')
    <style>
        .table-theme {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(25, 118, 210, 0.08);
        }
        .table-theme th {
            background: linear-gradient(90deg, #1976d2 0%, #64b5f6 100%);
            color: #fff;
            font-weight: bold;
            border: none;
            font-size: 1.05em;
        }
        .table-theme td {
            border: none;
            vertical-align: middle;
            font-size: 1em;
        }
        .table-theme tr {
            border-bottom: 1.5px solid #e3f2fd;
            transition: background 0.2s;
        }
        .table-theme tr:hover {
            background: #e3f2fd;
        }
        .badge.bg-primary {
            background: #1976d2 !important;
        }
        .badge.bg-success {
            background: #43a047 !important;
        }
        .badge.bg-danger {
            background: #e53935 !important;
        }
        .btn-gradient {
            background: linear-gradient(90deg, #039be5 0%, #40c4ff 100%);
            color: #fff !important;
            border: none;
            border-radius: 50rem;
            padding: 0.3rem 1.1rem;
            font-weight: bold;
            font-size: 0.95em;
            box-shadow: 0 2px 8px rgba(2,136,209,0.10);
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn-gradient:hover {
            background: linear-gradient(90deg, #0288d1 0%, #039be5 100%);
            color: #fff !important;
            box-shadow: 0 4px 16px rgba(2,136,209,0.18);
        }
    </style>
    <div class="container py-4">
        <h2 class="mb-4" style="color:#1976d2;">ประวัติการยืมหนังสือ</h2>
        <div class="table-responsive">
            <table class="table table-theme align-middle">
                <thead>
                    <tr>
                        <th>ชื่อหนังสือ</th>
                        <th>วันที่ยืม</th>
                        <th>วันที่คืน</th>
                        <th>สถานะ</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions ?? [] as $tran)
                        <tr>
                            <td>{{ $tran->book_title ?? '-' }}</td>
                            <td>{{ $tran->borrow_date ?? '-' }}</td>
                            <td>{{ $tran->return_date ?? '-' }}</td>
                            <td>
                                @if(($tran->status ?? '') === 'reading')
                                    <span class="badge bg-primary">อ่าน</span>
                                @elseif(($tran->status ?? '') === 'returned')
                                    <span class="badge bg-success">คืนหนังสือ</span>
                                @elseif(($tran->status ?? '') === 'expired')
                                    <span class="badge bg-danger">หมดอายุ</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('book.detail', ['id' => $tran->book_id]) }}" class="btn btn-sm btn-gradient rounded-pill">ดูรายละเอียด</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">ไม่มีข้อมูลการยืมหนังสือ</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
@endsection