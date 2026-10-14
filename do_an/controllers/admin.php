<?php
$act = $_REQUEST['act'] ?? 'orders';

// --- 1. XỬ LÝ ĐĂNG NHẬP ---
if ($act === 'login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Kiểm tra đăng nhập với tài khoản admin / 123
        if ($username === 'admin' && $password === '123') {
            $_SESSION['admin_logged'] = true;
            $_SESSION['admin_user'] = 'admin';
            header("Location: index.php?mod=admin&act=orders");
            exit;
        } else {
            $error = "Tài khoản hoặc mật khẩu không chính xác!";
        }
    }
    require_once __DIR__ . '/../views/admin/login.php';
    exit;
}

// --- 2. BẮT BỘC ĐĂNG NHẬP (Chưa đăng nhập sẽ bị đẩy về trang Login) ---
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header("Location: index.php?mod=admin&act=login");
    exit;
}

// --- 3. XỬ LÝ ĐĂNG XUẤT ---
if ($act === 'logout') {
    unset($_SESSION['admin_logged']);
    unset($_SESSION['admin_user']);
    header("Location: index.php?mod=admin&act=login");
    exit;
}

// --- 4. QUẢN LÝ ĐƠN HÀNG & CẬP NHẬT TRẠNG THÁI ---
if ($act === 'orders') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$status, $order_id]);
    }

    $stmt = $pdo->query("SELECT * FROM orders ORDER BY id DESC");
    $orders = $stmt->fetchAll();
    require_once __DIR__ . '/../views/admin/orders.php';
}

// --- 5. QUẢN LÝ MÓN (CRUD: Thêm & Xóa món) ---
elseif ($act === 'products') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $stmt = $pdo->prepare("INSERT INTO products (name, price, description) VALUES (?, ?, ?)");
        $stmt->execute([$name, $price, $description]);
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: index.php?mod=admin&act=products");
        exit;
    }

    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    $products = $stmt->fetchAll();
    require_once __DIR__ . '/../views/admin/products.php';
}

// --- 6. THỐNG KÊ DOANH THU (Theo tuần & tháng) ---
elseif ($act === 'stats') {
    $stmtWeek = $pdo->query("
        SELECT DATE(created_at) as date, COUNT(*) as total_orders, SUM(total_price) as revenue 
        FROM orders 
        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND status = 'completed'
        GROUP BY DATE(created_at)
    ");
    $statsWeek = $stmtWeek->fetchAll();

    $stmtMonth = $pdo->query("
        SELECT MONTH(created_at) as month, COUNT(*) as total_orders, SUM(total_price) as revenue 
        FROM orders 
        WHERE YEAR(created_at) = YEAR(CURDATE()) AND status = 'completed'
        GROUP BY MONTH(created_at)
    ");
    $statsMonth = $stmtMonth->fetchAll();

    require_once __DIR__ . '/../views/admin/stats.php';
}
?>