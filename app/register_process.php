<?php
require '../config/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $ipk = 3.4; // Nilai IPK default

    // Cek apakah email sudah terdaftar
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Jika email sudah terdaftar, simpan pesan error di session
        $_SESSION['error_message'] = "Email sudah terdaftar!";
        header("Location: ../public/register.php");
        exit();
    } else {
        // Masukkan data pengguna baru ke dalam database
        $insert_query = "INSERT INTO users (nama, email, password, ipk) VALUES ('$nama', '$email', '$password', '$ipk')";
        if ($conn->query($insert_query) === TRUE) {
            // Simpan data user ke session
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_name'] = $nama;
            $_SESSION['user_ipk'] = $ipk;

            // Redirect ke halaman dashboard
            header("Location: ../public/dashboard.php");
            exit();
        } else {
            // Simpan pesan error jika terjadi kesalahan pada database
            $_SESSION['error_message'] = "Terjadi kesalahan: " . $conn->error;
            header("Location: ../public/register.php");
            exit();
        }
    }
}

$conn->close();
?>