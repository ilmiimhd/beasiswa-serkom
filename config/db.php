<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // kosongkan jika tidak ada password untuk MySQL
$dbname = 'beasiswa_serkom';

$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>