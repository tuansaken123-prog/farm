@extends('layouts.app')

@section('title', 'Danh Sách Bài Viết')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh Sách Bài Viết</h2>
        @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">+ Thêm Bài Viết</a>
        @endauth
    </div>

    @if(session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 50px;" class="text-center">ID</th>
                <th style="width: 100px;" class="text-center">Ảnh</th>
                <th>Tiêu đề</th>
                <th>Người tạo</th>
                <th style="width: 150px;">Ngày tạo</th>
                <th style="width: 150px;">Deleted At</th>
                <th style="width: 160px;" class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr id="post-row-{{ $post->id }}">
                <td class="text-center fw-bold">{{ $post->id }}</td>

                <!-- Hiển thị hình ảnh bài viết -->
                <td class="text-center">
                    @if($post->file_path)
                    <img src="{{ asset('storage/' . $post->file_path) }}" alt="Ảnh bài viết"
                        style="width: 70px; height: 50px; object-fit: cover;" class="rounded border">
                    @else
                    <span class="text-muted small">Không có</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none fw-bold text-dark">
                        {{ $post->title }}
                    </a>
                </td>

                <td>
                    <span class="badge bg-info text-dark">
                        {{ $post->user->name ?? 'User ' . $post->user_id }}
                    </span>
                </td>

                <td>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->format('d/m/Y H:i') : '' }}</td>

                <td class="deleted-at-col {{ $post->trashed() ? 'text-danger fw-bold' : 'text-muted' }}">
                    {{ $post->deleted_at ? \Carbon\Carbon::parse($post->deleted_at)->format('d/m/Y H:i') : 'Chưa xóa' }}
                </td>

                <!-- Cột Hành động: Kiểm tra quyền sở hữu bằng Gate / Policy -->
                <td class="text-center">
                    @can('manage-post', $post)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline form-delete"
                        data-id="{{ $post->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-sm {{ $post->trashed() ? 'btn-danger' : 'btn-outline-danger' }}">
                            {{ $post->trashed() ? 'Xóa hẳn' : 'Xóa' }}
                        </button>
                    </form>
                    @else
                    <span class="text-muted small">Không có quyền</span>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted">Chưa có bài viết nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- JavaScript gửi request Xóa bằng AJAX không reload trang -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.form-delete').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Chặn hành vi reload lại trang

            const actionUrl = this.action;
            const postId = this.getAttribute('data-id');
            const row = document.getElementById(`post-row-${postId}`);
            const formData = new FormData(this);

            fetch(actionUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Bạn không có quyền thực hiện thao tác này!');
                    }
                    return response.json();
                })
                .then(data => {
                    if (row) {
                        row.style.transition = 'all 0.4s ease';
                        row.style.opacity = '0';
                        setTimeout(() => row.remove(), 400);
                    }
                })
                .catch(error => alert(error.message));
        });
    });
});
</script>
@endsection