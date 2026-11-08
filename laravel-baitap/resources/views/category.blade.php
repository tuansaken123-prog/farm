@extends('layouts.app')

@section('title', 'Category - Learn2Earn')

@section('content')
<div class="bg-dark text-white text-center py-5 mb-5 rounded-3"
    style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://picsum.photos/1200/350?random=20') center/cover;">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Post Category</h1>
        <p class="lead">Home - Category</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <h4 class="fw-bold mb-4">Chuyên mục: Lập trình & Công nghệ</h4>
        @foreach($posts as $post)
        <div class="card mb-3 border-0 shadow-sm">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <img src="https://picsum.photos/300/200?random={{ $post->id }}" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                        <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($post->content, 90) }}
                        </p>
                        <a href="/posts/{{ $post->id }}" class="btn btn-primary btn-sm">Đọc bài viết</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection