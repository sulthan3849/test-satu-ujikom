<?php
include 'koneksi.php';
include 'header.php';
?>

<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 print:hidden">
    <div>
        <h2 class="text-3xl font-semibold text-gray-900 tracking-tight">Laporan Transaksi Berobat</h2>
        <p class="mt-2 text-gray-500 text-sm">Dokumen rekapitulasi riwayat kunjungan medis pasien.</p>
    </div>
    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 shadow-sm print:hidden">
        <i class="ph ph-printer mr-2 text-lg"></i> Cetak Laporan
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden print:border-none print:shadow-none">
    <!-- Kop Laporan khusus cetak -->
    <div class="hidden print:block text-center py-6 border-b border-gray-300 mb-4">
        <h1 class="text-2xl font-bold text-gray-900">KLINIK MEK GACOR</h1>
        <p class="text-sm text-gray-500">Laporan Resmi Transaksi Kunjungan Berobat</p>
        <p class="text-xs text-gray-400 mt-1">Dicetak pada: <?php echo date('d M Y H:i'); ?></p>
    </div>

    <div class="table-container overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-xs font-medium text-gray-500 uppercase tracking-wider print:bg-white print:border-b-2 print:border-gray-800">
                    <th class="px-6 py-4">No Transaksi</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Pasien</th>
                    <th class="px-6 py-4">Keluhan Medis</th>
                    <th class="px-6 py-4">Dokter & Poli</th>
                    <th class="px-6 py-4 text-right">Biaya Adm</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm print:divide-gray-300">
                <?php
                $sql = "SELECT b.No_Transaksi, b.Tanggal_Berobat, 
                        p.Nama_PasienKlinik, p.Tanggal_LahirPasien, p.Jenis_KelaminPasien,
                        b.Keluhan_Pasien, pol.Nama_Poli, d.Nama_Dokter, b.Biaya_Adm 
                        FROM Berobat b
                        JOIN Pasien p ON b.PasienKlinik_ID = p.PasienKlinik_ID
                        JOIN Dokter d ON b.Dokter_ID = d.Dokter_ID
                        JOIN Poli pol ON d.Poli_ID = pol.Poli_ID
                        ORDER BY b.Tanggal_Berobat DESC, b.No_Transaksi DESC";
                
                $result = mysqli_query($conn, $sql);
                $total_biaya = 0;
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $total_biaya += $row['Biaya_Adm'];
                        $birthDate = new DateTime($row['Tanggal_LahirPasien']);
                        $today = new DateTime('today');
                        $usia = $birthDate->diff($today)->y;
                        
                        echo "<tr class='hover:bg-gray-50/50 transition-colors'>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>" . htmlspecialchars($row['No_Transaksi']) . "</td>";
                        echo "<td class='px-6 py-4 text-gray-500'>" . date('d/m/Y', strtotime($row['Tanggal_Berobat'])) . "</td>";
                        echo "<td class='px-6 py-4'>
                                <div class='font-medium text-gray-900'>" . htmlspecialchars($row['Nama_PasienKlinik']) . "</div>
                                <div class='text-gray-500 text-xs mt-0.5'>$usia thn, " . htmlspecialchars($row['Jenis_KelaminPasien']) . "</div>
                              </td>";
                        echo "<td class='px-6 py-4 text-gray-600 max-w-xs truncate print:max-w-none print:whitespace-normal'>" . htmlspecialchars($row['Keluhan_Pasien']) . "</td>";
                        echo "<td class='px-6 py-4'>
                                <div class='font-medium text-gray-900'>" . htmlspecialchars($row['Nama_Dokter']) . "</div>
                                <div class='text-gray-500 text-xs mt-0.5'>Poli " . htmlspecialchars($row['Nama_Poli']) . "</div>
                              </td>";
                        echo "<td class='px-6 py-4 text-right font-medium text-gray-900'>Rp " . number_format($row['Biaya_Adm'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='px-6 py-12 text-center text-gray-500'>Tidak ada riwayat transaksi.</td></tr>";
                }
                ?>
            </tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
            <tfoot class="bg-gray-50/80 border-t-2 border-gray-200 print:bg-white print:border-gray-800">
                <tr>
                    <td colspan="5" class="px-6 py-4 text-right font-semibold text-gray-900 uppercase text-xs tracking-wider">Total Pendapatan:</td>
                    <td class="px-6 py-4 text-right font-bold text-gray-900 text-base">Rp <?php echo number_format($total_biaya, 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
