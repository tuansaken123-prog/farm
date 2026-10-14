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
        padding-bottom: 50px;
    }

    /* Navigation */
    .navbar {
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 15px 8%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .logo {
        font-size: 22px;
        font-weight: bold;
        color: var(--primary);
        text-decoration: none;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text);
        font-weight: 600;
        margin-left: 20px;
        transition: 0.2s;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: var(--primary);
    }

    /* Container */
    .container {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 20px;
    }

    /* Search Section */
    .search-box {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }

    .search-box input {
        width: 60%;
        max-width: 400px;
        padding: 12px 18px;
        border: 2px solid var(--accent);
        border-radius: 25px 0 0 25px;
        outline: none;
        font-size: 15px;
    }

    .search-box button {
        padding: 12px 25px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 0 25px 25px 0;
        cursor: pointer;
        font-weight: bold;
        transition: 0.2s;
    }

    .search-box button:hover {
        background: var(--primary-hover);
    }

    /* Product Grid */
    .section-title {
        font-size: 22px;
        margin-bottom: 20px;
        text-align: center;
        color: var(--text);
        position: relative;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 50px;
        height: 3px;
        background: var(--primary);
        margin: 8px auto 0;
        border-radius: 2px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .card {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid #f0e6e1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #2c2221;
    }

    .card-desc {
        font-size: 13px;
        color: #7a6e6c;
        margin-bottom: 12px;
        height: 36px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .card-price {
        font-size: 16px;
        font-weight: bold;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .qty-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fdf5f2;
        padding: 6px 12px;
        border-radius: 8px;
    }

    .qty-box label {
        font-size: 13px;
        font-weight: 600;
    }

    .qty-box input {
        width: 50px;
        padding: 5px;
        text-align: center;
        border: 1px solid #e0d0c8;
        border-radius: 6px;
        font-weight: bold;
        outline: none;
    }

    /* Order Form */
    .order-container {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0e6e1;
        max-width: 600px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #e0d0c8;
        border-radius: 8px;
        outline: none;
        font-size: 14px;
        transition: border-color 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: var(--primary);
    }

    .btn-submit {
        width: 100%;
        padding: 14px;
        background: var(--primary);
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-submit:hover {
        background: var(--primary-hover);
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
            <h2 class="section-title">DANH SÁCH ĐỒ UỐNG</h2>
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

            <div class="order-container">
                <h2 class="section-title" style="margin-bottom: 25px;">THÔNG TIN GIAO HÀNG</h2>
                <div class="form-group">
                    <label>Họ và Tên Khách Hàng:</label>
                    <input type="text" name="customer_name" required placeholder="Nhập tên của bạn">
                </div>
                <div class="form-group">
                    <label>Số Điện Thoại:</label>
                    <input type="text" name="customer_phone" required placeholder="Nhập số điện thoại để tra cứu">
                </div>
                <div class="form-group">
                    <label>Địa Chỉ Giao Hàng:</label>
                    <textarea name="address" rows="3" required placeholder="Nhập địa chỉ nhận hàng"></textarea>
                </div>
                <button type="submit" class="btn-submit">XÁC NHẬN ĐẶT HÀNG</button>
            </div>
        </form>
    </div>

</body>

</html>