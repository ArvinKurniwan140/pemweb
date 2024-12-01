<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$Nama = $_POST['Nama'];
$Email = $_POST['Email'];
$Alamat = $_POST['Alamat'];
$Telepon = $_POST['Telepon'];
$Username = $_POST['Username'];
$password = md5($_POST['Password']);


// Hapus Id_Barang dari values dan sebutkan kolom yang akan diisi
$query = "INSERT INTO member (Nama, Email, Alamat, Telepon, Username, Password) 
          VALUES ('$Nama', '$Email', '$Alamat', '$Telepon','$Username','$password')";

// Eksekusi query
if(mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect ke index.php
    header("location:member.php");
    exit();
} else {
    // Jika gagal, tampilkan error
    echo "Error: " . mysqli_error($koneksi);
}
?>