{{-- filepath: c:\xampp\htdocs\ebook\resources\views\admin\user.blade.php --}}
@extends('admin.layout-admin')

@section('title', 'จัดการผู้ใช้')

@section('content')
<div class="container">
    <h3 class="mb-3">จัดการผู้ใช้</h3>
    <div class="card">
        <div class="card-body p-0">
            @if(empty($users))
                <div class="alert alert-danger">ไม่พบข้อมูลผู้ใช้</div>
            @else
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>อีเมล</th>
                            <th>บทบาท</th>
                            <th class="text-end">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $i => $user)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $user['name'] ?? '-' }}</td>
                                <td>{{ $user['email'] ?? '-' }}</td>
                                <td>
                                    {{ is_array($user['roles'] ?? null) ? implode(',', $user['roles']) : ($user['role'] ?? '-') }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('user.edit', $user['id'] ?? $user['_id']) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                                    <form action="{{ route('user.destroy', $user['id'] ?? $user['_id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('ยืนยันการลบ?')">ลบ</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">ไม่พบข้อมูลผู้ใช้</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection