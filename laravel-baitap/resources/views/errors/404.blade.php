@extends('layouts.app')

@section('title', '404 - Trang Không Tồn Tại')

@section('content')
<div class="container text-center my-5">
    <h1 class="display-1 fw-bold text-danger">404</h1>
    <h3 class="mb-3">NguyenTuan Error: Not Found</h3>
    <p class="text-muted">Trang bạn đang truy cập không tồn tại hoặc đã bị xóa.</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-2">Quay lại Trang Chủ</a>
</div>
@endsection