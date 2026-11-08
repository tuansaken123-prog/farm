CREATE DATABASE qlsp;
USE qlsp;
CREATE TABLE sanpham (
    maSP INT AUTO_INCREMENT PRIMARY KEY,
    ten VARCHAR(100) NOT NULL,
    gia DECIMAL(10,2) NOT NULL,
    soluong INT NOT NULL
);
INSERT INTO sanpham (ten, gia, soluong) VALUES
('Ao thun', 80000.00, 50),
('Mu luoi trai', 120000.00, 30),
('Ao khoac bomber', 350000.00, 18),
('Tui xach nu', 280000.00, 25),
('Tat co trung', 25000.00, 100);

SELECT * FROM sanpham;