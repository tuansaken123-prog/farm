<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Thống Kê</title>
    <style>
    :root {
        --admin-main: #34495e;
        --admin-bg: #f4f6f9;
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
    }

    .nav-links a.active {
        color: #3498db;
    }

    .container {
        max-width: 1000px;
        margin: 30px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #2c3e50;
        border-bottom: 2px solid #ecf0f1;
        padding-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ecf0f1;
        font-size: 14px;
    }

    th {
        background: #f8f9fa;
        color: #7f8c8d;
    }
    </style>
</head>

<body>

    <div class="header">
        <h2>⚙️ Quản Trị Tiệm Trà Sữa</h2>
        <div class="nav-links">
            <a href="index.php?mod=admin&act=orders">Đơn Hàng</a>
            <a href="index.php?mod=admin&act=products">Quản Lý Món</a>
            <a href="index.php?mod=admin&act=stats" class="active">Thống Kê</a>
            <a href="index.php?mod=client">Xem Website</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">📊 DOANH THU 7 NGÀY GẦN NHẤT</div>
            <table>
                <thead>
                    <tr>
                        <th>Ngày</th>
                        <th>Số Đơn</th>
                        <th>Doanh Thu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($statsWeek as $row): ?>
                    <tr>
                        <td><?= $row['date'] ?></td>
                        <td><?= $row['total_orders'] ?></td>
                        <td style="color: #27ae60; font-weight: bold;"><?= number_format($row['revenue']) ?> VNĐ</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-header">📈 DOANH THU THEO THÁNG</div>
            <table>
                <thead>
                    <tr>
                        <th>Tháng</th>
                        <th>Số Đơn</th>
                        <th>Doanh Thu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($statsMonth as $row): ?>
                    <tr>
                        <td>Tháng <?= $row['month'] ?></td>
                        <td><?= $row['total_orders'] ?></td>
                        <td style="color: #27ae60; font-weight: bold;"><?= number_format($row['revenue']) ?> VNĐ</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>