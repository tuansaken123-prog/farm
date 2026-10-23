<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Learn2Earn - Trang Tin Tức & Blog')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    {{-- 1. Nhúng Header bằng @include --}}
    @include('layouts.header')

    {{-- 2. Vùng nội dung thay đổi bằng @yield --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- 3. Nhúng Footer bằng @include --}}
    @include('layouts.footer')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>