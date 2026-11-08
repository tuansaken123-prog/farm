<?php
// 1. Khai báo các biến tương ứng
$tenSanPham = "Bánh mì";
$donGia = 15000;
$soLuong = 3;

// 2. Tính thành tiền (Số lượng * Đơn giá)
$thanhTien = $donGia * $soLuong;

// 3. Tính VAT 10%
$vat = $thanhTien * 0.10;

// 4. Tính tổng tiền phải trả (Thành tiền + VAT)
$tongTien = $thanhTien + $vat;

// 5. In kết quả ra màn hình
echo "Tên sản phẩm: " . $tenSanPham . "<br>";
echo "Đơn giá: " . number_format($donGia) . " VNĐ<br>";
echo "Số lượng: " . $soLuong . "<br>";
echo "-----------------------------<br>";
echo "Thành tiền: " . number_format($thanhTien) . " VNĐ<br>";
echo "Thuế VAT (10%): " . number_format($vat) . " VNĐ<br>";
echo "<strong>Tổng tiền phải trả: " . number_format($tongTien) . " VNĐ</strong>";
?>