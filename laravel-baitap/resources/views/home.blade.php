@extends('layouts.app')

@section('title', 'Trang Chủ - Learn2Earn')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <h3 class="fw-bold mb-4 pb-2 border-bottom border-primary text-uppercase">Bài Viết Mới Nhất</h3>

        {{-- Kiểm tra xem có bài viết nào không bằng @if --}}
        @if(count($posts) > 0)
        <div class="row">
            {{-- Lặp danh sách bài viết bằng @foreach --}}
            @foreach($posts as $post)
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                    <img src="https://picsum.photos/400/220?random={{ $post->id }}" class="card-img-top" alt="Thumb">
                    <div class="card-body">
                        <span class="badge bg-danger mb-2">Tin tức</span>
                        <h5 class="card-title fw-bold text-dark fs-6">{{ $post->title }}</h5>
                        <p class="card-text text-muted small">
                            {{ \Illuminate\Support\Str::limit($post->content, 90) }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                        <small class="text-muted">Tác giả ID: {{ $post->user_id }}</small>
                        <a href="/posts/{{ $post->id }}" class="btn btn-outline-primary btn-sm rounded-pill">Đọc tiếp
                            &rarr;</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-warning text-center">
            Hiện tại chưa có bài viết nào trong cơ sở dữ liệu!
        </div>
        @endif
    </div>

    <!-- Cột phải: Sidebar Đơn Giản (4 Cột) -->
    <div class="col-lg-4">
        <!-- Widget Giới thiệu -->
        <div class="card border-0 shadow-sm p-4 text-center mb-4 rounded-3">
            <img src="https://picsum.photos/100/100" class="rounded-circle mx-auto mb-3" alt="Author">
            <h5 class="fw-bold">Nguyễn Tuấn</h5>
            <p class="text-muted small">Blogger & Web Developer. Yêu thích chia sẻ kiến thức về Laravel và lập trình
                Web.</p>
        </div>

        <!-- Widget Chuyên mục -->
        <div class="card border-0 shadow-sm p-3 mb-4 rounded-3">
            <h6 class="fw-bold border-bottom pb-2 mb-3">Chuyên Mục</h6>
            <ul class="list-group list-group-flush small">
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                    Lập trình Laravel <span class="badge bg-primary rounded-pill">12</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                    Công nghệ mới <span class="badge bg-primary rounded-pill">8</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                    Cuộc sống & Góc nhìn <span class="badge bg-primary rounded-pill">5</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection