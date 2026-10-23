<header class="header_area">
    <!-- Main Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 text-primary" href="/">Learn2Earn</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-semibold">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'text-warning fw-bold' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('archive') ? 'text-warning fw-bold' : '' }}"
                            href="/archive">Archive</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('category') ? 'text-warning fw-bold' : '' }}"
                            href="/category">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pages') ? 'text-warning fw-bold' : '' }}"
                            href="/pages">Pages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'text-warning fw-bold' : '' }}"
                            href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-dark text-white text-center py-5 mb-5"
        style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://picsum.photos/1200/400') center/cover;">
        <div class="container py-4">
            <h1 class="display-4 fw-bold">Chào Mừng Đến Với Learn2Earn</h1>
            <p class="lead">Nơi cập nhật tin tức, công nghệ và các góc nhìn cuộc sống mới nhất</p>
        </div>
    </div>
</header>