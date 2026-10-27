<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password     = $_POST['password'];

    // Enkripsi password menggunakan standar industri
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (nama_lengkap, username, password) VALUES ('$nama_lengkap', '$username', '$password_hash')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
            alert('Registrasi petugas berhasil! Silakan login.');
            window.location='login.php';
        </script>";
    } else {
        echo "<script>
            alert('Registrasi gagal: " . mysqli_error($koneksi) . "');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Petugas Perpustakaan - SMK Muhammadiyah 3 South Tangerang</title>
</head>
<body>
    <h2>Registrasi Petugas Perpustakaan</h2>
    <form action="" method="POST">
        <p>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama_lengkap" required>
        </p>
        <p>
            <label>Username:</label><br>
            <input type="text" name="username" required>
        </p>
        <p>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </p>
        <p>
            <button type="submit" name="register">Daftar Sekarang</button>
        </p>
    </form>
    <p>Sudah memiliki akun petugas? <a href="login.php">Login di sini</a></p>
</body>
</html>