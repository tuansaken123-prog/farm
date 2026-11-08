<?php require_once __DIR__ . '/../header.php'; ?>

<style>
.container {
    max-width: 1000px;
    margin: 30px auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

.card {
    background: #fff;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    border: 1px solid #f0e6e1;
}

.card-header {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 20px;
    color: var(--primary);
    border-bottom: 2px solid #f7d6c8;
    padding-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #f0e6e1;
    font-size: 14px;
}

th {
    background: #fdf5f2;
    color: var(--text);
}
</style>

<div class="container">
    <div class="card">
        <div class="card-header">📊 DOANH THU 7 NGÀY GẦN NHẤT</div>
        <table>
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Số Đơn</th>
                    <th>Doanh Thu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statsWeek as $row): ?>
                <tr>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['total_orders'] ?></td>
                    <td style="color: var(--primary); font-weight: bold;"><?= number_format($row['revenue']) ?> VNĐ</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-header">📈 DOANH THU THEO THÁNG</div>
        <table>
            <thead>
                <tr>
                    <th>Tháng</th>
                    <th>Số Đơn</th>
                    <th>Doanh Thu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statsMonth as $row): ?>
                <tr>
                    <td>Tháng <?= $row['month'] ?></td>
                    <td><?= $row['total_orders'] ?></td>
                    <td style="color: var(--primary); font-weight: bold;"><?= number_format($row['revenue']) ?> VNĐ</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>