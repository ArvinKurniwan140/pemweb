<?php
include 'koneksi.php';

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    header('Location: pembelian.php');
    exit();
}

$id_pembelian = $_GET['id'];

// Mulai transaction
mysqli_begin_transaction($koneksi);

try {
    // Hapus detail pembelian terlebih dahulu (karena merupakan child table)
    $query_hapus_detail = "DELETE FROM detail_pembelian WHERE Id_Pembelian = '$id_pembelian'";
    mysqli_query($koneksi, $query_hapus_detail);
    
    // Hapus data pembelian
    $query_hapus_pembelian = "DELETE FROM pembelian WHERE Id_Pembelian = '$id_pembelian'";
    mysqli_query($koneksi, $query_hapus_pembelian);
    
    // Commit transaction
    mysqli_commit($koneksi);
    
    // Redirect dengan pesan sukses
    header('Location: pembelian_barang.php?pesan=hapus_sukses');
} catch (Exception $e) {
    // Rollback jika terjadi error
    mysqli_rollback($koneksi);
    header('Location: pembelian_barang.php?pesan=hapus_gagal');
}
?>