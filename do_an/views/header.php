<?php
$mod = $_REQUEST['mod'] ?? 'client';
$act = $_REQUEST['act'] ?? 'menu';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiệm Trà Sữa Sweet</title>
    <style>
    html {
        overflow-y: scroll;
    }

    :root {
        --primary: #ff7e67;
        --primary-hover: #e06653;
        --bg: #fcf8f5;
        --card-bg: #ffffff;
        --text: #4a3e3d;
        --accent: #f7d6c8;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    body {
        background-color: var(--bg);
        color: var(--text);
        padding-bottom: 30px;
    }

    .navbar {
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 0 8%;
        height: 65px;
        min-height: 65px;
        max-height: 65px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .logo {
        font-size: 20px;
        font-weight: bold;
        color: var(--primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 20px;
        height: 100%;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text);
        font-weight: 600;
        font-size: 14px;
        transition: color 0.15s ease-in-out;
        height: 100%;
        display: flex;
        align-items: center;
        white-space: nowrap;
        border-bottom: 3px solid transparent;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: var(--primary);
        border-bottom-color: var(--primary);
    }

    .nav-links a.btn-logout {
        color: #e74c3c;
        border: 1px solid #e74c3c;
        padding: 5px 12px;
        border-radius: 6px;
        height: auto;
    }

    .nav-links a.btn-logout:hover {
        background: #e74c3c;
        color: #fff;
        border-bottom-color: #e74c3c;
    }
    </style>
</head>

<body>

    <div class="navbar">
        <a href="index.php?mod=client&act=menu" class="logo">
            🧋 Trà Sữa Sweet
            <?php if ($mod === 'admin'): ?>
            <small style="font-size: 12px; color: #888; font-weight: normal;">(Admin)</small>
            <?php endif; ?>
        </a>
        <div class="nav-links">
            <?php if ($mod === 'client'): ?>
            <a href="index.php?mod=client&act=menu" class="<?= $act === 'menu' ? 'active' : '' ?>">Menu & Đặt Món</a>
            <a href="index.php?mod=client&act=tracking" class="<?= $act === 'tracking' ? 'active' : '' ?>">Tra Cứu
                Đơn</a>
            <a href="index.php?mod=admin">Quản Trị</a>
            <?php else: ?>
            <a href="index.php?mod=admin&act=orders" class="<?= $act === 'orders' ? 'active' : '' ?>">Đơn Hàng</a>
            <a href="index.php?mod=admin&act=products" class="<?= $act === 'products' ? 'active' : '' ?>">Quản Lý
                Món</a>
            <a href="index.php?mod=admin&act=stats" class="<?= $act === 'stats' ? 'active' : '' ?>">Thống Kê</a>
            <a href="index.php?mod=client">Xem Website</a>
            <a href="index.php?mod=admin&act=logout" class="btn-logout">Đăng Xuất</a>
            <?php endif; ?>
        </div>
    </div>