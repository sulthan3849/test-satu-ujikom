<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "DELETE FROM Berobat WHERE No_Transaksi = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: listberobat.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: listberobat.php");
    exit();
}
?>
