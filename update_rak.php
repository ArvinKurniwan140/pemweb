<?php
// update_rak.php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    if (!isset($_POST['Id_Rak']) || !isset($_POST['Nama_Rak']) || !isset($_POST['Kapasitas'])) {
        echo "<script>
                alert('Data tidak lengkap!');
                window.location.href = 'rak.php';
              </script>";
        exit;
    }

    // Ambil data dari form
    $id = mysqli_real_escape_string($koneksi, $_POST['Id_Rak']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['Nama_Rak']);
    $kapasitas = mysqli_real_escape_string($koneksi, $_POST['Kapasitas']);

    // Query update
    $query = "UPDATE rak SET 
              Nama_Rak='$nama', 
              Kapasitas='$kapasitas' 
              WHERE Id_Rak='$id'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil
        echo "<script>
                alert('Data rak berhasil diupdate!');
                window.location.href = 'rak.php';
              </script>";
    } else {
        // Jika gagal
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = 'rak.php';
              </script>";
    }
} else {
    // Jika bukan method POST
    header("Location: rak.php");
    exit;
}
?>