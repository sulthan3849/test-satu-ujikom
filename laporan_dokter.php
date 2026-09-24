<?php
include 'koneksi.php';
include 'header.php';
?>

<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 print:hidden">
    <div>
        <h2 class="text-3xl font-semibold text-gray-900 tracking-tight">Laporan Data Dokter</h2>
        <p class="mt-2 text-gray-500 text-sm">Dokumen rekapitulasi tenaga medis klinik.</p>
    </div>
    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 shadow-sm print:hidden">
        <i class="ph ph-printer mr-2 text-lg"></i> Cetak Laporan
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden print:border-none print:shadow-none">
    <!-- Kop Laporan khusus cetak -->
    <div class="hidden print:block text-center py-6 border-b border-gray-300 mb-4">
        <h1 class="text-2xl font-bold text-gray-900">KLINIK MEK GACOR</h1>
        <p class="text-sm text-gray-500">Laporan Resmi Daftar Tenaga Medis</p>
        <p class="text-xs text-gray-400 mt-1">Dicetak pada: <?php echo date('d M Y H:i'); ?></p>
    </div>

    <div class="table-container overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-xs font-medium text-gray-500 uppercase tracking-wider print:bg-white print:border-b-2 print:border-gray-800">
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">ID Dokter</th>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Spesialisasi / Poli</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm print:divide-gray-300">
                <?php
                $sql = "SELECT d.Dokter_ID, d.Nama_Dokter, p.Nama_Poli 
                        FROM Dokter d 
                        LEFT JOIN Poli p ON d.Poli_ID = p.Poli_ID 
                        ORDER BY d.Dokter_ID ASC";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='hover:bg-gray-50/50 transition-colors'>";
                        echo "<td class='px-6 py-4 text-gray-500'>" . $no++ . "</td>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>" . htmlspecialchars($row['Dokter_ID']) . "</td>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>" . htmlspecialchars($row['Nama_Dokter']) . "</td>";
                        echo "<td class='px-6 py-4 text-gray-600'>" . htmlspecialchars($row['Nama_Poli'] ?? 'Tidak ditugaskan') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='px-6 py-12 text-center text-gray-500'>Tidak ada data dokter.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
