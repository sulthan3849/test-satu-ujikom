<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $poli_id = mysqli_real_escape_string($conn, $_POST['poli_id']);
    $nama_poli = mysqli_real_escape_string($conn, $_POST['nama_poli']);
    
    $sql_insert = "INSERT INTO Poli (Poli_ID, Nama_Poli) VALUES ('$poli_id', '$nama_poli')";
    
    if (mysqli_query($conn, $sql_insert)) {
        header("Location: poli.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

include 'header.php';
?>

<div class="mb-8">
    <div class="flex items-center text-sm text-gray-500 mb-2">
        <a href="poli.php" class="hover:text-brand-600 transition-colors">Data Poliklinik</a>
        <i class="ph ph-caret-right mx-2 text-xs"></i>
        <span class="text-gray-900">Tambah Poli</span>
    </div>
    <h2 class="text-2xl font-semibold text-gray-900 tracking-tight">Data Poli Baru</h2>
</div>

<?php if(isset($error)): ?>
<div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 text-sm border border-red-100 flex items-start">
    <i class="ph-fill ph-warning-circle text-lg mr-2 mt-0.5"></i>
    <span><?php echo $error; ?></span>
</div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 max-w-2xl">
    <form action="" method="post" class="space-y-6">
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">ID Poli</label>
            <input type="text" name="poli_id" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 placeholder-gray-400" placeholder="e.g. POL001">
        </div>
        
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Nama Poliklinik</label>
            <input type="text" name="nama_poli" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 placeholder-gray-400" placeholder="e.g. Umum">
        </div>

        <div class="pt-4 flex items-center gap-3 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                Simpan Poli
            </button>
            <a href="poli.php" class="px-6 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 text-center">
                Batal
            </a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
