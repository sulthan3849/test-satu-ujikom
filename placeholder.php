<?php
include 'header.php';
$title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'Halaman';
?>

<h2><?php echo $title; ?></h2>
<div style="background-color: #fff3cd; color: #856404; padding: 15px; border: 1px solid #ffeeba; border-radius: 4px; margin-top: 20px;">
    <strong>Informasi:</strong> Halaman ini belum tersedia (Under Construction). Berdasarkan spesifikasi instruksi Ujikom (hanya fokus di modul Berobat), modul master data ini tidak wajib diselesaikan dan hanya bertindak sebagai komponen navigasi antarmuka. 
    <br><br>
    Silakan kunjungi <a href="listberobat.php" style="color: #0056b3; text-decoration: underline;">Modul Utama: Berobat</a>.
</div>

<?php
include 'footer.php';
?>
