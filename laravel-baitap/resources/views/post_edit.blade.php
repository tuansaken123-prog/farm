@extends('layouts.app')

@section('title', 'Cập Nhật Bài Viết')

@section('content')
<div class="container my-4" style="max-width: 600px;">
    <h2>Cập Nhật Bài Viết #{{ $post->id }}</h2>

    <!-- ROUTE PHẢI LÀ posts.update VÀ CÓ ENCTYPE -->
    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- BẮT BUỘC PHẢI CÓ DÒNG NÀY ĐỂ LARAVEL HIỂU LÀ SỬA -->

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Tiêu đề (Tối đa 50 ký tự)</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $post->title) }}">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Hình ảnh (jpg, png, webp)</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            @if($post->file_path)
            <div class="mt-2">
                <small class="text-muted d-block">Ảnh hiện tại:</small>
                <img src="{{ asset('storage/' . $post->file_path) }}" alt="Ảnh hiện tại"
                    style="width: 80px; height: 60px; object-fit: cover;" class="rounded border mt-1">
            </div>
            @endif
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label fw-bold">Nội dung bài viết</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror"
                rows="4">{{ old('content', $post->content) }}</textarea>
            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu bài viết</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection