<?php
require_once 'config.php';

// Cấu hình header để in ra văn bản tiếng Việt chuẩn trong Terminal
if (PHP_SAPI !== 'cli') {
    header('Content-Type: text/plain; charset=utf-8');
}

echo "=== KẾT NỐI VÀ LẤY DỮ LIỆU ===\n\n";

// Lấy danh sách sinh viên sắp xếp theo ID
$stmt = $pdo->query("SELECT id, ho_ten, lop, diem FROM sinh_vien ORDER BY id");
$danhSachSinhVien = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Kết nối thành công!\n\n";

// In từng sinh viên ra màn hình
foreach ($danhSachSinhVien as $sv) {
    echo $sv['id'] . ". " . $sv['ho_ten'] . " - Lớp: " . $sv['lop'] . " - Điểm: " . $sv['diem'] . "\n";
}
?>