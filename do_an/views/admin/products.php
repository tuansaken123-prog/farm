<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản Lý Món</title>
    <style>
    :root {
        --admin-main: #34495e;
        --admin-bg: #f4f6f9;
        --primary: #2ecc71;
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
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 25px;
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

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        font-size: 14px;
    }

    .btn-add {
        width: 100%;
        padding: 12px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-add:hover {
        background: #27ae60;
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

    .btn-delete {
        color: #e74c3c;
        text-decoration: none;
        font-weight: bold;
    }
    </style>
</head>

<body>

    <div class="header">
        <h2>⚙️ Quản Trị Tiệm Trà Sữa</h2>
        <div class="nav-links">
            <a href="index.php?mod=admin&act=orders">Đơn Hàng</a>
            <a href="index.php?mod=admin&act=products" class="active">Quản Lý Món</a>
            <a href="index.php?mod=admin&act=stats">Thống Kê</a>
            <a href="index.php?mod=client">Xem Website</a>
        </div>
    </div>

    <div class="container">
        <!-- Form thêm món mới -->
        <div class="card">
            <div class="card-header">THÊM MÓN MỚI</div>
            <form method="POST" action="index.php?mod=admin&act=products">
                <div class="form-group">
                    <label>Tên đồ uống:</label>
                    <input type="text" name="name" required placeholder="VD: Trà sữa Ô Long">
                </div>
                <div class="form-group">
                    <label>Giá tiền (VNĐ):</label>
                    <input type="number" name="price" required placeholder="VD: 35000">
                </div>
                <div class="form-group">
                    <label>Mô tả ngắn:</label>
                    <textarea name="description" rows="3" placeholder="Đậm vị trà, thơm vị sữa..."></textarea>
                </div>
                <button type="submit" name="add_product" class="btn-add">+ THÊM MÓN</button>
            </form>
        </div>

        <!-- Danh sách món -->
        <div class="card">
            <div class="card-header">DANH SÁCH MÓN HIỆN CÓ</div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Món</th>
                        <th>Giá</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p): ?>
                    <tr>
                        <td><b>#<?= $p['id'] ?></b></td>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= number_format($p['price']) ?> VNĐ</td>
                        <td>
                            <a href="index.php?mod=admin&act=products&delete=<?= $p['id'] ?>" class="btn-delete"
                                onclick="return confirm('Xóa món này?');">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>