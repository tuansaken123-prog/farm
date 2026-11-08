@extends('layouts.app')
@section('title', 'Bài Viết Của Tôi')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Bài viết của tôi</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Đăng bài mới</a>
</div>

<div class="table-responsive bg-white rounded shadow-sm">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Thời gian xuất bản</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->slug) }}" class="fw-bold text-dark text-decoration-none">
                            {{ $post->title }}
                        </a>
                    </td>
                    <td><span class="badge bg-secondary">{{ $post->category->name ?? 'N/A' }}</span></td>
                    <td>
                        @php
                            // Kiểm tra nếu là hẹn giờ nhưng đã qua thời gian thì hiển thị như đã xuất bản
                            $isPassedSchedule = ($post->status === 'scheduled' && $post->published_at && \Carbon\Carbon::parse($post->published_at)->isPast());
                        @endphp

                        @if($post->status === 'published' || $isPassedSchedule)
                            <span class="badge bg-success">Đã xuất bản</span>
                        @elseif($post->status === 'draft')
                            <span class="badge bg-secondary">Bản nháp</span>
                        @else
                            <span class="badge bg-warning text-dark">Hẹn giờ đăng</span>
                        @endif
                    </td>
                    <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i') : 'Chưa đặt' }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Bạn chưa tạo bài viết nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>

@endsection