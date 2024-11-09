<?php
session_start();
require '../config/database.php';

// Pastikan pengguna adalah admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil semua pengajuan beasiswa dari pengguna
$query_pengajuan = "SELECT pengajuan_beasiswa.id, users.nama AS nama_pengguna, jenis_beasiswa.nama_beasiswa, 
                    pengajuan_beasiswa.tanggal_pengajuan, pengajuan_beasiswa.status_ajuan, 
                    pengajuan_beasiswa.telepon, pengajuan_beasiswa.semester, pengajuan_beasiswa.dokumen 
                    FROM pengajuan_beasiswa 
                    JOIN users ON pengajuan_beasiswa.user_id = users.id 
                    JOIN jenis_beasiswa ON pengajuan_beasiswa.jenis_beasiswa_id = jenis_beasiswa.id";
$result_pengajuan = $conn->query($query_pengajuan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Pengajuan Beasiswa</title>
    <link rel="stylesheet" href="../views/admin-style.css">
</head>
<body>
<div class="container">
    <h1>Dashboard Admin - Pengajuan Beasiswa</h1>

    <table>
        <tr>
            <th>Nama Pengguna</th>
            <th>Nama Beasiswa</th>
            <th>Telepon</th>
            <th>Semester</th>
            <th>Dokumen</th>
            <th>Tanggal Pengajuan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result_pengajuan->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama_pengguna']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_beasiswa']); ?></td>
                <td><?php echo htmlspecialchars($row['telepon']); ?></td>
                <td><?php echo htmlspecialchars($row['semester']); ?></td>
                <td>
                    <?php if (!empty($row['dokumen'])): ?>
                        <a href="../uploads/<?php echo htmlspecialchars($row['dokumen']); ?>" target="_blank">Lihat Dokumen</a>
                    <?php else: ?>
                        Tidak ada dokumen
                    <?php endif; ?>
                </td>
                <td><?php echo date('d-m-Y', strtotime($row['tanggal_pengajuan'])); ?></td>
                <td><?php echo htmlspecialchars($row['status_ajuan']); ?></td>
                <td>
                    <form action="update_status.php" method="POST">
                        <input type="hidden" name="pengajuan_id" value="<?php echo $row['id']; ?>">
                        <select name="status_ajuan">
                            <option value="Belum diverifikasi" <?php if ($row['status_ajuan'] == 'Belum diverifikasi') echo 'selected'; ?>>Belum diverifikasi</option>
                            <option value="Diproses" <?php if ($row['status_ajuan'] == 'Diproses') echo 'selected'; ?>>Diproses</option>
                            <option value="Diterima" <?php if ($row['status_ajuan'] == 'Diterima') echo 'selected'; ?>>Diterima</option>
                            <option value="Ditolak" <?php if ($row['status_ajuan'] == 'Ditolak') echo 'selected'; ?>>Ditolak</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="../public/logout.php" class="button">Logout</a>
</div>
</body>
</html>

