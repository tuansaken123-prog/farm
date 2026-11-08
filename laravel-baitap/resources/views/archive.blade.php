@extends('layouts.app')

@section('title', 'Archive - Learn2Earn')

@section('content')
<div class="bg-dark text-white text-center py-5 mb-5 rounded-3"
    style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://picsum.photos/1200/350?random=10') center/cover;">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Archive Page</h1>
        <p class="lead">Home - Archive</p>
    </div>
</div>

<div class="row">
    @foreach($posts as $post)
    <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow-sm">
            <img src="https://picsum.photos/400/220?random={{ $post->id }}" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($post->content, 70) }}</p>
                <a href="/posts/{{ $post->id }}" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection