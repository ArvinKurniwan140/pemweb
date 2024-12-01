<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['Level'] != "Member") {
    header("location:login_member.php");
    exit();
}

$id_member = $_SESSION['Id_Member'];
$uang_bayar = $_POST['Uang_Bayar'];

// Ambil data transaksi yang masih pending
$query = "SELECT t.Id_Transaksi, t.Tgl_Transaksi, dt.Id_Barang, b.Nama_Barang, 
          dt.Jumlah, b.Harga_Jual, dt.Subtotal 
          FROM transaksi t 
          JOIN detail_transaksi dt ON t.Id_Transaksi = dt.Id_Transaksi
          JOIN barang b ON dt.Id_Barang = b.Id_Barang
          WHERE t.id_member = '$id_member' AND t.status = 'pending'";
$result = mysqli_query($koneksi, $query);

$total = 0;
while($row = mysqli_fetch_assoc($result)) {
    $total += $row['Subtotal'];
}

// Hitung diskon dan pajak
$diskon = ($total > 100000) ? 0.1 : 0; // 10% diskon jika total > 100.000
$pajak = 0.05; // 5% pajak
$total_bayar = $total - ($total * $diskon) + ($total * $pajak);
$uang_kembali = $uang_bayar - $total_bayar;

if ($uang_bayar >= $total_bayar) {
    // Ubah status transaksi menjadi 'selesai'
    $query_update = "UPDATE transaksi SET status = 'selesai' WHERE Id_Member = '$id_member' AND status = 'pending'";
    mysqli_query($koneksi, $query_update);

    echo "<script>
            alert('Pembayaran berhasil! Uang kembali: Rp " . number_format($uang_kembali, 0, ',', '.') . "');
            window.location='index.php';
          </script>";
} else {
    echo "<script>
            alert('Uang bayar tidak mencukupi!');
            window.location='pembelian.php';
          </script>";
}
?>