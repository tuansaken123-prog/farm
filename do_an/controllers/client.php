<?php
$act = $_REQUEST['act'] ?? 'menu';

if ($act === 'menu') {
    $search = $_GET['search'] ?? '';
    if ($search !== '') {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?");
        $stmt->execute(["%$search%"]);
    } else {
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    }
    $products = $stmt->fetchAll();
    require_once __DIR__ . '/../views/client/menu.php';
} 
elseif ($act === 'order') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['customer_name'] ?? '';
        $phone = $_POST['customer_phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $quantities = $_POST['quantities'] ?? []; // Array [product_id => quantity]

        $total_price = 0;
        $order_details = [];

        foreach ($quantities as $product_id => $qty) {
            $qty = (int)$qty;
            if ($qty > 0) {
                $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
                $stmt->execute([$product_id]);
                $prod = $stmt->fetch();
                if ($prod) {
                    $item_price = $prod['price'] * $qty;
                    $total_price += $item_price;
                    $order_details[] = [
                        'product_id' => $product_id,
                        'quantity' => $qty,
                        'price' => $prod['price']
                    ];
                }
            }
        }

        if ($total_price > 0) {
            $stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_phone, address, total_price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $phone, $address, $total_price]);
            $order_id = $pdo->lastInsertId();

            foreach ($order_details as $item) {
                $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
            }

            echo "<script>alert('Đặt hàng thành công! Mã đơn của bạn là: $order_id'); window.location='index.php?mod=client&act=tracking&phone=$phone';</script>";
        } else {
            echo "<script>alert('Vui lòng chọn ít nhất 1 món!'); window.history.back();</script>";
        }
    }
} 
elseif ($act === 'tracking') {
    $phone = $_GET['phone'] ?? '';
    $orders = [];
    if ($phone !== '') {
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_phone = ? ORDER BY id DESC");
        $stmt->execute([$phone]);
        $orders = $stmt->fetchAll();
    }
    require_once __DIR__ . '/../views/client/tracking.php';
}