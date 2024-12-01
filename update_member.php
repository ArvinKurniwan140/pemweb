<?php
include 'koneksi.php';

// Mengambil data dari form
$Id_Member = $_POST['Id_Member'];
$Tgl_Bergabung = $_POST['Tgl_Bergabung'];
$Nama = $_POST['Nama'];
$Email = $_POST['Email'];
$Alamat = $_POST['Alamat'];
$Telepon = $_POST['Telepon'];
$Point = $_POST['Point'];
$Username = $_POST['Username'];
$password = md5($_POST['Password']);

// Query update data
$query = "UPDATE member SET 
            Tgl_Bergabung = '$Tgl_Bergabung',
            Nama = '$Nama',
            Alamat = '$Alamat',
            Telepon = '$Telepon',
            Point = '$Point',
            Email = '$Email',
            Username = '$Username',
            Password = '$password'
          WHERE Id_Member = '$Id_Member'";

$hasil = mysqli_query($koneksi, $query);

if($hasil) {
    echo "<script>alert('Data berhasil diupdate!');window.location='member.php';</script>";
} else {
    echo "<script>alert('Gagal mengupdate data!');window.location='edit_member.php?id=".$id_pembelian."';</script>";
}
?>