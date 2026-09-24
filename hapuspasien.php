<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Pengecekan relasi dengan tabel Berobat
    $check = mysqli_query($conn, "SELECT * FROM Berobat WHERE PasienKlinik_ID = '$id'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Gagal menghapus: Pasien masih memiliki riwayat transaksi berobat!'); window.location.href='pasien.php';</script>";
        exit();
    }
    
    $sql_delete = "DELETE FROM Pasien WHERE PasienKlinik_ID = '$id'";
    mysqli_query($conn, $sql_delete);
}
header("Location: pasien.php");
exit();
?>
