<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết bài viết #{{ $post->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">
    <div class="container">
        <h2>{{ $post->title }}</h2>
        <p class="text-muted">Slug: {{ $post->slug }} | Tac gia (user_id): {{ $post->user_id }}</p>
        <hr>
        <p>{{ $post->content }}</p>
    </div>
</body>

</html>