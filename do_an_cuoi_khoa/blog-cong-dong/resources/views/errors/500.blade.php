@extends('layouts.app')
@section('title', '500 Server Error')
@section('content')
<div class="text-center py-5">
    <h1 class="display-1 text-secondary fw-bold">500</h1>
    <h2>Lỗi máy chủ!</h2>
    <p class="text-muted">Đã xảy ra sự cố hệ thống. Vui lòng thử lại sau.</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">Về trang chủ</a>
</div>
@endsection