<?php require_once __DIR__ . '/../header.php'; ?>

<style>
.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 0 20px;
}

.search-card {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    text-align: center;
    margin-bottom: 30px;
}

.search-form {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 15px;
}

.search-form input {
    width: 60%;
    padding: 12px 15px;
    border: 1px solid #e0d0c8;
    border-radius: 8px;
    outline: none;
}

.search-form button {
    padding: 12px 25px;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
}

th,
td {
    padding: 14px 18px;
    text-align: left;
    border-bottom: 1px solid #f0e6e1;
}

th {
    background-color: #fdf5f2;
    color: var(--text);
    font-size: 14px;
}

.badge {
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
    display: inline-block;
}

.badge-pending {
    background: #fff3cd;
    color: #856404;
}

.badge-processing {
    background: #cce5ff;
    color: #004085;
}

.badge-completed {
    background: #d4edda;
    color: #155724;
}

.badge-cancelled {
    background: #f8d7da;
    color: #721c24;
}
</style>

<div class="container">
    <div class="search-card">
        <h2>Tra Cứu Đơn Hàng</h2>
        <p style="color: #7a6e6c; margin-top: 5px; font-size: 14px;">Nhập số điện thoại đã sử dụng khi đặt hàng</p>
        <form method="GET" action="index.php" class="search-form">
            <input type="hidden" name="mod" value="client">
            <input type="hidden" name="act" value="tracking">
            <input type="text" name="phone" placeholder="Nhập SĐT của bạn..."
                value="<?= htmlspecialchars($_GET['phone'] ?? '') ?>" required>
            <button type="submit">Tra Cứu</button>
        </form>
    </div>

    <?php if (!empty($orders)): ?>
    <table>
        <thead>
            <tr>
                <th>Mã Đơn</th>
                <th>Người Nhận</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái</th>
                <th>Thời Gian</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $o): ?>
            <tr>
                <td><b>#<?= $o['id'] ?></b></td>
                <td><?= htmlspecialchars($o['customer_name']) ?></td>
                <td style="color: var(--primary); font-weight: bold;"><?= number_format($o['total_price']) ?> VNĐ</td>
                <td>
                    <?php 
                                $st = $o['status'];
                                $class = "badge-" . $st;
                                $text = ['pending'=>'Chờ xử lý', 'processing'=>'Đang pha chế', 'completed'=>'Hoàn thành', 'cancelled'=>'Đã hủy'][$st] ?? $st;
                            ?>
                    <span class="badge <?= $class ?>"><?= $text ?></span>
                </td>
                <td style="font-size: 13px; color: #7a6e6c;"><?= $o['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php elseif (isset($_GET['phone'])): ?>
    <div style="text-align: center; color: #7a6e6c; margin-top: 20px;">Không tìm thấy lịch sử đơn hàng cho số điện thoại
        này!</div>
    <?php endif; ?>
</div>
</body>

</html>