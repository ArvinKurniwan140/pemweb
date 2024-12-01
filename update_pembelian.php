<?php
include 'koneksi.php';

// Mengambil data dari form
$id_pembelian = $_POST['Id_Pembelian'];
$tanggal = $_POST['Tgl_Pembelian'];
$supplier = $_POST['Id_Supplier'];
$total = $_POST['Total_Harga'];
$status = $_POST['Status_Pembelian'];

// Query update data
$query = "UPDATE pembelian SET 
            Tgl_Pembelian = '$tanggal',
            Id_Supplier = '$supplier',
            Total_Harga = '$total',
            Status_Pembelian = '$status'
          WHERE Id_Pembelian = '$id_pembelian'";

$hasil = mysqli_query($koneksi, $query);

if($hasil) {
    echo "<script>alert('Data berhasil diupdate!');window.location='pembelian_barang.php';</script>";
} else {
    echo "<script>alert('Gagal mengupdate data!');window.location='edit_pembelian.php?id=".$id_pembelian."';</script>";
}
?>