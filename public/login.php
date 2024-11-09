<?php
session_start();
$error_message = "";

// Tampilkan pesan error jika ada
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../views/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        
        <!-- Tampilkan Pesan Kesalahan -->
        <?php if (!empty($error_message)) : ?>
            <p class="error-message"><?= $error_message ?></p>
        <?php endif; ?>

        <form action="../app/login_process.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>

            <input type="submit" value="Login">
        </form>
        
        <!-- Tautan ke Halaman Pendaftaran -->
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>
</html>
