<?php
session_start();
require_once __DIR__ . '/config/db.php';

// Lấy module từ URL (Mặc định là client)
$mod = $_REQUEST['mod'] ?? 'client';
$act = $_REQUEST['act'] ?? 'menu';

switch ($mod) {
    case 'client':
        require_once __DIR__ . '/controllers/client.php';
        break;

    case 'admin':
        require_once __DIR__ . '/controllers/admin.php';
        break;

    default:
        http_response_code(404);
        echo "<h3>Trang không tồn tại (404)</h3>";
        break;
}
?>