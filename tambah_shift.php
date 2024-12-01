<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$Nama_Shift = $_POST['Nama_Shift'];
$Waktu_Mulai = $_POST['Waktu_Mulai'];
$Waktu_Selesai = $_POST['Waktu_Selesai'];


// Hapus Id_Barang dari values dan sebutkan kolom yang akan diisi
$query = "INSERT INTO shift (Nama_Shift, Waktu_Mulai, Waktu_Selesai) 
          VALUES ('$Nama_Shift', '$Waktu_Mulai', '$Waktu_Selesai')";

// Eksekusi query
if(mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect ke index.php
    header("location:shift.php");
    exit();
} else {
    // Jika gagal, tampilkan error
    echo "Error: " . mysqli_error($koneksi);
}
?>