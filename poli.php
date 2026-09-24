<?php
include 'koneksi.php';
include 'header.php';
?>

<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-semibold text-gray-900 tracking-tight">Data Poliklinik</h2>
        <p class="mt-2 text-gray-500 text-sm">Kelola daftar layanan spesialis di klinik.</p>
    </div>
    <a href="tambahpoli.php" class="inline-flex items-center px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
        <i class="ph ph-plus mr-2 text-lg"></i> Tambah Poli
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="table-container overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4">ID Poli</th>
                    <th class="px-6 py-4">Nama Poliklinik</th>
                    <th class="px-6 py-4">Jumlah Dokter</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                <?php
                $sql = "SELECT p.Poli_ID, p.Nama_Poli, COUNT(d.Dokter_ID) as Jumlah_Dokter 
                        FROM Poli p 
                        LEFT JOIN Dokter d ON p.Poli_ID = d.Poli_ID 
                        GROUP BY p.Poli_ID, p.Nama_Poli 
                        ORDER BY p.Poli_ID ASC";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='hover:bg-gray-50/50 transition-colors'>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>" . htmlspecialchars($row['Poli_ID']) . "</td>";
                        echo "<td class='px-6 py-4 font-medium text-gray-900'>Poli " . htmlspecialchars($row['Nama_Poli']) . "</td>";
                        echo "<td class='px-6 py-4 text-gray-500'>
                                <span class='inline-flex items-center gap-1.5'>
                                    <i class='ph-fill ph-users text-gray-400'></i> " . $row['Jumlah_Dokter'] . " Dokter
                                </span>
                              </td>";
                        echo "<td class='px-6 py-4 text-right'>
                                <div class='flex justify-end gap-3 text-lg'>
                                    <a href='editpoli.php?id=" . urlencode($row['Poli_ID']) . "' class='text-gray-400 hover:text-brand-600 transition-colors' title='Edit'>
                                        <i class='ph ph-pencil-simple'></i>
                                    </a>
                                    <a href='hapuspoli.php?id=" . urlencode($row['Poli_ID']) . "' onclick=\"return confirm('Hapus poli ini?');\" class='text-gray-400 hover:text-red-600 transition-colors' title='Delete'>
                                        <i class='ph ph-trash'></i>
                                    </a>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='px-6 py-12 text-center text-gray-500'>Tidak ada data poliklinik.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
