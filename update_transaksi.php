<?php 
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$Id_Transaksi = $_POST['Id_Transaksi'];

// update data ke database
mysqli_query($koneksi, "UPDATE transaksi SET Status='succes' WHERE Id_Transaksi='$Id_Transaksi'");

// mengalihkan halaman kembali ke index.php
header("location:kasir.php");
exit();
?>