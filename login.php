<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    $data  = mysqli_fetch_assoc($query);

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['status_login'] = true;
        $_SESSION['username']     = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];

        echo "<script>
            alert('Selamat Datang, " . $data['nama_lengkap'] . "!');
            window.location='dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Username atau Password salah!');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Perpustakaan - SMK Muhammadiyah 3 South Tangerang</title>
</head>
<body>
    <h2>Login Portal Perpustakaan</h2>
    <form action="" method="POST">
        <p>
            <label>Username:</label><br>
            <input type="text" name="username" required>
        </p>
        <p>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </p>
        <p>
            <button type="submit" name="login">Masuk Sistem</button>
        </p>
    </form>
    <p>Belum terdaftar sebagai petugas? <a href="register.php">Daftar di sini</a></p>
</body>
</html>