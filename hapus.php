<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");

    if ($query) {
        echo "<script>
            alert('Data buku berhasil dihapus!');
            window.location='dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
            window.location='dashboard.php';
        </script>";
    }
} else {
    header("Location: dashboard.php");
}
?>