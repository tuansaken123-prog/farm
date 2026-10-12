<?php
$name = "Nguyen Van An";
$score = 7.5;

if ($score >= 8) {
    $xepLoai = "Giỏi";
} elseif ($score >= 6.5) {
    $xepLoai = "Khá";
} elseif ($score >= 5) {
    $xepLoai = "Trung bình";
} else {
    $xepLoai = "Không đạt";
}

if ($score >= 5) {
    $ketQua = "Bạn đã đạt";
} else {
    $ketQua = "Bạn chưa đạt";
}

echo "Học viên: " . $name . "\n";
echo "Điểm: " . $score . "\n";
echo "Xếp loại: " . $xepLoai . "\n";
echo "Kết quả: " . $ketQua . "\n";
?>