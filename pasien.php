<?php
include 'koneksi.php';
include 'header.php';
?>

<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-semibold text-gray-900 tracking-tight">Data Pasien</h2>
        <p class="mt-2 text-gray-500 text-sm">Kelola direktori pasien klinik.</p>
    </div>
    <a href="tambahpasien.php" class="inline-flex items-center px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
        <i class="ph ph-plus mr-2 text-lg"></i> Tambah Pasien
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="table-container overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4">ID Pasien</th>
                    <th class="px-6 py-4">Nama Pasien</th>
                    <th class="px-6 py-4">Tanggal Lahir</th>
                    <th class="px-6 py-4">Jenis Kelamin</th>
                    <th class="px-6 py-4">Alamat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                <?php
                $sql = "SELECT * FROM Pasien ORDER BY PasienKlinik_ID ASC";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $jk_bg = $row['Jenis_KelaminPasien'] == 'Laki-Laki' ? 'bg-blue-50 text-blue-700' : 'bg-pink-50 text-pink-700';
                        
                        echo "<tr class='hover:bg-gray-50/50 transition-colors'>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>" . htmlspecialchars($row['PasienKlinik_ID']) . "</td>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>" . htmlspecialchars($row['Nama_PasienKlinik']) . "</td>";
                        echo "<td class='px-6 py-4 text-gray-500'>" . date('d M Y', strtotime($row['Tanggal_LahirPasien'])) . "</td>";
                        echo "<td class='px-6 py-4'>
                                <span class='px-2 py-0.5 rounded-full $jk_bg font-medium text-xs'>" . htmlspecialchars($row['Jenis_KelaminPasien']) . "</span>
                              </td>";
                        echo "<td class='px-6 py-4 text-gray-600 max-w-xs truncate' title='".htmlspecialchars($row['Alamat_Pasien'])."'>" . htmlspecialchars($row['Alamat_Pasien']) . "</td>";
                        echo "<td class='px-6 py-4 text-right'>
                                <div class='flex justify-end gap-3 text-lg'>
                                    <a href='editpasien.php?id=" . urlencode($row['PasienKlinik_ID']) . "' class='text-gray-400 hover:text-brand-600 transition-colors' title='Edit'>
                                        <i class='ph ph-pencil-simple'></i>
                                    </a>
                                    <a href='hapuspasien.php?id=" . urlencode($row['PasienKlinik_ID']) . "' onclick=\"return confirm('Hapus data pasien ini?');\" class='text-gray-400 hover:text-red-600 transition-colors' title='Delete'>
                                        <i class='ph ph-trash'></i>
                                    </a>
                                </div>
                              </td>";
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
