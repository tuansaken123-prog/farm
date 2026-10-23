<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Hiển thị bài viết</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>Dữ liệu vừa nhập hợp lệ:</h2>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Title:</strong> {{ $data['title'] }}</h3>
                    </div>
                    <div class="panel-body">
                        <p><strong>Slug:</strong> {{ $data['slug'] }}</p>
                        <hr>
                        <p><strong>Content:</strong></p>
                        <p>{{ $data['content'] }}</p>
                    </div>
                </div>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Tạo bài viết mới</a>
            </div>
        </div>
    </div>
</body>

</html>