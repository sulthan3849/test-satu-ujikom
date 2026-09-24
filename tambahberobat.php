<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_transaksi = mysqli_real_escape_string($conn, $_POST['no_transaksi']);
    $pasien_id = mysqli_real_escape_string($conn, $_POST['pasien_id']);
    
    $tgl = $_POST['tanggal'];
    $bln = $_POST['bulan'];
    $thn = $_POST['tahun'];
    $tanggal_berobat = sprintf("%04d-%02d-%02d", $thn, $bln, $tgl);
    
    $dokter_id = mysqli_real_escape_string($conn, $_POST['dokter_id']);
    $keluhan = mysqli_real_escape_string($conn, $_POST['keluhan']);
    $biaya = mysqli_real_escape_string($conn, $_POST['biaya']);
    
    $sql_insert = "INSERT INTO Berobat (No_Transaksi, PasienKlinik_ID, Tanggal_Berobat, Dokter_ID, Keluhan_Pasien, Biaya_Adm) 
                   VALUES ('$no_transaksi', '$pasien_id', '$tanggal_berobat', '$dokter_id', '$keluhan', '$biaya')";
                   
    if (mysqli_query($conn, $sql_insert)) {
        header("Location: listberobat.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

include 'header.php';
?>

<div class="mb-8">
    <div class="flex items-center text-sm text-gray-500 mb-2">
        <a href="listberobat.php" class="hover:text-brand-600 transition-colors">Data Berobat</a>
        <i class="ph ph-caret-right mx-2 text-xs"></i>
        <span class="text-gray-900">Tambah Transaksi</span>
    </div>
    <h2 class="text-2xl font-semibold text-gray-900 tracking-tight">Catat Transaksi Baru</h2>
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
                <label class="block text-sm font-medium text-gray-700">No Transaksi</label>
                <input type="text" name="no_transaksi" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 placeholder-gray-400" placeholder="e.g. TR004">
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                <div class="relative">
                    <select name="pasien_id" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 appearance-none">
                        <option value="">-- Pilih Pasien --</option>
                        <?php
                        $sql_p = "SELECT PasienKlinik_ID, Nama_PasienKlinik FROM Pasien";
                        $res_p = mysqli_query($conn, $sql_p);
                        while($row_p = mysqli_fetch_assoc($res_p)) {
                            echo "<option value='".$row_p['PasienKlinik_ID']."'>".$row_p['Nama_PasienKlinik']."</option>";
                        }
                        ?>
                    </select>
                    <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Tanggal Berobat</label>
            <div class="flex gap-3">
                <div class="relative w-24 flex-shrink-0">
                    <select name="tanggal" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 appearance-none">
                        <option value="">Tgl</option>
                        <?php for($i=1; $i<=31; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                    <i class="ph ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                </div>
                
                <div class="relative flex-grow">
                    <select name="bulan" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 appearance-none">
                        <option value="">-- Pilih Bulan --</option>
                        <?php
                        $nama_bulan = array(1=>'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                        foreach($nama_bulan as $key => $val) echo "<option value='$key'>$val</option>";
                        ?>
                    </select>
                    <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
                
                <input type="text" name="tahun" required placeholder="Tahun" class="w-24 flex-shrink-0 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 placeholder-gray-400 text-center">
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Nama Dokter</label>
            <div class="relative">
                <select name="dokter_id" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 appearance-none">
                    <option value="">-- Pilih Dokter --</option>
                    <?php
                    $sql_d = "SELECT Dokter_ID, Nama_Dokter FROM Dokter";
                    $res_d = mysqli_query($conn, $sql_d);
                    while($row_d = mysqli_fetch_assoc($res_d)) {
                        echo "<option value='".$row_d['Dokter_ID']."'>".$row_d['Nama_Dokter']."</option>";
                    }
                    ?>
                </select>
                <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Keluhan Pasien</label>
            <input type="text" name="keluhan" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 placeholder-gray-400" placeholder="Penjelasan singkat keluhan">
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Biaya Administrasi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">Rp</span>
                </div>
                <input type="text" name="biaya" required class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 placeholder-gray-400" placeholder="0">
            </div>
        </div>

        <div class="pt-4 flex items-center gap-3 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                Simpan Transaksi
            </button>
            <button type="reset" class="px-6 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                Reset Form
            </button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
