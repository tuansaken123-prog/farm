@extends('layouts.app')
@section('title', 'Chỉnh Sửa Bài Viết')
@section('content')

<div class="container" style="max-width: 700px;">
    <h3 class="mb-4 fw-bold"><i class="fa-solid fa-pen-to-square text-warning me-2"></i>Chỉnh Sửa Bài Viết</h3>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Danh mục</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Ảnh đại diện (Để trống nếu không đổi)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @if($post->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $post->image) }}" style="height: 80px; object-fit: cover;" class="rounded border">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nội dung bài viết</label>
            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="6" required>{{ old('content', $post->content) }}</textarea>
            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- TRẠNG THÁI BÀI VIẾT -->
        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái</label>
            <select name="status" id="statusSelect" class="form-select" onchange="toggleScheduledInput()">
                <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Xuất bản ngay</option>
                <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                <option value="scheduled" {{ old('status', $post->status) == 'scheduled' ? 'selected' : '' }}>Hẹn giờ đăng</option>
            </select>
        </div>

        <!-- Ô CHỌN THỜI GIAN ĐĂNG BÀI -->
        <div class="mb-3" id="scheduledInputGroup" style="display: none;">
            <label class="form-label fw-bold text-primary"><i class="fa-regular fa-clock me-1"></i>Thời gian đăng bài</label>
            <input type="datetime-local" 
                name="published_at" 
                class="form-control @error('published_at') is-invalid @enderror" 
                value="{{ old('published_at', $post->published_at ? date('Y-m-d\TH:i', strtotime($post->published_at)) : now()->format('Y-m-d\TH:i')) }}">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning"><i class="fa-solid fa-floppy-disk me-1"></i> Lưu thay đổi</button>
            <a href="{{ route('posts.myPosts') }}" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<script>
    function toggleScheduledInput() {
        const status = document.getElementById('statusSelect').value;
        const group = document.getElementById('scheduledInputGroup');
        group.style.display = (status === 'scheduled') ? 'block' : 'none';
    }
    document.addEventListener('DOMContentLoaded', toggleScheduledInput);
</script>

@endsection