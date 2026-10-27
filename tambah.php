<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $judul        = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $pengarang    = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $penerbit     = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun_terbit = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
    $stok         = (int)$_POST['stok'];

    $query = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, stok) 
              VALUES ('$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$stok')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
            alert('Data buku berhasil ditambahkan!');
            window.location='dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menambah data: " . mysqli_error($koneksi) . "');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku Baru - Perpustakaan</title>
</head>
<body>
    <h2>Form Tambah Buku Baru</h2>
    <form action="" method="POST">
        <p>
            <label>Judul Buku:</label><br>
            <input type="text" name="judul" required>
        </p>
        <p>
            <label>Pengarang:</label><br>
            <input type="text" name="pengarang" required>
        </p>
        <p>
            <label>Penerbit:</label><br>
            <input type="text" name="penerbit" required>
        </p>
        <p>
            <label>Tahun Terbit:</label><br>
            <input type="text" name="tahun_terbit" maxlength="4" required>
        </p>
        <p>
            <label>Stok Buku:</label><br>
            <input type="number" name="stok" required>
        </p>
        <p>
            <button type="submit" name="simpan">Simpan Data</button>
            <a href="dashboard.php">Batal</a>
        </p>
    </form>
</body>
</html>