<?php
$conn = mysqli_connect("localhost", "root", "", "qlsp");

if (!$conn) {
    die("Kết nối CSDL thất bại: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");