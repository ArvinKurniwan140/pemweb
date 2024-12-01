<?php 
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['Id_Barang'];
$nama = $_POST['Nama_Barang'];
$harga_beli = $_POST['Harga_Beli'];
$harga_jual = $_POST['Harga_Jual'];
$stok = $_POST['Stok'];
$jenis = $_POST['Jenis_Barang'];
$tanggal = $_POST['Tanggal_Kadaluarsa'];
$satuan = $_POST['Satuan'];

// update data ke database
mysqli_query($koneksi, "UPDATE barang SET  
    Nama_Barang='$nama', 
    Harga_Beli='$harga_beli', 
    Harga_Jual='$harga_jual', 
    Stok='$stok', 
    Jenis_Barang='$jenis', 
    Tanggal_Kadaluarsa='$tanggal', 
    Satuan='$satuan' 
    WHERE Id_Barang='$id'");

// mengalihkan halaman kembali ke index.php
header("location:barang.php");
exit();
?>