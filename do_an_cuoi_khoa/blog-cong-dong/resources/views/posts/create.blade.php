@extends('layouts.app')
@section('title', 'Tạo Bài Viết Mới')
@section('content')

<div class="container" style="max-width: 700px;">
    <h3 class="mb-4 fw-bold"><i class="fa-solid fa-pen-to-square text-primary me-2"></i>Tạo Bài Viết Mới</h3>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Nhập tiêu đề bài viết..." required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Danh mục</label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Ảnh đại diện</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nội dung bài viết</label>
            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="6" placeholder="Nhập nội dung bài viết..." required>{{ old('content') }}</textarea>
            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- THẺ CHỌN TRẠNG THÁI -->
        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái</label>
            <select name="status" id="statusSelect" class="form-select" onchange="toggleScheduledInput()">
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Xuất bản ngay</option>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Hẹn giờ đăng</option>
            </select>
        </div>

        <!-- Ô CHỌN NGÀY GIỜ (TỰ ĐỘNG LẤY GIỜ HIỆN TẠI) -->
        <div class="mb-3" id="scheduledInputGroup" style="display: none;">
            <label class="form-label fw-bold text-primary"><i class="fa-regular fa-clock me-1"></i>Thời gian đăng bài</label>
            <input type="datetime-local" 
                   name="published_at" 
                   class="form-control @error('published_at') is-invalid @enderror" 
                   value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
            @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane me-1"></i> Đăng bài</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<script>
    function toggleScheduledInput() {
        const status = document.getElementById('statusSelect').value;
        const group = document.getElementById('scheduledInputGroup');
        group.style.display = (status === 'scheduled') ? 'block' : 'none';
    }

    // Chạy ngay khi load trang để giữ trạng thái nếu vừa submit lỗi
    document.addEventListener('DOMContentLoaded', function() {
        toggleScheduledInput();
    });
</script>

@endsection