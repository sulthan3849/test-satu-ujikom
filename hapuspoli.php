<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Pengecekan relasi dengan tabel Dokter
    $check = mysqli_query($conn, "SELECT * FROM Dokter WHERE Poli_ID = '$id'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Gagal menghapus: Poli masih digunakan oleh Dokter!'); window.location.href='poli.php';</script>";
        exit();
    }
    
    $sql_delete = "DELETE FROM Poli WHERE Poli_ID = '$id'";
    mysqli_query($conn, $sql_delete);
}
header("Location: poli.php");
exit();
?>
