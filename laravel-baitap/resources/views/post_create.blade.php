@extends('layouts.app')

@section('title', 'Thêm Bài Viết Mới')

@section('content')
<div class="container my-4" style="max-width: 600px;">
    <h2>Thêm Bài Viết Mới</h2>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Tiêu đề bài viết (Tối đa 50 ký tự)</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}" placeholder="Nhập tiêu đề...">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Ô CHỌN HÌNH ẢNH MỚI BỔ SUNG -->
        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Hình ảnh (jpg, png, webp)</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label fw-bold">Nội dung bài viết</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="4"
                placeholder="Nhập nội dung...">{{ old('content') }}</textarea>
            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">+ Tạo Bài Viết</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection