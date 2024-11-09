<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require '../config/database.php';

// Ambil ID beasiswa dari URL
$beasiswa_id = $_GET['beasiswa_id'];

// Ambil data beasiswa yang dipilih
$query = "SELECT * FROM jenis_beasiswa WHERE id = '$beasiswa_id'";
$result = $conn->query($query);
$beasiswa = $result->fetch_assoc();

// Ambil nilai IPK dari session
$ipk = $_SESSION['user_ipk'];

// Cek apakah IPK memenuhi syarat
$ipk_minimum = (float)$beasiswa['syarat']; // Asumsikan syarat IPK diambil dari database
$show_error = false;

if ($ipk < $ipk_minimum) {
    $show_error = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pengajuan Beasiswa</title>
    <link rel="stylesheet" href="../views/style.css">
</head>
<body>
<div class="container">
    <h1>Formulir Pengajuan Beasiswa</h1>
    <h2><?php echo htmlspecialchars($beasiswa['nama_beasiswa']); ?></h2>
    <p><?php echo htmlspecialchars($beasiswa['deskripsi']); ?></p>
    <p><strong>Syarat:</strong> IPK minimal <?php echo htmlspecialchars($beasiswa['syarat']); ?>.</p>

    <?php if ($show_error): ?>
        <div class="error-message" style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            Maaf, Anda tidak memenuhi syarat untuk mengajukan beasiswa ini. IPK Anda adalah <?php echo $ipk; ?>, sementara IPK minimal yang disyaratkan adalah <?php echo $ipk_minimum; ?>.
        </div>
    <?php else: ?>
        <form action="../app/proses_pengajuan.php" method="POST" enctype="multipart/form-data">
            <!-- Hidden field untuk ID beasiswa -->
            <input type="hidden" name="beasiswa_id" value="<?php echo htmlspecialchars($beasiswa_id); ?>">

            <!-- Field Nama -->
            <label for="nama">Nama Lengkap:</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" readonly required>

            <!-- Field Nomor Telepon -->
            <label for="telepon">Nomor Telepon:</label>
            <input type="text" name="telepon" required>

            <!-- Dropdown Semester -->
            <label for="semester">Semester:</label>
            <select name="semester" required>
                <option value="">Pilih Semester</option>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
                <option value="7">Semester 7</option>
            </select>

            <!-- Field IPK (Sembunyikan) -->
            <input type="hidden" name="ipk" value="<?php echo htmlspecialchars($ipk); ?>">

            <!-- Field Dokumen Pelengkap -->
            <label for="dokumen">Dokumen Pelengkap (PDF):</label>
            <input type="file" name="dokumen" accept=".pdf" required>

            <!-- Tombol Kirim Pengajuan -->
            <input type="submit" value="Kirim Pengajuan">
        </form>
    <?php endif; ?>

    <!-- Link Kembali ke Dashboard -->
    <a href="dashboard.php">Kembali ke Dashboard</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
