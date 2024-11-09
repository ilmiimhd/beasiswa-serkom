<?php
require '../config/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $beasiswa_id = $_POST['beasiswa_id'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $semester = $_POST['semester'];
    $ipk = $_SESSION['user_ipk']; // Ambil nilai IPK dari session
    $ipk_minimum = (float) $_POST['ipk_minimum']; 
    
    // Validasi syarat IPK sebelum melanjutkan
    if ($ipk < $ipk_minimum) {
        echo "<p style='color: red;'>Maaf, Anda tidak memenuhi syarat untuk mengajukan beasiswa ini. IPK Anda harus minimal $ipk_minimum.</p>";
        echo "<a href='../public/form_pengajuan.php?beasiswa_id=$beasiswa_id'>Kembali ke Form Pengajuan</a>";
        exit();
    }

    // Proses upload dokumen
    $upload_dir = '../uploads/';
    $dokumen_name = $_FILES['dokumen']['name'];
    $dokumen_tmp_name = $_FILES['dokumen']['tmp_name'];
    $dokumen_size = $_FILES['dokumen']['size'];
    $dokumen_type = $_FILES['dokumen']['type'];
    $dokumen_error = $_FILES['dokumen']['error'];

    // Cek jika file adalah PDF
    if ($dokumen_type === 'application/pdf' && $dokumen_error === 0) {
        $dokumen_new_name = uniqid('', true) . "-" . $dokumen_name;
        $dokumen_destination = $upload_dir . $dokumen_new_name;
        
        if (move_uploaded_file($dokumen_tmp_name, $dokumen_destination)) {
            // Simpan data pengajuan ke database
            $query = "INSERT INTO pengajuan_beasiswa (user_id, jenis_beasiswa_id, nama, telepon, semester, ipk, dokumen, status_ajuan) 
                      VALUES ('$user_id', '$beasiswa_id', '$nama', '$telepon', '$semester', '$ipk', '$dokumen_new_name', 'Belum diverifikasi')";

            if ($conn->query($query) === TRUE) {
                echo "<p style='color: green;'>Pengajuan berhasil diajukan!</p>";
                header("Location: ../public/dashboard.php");
                exit();
            } else {
                echo "<p style='color: red;'>Error: " . $query . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "<p style='color: red;'>Gagal mengunggah dokumen.</p>";
        }
    } else {
        echo "<p style='color: red;'>Hanya file PDF yang diperbolehkan.</p>";
    }
}

$conn->close();
?>
