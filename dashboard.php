<?php
session_start();
include 'koneksi.php';

// Proteksi Halaman: Wajib Login
if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Informasi Perpustakaan SMK Muhammadiyah 3 South Tangerang</title>
</head>
<body>
    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>!</h2>
    <p>Sistem Informasi Katalog & Kelola Data Perpustakaan SMK Muhammadiyah 3 South Tangerang</p>
    <hr>

    <p>
        <a href="tambah.php">+ Tambah Koleksi Buku Baru</a> | 
        <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar dari sistem?')">Logout</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['judul']); ?></td>
                        <td><?php echo htmlspecialchars($row['pengarang']); ?></td>
                        <td><?php echo htmlspecialchars($row['penerbit']); ?></td>
                        <td><?php echo htmlspecialchars($row['tahun_terbit']); ?></td>
                        <td><?php echo htmlspecialchars($row['stok']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                            <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
                        </td>
                    </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='7' align='center'>Belum ada data buku tersimpan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>