<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$Tanggal = $_POST['Tanggal'];
$Kas_Awal = $_POST['Kas_Awal'];
$Kas_Akhir = $_POST['Kas_Akhir'];
$Total_Penjualan = $_POST['Total_Penjualan'];
$Id_Kasir = $_POST['Id_Kasir'];
$Id_Shift = $_POST['Id_Shift'];


// Hapus Id_Barang dari values dan sebutkan kolom yang akan diisi
$query = "INSERT INTO kas (Tanggal, Kas_Awal, Kas_Akhir, Total_Penjualan, Id_Kasir, Id_Shift) 
          VALUES ('$Tanggal', '$Kas_Awal', '$Kas_Akhir', '$Total_Penjualan','$Id_Kasir','$Id_Shift')";

// Eksekusi query
if(mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect ke index.php
    header("location:kas.php");
    exit();
} else {
    // Jika gagal, tampilkan error
    echo "Error: " . mysqli_error($koneksi);
}
?>