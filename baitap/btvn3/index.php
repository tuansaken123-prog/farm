<?php
require_once 'ketnoi.php';

$sql = "SELECT * FROM sanpham ORDER BY maSp DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh Sách Sản Phẩm</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn {
        text-decoration: none;
        padding: 6px 12px;
        background: #28a745;
        color: white;
        border-radius: 4px;
        display: inline-block;
    }
    </style>
</head>

<body>

    <h2>QUẢN LÝ SẢN PHẨM</h2>
    <a href="create.php" class="btn">+ Thêm sản phẩm mới</a>

    <table>
        <thead>
            <tr>
                <th>Mã SP</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['maSp'] ?></td>
                <td><b><?= ($row['ten']) ?></b></td>
                <td><?= number_format($row['gia'], 0, ',', '.') ?> đ</td>
                <td><?= $row['soluong'] ?></td>
                <td>
                    <a href="update.php?id=<?= $row['maSp'] ?>">Sửa</a> |
                    <a href="delete.php?id=<?= $row['maSp'] ?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                </td>
            </tr>
            <?php endwhile; ?>
            <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">Chưa có sản phẩm nào.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>