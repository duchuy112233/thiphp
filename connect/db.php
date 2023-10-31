<?php

$servername = 'localhost';
$username = 'root';
$passwork = '';
$database = 'ph33852_examphp1';

$conn = new mysqli ($servername,$username,$passwork,$database);

if ($conn->connect_error) {
    die("Lỗi kết nối"). $conn->connect_error;
}
