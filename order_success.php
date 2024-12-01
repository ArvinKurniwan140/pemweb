<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['Level'] != "Member") {
    header("location:loginM.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("location:pembelian.php");
    exit();
}

$id_transaksi = mysqli_real_escape_string($koneksi, $_GET['id']);
$id_member = $_SESSION['Id_Member'];

// Get transaction details
$query_trans = "SELECT t.*, m.Nama, m.Telepon, m.Alamat 
                FROM transaksi t 
                JOIN member m ON t.Id_Member = m.Id_Member 
                WHERE t.Id_Transaksi = '$id_transaksi' 
                AND t.Id_Member = '$id_member' 
                AND t.status = 'Selesai'";
$result_trans = mysqli_query($koneksi, $query_trans);

if (!$result_trans || mysqli_num_rows($result_trans) == 0) {
    header("location:pembelian.php");
    exit();
}

$trans = mysqli_fetch_assoc($result_trans);

$query_member = "SELECT Alamat FROM member WHERE Id_Member = '$id_member'";
$result_member = mysqli_query($koneksi, $query_member);
$member = mysqli_fetch_assoc($result_member);
$alamat_pengiriman = $member['Alamat'];

// Get order items
$query_items = "SELECT dt.*, b.Nama_Barang, b.Harga_Jual 
                FROM detail_transaksi dt 
                JOIN barang b ON dt.Id_Barang = b.Id_Barang 
                WHERE dt.Id_Transaksi = '$id_transaksi'";
$result_items = mysqli_query($koneksi, $query_items);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Success Message -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Thank You For Your Order!</h2>
                <p class="text-gray-600">Your order has been successfully placed.</p>
            </div>

            <!-- Order Items -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-xl font-semibold mb-4">Order Items</h3>
    <div class="divide-y">
        <?php 
        $total = 0;
        while ($item = mysqli_fetch_assoc($result_items)) {
            $subtotal = (float)$item['Subtotal'];
            $total += $subtotal;
        ?>
        <div class="py-4 flex justify-between">
            <div>
                <p class="font-semibold"><?php echo htmlspecialchars($item['Nama_Barang']); ?></p>
                <p class="text-gray-600 text-sm">
                    <?php echo (int)$item['Jumlah']; ?> x 
                    Rp <?php echo number_format((float)$item['Harga_Jual'], 0, ',', '.'); ?>
                </p>
            </div>
            <div class="text-right">
                <p class="font-semibold">
                    Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                </p>
            </div>
        </div>
        <?php } ?>

        <!-- Price Summary -->
        <div class="py-4 space-y-3">
            <div class="flex justify-between text-gray-600">
                <p>Subtotal</p>
                <p>Rp <?php echo number_format($total, 0, ',', '.'); ?></p>
            </div>
            <div class="flex justify-between text-gray-600">
                <p>Discount</p>
                <p>Rp <?php echo number_format((float)$trans['Diskon'], 0, ',', '.'); ?></p>
            </div>
            <div class="flex justify-between text-gray-600">
                <p>Tax (3%)</p>
                <p>Rp <?php echo number_format((float)$trans['Fee'], 0, ',', '.'); ?></p>
            </div>
            <div class="flex justify-between font-bold text-lg">
                <p>Total After Discount & Tax</p>
                <p>Rp <?php echo number_format((float)$trans['Total_Harga'], 0, ',', '.'); ?></p>
            </div>
            <div class="flex justify-between text-gray-600">
                <p>Payment Amount</p>
                <p>Rp <?php echo number_format((float)$trans['Uang_Bayar'], 0, ',', '.'); ?></p>
            </div>
            <div class="flex justify-between text-gray-600">
                <p>Change</p>
                <p>Rp <?php echo number_format((float)$trans['Uang_Kembali'], 0, ',', '.'); ?></p>
            </div>
        </div>
    </div>
</div>

            <!-- Actions -->
            <div class="text-center">
                <a href="index.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</body>
</html>