{{-- filepath: resources/views/ebook/search.blade.php --}}
@extends('layout')

@section('title', 'ค้นหาหนังสือ | E-Book System')

@section('content')
<div class="container py-5">
    <h2 class="text-center section-title mb-4">ค้นหาหนังสือที่ต้องการยืม</h2>
    <form method="GET" action="{{ route('book.search') }}" class="mb-4">
        <div class="row justify-content-center align-items-end g-2">
            <div class="col-md-4 mb-2">
                <input type="text" name="q" class="form-control rounded-pill shadow-sm" placeholder="ค้นหาด้วยชื่อหนังสือหรือผู้แต่ง..." value="{{ request('q') }}">
            </div>
            <div class="col-md-2 mb-2">
                <button type="submit"
                    class="btn w-100 rounded-pill shadow-sm"
                    style="background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%); color: #fff; border: none;">
                    <i class="fas fa-search me-1"></i> ค้นหา
                </button>
            </div>
        </div>
    </form>
    <div class="row mt-4">
        @if(!request('q') && !request('category_id'))
            <div class="col-12 text-center text-secondary py-5">
                <i class="fas fa-search fa-2x mb-3"></i>
                <div>กรุณาค้นหาหนังสือที่ต้องการยืมก่อน</div>
            </div>
        @else
            @forelse($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card book-card h-100 shadow-sm border-0">
                        <div class="book-cover text-center pt-3">
                            <img src="{{ $book['book_cover_image_url'] ?? 'https://via.placeholder.com/100x150?text=No+Cover' }}" alt="cover" style="width:100px;height:150px;object-fit:cover;border-radius:8px;">
                        </div>
                        <div class="card-body book-info">
                            <h5 class="book-title mb-1">{{ $book['book_name'] }}</h5>
                            <p class="book-author mb-1 text-muted small">โดย {{ $book['book_author'] }}</p>
                            <p class="text-muted small mb-2">{{ \Illuminate\Support\Str::limit($book['book_description'], 60) }}</p>
                            <a href="{{ route('book.detail', $book['_id']) }}"
                               class="btn btn-sm rounded-pill w-100"
                               style="background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%); color: #fff; border: none; font-weight: 500;">
                                ดูรายละเอียด/ยืมหนังสือ
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-danger py-5">
                    <i class="fas fa-exclamation-circle fa-2x mb-3"></i>
                    <div>ไม่พบหนังสือตามเงื่อนไขที่ค้นหา</div>
                </div>
            @endforelse
        @endif
    </div>
    {{-- ปุ่มเปลี่ยนหน้า --}}
    @if(isset($meta) && $meta['totalpage'] > 1)
        <div class="d-flex justify-content-center align-items-center my-3">
            {{-- ปุ่มก่อนหน้า --}}
            @if($meta['currentpage'] > 1)
                <a href="{{ request()->fullUrlWithQuery(['page' => $meta['currentpage'] - 1]) }}"
                   class="btn btn-outline-primary rounded-pill me-2"
                   style="min-width: 100px;">
                    &laquo; ก่อนหน้า
                </a>
            @endif

            {{-- ลูปเลขหน้า --}}
            @for($i = 1; $i <= $meta['totalpage']; $i++)
                <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                   class="btn btn-sm mx-1 rounded-pill {{ $meta['currentpage'] == $i ? 'btn-primary text-white' : 'btn-outline-primary' }}"
                   style="min-width: 38px;">
                    {{ $i }}
                </a>
            @endfor

            {{-- ปุ่มถัดไป --}}
            @if($meta['currentpage'] < $meta['totalpage'])
                <a href="{{ request()->fullUrlWithQuery(['page' => $meta['currentpage'] + 1]) }}"
                   class="btn btn-outline-primary rounded-pill ms-2"
                   style="min-width: 100px;">
                    ถัดไป &raquo;
                </a>
            @endif
        </div>
    @endif
</div>
@endsection