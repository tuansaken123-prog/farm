@extends('layouts.app')
@section('title', 'Trang Chủ - Blog Cộng Đồng')
@section('content')

<!-- 1. Thêm Banner Hero chào mừng ở đầu trang cho sinh động -->
<div class="p-5 mb-4 bg-light rounded-3 shadow-sm border">
    <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold text-dark">Chào mừng đến với MyBlog! 🚀</h1>
        <p class="col-md-8 fs-5 text-secondary">
            Nơi chia sẻ kiến thức lập trình, công nghệ 24h và các bài viết hữu ích từ cộng đồng developer.
        </p>
        @guest
        <div class="mt-3">
            <a href="{{ route('login') }}" class="btn btn-dark btn-lg me-2">Đăng nhập</a>
            <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg">Đăng ký ngay</a>
        </div>
        @endguest
    </div>
</div>

<div class="container mb-5">
    <h3 class="mb-4 text-dark border-bottom pb-2">🔥 Bài viết mới nhất</h3>

    <!-- Form tìm kiếm và lọc -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('posts.index') }}" method="GET" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm bài viết..."
                    value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit">Tìm</button>
            </form>
        </div>
    </div>

    <!-- Danh sách bài viết -->
    <div class="row">
        @forelse($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <!-- Xử lý hiển thị ảnh: Hỗ trợ cả link online từ seeder và ảnh upload nội bộ -->
                @if($post->image)
                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}"
                    class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                @else
                <!-- Ảnh mặc định sang trọng thay vì chữ (Không có ảnh) -->
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                    style="height: 200px;">
                    <i class="fa-solid fa-image fa-3x opacity-50"></i>
                </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <div class="mb-2">
                        <span class="badge bg-dark text-white">{{ $post->category->name ?? 'Chưa phân loại' }}</span>
                    </div>
                    <h5 class="card-title fw-bold">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none text-dark">
                            {{ $post->title }}
                        </a>
                    </h5>
                    <p class="card-text text-muted small mb-3">Tác giả: {{ $post->user->name ?? 'Admin' }}</p>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <small
                            class="text-muted">{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i') : $post->created_at->format('d/m/Y H:i') }}</small>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-dark">Xem chi
                            tiết</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted fs-5">Không tìm thấy bài viết nào phù hợp.</p>
        </div>
        @endforelse
    </div>

    <!-- Phân trang căn giữa hoàn hảo -->
    <div class="d-flex justify-content-center mt-4 mb-5">
        <style>
        .pagination {
            margin-bottom: 0;
        }

        nav[role="navigation"] {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        nav[role="navigation"]>div:first-child {
            display: none;
            /* Ẩn dòng chữ "Showing 1 to 6..." cho giao diện gọn gàng */
        }

        nav[role="navigation"]>div:last-child {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        </style>

        {{ $posts->withQueryString()->links() }}
    </div>
</div>
@endsection