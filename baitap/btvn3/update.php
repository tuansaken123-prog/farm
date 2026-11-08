<?php
require_once 'ketnoi.php';

$maSp = $_GET['id'] ?? 0;

$stmt = mysqli_prepare($conn, "SELECT * FROM sanpham WHERE maSp = ?");
mysqli_stmt_bind_param($stmt, "i", $maSp);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$item = mysqli_fetch_assoc($result);

if (!$item) {
    header("Location: index.php");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = trim($_POST['ten'] ?? '');
    $gia = trim($_POST['gia'] ?? '');
    $soluong = trim($_POST['soluong'] ?? '');

    if (empty($ten)) $errors[] = "Tên sản phẩm không được để trống!";
    if (!is_numeric($gia) || $gia < 0) $errors[] = "Giá không hợp lệ!";
    if (!is_numeric($soluong) || $soluong < 0) $errors[] = "Số lượng không hợp lệ!";

    if (empty($errors)) {
        $stmt_update = mysqli_prepare($conn, "UPDATE sanpham SET ten = ?, gia = ?, soluong = ? WHERE maSp = ?");
        mysqli_stmt_bind_param($stmt_update, "sdii", $ten, $gia, $soluong, $maSp);

        if (mysqli_stmt_execute($stmt_update)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Lỗi khi cập nhật!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa Sản Phẩm</title>
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

    <h2>SỬA SẢN PHẨM</h2>

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
            <input type="text" name="ten" value="<?= htmlspecialchars($_POST['ten'] ?? $item['ten']) ?>" required>
        </div>

        <div class="form-group">
            <label>Giá bán (VNĐ):</label>
            <input type="number" step="0.01" name="gia" value="<?= htmlspecialchars($_POST['gia'] ?? $item['gia']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Số lượng:</label>
            <input type="number" name="soluong" value="<?= htmlspecialchars($_POST['soluong'] ?? $item['soluong']) ?>"
                required>
        </div>

        <button type="submit">Cập nhật</button>
        <a href="index.php">Hủy</a>
    </form>

</body>

</html>