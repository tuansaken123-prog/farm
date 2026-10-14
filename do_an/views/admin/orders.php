<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản Lý Đơn Hàng</title>
    <style>
    :root {
        --admin-main: #34495e;
        --admin-bg: #f4f6f9;
        --primary: #3498db;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background: var(--admin-bg);
        color: #333;
    }

    .header {
        background: var(--admin-main);
        color: #fff;
        padding: 15px 5%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header h2 {
        font-size: 20px;
    }

    .nav-links a {
        color: #ecf0f1;
        text-decoration: none;
        font-weight: 600;
        margin-left: 20px;
        transition: 0.2s;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: #3498db;
    }

    .container {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 20px;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #2c3e50;
        border-bottom: 2px solid #ecf0f1;
        padding-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ecf0f1;
        font-size: 14px;
    }

    th {
        background: #f8f9fa;
        color: #7f8c8d;
    }

    select {
        padding: 6px 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 13px;
    }

    .btn-save {
        padding: 6px 12px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        margin-left: 5px;
    }

    .btn-save:hover {
        background: #2980b9;
    }
    </style>
</head>

<body>

    <div class="header">
        <h2>⚙️ Quản Trị Tiệm Trà Sữa</h2>
        <div class="nav-links">
            <a href="index.php?mod=admin&act=orders" class="active">Đơn Hàng</a>
            <a href="index.php?mod=admin&act=products">Quản Lý Món</a>
            <a href="index.php?mod=admin&act=stats">Thống Kê</a>
            <a href="index.php?mod=client">Xem Website</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">DANH SÁCH ĐƠN HÀNG MỚI NHẤT</div>
            <table>
                <thead>
                    <tr>
                        <th>Mã Đơn</th>
                        <th>Khách Hàng</th>
                        <th>SĐT</th>
                        <th>Địa Chỉ</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $o): ?>
                    <tr>
                        <td><b>#<?= $o['id'] ?></b></td>
                        <td><?= htmlspecialchars($o['customer_name']) ?></td>
                        <td><?= htmlspecialchars($o['customer_phone']) ?></td>
                        <td><?= htmlspecialchars($o['address']) ?></td>
                        <td style="color: #e74c3c; font-weight: bold;"><?= number_format($o['total_price']) ?> VNĐ</td>
                        <td><b><?= $o['status'] ?></b></td>
                        <td>
                            <form method="POST" action="index.php?mod=admin&act=orders"
                                style="display: flex; align-items: center;">
                                <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
                                <select name="status">
                                    <option value="pending" <?= $o['status'] === 'pending' ? 'selected' : '' ?>>Chờ xử
                                        lý</option>
                                    <option value="processing" <?= $o['status'] === 'processing' ? 'selected' : '' ?>>
                                        Đang làm</option>
                                    <option value="completed" <?= $o['status'] === 'completed' ? 'selected' : '' ?>>Hoàn
                                        thành</option>
                                    <option value="cancelled" <?= $o['status'] === 'cancelled' ? 'selected' : '' ?>>Hủy
                                        đơn</option>
                                </select>
                                <button type="submit" name="update_status" class="btn-save">Lưu</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: #95a5a6;">Chưa có đơn hàng nào.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>