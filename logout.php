<?php
session_start();

// Menghapus seluruh session yang tersimpan
session_unset();
session_destroy();

echo "<script>
    alert('Anda telah berhasil keluar dari sistem perpustakaan.');
    window.location='login.php';
</script>";
?>