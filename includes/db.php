<?php
$host = '127.0.0.1'; //localhost
$user = 'root';
$password = '';
$database = 'kesiswaan';

// perintah untuk mengkoneksikan ke database
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
