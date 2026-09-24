<?php include 'header.php'; ?>

<div class="mt-8">
    <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 tracking-tight">Klinik Dashboard</h2>
    <p class="mt-2 text-gray-500 max-w-2xl text-lg">Sistem informasi pengelolaan data operasional klinik secara terpusat.</p>
</div>

<div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
        <div>
            <div class="h-10 w-10 rounded-full bg-brand-50 flex items-center justify-center mb-6">
                <i class="ph ph-folder-plus text-xl text-brand-600"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Transaksi Berobat</h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-6">Kelola data pasien yang melakukan kunjungan, rekam keluhan, tetapkan dokter penanggung jawab, dan biaya administrasi.</p>
        </div>
        <a href="listberobat.php" class="inline-flex items-center text-sm font-medium text-brand-600 hover:text-brand-700 transition-colors">
            Buka Modul Berobat <i class="ph ph-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
        <div>
            <div class="h-10 w-10 rounded-full bg-gray-50 flex items-center justify-center mb-6">
                <i class="ph ph-database text-xl text-gray-600"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Master Data</h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-6">Kelola data referensi utama klinik termasuk direktori Dokter, rekam data Pasien, dan daftar Poliklinik.</p>
        </div>
        <div class="flex space-x-4">
            <a href="pasien.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Pasien</a>
            <a href="dokter.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Dokter</a>
            <a href="poli.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Poli</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
