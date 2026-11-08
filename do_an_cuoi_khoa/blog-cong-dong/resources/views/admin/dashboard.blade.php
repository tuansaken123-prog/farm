@extends('layouts.app')
@section('title', 'Bảng Quản Trị - Admin')
@section('content')

<h2 class="mb-4">Khu vực Quản trị Admin</h2>

<!-- 1. THỐNG KÊ TỔNG QUAN -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Tổng Thành Viên</h5>
                <p class="card-text display-6 fw-bold">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Tổng Bài Viết</h5>
                <p class="card-text display-6 fw-bold">{{ $totalPosts }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Tổng Bình Luận</h5>
                <p class="card-text display-6 fw-bold">{{ $totalComments }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-5">
    <!-- 2. TOP 5 BÀI VIẾT NHIỀU BÌNH LUẬN NHẤT -->
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-bold">
                5 bài viết nhiều bình luận nhất
            </div>
            <ul class="list-group list-group-flush">
                @forelse($topPosts as $topPost)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('posts.show', $topPost->slug) }}" class="text-decoration-none text-dark fw-bold">
                            {{ Str::limit($topPost->title, 50) }}
                        </a>
                        <span class="badge bg-primary rounded-pill">{{ $topPost->comments_count }} bình luận</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted text-center py-3">Chưa có bình luận nào.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- 3. QUẢN LÝ DANH MỤC -->
    <div class="col-md-5">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white fw-bold">
                Quản lý Danh mục
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" class="d-flex mb-3">
                    @csrf
                    <input type="text" name="name" class="form-control me-2" placeholder="Tên danh mục..." required>
                    <button type="submit" class="btn btn-sm btn-success text-nowrap">Thêm</button>
                </form>

                <ul class="list-group">
                    @foreach($categories as $cat)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span>{{ $cat->name }} <small class="text-muted">({{ $cat->posts_count }} bài)</small></span>
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Xóa danh mục này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2">Xóa</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- 4. QUẢN LÝ TẤT CẢ BÀI VIẾT (XÓA BÀI VI PHẠM) -->
<div class="card shadow-sm">
    <div class="card-header bg-danger text-white fw-bold">
        Danh sách tất cả bài viết (Xóa bài vi phạm)
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề bài viết</th>
                    <th>Tác giả</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $index => $post)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none fw-bold text-dark">
                                {{ Str::limit($post->title, 40) }}
                            </a>
                        </td>
                        <td>{{ $post->user->name ?? 'N/A' }}</td>
                        <td><span class="badge bg-secondary">{{ $post->category->name ?? 'N/A' }}</span></td>
                        <td>
                            <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'warning' }}">
                                {{ $post->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa bài viết vi phạm này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa vi phạm</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>

@endsection