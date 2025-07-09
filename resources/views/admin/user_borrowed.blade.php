{{-- filepath: resources/views/admin/user_borrowed.blade.php --}}
@extends('admin.layout-admin')

@section('title', 'ประวัติการยืมของ {{ $user["name"] ?? "-" }}')

@section('content')
<div class="container">
    <h3 class="mb-3">ประวัติการยืมของ {{ $user['name'] ?? '-' }}</h3>
    <a href="{{ route('user') }}" class="btn btn-secondary mb-3">ย้อนกลับ</a>
    <div class="card">
        <div class="card-body p-0">
            @if(empty($borrowedBooks))
                <div class="alert alert-warning">ไม่พบประวัติการยืม</div>
            @else
                <table>
                    <tbody>
                        @foreach($borrowedBooks as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['book_name'] ?? $item['bookId']['$oid'] ?? '-' }}</td>
                                <td>{{ isset($item['startTime']) ? \Carbon\Carbon::parse($item['startTime'])->format('d/m/Y H:i') : '-' }}</td>
                                <td>{{ isset($item['expiresAt']) ? \Carbon\Carbon::parse($item['expiresAt'])->format('d/m/Y H:i') : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection