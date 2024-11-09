<?php
require '../config/database.php';
session_start();

// Pastikan pengguna adalah admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pengajuan_id = $_POST['pengajuan_id'];
    $status_ajuan = $_POST['status_ajuan'];

    // Update status pengajuan di database
    $query = "UPDATE pengajuan_beasiswa SET status_ajuan = '$status_ajuan' WHERE id = '$pengajuan_id'";
    
    if ($conn->query($query) === TRUE) {
        header("Location: admin_dashboard.php"); // Kembali ke halaman admin
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

$conn->close();
?>
