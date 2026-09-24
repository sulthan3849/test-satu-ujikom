<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: pasien.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pasien = mysqli_real_escape_string($conn, $_POST['nama_pasien']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    
    $sql_update = "UPDATE Pasien SET 
                    Nama_PasienKlinik = '$nama_pasien', 
                    Tanggal_LahirPasien = '$tanggal_lahir', 
                    Jenis_KelaminPasien = '$jenis_kelamin', 
                    Alamat_Pasien = '$alamat' 
                   WHERE PasienKlinik_ID = '$id'";
    
    if (mysqli_query($conn, $sql_update)) {
        header("Location: pasien.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

$sql_edit = "SELECT * FROM Pasien WHERE PasienKlinik_ID = '$id'";
$res_edit = mysqli_query($conn, $sql_edit);
if (mysqli_num_rows($res_edit) == 0) {
    header("Location: pasien.php");
    exit();
}
$data = mysqli_fetch_assoc($res_edit);

include 'header.php';
?>

<div class="mb-8">
    <div class="flex items-center text-sm text-gray-500 mb-2">
        <a href="pasien.php" class="hover:text-brand-600 transition-colors">Data Pasien</a>
        <i class="ph ph-caret-right mx-2 text-xs"></i>
        <span class="text-gray-900">Edit Pasien</span>
    </div>
    <h2 class="text-2xl font-semibold text-gray-900 tracking-tight">Perbarui Data Pasien</h2>
</div>

<?php if(isset($error)): ?>
<div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 text-sm border border-red-100 flex items-start">
    <i class="ph-fill ph-warning-circle text-lg mr-2 mt-0.5"></i>
    <span><?php echo $error; ?></span>
</div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 max-w-3xl">
    <form action="" method="post" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">ID Pasien</label>
                <input type="text" name="pasien_id" value="<?php echo htmlspecialchars($data['PasienKlinik_ID']); ?>" readonly class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg outline-none text-sm text-gray-600 cursor-not-allowed">
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                <input type="text" name="nama_pasien" value="<?php echo htmlspecialchars($data['Nama_PasienKlinik']); ?>" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="<?php echo htmlspecialchars($data['Tanggal_LahirPasien']); ?>" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900">
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <div class="relative">
                    <select name="jenis_kelamin" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 appearance-none">
                        <option value="Laki-Laki" <?php if($data['Jenis_KelaminPasien'] == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
                        <option value="Perempuan" <?php if($data['Jenis_KelaminPasien'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                    <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea name="alamat" required rows="3" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900"><?php echo htmlspecialchars($data['Alamat_Pasien']); ?></textarea>
        </div>

        <div class="pt-4 flex items-center gap-3 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                Update Pasien
            </button>
            <a href="pasien.php" class="px-6 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 text-center">
                Batal
            </a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
