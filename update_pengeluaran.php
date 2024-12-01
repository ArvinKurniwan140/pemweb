<?php
include 'koneksi.php';

// Mengambil data dari form
$id_Pengeluaran = $_POST['Id_Pengeluaran'];
$tanggal = $_POST['Tanggal'];
$supplier = $_POST['Id_Supplier'];
$kasir = $_POST['Id_Kasir'];
$pembelian = $_POST['Id_Pembelian'];
$Jumlah = $_POST['Jumlah'];
$Keterangan = $_POST['Keterangan'];
$Kategori = $_POST['Kategori'];

// Query update data
$query = "UPDATE pengeluaran SET 
            Tanggal = '$tanggal',
            Id_Supplier = '$supplier',
            Jumlah = '$Jumlah',
            Keterangan = '$Keterangan',
            Kategori = '$Kategori',
            Id_Kasir = '$kasir',
            Id_Pembelian = '$pembelian'
          WHERE Id_Pengeluaran = '$id_Pengeluaran'";

$hasil = mysqli_query($koneksi, $query);

if($hasil) {
    echo "<script>alert('Data berhasil diupdate!');window.location='pengeluaran.php';</script>";
} else {
    echo "<script>alert('Gagal mengupdate data!');window.location='edit_pengeluaran.php?id=".$id_pembelian."';</script>";
}
?>