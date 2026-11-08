<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Cộng Đồng')</title>
    <!-- Bootstrap 5 CSS & FontAwesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    html {
        overflow-y: scroll;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-color: #f8f9fa;
    }

    .main-content {
        flex: 1;
    }

    .footer {
        background-color: #212529;
        color: #adb5bd;
    }

    .footer a {
        color: #adb5bd;
        text-decoration: none;
        transition: color 0.2s;
    }

    .footer a:hover {
        color: #fff;
    }

    .custom-nav .nav-link {
        transition: transform 0.2s ease, color 0.2s ease;
        color: rgba(255, 255, 255, 0.75) !important;
    }

    .custom-nav .nav-link:hover {
        transform: scale(1.08);
        color: #fff !important;
    }

    .custom-nav .nav-link.active-page {
        color: #ffc107 !important;
        font-weight: bold;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <!-- 1. Logo bên trái -->
            <a class="navbar-brand fw-bold text-warning" href="{{ url('/') }}">
                <i class="fa-solid fa-blog"></i> MyBlog
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- 2. Menu chính ở GIỮA -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.index') ? 'active fw-bold text-warning' : '' }}"
                            href="{{ route('posts.index') }}">Trang chủ</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.myPosts') ? 'active fw-bold text-warning' : '' }}"
                            href="{{ route('posts.myPosts') }}">Bài viết của tôi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.create') ? 'active fw-bold text-warning' : '' }}"
                            href="{{ route('posts.create') }}">Đăng bài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.trash') ? 'active fw-bold text-warning' : '' }}"
                            href="{{ route('posts.trash') }}">Thùng rác</a>
                    </li>
                    @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold text-warning' : '' }}"
                            href="{{ route('admin.dashboard') }}">Quản trị (Admin)</a>
                    </li>
                    @endif
                    @endauth
                </ul>

                <!-- 3. Khu vực bên phải -->
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item ms-2">
                        <a class="btn btn-warning text-dark fw-bold px-3" href="{{ route('register') }}">Đăng ký</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white fw-bold"
                            href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" v-pre>
                            Xin chào, {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket me-1"></i> Đăng xuất
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- NỘI DUNG CHÍNH -->
    <div class="container my-4 main-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>

    <!-- FOOTER CHUYÊN NGHIỆP -->
    <footer class="footer pt-5 pb-3 border-top border-secondary">
        <div class="container">
            <div class="row">
                <!-- Cột 1: Giới thiệu -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-white fw-bold"><i class="fa-solid fa-blog text-warning me-2"></i>MyBlog Community
                    </h5>
                    <p class="small mt-3">Nền tảng chia sẻ kiến thức lập trình, tin tức công nghệ và kết nối cộng đồng
                        nhà phát triển web.</p>
                </div>

                <!-- Cột 2: Điều hướng nhanh -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-white fw-bold">Liên kết nhanh</h5>
                    <ul class="list-unstyled small mt-3">
                        <li class="mb-2"><a href="{{ route('posts.index') }}"><i
                                    class="fa-solid fa-angle-right me-1 text-warning"></i> Trang chủ</a></li>
                        @auth
                        <li class="mb-2"><a href="{{ route('posts.myPosts') }}"><i
                                    class="fa-solid fa-angle-right me-1 text-warning"></i> Bài viết của tôi</a></li>
                        <li class="mb-2"><a href="{{ route('posts.create') }}"><i
                                    class="fa-solid fa-angle-right me-1 text-warning"></i> Đăng bài viết mới</a></li>
                        <li class="mb-2"><a href="{{ route('posts.trash') }}"><i
                                    class="fa-solid fa-angle-right me-1 text-warning"></i> Thùng rác bài viết</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Cột 3: Thông tin đồ án -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-white fw-bold">Đồ Án Tốt Nghiệp</h5>
                    <p class="small mt-3 mb-1"><i class="fa-solid fa-code me-2 text-warning"></i>Xây dựng trên nền tảng
                        Laravel 11/12</p>
                    <p class="small mb-1"><i class="fa-solid fa-graduation-cap me-2 text-warning"></i>Đồ án môn học Web
                        Development</p>
                    <p class="small"><i class="fa-solid fa-copyright me-2 text-warning"></i>2026 MyBlog - All rights
                        reserved.</p>
                </div>
            </div>
            <hr class="border-secondary my-3">
            <div class="text-center small">
                <span>Thiết kế & Phát triển cho Đồ án Laravel Blog Cộng Đồng</span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>