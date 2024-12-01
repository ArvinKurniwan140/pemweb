<?php 
session_start();
include 'koneksi.php';

// Mendeteksi dari mana login berasal (kasir atau member) dengan menambahkan hidden input
$login_source = $_POST['login_source'];

// menangkap data yang dikirim dari form login
$username = mysqli_real_escape_string($koneksi, $_POST['Username']);
$password = md5($_POST['Password']);

if($login_source == "Kasir") {
    // Query untuk kasir
    $query = "SELECT * FROM kasir WHERE Username='$username' AND Password='$password'";
    $result = mysqli_query($koneksi, $query);
    
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Set session untuk kasir
        $_SESSION['Username'] = $username;
        $_SESSION['Nama_Kasir'] = $row['Nama_Kasir'];
        $_SESSION['Id_Kasir'] = $row['Id_Kasir'];
        $_SESSION['Level'] = "Kasir";
        $_SESSION['status'] = "login";
        
        header("location:index.php");
        exit();
    } else {
        // Jika login kasir gagal
        echo "<script>alert('Login gagal! Username atau password tidak benar');</script>";
        echo "<script>window.location='login.php';</script>"; // Redirect ke halaman login kasir
        exit();
    }
} 
else if($login_source == "Member") {
    // Query untuk member
    $query = "SELECT * FROM member WHERE Username='$username' AND Password='$password'";
    $result = mysqli_query($koneksi, $query);
    
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Set session untuk member
        $_SESSION['Username'] = $username;
        $_SESSION['Nama'] = $row['Nama'];
        $_SESSION['Id_Member'] = $row['Id_Member'];
        $_SESSION['Level'] = "Member";
        $_SESSION['status'] = "login";
        
        header("location:index.php");
        exit();
    } else {
        // Jika login member gagal
        echo "<script>alert('Login gagal! Username atau password tidak benar');</script>";
        echo "<script>window.location='loginM.php';</script>"; // Redirect ke halaman login member
        exit();
    }
}
?>