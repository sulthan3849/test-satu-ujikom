<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: listberobat.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pasien_id = mysqli_real_escape_string($conn, $_POST['pasien_id']);
    
    $tgl = $_POST['tanggal'];
    $bln = $_POST['bulan'];
    $thn = $_POST['tahun'];
    $tanggal_berobat = sprintf("%04d-%02d-%02d", $thn, $bln, $tgl);
    
    $dokter_id = mysqli_real_escape_string($conn, $_POST['dokter_id']);
    $keluhan = mysqli_real_escape_string($conn, $_POST['keluhan']);
    $biaya = mysqli_real_escape_string($conn, $_POST['biaya']);
    
    $sql_update = "UPDATE Berobat SET 
                    PasienKlinik_ID = '$pasien_id', 
                    Tanggal_Berobat = '$tanggal_berobat', 
                    Dokter_ID = '$dokter_id', 
                    Keluhan_Pasien = '$keluhan', 
                    Biaya_Adm = '$biaya' 
                   WHERE No_Transaksi = '$id'";
                   
    if (mysqli_query($conn, $sql_update)) {
        header("Location: listberobat.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

$sql_edit = "SELECT * FROM Berobat WHERE No_Transaksi = '$id'";
$res_edit = mysqli_query($conn, $sql_edit);
if (mysqli_num_rows($res_edit) == 0) {
    header("Location: listberobat.php");
    exit();
}
$data = mysqli_fetch_assoc($res_edit);

$date_parts = explode('-', $data['Tanggal_Berobat']);
$tgl_edit = (int)$date_parts[2];
$bln_edit = (int)$date_parts[1];
$thn_edit = (int)$date_parts[0];

include 'header.php';
?>

<div class="mb-8">
    <div class="flex items-center text-sm text-gray-500 mb-2">
        <a href="listberobat.php" class="hover:text-brand-600 transition-colors">Data Berobat</a>
        <i class="ph ph-caret-right mx-2 text-xs"></i>
        <span class="text-gray-900">Edit Transaksi</span>
    </div>
    <h2 class="text-2xl font-semibold text-gray-900 tracking-tight">Perbarui Transaksi</h2>
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
                <input type="text" name="no_transaksi" value="<?php echo htmlspecialchars($data['No_Transaksi']); ?>" readonly class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg outline-none text-sm text-gray-600 cursor-not-allowed">
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
                            $selected = ($row_p['PasienKlinik_ID'] == $data['PasienKlinik_ID']) ? 'selected' : '';
                            echo "<option value='".$row_p['PasienKlinik_ID']."' $selected>".$row_p['Nama_PasienKlinik']."</option>";
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
                        <?php
                        for($i=1; $i<=31; $i++){
                            $selected = ($i == $tgl_edit) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                    <i class="ph ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                </div>
                
                <div class="relative flex-grow">
                    <select name="bulan" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 appearance-none">
                        <option value="">-- Pilih Bulan --</option>
                        <?php
                        $nama_bulan = array(1=>'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                        foreach($nama_bulan as $key => $val){
                            $selected = ($key == $bln_edit) ? 'selected' : '';
                            echo "<option value='$key' $selected>$val</option>";
                        }
                        ?>
                    </select>
                    <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
                
                <input type="text" name="tahun" value="<?php echo $thn_edit; ?>" required placeholder="Tahun" class="w-24 flex-shrink-0 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900 text-center">
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
                    while($row_d = mysqli_fetch_assoc($res_d)){
                        $selected = ($row_d['Dokter_ID'] == $data['Dokter_ID']) ? 'selected' : '';
                        echo "<option value='".$row_d['Dokter_ID']."' $selected>".$row_d['Nama_Dokter']."</option>";
                    }
                    ?>
                </select>
                <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Keluhan Pasien</label>
            <input type="text" name="keluhan" value="<?php echo htmlspecialchars($data['Keluhan_Pasien']); ?>" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900">
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Biaya Administrasi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">Rp</span>
                </div>
                <input type="text" name="biaya" value="<?php echo htmlspecialchars($data['Biaya_Adm']); ?>" required class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm text-gray-900">
            </div>
        </div>

        <div class="pt-4 flex items-center gap-3 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                Update Transaksi
            </button>
            <a href="listberobat.php" class="px-6 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 text-center">
                Batal
            </a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
