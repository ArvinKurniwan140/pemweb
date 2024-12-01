<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['Level'] != "Member") {
    header("location:login_member.php");
    exit();
}

$id_member = $_SESSION['Id_Member'];

// Get pending transaction
$query_trans = "SELECT t.*, m.Nama, m.Alamat, m.Telepon 
                FROM transaksi t 
                JOIN member m ON t.Id_Member = m.Id_Member 
                WHERE t.Id_Member = '$id_member' AND t.status = 'pending'";
$result_trans = mysqli_query($koneksi, $query_trans);

if (!$result_trans || mysqli_num_rows($result_trans) == 0) {
    header("location:pembelian.php");
    exit();
}

$trans = mysqli_fetch_assoc($result_trans);
$id_transaksi = $trans['Id_Transaksi'];

// Hitung total dari detail_transaksi
$query_total = "SELECT SUM(Subtotal) as total 
                FROM detail_transaksi 
                WHERE Id_Transaksi = '$id_transaksi'";
$result_total = mysqli_query($koneksi, $query_total);
$row_total = mysqli_fetch_assoc($result_total);
$total_harga = floatval($row_total['total']); // Total sebelum pajak dan diskon

// Hitung diskon dan pajak
$diskon = ($total_harga > 100000) ? ($total_harga * 0.1) : 0;
$fee = $total_harga * 0.03;
$subtotal = $total_harga - $diskon + $fee; // Total setelah pajak dan diskon

// Fungsi untuk menambah point member
function addMemberPoints($koneksi, $id_member, $points_to_add = 10) {
    // Update point di tabel member
    $update_query = "UPDATE member SET Point = Point + ? WHERE Id_Member = ?";
    $stmt = mysqli_prepare($koneksi, $update_query);
    mysqli_stmt_bind_param($stmt, "ii", $points_to_add, $id_member);
    return mysqli_stmt_execute($stmt);
}



// Process checkout if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_POST['uang_bayar'])) {
        echo "<script>alert('Semua field harus diisi!');</script>";
        exit();
    }
    
    $alamat_pengiriman = mysqli_real_escape_string($koneksi, $trans['Alamat']);
    $uang_bayar = floatval($_POST['uang_bayar']);
    
    // Validasi uang bayar
    if($uang_bayar < $subtotal) {
        echo "<script>alert('Uang bayar kurang!');</script>";
        exit();
    }
    
    $uang_kembali = $uang_bayar - $subtotal;
    
    // Update transaction details dengan prepared statement
    $query_update = $koneksi->prepare("
        UPDATE transaksi SET 
        status = 'proses',
        Alamat_Pengiriman = ?,
        Total_Harga = ?,
        Diskon = ?,
        Fee = ?,
        Uang_Bayar = ?,
        Uang_Kembali = ?,
        Tgl_Transaksi = NOW()
        WHERE Id_Transaksi = ?
    ");
    
    $query_update->bind_param("sddddds", 
        $alamat_pengiriman,
        $total_harga,
        $diskon,
        $fee,
        $uang_bayar,
        $uang_kembali,
        $id_transaksi
    );
    
    
    if ($query_update->execute()) {
        addMemberPoints($koneksi, $_SESSION['Id_Member']);
        header("location:order_success.php?id=" . $id_transaksi);
        exit();
    } else {
        echo "<script>alert('Gagal memproses pesanan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function hitungKembalian() {
            const subtotal = <?php echo $subtotal; ?>;
            const uangBayar = parseFloat(document.getElementById('uang_bayar').value) || 0;
            const kembalian = uangBayar - subtotal;
            
            document.getElementById('kembalian').textContent = 
                kembalian >= 0 ? 
                'Rp ' + kembalian.toLocaleString('id-ID') : 
                'Uang bayar kurang!';
                
            document.getElementById('kembalian').style.color = 
                kembalian >= 0 ? 'green' : 'red';
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Checkout</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
                <div class="mb-4">
                    <table class="w-full">
                        <tbody>
                            <?php
                            $query_items = "SELECT dt.*, b.Nama_Barang, b.Harga_Jual 
                                          FROM detail_transaksi dt 
                                          JOIN barang b ON dt.Id_Barang = b.Id_Barang 
                                          WHERE dt.Id_Transaksi = '$id_transaksi'";
                            $result_items = mysqli_query($koneksi, $query_items);
                            while ($item = mysqli_fetch_assoc($result_items)) {
                            ?>
                            <tr>
                                <td class="py-2"><?php echo htmlspecialchars($item['Nama_Barang']); ?></td>
                                <td class="text-right">
                                    <?php echo (int)$item['Jumlah']; ?> x 
                                    Rp <?php echo number_format($item['Harga_Jual'], 0, ',', '.'); ?>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr class="border-t">
                                <td class="py-2 font-bold">Total Harga</td>
                                <td class="py-2 text-right font-bold">
                                    Rp <?php echo number_format($total_harga, 0, ',', '.'); ?>
                                </td>
                            </tr>
                            <?php if ($total_harga > 100000) { ?>
                            <tr>
                                <td class="py-2">Diskon (10%)</td>
                                <td class="py-2 text-right text-green-600">
                                    - Rp <?php echo number_format($diskon, 0, ',', '.'); ?>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td class="py-2">Biaya Layanan (3%)</td>
                                <td class="py-2 text-right">
                                    + Rp <?php echo number_format($fee, 0, ',', '.'); ?>
                                </td>
                            </tr>
                            <tr class="border-t">
                                <td class="py-2 font-bold">Subtotal</td>
                                <td class="py-2 text-right font-bold">
                                    Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Checkout Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4">Shipping & Payment</h3>
                <form method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Nama Penerima
                        </label>
                        <input type="text" value="<?php echo htmlspecialchars($trans['Nama']); ?>" 
                               class="w-full p-2 border rounded" readonly>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Nomor Telepon
                        </label>
                        <input type="text" value="<?php echo htmlspecialchars($trans['Telepon']); ?>" 
                               class="w-full p-2 border rounded" readonly>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Alamat Pengiriman
                        </label>
                        <textarea class="w-full p-2 border rounded bg-gray-50" 
                                rows="3" readonly><?php echo htmlspecialchars($trans['Alamat']); ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Uang Bayar
                        </label>
                        <input type="number" name="uang_bayar" id="uang_bayar"
                               min="<?php echo $subtotal; ?>" 
                               class="w-full p-2 border rounded"
                               required
                               onkeyup="hitungKembalian()"
                               onchange="hitungKembalian()">
                        <p class="mt-1 text-sm">
                            Kembalian: <span id="kembalian">Rp 0</span>
                        </p>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>