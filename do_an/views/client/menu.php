<?php require_once __DIR__ . '/../header.php'; ?>

<style>
.container {
    max-width: 1200px;
    margin: 25px auto;
    padding: 0 20px;
}

.search-box {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.search-box input {
    width: 100%;
    max-width: 450px;
    padding: 10px 18px;
    border: 2px solid var(--accent);
    border-radius: 20px 0 0 20px;
    outline: none;
    font-size: 14px;
}

.search-box button {
    padding: 10px 22px;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 0 20px 20px 0;
    cursor: pointer;
    font-weight: bold;
}

.main-layout {
    display: grid;
    grid-template-columns: 2.2fr 1fr;
    gap: 25px;
    align-items: start;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
}

.card {
    background: var(--card-bg);
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    border: 1px solid #f0e6e1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 180px;
}

.card-title {
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #2c2221;
}

.card-desc {
    font-size: 12px;
    color: #7a6e6c;
    margin-bottom: 10px;
    line-height: 1.3;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.card-price {
    font-size: 15px;
    font-weight: bold;
    color: var(--primary);
    margin-bottom: 8px;
}

.qty-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fdf5f2;
    padding: 4px 10px;
    border-radius: 6px;
}

.qty-box label {
    font-size: 12px;
    font-weight: 600;
}

.qty-box input {
    width: 45px;
    padding: 3px;
    text-align: center;
    border: 1px solid #e0d0c8;
    border-radius: 4px;
    font-weight: bold;
    outline: none;
}

.order-sidebar {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    border: 1px solid #f0e6e1;
    position: sticky;
    top: 85px;
}

.sidebar-title {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 15px;
    text-align: center;
    color: var(--primary);
    border-bottom: 2px solid var(--accent);
    padding-bottom: 8px;
}

.form-group {
    margin-bottom: 12px;
}

.form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 4px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #e0d0c8;
    border-radius: 6px;
    outline: none;
    font-size: 13px;
}

.btn-submit {
    width: 100%;
    padding: 12px;
    background: var(--primary);
    color: #fff;
    font-size: 15px;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.2s;
    margin-top: 10px;
}

.btn-submit:hover {
    background: var(--primary-hover);
}

@media (max-width: 850px) {
    .main-layout {
        grid-template-columns: 1fr;
    }

    .order-sidebar {
        position: static;
    }
}
</style>

<div class="container">
    <form method="GET" action="index.php" class="search-box">
        <input type="hidden" name="mod" value="client">
        <input type="hidden" name="act" value="menu">
        <input type="text" name="search" placeholder="Nhập tên đồ uống..."
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">Tìm Kiếm</button>
    </form>

    <form method="POST" action="index.php?mod=client&act=order">
        <div class="main-layout">
            <div>
                <div class="grid">
                    <?php foreach ($products as $p): ?>
                    <div class="card">
                        <div>
                            <div class="card-title"><?= htmlspecialchars($p['name']) ?></div>
                            <div class="card-desc"><?= htmlspecialchars($p['description']) ?></div>
                        </div>
                        <div>
                            <div class="card-price"><?= number_format($p['price']) ?> VNĐ</div>
                            <div class="qty-box">
                                <label>Số lượng:</label>
                                <input type="number" name="quantities[<?= $p['id'] ?>]" value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="order-sidebar">
                <div class="sidebar-title">🛒 THÔNG TIN GIAO HÀNG</div>
                <div class="form-group">
                    <label>Họ và Tên Khách Hàng:</label>
                    <input type="text" name="customer_name" required placeholder="Nhập tên của bạn">
                </div>
                <div class="form-group">
                    <label>Số Điện Thoại:</label>
                    <input type="text" name="customer_phone" required placeholder="Nhập SĐT để tra cứu">
                </div>
                <div class="form-group">
                    <label>Địa Chỉ Giao Hàng:</label>
                    <textarea name="address" rows="3" required placeholder="Nhập địa chỉ nhận hàng"></textarea>
                </div>
                <button type="submit" class="btn-submit">XÁC NHẬN ĐẶT HÀNG</button>
            </div>
        </div>
    </form>
</div>
</body>

</html>