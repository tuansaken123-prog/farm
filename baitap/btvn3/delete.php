<?php
require_once 'ketnoi.php';

$maSp = $_GET['id'] ?? 0;

if ($maSp > 0) {
    $stmt = mysqli_prepare($conn, "DELETE FROM sanpham WHERE maSp = ?");
    mysqli_stmt_bind_param($stmt, "i", $maSp);
    mysqli_stmt_execute($stmt);
}

header("Location: index.php");
exit;