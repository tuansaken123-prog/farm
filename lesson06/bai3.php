<?php
$products = [
    [
        "name" => "Bánh mì",
        "price" => 15000,
        "quantity" => 2
    ],
    [
        "name" => "Sữa",
        "price" => 30000,
        "quantity" => 1
    ],
    [
        "name" => "Trứng",
        "price" => 25000,
        "quantity" => 3
    ]
];

echo "===== DANH SÁCH SẢN PHẨM =====\n\n";

$tamTinh = 0;

foreach ($products as $item) {
    $thanhTienItem = $item["price"] * $item["quantity"];
    
    $tamTinh += $thanhTienItem;
    
    echo $item["name"] . " - " . number_format($item["price"]) . " VNĐ x " 
         . $item["quantity"] . " = " . number_format($thanhTienItem) . " VNĐ\n";
}

if ($tamTinh >= 100000) {
    $giamGia = $tamTinh * 0.10;
} else {
    $giamGia = 0;
}

$thanhToan = $tamTinh - $giamGia;

echo "\nTạm tính: " . number_format($tamTinh) . " VNĐ\n";
echo "Giảm giá: " . number_format($giamGia) . " VNĐ\n";
echo "Thanh toán: " . number_format($thanhToan) . " VNĐ\n";
?>