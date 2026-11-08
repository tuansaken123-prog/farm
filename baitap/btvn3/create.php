<?php
require_once 'ketnoi.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = trim($_POST['ten'] ?? '');
    $gia = trim($_POST['gia'] ?? '');
    $soluong = trim($_POST['soluong'] ?? '');

    if (empty($ten)) $errors[] = "Tên sản phẩm không được để trống!";
    if (!is_numeric($gia) || $gia < 0) $errors[] = "Giá sản phẩm không hợp lệ!";
    if (!is_numeric($soluong) || $soluong < 0) $errors[] = "Số lượng không hợp lệ!";

    if (empty($errors)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO sanpham (ten, gia, soluong) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sdi", $ten, $gia, $soluong);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Lỗi khi thêm mới!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 400px;
        margin: 30px auto;
    }

    .form-group {
        margin-bottom: 12px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .error {
        color: red;
    }
    </style>
</head>

<body>

    <h2>THÊM SẢN PHẨM MỚI</h2>

    <?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $err): ?>
            <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Tên sản phẩm:</label>
            <input type="text" name="ten" value="<?= htmlspecialchars($_POST['ten'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Giá bán (VNĐ):</label>
            <input type="number" step="0.01" name="gia" value="<?= htmlspecialchars($_POST['gia'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Số lượng:</label>
            <input type="number" name="soluong" value="<?= htmlspecialchars($_POST['soluong'] ?? '0') ?>" required>
        </div>

        <button type="submit">Lưu lại</button>
        <a href="index.php">Quay lại</a>
    </form>

</body>

</html>