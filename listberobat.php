<?php
include 'koneksi.php';
include 'header.php';
?>

<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-semibold text-gray-900 tracking-tight">Data Berobat</h2>
        <p class="mt-2 text-gray-500 text-sm">Daftar rekam transaksi kunjungan pasien klinik.</p>
    </div>
    <a href="tambahberobat.php" class="inline-flex items-center px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
        <i class="ph ph-plus mr-2 text-lg"></i> Transaksi Baru
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="table-container overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4">No Transaksi</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Pasien</th>
                    <th class="px-6 py-4">Keluhan</th>
                    <th class="px-6 py-4">Poli & Dokter</th>
                    <th class="px-6 py-4">Biaya</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                <?php
                $sql = "SELECT b.No_Transaksi, b.Tanggal_Berobat, 
                        p.Nama_PasienKlinik, p.Tanggal_LahirPasien, p.Jenis_KelaminPasien,
                        b.Keluhan_Pasien, pol.Nama_Poli, d.Nama_Dokter, b.Biaya_Adm 
                        FROM Berobat b
                        JOIN Pasien p ON b.PasienKlinik_ID = p.PasienKlinik_ID
                        JOIN Dokter d ON b.Dokter_ID = d.Dokter_ID
                        JOIN Poli pol ON d.Poli_ID = pol.Poli_ID
                        ORDER BY b.No_Transaksi ASC";
                
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $birthDate = new DateTime($row['Tanggal_LahirPasien']);
                        $today = new DateTime('today');
                        $usia = $birthDate->diff($today)->y;
                        
                        $jk_bg = $row['Jenis_KelaminPasien'] == 'Laki-Laki' ? 'bg-blue-50 text-blue-700' : 'bg-pink-50 text-pink-700';
                        
                        echo "<tr class='hover:bg-gray-50/50 transition-colors'>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>" . htmlspecialchars($row['No_Transaksi']) . "</td>";
                        echo "<td class='px-6 py-4 text-gray-500'>" . date('d M Y', strtotime($row['Tanggal_Berobat'])) . "</td>";
                        echo "<td class='px-6 py-4'>
                                <div class='font-medium text-gray-900'>" . htmlspecialchars($row['Nama_PasienKlinik']) . "</div>
                                <div class='flex items-center gap-2 mt-1 text-xs'>
                                    <span class='text-gray-500'>$usia thn</span>
                                    <span class='px-2 py-0.5 rounded-full $jk_bg font-medium'>" . htmlspecialchars($row['Jenis_KelaminPasien']) . "</span>
                                </div>
                              </td>";
                        echo "<td class='px-6 py-4 text-gray-600 max-w-xs truncate' title='".htmlspecialchars($row['Keluhan_Pasien'])."'>" . htmlspecialchars($row['Keluhan_Pasien']) . "</td>";
                        echo "<td class='px-6 py-4'>
                                <span class='inline-flex items-center px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-medium mb-1'>".htmlspecialchars($row['Nama_Poli'])."</span>
                                <div class='text-gray-500 text-xs'>" . htmlspecialchars($row['Nama_Dokter']) . "</div>
                              </td>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>Rp " . number_format($row['Biaya_Adm'], 0, ',', '.') . "</td>";
                        echo "<td class='px-6 py-4 text-right'>
                                <div class='flex justify-end gap-3 text-lg'>
                                    <a href='editberobat.php?id=" . urlencode($row['No_Transaksi']) . "' class='text-gray-400 hover:text-brand-600 transition-colors' title='Edit'>
                                        <i class='ph ph-pencil-simple'></i>
                                    </a>
                                    <a href='hapusberobat.php?id=" . urlencode($row['No_Transaksi']) . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\" class='text-gray-400 hover:text-red-600 transition-colors' title='Delete'>
                                        <i class='ph ph-trash'></i>
                                    </a>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='px-6 py-12 text-center text-gray-500'>Tidak ada data transaksi.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
