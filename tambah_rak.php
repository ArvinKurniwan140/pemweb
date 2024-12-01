<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$Nama_Rak = $_POST['Nama_Rak'];
$Kapasitas = $_POST['Kapasitas'];


// Hapus Id_Barang dari values dan sebutkan kolom yang akan diisi
$query = "INSERT INTO rak (Nama_Rak, Kapasitas) 
          VALUES ('$Nama_Rak', '$Kapasitas')";

// Eksekusi query
if(mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect ke index.php
    header("location:rak.php");
    exit();
} else {
    // Jika gagal, tampilkan error
    echo "Error: " . mysqli_error($koneksi);
}
?>