<?php
session_start();
require '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_ipk = $_SESSION['user_ipk']; // Ambil nilai IPK dari session

// Ambil data pengajuan beasiswa pengguna
$query_pengajuan = "SELECT jenis_beasiswa.nama_beasiswa, pengajuan_beasiswa.tanggal_pengajuan, pengajuan_beasiswa.status_ajuan 
                    FROM pengajuan_beasiswa 
                    JOIN jenis_beasiswa ON pengajuan_beasiswa.jenis_beasiswa_id = jenis_beasiswa.id 
                    WHERE pengajuan_beasiswa.user_id = '$user_id'";
$result_pengajuan = $conn->query($query_pengajuan);

// Ambil data beasiswa yang belum diajukan
$query_beasiswa_tersedia = "SELECT * FROM jenis_beasiswa WHERE id NOT IN (
    SELECT jenis_beasiswa_id FROM pengajuan_beasiswa WHERE user_id = '$user_id'
)";
$result_beasiswa_tersedia = $conn->query($query_beasiswa_tersedia);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../views/style.css">
</head>
<body>
<div class="container">
    <h1>Selamat datang <?php echo $_SESSION['user_name']; ?> </h1>
    
    <!-- Tampilkan nilai IPK -->
    <p>Nilai IPK Anda: <strong><?php echo $user_ipk; ?></strong></p>

    <?php if ($result_beasiswa_tersedia->num_rows > 0): ?>
        <p>Daftar beasiswa yang bisa diajukan:</p>
        <table>
            <tr>
                <th>Nama Beasiswa</th>
                <th>Deskripsi</th>
                <th>Syarat</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result_beasiswa_tersedia->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nama_beasiswa']; ?></td>
                    <td><?php echo $row['deskripsi']; ?></td>
                    <td>IPK minimal <?php echo $row['syarat']; ?></td>
                    <td>
                        <?php if ($user_ipk >= (float)$row['syarat']): ?>
                            <a href="form_pengajuan.php?beasiswa_id=<?php echo $row['id']; ?>" class="button">Ajukan</a>
                        <?php else: ?>
                            <span style="color: red;">Tidak memenuhi syarat</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Anda sudah mengajukan semua beasiswa yang tersedia.</p>
    <?php endif; ?>

    <h2>Status Pengajuan Beasiswa</h2>
    <table>
        <tr>
            <th>Nama Beasiswa</th>
            <th>Tanggal Pengajuan</th>
            <th>Status</th>
        </tr>
        <?php if ($result_pengajuan->num_rows > 0): ?>
            <?php while ($row = $result_pengajuan->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nama_beasiswa']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['tanggal_pengajuan'])); ?></td>
                    <td><?php echo $row['status_ajuan']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Belum ada pengajuan beasiswa.</td>
            </tr>
        <?php endif; ?>
    </table>

    <a href="logout.php" class="button">Logout</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
