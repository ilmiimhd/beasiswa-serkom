<?php
session_start();
$error_message = "";

// Cek apakah ada pesan error di session
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../views/style.css">
</head>
<body>
    <div class="container">
        <h1>Registrasi Akun</h1>

        <!-- Tampilkan Pesan Kesalahan -->
        <?php if (!empty($error_message)) : ?>
            <p class="error-message"><?= $error_message ?></p>
        <?php endif; ?>

        <form action="../app/register_process.php" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>

            <input type="submit" value="Register">
        </form>
        <p>Sudah Pernah Daftar? <a href="login.php">Masuk disini</a></p>
    </div>
</body>
</html>