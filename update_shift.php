<?php
// update_Shift.php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    if (!isset($_POST['Id_Shift']) || !isset($_POST['Nama_Shift']) || !isset($_POST['Waktu_Mulai'])|| !isset($_POST['Waktu_Selesai'])) {
        echo "<script>
                alert('Data tidak lengkap!');
                window.location.href = 'Shift.php';
              </script>";
        exit;
    }

    // Ambil data dari form
    $id = mysqli_real_escape_string($koneksi, $_POST['Id_Shift']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['Nama_Shift']);
    $waktu_mulai = mysqli_real_escape_string($koneksi, $_POST['Waktu_Mulai']);
    $waktu_selesai = mysqli_real_escape_string($koneksi, $_POST['Waktu_Selesai']);

    // Query update
    $query = "UPDATE Shift SET 
              Nama_Shift='$nama', 
              Waktu_Mulai='$waktu_mulai', 
              Waktu_Selesai='$waktu_selesai' 
              WHERE Id_Shift='$id'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil
        echo "<script>
                alert('Data Shift berhasil diupdate!');
                window.location.href = 'shift.php';
              </script>";
    } else {
        // Jika gagal
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = 'shift.php';
              </script>";
    }
} else {
    // Jika bukan method POST
    header("Location: shift.php");
    exit;
}
?>