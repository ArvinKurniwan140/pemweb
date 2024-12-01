<?php
session_start();
include 'koneksi.php';

// Validasi login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['Level'] != "Member") {
    header("location:loginM.php");
    exit();
}

if (isset($_GET['id_transaksi']) && isset($_GET['Id_Barang'])) {
    $id_transaksi = mysqli_real_escape_string($koneksi, $_GET['id_transaksi']);
    $id_barang = mysqli_real_escape_string($koneksi, $_GET['Id_Barang']);
    $id_member = $_SESSION['Id_Member'];

    // Validasi kepemilikan transaksi
    $query_validate = "SELECT t.Status, dt.Jumlah 
                      FROM transaksi t 
                      JOIN detail_transaksi dt ON t.Id_Transaksi = dt.Id_Transaksi 
                      WHERE t.Id_Transaksi = '$id_transaksi' 
                      AND t.Id_Member = '$id_member' 
                      AND dt.Id_Barang = '$id_barang'
                      AND t.Status = 'pending'";
    $result_validate = mysqli_query($koneksi, $query_validate);

    if (mysqli_num_rows($result_validate) > 0) {
        $row_validate = mysqli_fetch_assoc($result_validate);
        $jumlah_kembali = $row_validate['Jumlah'];

        // Mulai transaction untuk memastikan data konsisten
        mysqli_begin_transaction($koneksi);

        try {
            // Kembalikan stok barang
            $query_update_stok = "UPDATE barang 
                                 SET Stok = Stok + $jumlah_kembali 
                                 WHERE Id_Barang = '$id_barang'";
            if (!mysqli_query($koneksi, $query_update_stok)) {
                throw new Exception("Gagal mengupdate stok");
            }

            // Get the subtotal before deleting
            $query_subtotal = "SELECT Subtotal FROM detail_transaksi 
                             WHERE Id_Transaksi = '$id_transaksi' 
                             AND Id_Barang = '$id_barang'";
            $result_subtotal = mysqli_query($koneksi, $query_subtotal);
            if (!$result_subtotal) {
                throw new Exception("Gagal mengambil subtotal");
            }
            $row_subtotal = mysqli_fetch_assoc($result_subtotal);
            $subtotal = $row_subtotal['Subtotal'];

            // Delete the item from detail_transaksi
            $query_delete = "DELETE FROM detail_transaksi 
                            WHERE Id_Transaksi = '$id_transaksi' 
                            AND Id_Barang = '$id_barang'";
            if (!mysqli_query($koneksi, $query_delete)) {
                throw new Exception("Gagal menghapus item");
            }

            // Check if there are any items left in the transaction
            $query_check = "SELECT COUNT(*) as count 
                           FROM detail_transaksi 
                           WHERE Id_Transaksi = '$id_transaksi'";
            $result_check = mysqli_query($koneksi, $query_check);
            if (!$result_check) {
                throw new Exception("Gagal memeriksa sisa item");
            }
            $row_check = mysqli_fetch_assoc($result_check);

            if ($row_check['count'] == 0) {
                // If no items left, delete the transaction
                $query_delete_trans = "DELETE FROM transaksi 
                                     WHERE Id_Transaksi = '$id_transaksi' 
                                     AND Id_Member = '$id_member'";
                if (!mysqli_query($koneksi, $query_delete_trans)) {
                    throw new Exception("Gagal menghapus transaksi");
                }
            } else {
                // Update the total in transaksi table
                $query_update = "UPDATE transaksi 
                               SET Total_Harga = Total_Harga - $subtotal 
                               WHERE Id_Transaksi = '$id_transaksi' 
                               AND Id_Member = '$id_member'";
                if (!mysqli_query($koneksi, $query_update)) {
                    throw new Exception("Gagal mengupdate total harga");
                }
            }

            // Commit transaction
            mysqli_commit($koneksi);
            
            $_SESSION['success'] = "Item berhasil dihapus dari keranjang";
            header("location:pembelian.php");
            exit();

        } catch (Exception $e) {
            // Rollback transaction jika terjadi error
            mysqli_rollback($koneksi);
            $_SESSION['error'] = "Gagal menghapus item: " . $e->getMessage();
            header("location:pembelian.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Transaksi tidak valid atau sudah diproses";
        header("location:pembelian.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Parameter tidak lengkap";
    header("location:pembelian.php");
    exit();
}
?>