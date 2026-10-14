<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiệm Trà Sữa - Menu & Đặt Hàng</title>
    <style>
    :root {
        --primary: #ff7e67;
        --primary-hover: #e06653;
        --bg: #fcf8f5;
        --card-bg: #ffffff;
        --text: #4a3e3d;
        --accent: #f7d6c8;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: var(--bg);
        color: var(--text);
        padding-bottom: 30px;
    }

    /* Navbar */
    .navbar {
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 15px 5%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .logo {
        font-size: 20px;
        font-weight: bold;
        color: var(--primary);
        text-decoration: none;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text);
        font-weight: 600;
        margin-left: 20px;
        font-size: 14px;
    }

    .nav-links a.active {
        color: var(--primary);
    }

    /* Main Layout 2 Cột */
    .container {
        max-width: 1200px;
        margin: 25px auto;
        padding: 0 20px;
    }

    /* Search Box */
    .search-box {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .search-box input {
        width: 100%;
        max-width: 450px;
        padding: 10px 18px;
        border: 2px solid var(--accent);
        border-radius: 20px 0 0 20px;
        outline: none;
        font-size: 14px;
    }

    .search-box button {
        padding: 10px 22px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 0 20px 20px 0;
        cursor: pointer;
        font-weight: bold;
    }

    .main-layout {
        display: grid;
        grid-template-columns: 2.2fr 1fr;
        gap: 25px;
        align-items: start;
    }

    /* Cột bên trái: Danh sách sản phẩm */
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }

    .card {
        background: var(--card-bg);
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #f0e6e1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 180px;
    }

    .card-title {
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #2c2221;
    }

    .card-desc {
        font-size: 12px;
        color: #7a6e6c;
        margin-bottom: 10px;
        line-height: 1.3;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .card-price {
        font-size: 15px;
        font-weight: bold;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .qty-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fdf5f2;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .qty-box label {
        font-size: 12px;
        font-weight: 600;
    }

    .qty-box input {
        width: 45px;
        padding: 3px;
        text-align: center;
        border: 1px solid #e0d0c8;
        border-radius: 4px;
        font-weight: bold;
        outline: none;
    }

    /* Cột bên phải: Form Đặt Hàng Cố Định (Sticky) */
    .order-sidebar {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0e6e1;
        position: sticky;
        top: 80px;
    }

    .sidebar-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
        text-align: center;
        color: var(--primary);
        border-bottom: 2px solid var(--accent);
        padding-bottom: 8px;
    }

    .form-group {
        margin-bottom: 12px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #e0d0c8;
        border-radius: 6px;
        outline: none;
        font-size: 13px;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background: var(--primary);
        color: #fff;
        font-size: 15px;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: var(--primary-hover);
    }

    /* Responsive */
    @media (max-width: 850px) {
        .main-layout {
            grid-template-columns: 1fr;
        }

        .order-sidebar {
            position: static;
        }
    }
    </style>
</head>

<body>

    <div class="navbar">
        <a href="index.php?mod=client&act=menu" class="logo">🧋 Trà Sữa Sweet</a>
        <div class="nav-links">
            <a href="index.php?mod=client&act=menu" class="active">Menu & Đặt Món</a>
            <a href="index.php?mod=client&act=tracking">Tra Cứu Đơn</a>
            <a href="index.php?mod=admin">Quản Trị</a>
        </div>
    </div>

    <div class="container">
        <form method="GET" action="index.php" class="search-box">
            <input type="hidden" name="mod" value="client">
            <input type="hidden" name="act" value="menu">
            <input type="text" name="search" placeholder="Nhập tên đồ uống..."
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit">Tìm Kiếm</button>
        </form>

        <form method="POST" action="index.php?mod=client&act=order">
            <div class="main-layout">
                <!-- Cột Trái: Danh sách Món -->
                <div>
                    <div class="grid">
                        <?php foreach ($products as $p): ?>
                        <div class="card">
                            <div>
                                <div class="card-title"><?= htmlspecialchars($p['name']) ?></div>
                                <div class="card-desc"><?= htmlspecialchars($p['description']) ?></div>
                            </div>
                            <div>
                                <div class="card-price"><?= number_format($p['price']) ?> VNĐ</div>
                                <div class="qty-box">
                                    <label>Số lượng:</label>
                                    <input type="number" name="quantities[<?= $p['id'] ?>]" value="0" min="0">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Cột Phải: Form Đặt Hàng -->
                <div class="order-sidebar">
                    <div class="sidebar-title">🛒 THÔNG TIN GIAO HÀNG</div>
                    <div class="form-group">
                        <label>Họ và Tên Khách Hàng:</label>
                        <input type="text" name="customer_name" required placeholder="Nhập tên của bạn">
                    </div>
                    <div class="form-group">
                        <label>Số Điện Thoại:</label>
                        <input type="text" name="customer_phone" required placeholder="Nhập SĐT để tra cứu">
                    </div>
                    <div class="form-group">
                        <label>Địa Chỉ Giao Hàng:</label>
                        <textarea name="address" rows="3" required placeholder="Nhập địa chỉ nhận hàng"></textarea>
                    </div>
                    <button type="submit" class="btn-submit">XÁC NHẬN ĐẶT HÀNG</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>