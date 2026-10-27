<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID dari URL
$id = $_GET['id'];
$query_get = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");
$data = mysqli_fetch_assoc($query_get);

if (!$data) {
    echo "<script>
        alert('Data buku tidak ditemukan!');
        window.location='dashboard.php';
    </script>";
    exit();
}

if (isset($_POST['update'])) {
    $judul        = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $pengarang    = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $penerbit     = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun_terbit = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
    $stok         = (int)$_POST['stok'];

    $query_update = "UPDATE buku SET 
                        judul='$judul', 
                        pengarang='$pengarang', 
                        penerbit='$penerbit', 
                        tahun_terbit='$tahun_terbit', 
                        stok='$stok' 
                     WHERE id='$id'";

    $result = mysqli_query($koneksi, $query_update);

    if ($result) {
        echo "<script>
            alert('Data buku berhasil diperbarui!');
            window.location='dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal mengedit data: " . mysqli_error($koneksi) . "');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Buku - Perpustakaan</title>
</head>
<body>
    <h2>Form Edit Data Buku</h2>
    <form action="" method="POST">
        <p>
            <label>Judul Buku:</label><br>
            <input type="text" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" required>
        </p>
        <p>
            <label>Pengarang:</label><br>
            <input type="text" name="pengarang" value="<?php echo htmlspecialchars($data['pengarang']); ?>" required>
        </p>
        <p>
            <label>Penerbit:</label><br>
            <input type="text" name="penerbit" value="<?php echo htmlspecialchars($data['penerbit']); ?>" required>
        </p>
        <p>
            <label>Tahun Terbit:</label><br>
            <input type="text" name="tahun_terbit" maxlength="4" value="<?php echo htmlspecialchars($data['tahun_terbit']); ?>" required>
        </p>
        <p>
            <label>Stok Buku:</label><br>
            <input type="number" name="stok" value="<?php echo htmlspecialchars($data['stok']); ?>" required>
        </p>
        <p>
            <button type="submit" name="update">Update Data</button>
            <a href="dashboard.php">Batal</a>
        </p>
    </form>
</body>
</html>