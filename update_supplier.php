<?php
// update_Shift.php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    if (!isset($_POST['Id_Supplier']) || !isset($_POST['Nama_Supplier']) || !isset($_POST['Alamat'])|| !isset($_POST['Telepon'])|| !isset($_POST['Email'])|| !isset($_POST['Npwp'])) {
        echo "<script>
                alert('Data tidak lengkap!');
                window.location.href = 'supplier.php';
              </script>";
        exit;
    }

    // Ambil data dari form
    $id = mysqli_real_escape_string($koneksi, $_POST['Id_Supplier']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['Nama_Supplier']);
    $Alamat = mysqli_real_escape_string($koneksi, $_POST['Alamat']);
    $Telepon = mysqli_real_escape_string($koneksi, $_POST['Telepon']);
    $Email = mysqli_real_escape_string($koneksi, $_POST['Email']);
    $Npwp = mysqli_real_escape_string($koneksi, $_POST['Npwp']);

    // Query update
    $query = "UPDATE Supplier SET 
              Nama_Supplier='$nama', 
              Alamat='$Alamat', 
              Telepon='$Telepon', 
              Email='$Email', 
              Npwp='$Npwp' 
              WHERE Id_Supplier='$id'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil
        echo "<script>
                alert('Data Shift berhasil diupdate!');
                window.location.href = 'supplier.php';
              </script>";
    } else {
        // Jika gagal
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = 'supplier.php';
              </script>";
    }
} else {
    // Jika bukan method POST
    header("Location: supplier.php");
    exit;
}
?>