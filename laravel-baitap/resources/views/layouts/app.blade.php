<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Laravel')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('posts.index') }}">My Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-dark navbar-nav ms-auto align-items-center">
                    @auth
                    <!-- Đã đăng nhập: Hiện tên người dùng & nút Đăng xuất -->
                    <li class="nav-item me-3 text-white">
                        Xin chào, <strong class="text-info">{{ Auth::user()->name }}</strong>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light">Đăng xuất</button>
                        </form>
                    </li>
                    @else
                    <!-- Chưa đăng nhập: Hiện nút Đăng nhập & Đăng ký -->
                    <li class="nav-item me-2">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Đăng ký</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nội dung chính của các trang -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>