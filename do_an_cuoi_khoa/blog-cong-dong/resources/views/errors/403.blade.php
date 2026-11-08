@extends('layouts.app')
@section('title', '403 Forbidden')
@section('content')
<div class="text-center py-5">
    <h1 class="display-1 text-danger fw-bold">403</h1>
    <h2>Truy cập bị từ chối!</h2>
    <p class="text-muted">Bạn không có quyền thực hiện hành động này.</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">Về trang chủ</a>
</div>
@endsection