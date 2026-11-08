<?php require_once __DIR__ . '/../header.php'; ?>

<style>
.container {
    max-width: 1100px;
    margin: 30px auto;
    padding: 0 20px;
}

.card {
    background: #fff;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    border: 1px solid #f0e6e1;
}

.card-header {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
    color: var(--primary);
    border-bottom: 2px solid #f7d6c8;
    padding-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th,
td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #f0e6e1;
    font-size: 14px;
}

th {
    background: #fdf5f2;
    color: var(--text);
}

select {
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 13px;
}

.btn-save {
    padding: 6px 12px;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    margin-left: 5px;
}

.btn-save:hover {
    background: #e06653;
}
</style>

<div class="container">
    <div class="card">
        <div class="card-header">DANH SÁCH ĐƠN HÀNG MỚI NHẤT</div>
        <table>
            <thead>
                <tr>
                    <th>Mã Đơn</th>
                    <th>Khách Hàng</th>
                    <th>SĐT</th>
                    <th>Địa Chỉ</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $o): ?>
                <tr>
                    <td><b>#<?= $o['id'] ?></b></td>
                    <td><?= htmlspecialchars($o['customer_name']) ?></td>
                    <td><?= htmlspecialchars($o['customer_phone']) ?></td>
                    <td><?= htmlspecialchars($o['address']) ?></td>
                    <td style="color: var(--primary); font-weight: bold;"><?= number_format($o['total_price']) ?> VNĐ
                    </td>
                    <td><b><?= $o['status'] ?></b></td>
                    <td>
                        <form method="POST" action="index.php?mod=admin&act=orders"
                            style="display: flex; align-items: center;">
                            <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
                            <select name="status">
                                <option value="pending" <?= $o['status'] === 'pending' ? 'selected' : '' ?>>Chờ xử lý
                                </option>
                                <option value="processing" <?= $o['status'] === 'processing' ? 'selected' : '' ?>>Đang
                                    làm</option>
                                <option value="completed" <?= $o['status'] === 'completed' ? 'selected' : '' ?>>Hoàn
                                    thành</option>
                                <option value="cancelled" <?= $o['status'] === 'cancelled' ? 'selected' : '' ?>>Hủy đơn
                                </option>
                            </select>
                            <button type="submit" name="update_status" class="btn-save">Lưu</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center; color: #95a5a6;">Chưa có đơn hàng nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>