<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo bài viết</title>
    <!-- Bootstrap 3 & jQuery -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <style>
    .require {
        color: #c00;
    }
    </style>
</head>

<body>

    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Create post</h1>

                {{-- Dòng quan trọng: Hiển thị thông báo khi thiếu trường --}}
                @if (session('error'))
                <h3 style="color: red; font-weight: bold;">{{ session('error') }}</h3>
                @endif

                <form action="{{ route('posts.store', ['token' => request('token'), 'role' => request('role')]) }}"
                    method="POST">
                    @csrf

                    {{-- Slug --}}
                    <div class="form-group">
                        <label for="slug">Slug <span class="require">*</span> <small>(This field use in url
                                path.)</small></label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" />
                    </div>

                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title">Title <span class="require">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" />
                    </div>

                    {{-- Content --}}
                    <div class="form-group">
                        <label for="content">Description <span class="require">*</span></label>
                        <textarea rows="5" class="form-control" name="content">{{ old('content') }}</textarea>
                    </div>

                    <div class="form-group">
                        <p><span class="require">*</span> - required fields</p>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('posts.create', ['token' => request('token'), 'role' => request('role')]) }}"
                            class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>