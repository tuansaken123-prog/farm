@extends('layouts.app')
@section('title', $post->title)
@section('content')

<div class="container" style="max-width: 800px;">
    <span class="badge bg-secondary mb-2">{{ $post->category->name ?? 'Chưa phân loại' }}</span>
    <h1 class="mb-3">{{ $post->title }}</h1>
    <p class="text-muted small">Tác giả: <strong>{{ $post->user->name ?? 'Ẩn danh' }}</strong> | Ngày đăng: {{ $post->created_at->format('d/m/Y H:i') }}</p>

    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $post->title }}">
    @endif

    <div class="content mb-5" style="font-size: 1.1rem; line-height: 1.8;">
        {!! nl2br(e($post->content)) !!}
    </div>

    <hr>

    <!-- Khối Bình luận -->
    <h4 class="mb-4">Bình luận ({{ $post->comments->count() }})</h4>

    @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="3" placeholder="Viết bình luận của bạn..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Gửi bình luận</button>
        </form>
    @else
        <div class="alert alert-light border mb-4">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.</div>
    @endauth

    <div class="list-group">
        @forelse($post->comments as $comment)
            <div class="list-group-item mb-2 rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-1 fw-bold">{{ $comment->user->name ?? 'Ẩn danh' }}</h6>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $comment->content }}</p>

                <!-- Nút xóa bình luận dành cho chủ nhân bình luận, admin hoặc chủ bài viết -->
                @auth
                    @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin' || auth()->id() === $post->user_id)
                        <div class="text-end mt-2">
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @empty
            <p class="text-muted small">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
        @endforelse
    </div>
</div>

@endsection