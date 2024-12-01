<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$Nama_Supplier = $_POST['Nama_Supplier'];
$Alamat = $_POST['Alamat'];
$Telepon = $_POST['Telepon'];
$Email = $_POST['Email'];
$Npwp = $_POST['Npwp'];


// Hapus Id_Barang dari values dan sebutkan kolom yang akan diisi
$query = "INSERT INTO supplier (Nama_Supplier, Alamat, Telepon, Email, Npwp) 
          VALUES ('$Nama_Supplier', '$Alamat', '$Telepon', '$Email', '$Npwp')";

// Eksekusi query
if(mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect ke index.php
    header("location:supplier.php");
    exit();
} else {
    // Jika gagal, tampilkan error
    echo "Error: " . mysqli_error($koneksi);
}
?>