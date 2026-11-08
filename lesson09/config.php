<?php
$host = 'localhost';
$dbname = 'quanly_sinhvien';
$username = 'root';
$password = '';

try {
    // Kết nối CSDL bằng PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Thiết lập chế độ báo lỗi
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}
?>