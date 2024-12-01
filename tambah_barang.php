<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$Nama_Barang = $_POST['Nama_Barang'];
$Harga_Beli = $_POST['Harga_Beli'];
$Harga_Jual = $_POST['Harga_Jual'];
$Stok = $_POST['Stok'];
$Jenis_Barang = $_POST['Jenis_Barang'];
$Tanggal_Kadaluarsa = $_POST['Tanggal_Kadaluarsa'];
$Satuan = $_POST['Satuan'];
$Id_Rak = $_POST['Id_Rak'];

// Hapus Id_Barang dari values dan sebutkan kolom yang akan diisi
$query = "INSERT INTO barang (Nama_Barang, Harga_Beli, Harga_Jual, Jenis_Barang, Satuan, Stok, Tanggal_Kadaluarsa, Id_Rak) 
          VALUES ('$Nama_Barang', '$Harga_Beli', '$Harga_Jual', '$Jenis_Barang', '$Satuan', '$Stok', '$Tanggal_Kadaluarsa','$Id_Rak')";

// Eksekusi query
if(mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect ke index.php
    header("location:barang.php");
    exit();
} else {
    // Jika gagal, tampilkan error
    echo "Error: " . mysqli_error($koneksi);
}
?>