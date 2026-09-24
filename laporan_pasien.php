<?php
include 'koneksi.php';
include 'header.php';
?>

<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 print:hidden">
    <div>
        <h2 class="text-3xl font-semibold text-gray-900 tracking-tight">Laporan Data Pasien</h2>
        <p class="mt-2 text-gray-500 text-sm">Dokumen rekapitulasi data pasien terdaftar.</p>
    </div>
    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 shadow-sm print:hidden">
        <i class="ph ph-printer mr-2 text-lg"></i> Cetak Laporan
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden print:border-none print:shadow-none">
    <!-- Kop Laporan khusus cetak -->
    <div class="hidden print:block text-center py-6 border-b border-gray-300 mb-4">
        <h1 class="text-2xl font-bold text-gray-900">KLINIK MEK GACOR</h1>
        <p class="text-sm text-gray-500">Laporan Resmi Daftar Pasien Klinik</p>
        <p class="text-xs text-gray-400 mt-1">Dicetak pada: <?php echo date('d M Y H:i'); ?></p>
    </div>

    <div class="table-container overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-xs font-medium text-gray-500 uppercase tracking-wider print:bg-white print:border-b-2 print:border-gray-800">
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">ID Pasien</th>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Usia</th>
                    <th class="px-6 py-4">Jenis Kelamin</th>
                    <th class="px-6 py-4">Alamat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm print:divide-gray-300">
                <?php
                $sql = "SELECT * FROM Pasien ORDER BY PasienKlinik_ID ASC";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        $birthDate = new DateTime($row['Tanggal_LahirPasien']);
                        $today = new DateTime('today');
                        $usia = $birthDate->diff($today)->y;
                        
                        echo "<tr class='hover:bg-gray-50/50 transition-colors'>";
                        echo "<td class='px-6 py-4 text-gray-500'>" . $no++ . "</td>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>" . htmlspecialchars($row['PasienKlinik_ID']) . "</td>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>" . htmlspecialchars($row['Nama_PasienKlinik']) . "</td>";
                        echo "<td class='px-6 py-4 text-gray-600'>" . $usia . " Tahun</td>";
                        echo "<td class='px-6 py-4 text-gray-600'>" . htmlspecialchars($row['Jenis_KelaminPasien']) . "</td>";
                        echo "<td class='px-6 py-4 text-gray-600 max-w-xs truncate print:max-w-none print:whitespace-normal'>" . htmlspecialchars($row['Alamat_Pasien']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='px-6 py-12 text-center text-gray-500'>Tidak ada data pasien.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
