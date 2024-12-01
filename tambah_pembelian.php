<?php
include 'koneksi.php';

// Start transaction
mysqli_begin_transaction($koneksi);

try {
    // Insert ke tabel pembelian
    $tanggal = $_POST['Tgl_Pembelian'];
    $supplier = $_POST['Id_Supplier'];
    $total = $_POST['Total_Harga'];
    $status = $_POST['Status_Pembelian'];

    $query_pembelian = "INSERT INTO pembelian (Tgl_Pembelian, Id_Supplier, Total_Harga, Status_Pembelian) 
                        VALUES ('$tanggal', '$supplier', '$total', '$status')";
    
    mysqli_query($koneksi, $query_pembelian);
    $id_pembelian = mysqli_insert_id($koneksi);

    // Insert ke tabel detail_pembelian
    $id_barang = $_POST['Id_Barang'];
    $jumlah = $_POST['Jumlah'];
    $harga_satuan = $_POST['Harga_Satuan'];
    $subtotal = $_POST['Subtotal'];

    for($i = 0; $i < count($id_barang); $i++) {
        if($id_barang[$i] != '') {
            $query_detail = "INSERT INTO detail_pembelian (Id_Pembelian, Id_Barang, Jumlah, Harga_Satuan, Subtotal) 
                            VALUES ('$id_pembelian', '$id_barang[$i]', '$jumlah[$i]', '$harga_satuan[$i]', '$subtotal[$i]')";
            mysqli_query($koneksi, $query_detail);
        }
    }

    // Commit transaction
    mysqli_commit($koneksi);
    echo "<script>alert('Data pembelian berhasil ditambahkan!');window.location='pembelian_barang.php';</script>";

} catch (Exception $e) {
    // Rollback transaction if error occurs
    mysqli_rollback($koneksi);
    echo "<script>alert('Gagal menambahkan data pembelian!');window.location='pembelian_barang.php';</script>";
}
?>