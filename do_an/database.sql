CREATE DATABASE IF NOT EXISTS tiem_tra_sua CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tiem_tra_sua;

-- Xóa bảng cũ nếu tồn tại
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS admins;

-- 1. Bảng tài khoản Admin
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- 2. Bảng sản phẩm (Món)
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Bảng đơn hàng
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Bảng chi tiết đơn hàng
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

--Dữ liệu mẫu

-- Thêm tài khoản Admin mặc định (admin / 123)
INSERT INTO admins (username, password) VALUES 
('admin', '123');

-- Thêm danh sách món ăn
INSERT INTO products (id, name, price, description) VALUES
(1, 'Trà Sữa Trân Châu Đường Đen', 35000, 'Đậm vị trà truyền thống kết hợp cùng trân châu dẻo thơm và đường đen ngậy.'),
(2, 'Trà Đào Cam Sả', 40000, 'Vị chua ngọt thanh mát của đào và cam tươi, thơm nồng hương sả tự nhiên.'),
(3, 'Trà Ô Long Kem Cheese', 45000, 'Lớp kem phô mai béo ngậy mặn nhẹ kết hợp trên nền trà Ô Long thanh mát.'),
(4, 'Trà Sữa Matcha Đậu Đỏ', 38000, 'Bột Matcha chuẩn Nhật Bản kết hợp đậu đỏ bùi bùi đậm vị.'),
(5, 'Trà Bưởi Hồng Nhài', 42000, 'Trà nhài thơm ngát kết hợp tép bưởi hồng tươi mát sảng khoái.'),
(6, 'Sữa Tươi Trân Châu Đường Đen', 39000, 'Sữa tươi thanh trùng béo ngậy cùng trân châu đường đen nóng hổi.'),
(7, 'Trà Xoài Khổng Lồ', 42000, 'Mứt xoài tươi nguyên chất kết hợp trà nhài thanh mát và hạt nổ trái cây.'),
(8, 'Lục Trà Dâu Tây Kem Phô Mai', 48000, 'Vị chua ngọt dịu của dâu tây đà lạt hòa quyện lớp kem cheese béo ngậy.'),
(9, 'Trà Sữa Thái Xanh Trân Châu Trắng', 32000, 'Trà thái xanh đậm đà béo ngậy ăn kèm trân châu trắng giòn sần sật.'),
(10, 'Trà Sữa Khoai Môn Củ Năng', 38000, 'Hương vị khoai môn thơm lừng béo dẻo kết hợp củ năng giòn ngọt.'),
(11, 'Đá Xay Cacao Cookie', 45000, 'Cacao đắng nhẹ xay cùng bánh OREO giòn rụm và phủ lớp kem tươi.'),
(12, 'Trà Sữa Nướng Caramel', 40000, 'Trà nướng đậm vị caramel đắng nhẹ thơm lừng đặc trưng.'),
(13, 'Trà Sữa Chocolate KitKat', 42000, 'Sô-cô-la đậm đà topped cùng thanh bánh KitKat giòn xốp.'),
(14, 'Trà Vải Lài Hạt Chia', 38000, 'Trà nhài ướp hương vải ngọt thanh mát lạnh bổ sung hạt chia tốt cho sức khỏe.'),
(15, 'Trà Sữa Hạt Dẻ Nướng', 45000, 'Sự kết hợp thơm bùi giữa hạt dẻ nướng mịn và trà sữa béo ngậy.'),
(16, 'Đá Xay Matcha Đậu Đỏ', 48000, 'Matcha Nhật Bản xay tuyết mát lạnh phủ đậu đỏ bùi bùi phía trên.');

-- Thêm lịch sử đơn hàng mẫu phục vụ báo cáo Thống Kê
INSERT INTO orders (id, customer_name, customer_phone, address, total_price, status, created_at) VALUES
(1, 'Nguyễn Văn Anh', '0901234567', '123 Cầu Giấy, Hà Nội', 110000, 'completed', NOW()),
(2, 'Trần Thị Bình', '0912345678', '456 Nguyễn Trãi, Hà Nội', 80000, 'completed', DATE_SUB(NOW(), INTERVAL 1 DAY)),
(3, 'Lê Văn Cường', '0987654321', '789 Đội Cấn, Hà Nội', 70000, 'completed', DATE_SUB(NOW(), INTERVAL 2 DAY)),
(4, 'Phạm Minh Đức', '0933334444', '12 Chùa Bộc, Hà Nội', 83000, 'pending', NOW());

-- Thêm chi tiết các món trong đơn hàng
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 2, 35000), 
(1, 2, 1, 40000),
(2, 2, 2, 40000), 
(3, 1, 2, 35000), 
(4, 5, 1, 42000), 
(4, 7, 1, 41000);