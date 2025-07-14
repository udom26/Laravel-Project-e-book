@extends('layout')

@section('title', 'ยืมหนังสือสำเร็จ')

@section('content')
<div class="container py-5 text-center">
    <h2 class="text-success mb-4">ยืมหนังสือสำเร็จ!</h2>
    <p>คุณสามารถดูหนังสือที่ยืมได้ที่ <a href="{{ route('mybook') }}">หนังสือของฉัน</a></p>
    <a href="{{ route('home') }}" 
       class="btn mt-3"
       style="background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%); color: #fff; border: none; font-weight: bold;">
        กลับหน้าหลัก
    </a>
</div>
@endsection