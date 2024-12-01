<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['Id_Barang'];
    $jumlah = $_POST['Jumlah'];
    $id_member = $_SESSION['Id_Member'];
    
    // Cek stok barang
    $query_stok = "SELECT Stok, Harga_Jual FROM barang WHERE Id_Barang = '$id_barang'";
    $result_stok = mysqli_query($koneksi, $query_stok);
    $barang = mysqli_fetch_assoc($result_stok);
    
    if ($jumlah <= $barang['Stok']) {
        // Cek apakah sudah ada transaksi yang belum selesai
        $query_cek = "SELECT * FROM transaksi 
                      WHERE Id_Member = '$id_member' 
                      AND Status = 'pending'";
        $result_cek = mysqli_query($koneksi, $query_cek);
        
        if (mysqli_num_rows($result_cek) == 0) {
            // Buat transaksi baru
            $tanggal = date('Y-m-d H:i:s');
            $query_transaksi = "INSERT INTO transaksi (Id_Member, Tgl_Transaksi, Status) 
                               VALUES ('$id_member', '$tanggal', 'pending')";
            mysqli_query($koneksi, $query_transaksi);
            $id_transaksi = mysqli_insert_id($koneksi);
        } else {
            $transaksi = mysqli_fetch_assoc($result_cek);
            $id_transaksi = $transaksi['Id_Transaksi'];
        }
        
        // Cek apakah barang sudah ada di detail_transaksi
        $query_cek_detail = "SELECT * FROM detail_transaksi 
                            WHERE Id_Transaksi = '$id_transaksi' 
                            AND Id_Barang = '$id_barang'";
        $result_cek_detail = mysqli_query($koneksi, $query_cek_detail);
        
        if (mysqli_num_rows($result_cek_detail) > 0) {
            // Update jumlah jika barang sudah ada
            $detail = mysqli_fetch_assoc($result_cek_detail);
            $jumlah_baru = $detail['Jumlah'] + $jumlah;
            $subtotal = $jumlah_baru * $barang['Harga_Jual'];
            
            $query_update = "UPDATE detail_transaksi 
                            SET Jumlah = '$jumlah_baru', Subtotal = '$subtotal' 
                            WHERE Id_Transaksi = '$id_transaksi' 
                            AND Id_Barang = '$id_barang'";
            mysqli_query($koneksi, $query_update);
        } else {
            // Insert barang baru ke detail_transaksi
            $subtotal = $jumlah * $barang['Harga_Jual'];
            $query_detail = "INSERT INTO detail_transaksi 
                            (Id_Transaksi, Id_Barang, Jumlah, Subtotal) 
                            VALUES ('$id_transaksi', '$id_barang', '$jumlah', '$subtotal')";
            mysqli_query($koneksi, $query_detail);
        }

        // Update stok barang (dikurangi)
        $stok_baru = $barang['Stok'] - $jumlah;
        $query_update_stok = "UPDATE barang 
                             SET Stok = '$stok_baru' 
                             WHERE Id_Barang = '$id_barang'";
        mysqli_query($koneksi, $query_update_stok);

        // Update total harga
        $query_total = "SELECT SUM(Subtotal) as total 
                       FROM detail_transaksi 
                       WHERE Id_Transaksi = '$id_transaksi'";
        $result_total = mysqli_query($koneksi, $query_total);
        $row_total = mysqli_fetch_assoc($result_total);
        $total_harga = $row_total['total'];

        // Update total di tabel transaksi
        $query_update_total = "UPDATE transaksi 
                              SET Total_Harga = '$total_harga'
                              WHERE Id_Transaksi = '$id_transaksi'";
        mysqli_query($koneksi, $query_update_total);
        
        echo "<script>
                alert('Barang berhasil ditambahkan ke keranjang!');
                window.location='barang.php';
              </script>";
    } else {
        echo "<script>
                alert('Stok tidak mencukupi!');
                window.location='barang.php';
              </script>";
    }
}
?>