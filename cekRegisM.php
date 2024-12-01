<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($koneksi, $_POST['Nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['Email']);
    $username = mysqli_real_escape_string($koneksi, $_POST['Username']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['Alamat']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['Telepon']);
    $password = md5($_POST['Password']);
    
    
    // Cek username atau email duplikat
    $check_query = "SELECT * FROM member WHERE Username = '$username' OR Email = '$email'";
    $check_result = mysqli_query($koneksi, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Username atau email sudah terdaftar!');
                window.location.href='registerM.php';
              </script>";
    } else {
        // Insert data ke database
        $query = "INSERT INTO member (Nama, Email, Username, Password, Alamat, Telepon) 
                 VALUES ('$nama', '$email', '$username', '$password', '$alamat', '$telepon')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location.href='loginM.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Registrasi gagal! Silakan coba lagi.');
                    window.location.href='registerM.php';
                  </script>";
        }
    }
}
?>