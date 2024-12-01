<?php
include 'koneksi.php';

// Mengambil data dari form
$Id_Kas = $_POST['Id_Kas'];
$tanggal = $_POST['Tanggal'];
$Shift = $_POST['Id_Shift'];
$kasir = $_POST['Id_Kasir'];
$Kas_Awal = $_POST['Kas_Awal'];
$Kas_Akhir = $_POST['Kas_Akhir'];
$Total_Penjualan = $_POST['Total_Penjualan'];

// Query update data
$query = "UPDATE kas SET 
            Tanggal = '$tanggal',
            Id_Shift = '$Shift',
            Kas_Awal = '$Kas_Awal',
            Kas_Akhir = '$Kas_Akhir',
            Total_Penjualan = '$Total_Penjualan',
            Id_Kasir = '$kasir'
          WHERE Id_Kas = '$Id_Kas'";

$hasil = mysqli_query($koneksi, $query);

if($hasil) {
    echo "<script>alert('Data berhasil diupdate!');window.location='kas.php';</script>";
} else {
    echo "<script>alert('Gagal mengupdate data!');window.location='edit_kas.php?id=".$id_pembelian."';</script>";
}
?>