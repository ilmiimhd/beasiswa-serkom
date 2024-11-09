<?php
require '../config/database.php'; //menghubungkan db
session_start();

$error_message = "";

// Proses login ketika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Simpan data ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nama'];
            $_SESSION['user_ipk'] = $user['ipk'];
            $_SESSION['user_role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: ../admin/admin_dashboard.php");
            } else {
                header("Location: ../public/dashboard.php");
            }
            exit();
        } else {
            $error_message = "Password salah.";
        }
    } else {
        $error_message = "Email tidak ditemukan.";
    }
}

// Tutup koneksi database dan arahkan kembali jika ada error
$conn->close();
if (!empty($error_message)) {
    // Simpan pesan error di session
    $_SESSION['error_message'] = $error_message;
    header("Location: ../public/login.php");
    exit();
}
?>
