<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$Tanggal = $_POST['Tanggal'];
$Jumlah = $_POST['Jumlah'];
$Keterangan = $_POST['Keterangan'];
$Kategori = $_POST['Kategori'];
$Id_Kasir = $_POST['Id_Kasir'];
$Id_Supplier = $_POST['Id_Supplier'];
$Id_Pembelian = $_POST['Id_Pembelian'];


// Hapus Id_Barang dari values dan sebutkan kolom yang akan diisi
$query = "INSERT INTO pengeluaran (Tanggal, Jumlah, Keterangan, Kategori, Id_Kasir, Id_Supplier, Id_Pembelian) 
          VALUES ('$Tanggal', '$Jumlah', '$Keterangan', '$Kategori','$Id_Kasir','$Id_Supplier', '$Id_Pembelian')";

// Eksekusi query
if(mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect ke index.php
    header("location:pengeluaran.php");
    exit();
} else {
    // Jika gagal, tampilkan error
    echo "Error: " . mysqli_error($koneksi);
}
?>