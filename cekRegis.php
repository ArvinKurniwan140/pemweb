<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kasir = mysqli_real_escape_string($koneksi, $_POST['Nama_Kasir']);
    $email = mysqli_real_escape_string($koneksi, $_POST['Email']);
    $username = mysqli_real_escape_string($koneksi, $_POST['Username']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['Alamat']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['Telepon']);
    $tgl_kerja = mysqli_real_escape_string($koneksi, $_POST['Tgl_Mulai_Kerja']);
    $password = md5($_POST['Password']);
    
    
    // Cek username atau email duplikat
    $check_query = "SELECT * FROM kasir WHERE Username = '$username' OR Email = '$email'";
    $check_result = mysqli_query($koneksi, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Username atau email sudah terdaftar!');
                window.location.href='register.php';
              </script>";
    } else {
        // Insert data ke database
        $query = "INSERT INTO kasir (Nama_Kasir, Email, Username, Password, Alamat, Telepon, Tgl_Mulai_Kerja) 
                 VALUES ('$nama_kasir', '$email', '$username', '$password', '$alamat', '$telepon', '$tgl_kerja')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location.href='login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Registrasi gagal! Silakan coba lagi.');
                    window.location.href='register.php';
                  </script>";
        }
    }
}
?>