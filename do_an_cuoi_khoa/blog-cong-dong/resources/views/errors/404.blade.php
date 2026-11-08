@extends('layouts.app')
@section('title', '404 Not Found')
@section('content')
<div class="text-center py-5">
    <h1 class="display-1 text-warning fw-bold">404</h1>
    <h2>Không tìm thấy trang!</h2>
    <p class="text-muted">Bài viết hoặc đường dẫn bạn tìm kiếm không tồn tại.</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">Về trang chủ</a>
</div>
@endsection