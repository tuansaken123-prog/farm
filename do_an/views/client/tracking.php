<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tra Cứu Đơn Hàng - Tiệm Trà Sữa</title>
    <style>
    :root {
        --primary: #ff7e67;
        --bg: #fcf8f5;
        --card-bg: #ffffff;
        --text: #4a3e3d;
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
    }

    .navbar {
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 15px 8%;
        display: flex;
        justify-content: space-between;
        align-items: center;
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
    }

    .nav-links a.active {
        color: var(--primary);
    }

    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .search-card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        text-align: center;
        margin-bottom: 30px;
    }

    .search-form {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 15px;
    }

    .search-form input {
        width: 60%;
        padding: 12px 15px;
        border: 1px solid #e0d0c8;
        border-radius: 8px;
        outline: none;
    }

    .search-form button {
        padding: 12px 25px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    th,
    td {
        padding: 14px 18px;
        text-align: left;
        border-bottom: 1px solid #f0e6e1;
    }

    th {
        background-color: #fdf5f2;
        color: var(--text);
        font-size: 14px;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
    }

    .badge-pending {
        background: #fff3cd;
        color: #856404;
    }

    .badge-processing {
        background: #cce5ff;
        color: #004085;
    }

    .badge-completed {
        background: #d4edda;
        color: #155724;
    }

    .badge-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    </style>
</head>

<body>

    <div class="navbar">
        <a href="index.php?mod=client&act=menu" class="logo">🧋 Trà Sữa Sweet</a>
        <div class="nav-links">
            <a href="index.php?mod=client&act=menu">Menu & Đặt Món</a>
            <a href="index.php?mod=client&act=tracking" class="active">Tra Cứu Đơn</a>
            <a href="index.php?mod=admin">Quản Trị</a>
        </div>
    </div>

    <div class="container">
        <div class="search-card">
            <h2>Tra Cứu Đơn Hàng</h2>
            <p style="color: #7a6e6c; margin-top: 5px; font-size: 14px;">Nhập số điện thoại đã sử dụng khi đặt hàng</p>
            <form method="GET" action="index.php" class="search-form">
                <input type="hidden" name="mod" value="client">
                <input type="hidden" name="act" value="tracking">
                <input type="text" name="phone" placeholder="Nhập SĐT của bạn..."
                    value="<?= htmlspecialchars($_GET['phone'] ?? '') ?>" required>
                <button type="submit">Tra Cứu</button>
            </form>
        </div>

        <?php if (!empty($orders)): ?>
        <table>
            <thead>
                <tr>
                    <th>Mã Đơn</th>
                    <th>Người Nhận</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Thời Gian</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $o): ?>
                <tr>
                    <td><b>#<?= $o['id'] ?></b></td>
                    <td><?= htmlspecialchars($o['customer_name']) ?></td>
                    <td style="color: var(--primary); font-weight: bold;"><?= number_format($o['total_price']) ?> VNĐ
                    </td>
                    <td>
                        <?php 
                                    $st = $o['status'];
                                    $class = "badge-" . $st;
                                    $text = ['pending'=>'Chờ xử lý', 'processing'=>'Đang pha chế', 'completed'=>'Hoàn thành', 'cancelled'=>'Đã hủy'][$st] ?? $st;
                                ?>
                        <span class="badge <?= $class ?>"><?= $text ?></span>
                    </td>
                    <td style="font-size: 13px; color: #7a6e6c;"><?= $o['created_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif (isset($_GET['phone'])): ?>
        <div style="text-align: center; color: #7a6e6c; margin-top: 20px;">Không tìm thấy lịch sử đơn hàng cho số điện
            thoại này!</div>
        <?php endif; ?>
    </div>

</body>

</html>