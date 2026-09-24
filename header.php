<?php
// header.php
?>
<!DOCTYPE html>
<html lang="id" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Workspace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: { 50: '#f0fdfa', 100: '#ccfbf1', 500: '#14b8a6', 600: '#0d9488', 700: '#0f766e', 900: '#134e4a' }
                    }
                }
            }
        }
    </script>
    <style>
        .table-container::-webkit-scrollbar { height: 8px; }
        .table-container::-webkit-scrollbar-track { background: #f8fafc; }
        .table-container::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 flex h-screen overflow-hidden font-sans">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col flex-shrink-0 print:hidden">
        <div class="h-16 flex items-center px-6 border-b border-gray-200">
            <i class="ph-fill ph-heartbeats text-brand-600 text-2xl mr-2"></i>
            <span class="font-semibold text-gray-900 tracking-tight">Klinik Mek Gacor</span>
        </div>
        
        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-8">
            <div>
                <div class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</div>
                <div class="space-y-1">
                    <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
                    <a href="index.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors <?php echo ($current_page == 'index.php') ? 'text-brand-700 bg-brand-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="ph ph-squares-four text-lg mr-3 <?php echo ($current_page == 'index.php') ? 'text-brand-600' : 'text-gray-400'; ?>"></i> Dashboard
                    </a>
                </div>
            </div>

            <div>
                <div class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Workspace</div>
                <div class="space-y-1">
                    <a href="pasien.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors <?php echo ($current_page == 'pasien.php' || $current_page == 'tambahpasien.php' || $current_page == 'editpasien.php') ? 'text-brand-700 bg-brand-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="ph ph-users text-lg mr-3 <?php echo ($current_page == 'pasien.php' || $current_page == 'tambahpasien.php' || $current_page == 'editpasien.php') ? 'text-brand-600' : 'text-gray-400'; ?>"></i> Data Pasien
                    </a>
                    <a href="dokter.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors <?php echo ($current_page == 'dokter.php' || $current_page == 'tambahdokter.php' || $current_page == 'editdokter.php') ? 'text-brand-700 bg-brand-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="ph ph-stethoscope text-lg mr-3 <?php echo ($current_page == 'dokter.php' || $current_page == 'tambahdokter.php' || $current_page == 'editdokter.php') ? 'text-brand-600' : 'text-gray-400'; ?>"></i> Data Dokter
                    </a>
                    <a href="poli.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors <?php echo ($current_page == 'poli.php' || $current_page == 'tambahpoli.php' || $current_page == 'editpoli.php') ? 'text-brand-700 bg-brand-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="ph ph-first-aid text-lg mr-3 <?php echo ($current_page == 'poli.php' || $current_page == 'tambahpoli.php' || $current_page == 'editpoli.php') ? 'text-brand-600' : 'text-gray-400'; ?>"></i> Data Poli
                    </a>
                    <a href="listberobat.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors <?php echo ($current_page == 'listberobat.php' || $current_page == 'tambahberobat.php' || $current_page == 'editberobat.php') ? 'text-brand-700 bg-brand-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="ph ph-folder-plus text-lg mr-3 <?php echo ($current_page == 'listberobat.php' || $current_page == 'tambahberobat.php' || $current_page == 'editberobat.php') ? 'text-brand-600' : 'text-gray-400'; ?>"></i> Transaksi Berobat
                    </a>
                </div>
            </div>
            
            <div>
                <div class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Laporan</div>
                <div class="space-y-1">
                    <a href="laporan_dokter.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors <?php echo ($current_page == 'laporan_dokter.php') ? 'text-brand-700 bg-brand-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="ph ph-file-text text-lg mr-3 <?php echo ($current_page == 'laporan_dokter.php') ? 'text-brand-600' : 'text-gray-400'; ?>"></i> List Dokter
                    </a>
                    <a href="laporan_pasien.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors <?php echo ($current_page == 'laporan_pasien.php') ? 'text-brand-700 bg-brand-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="ph ph-file-text text-lg mr-3 <?php echo ($current_page == 'laporan_pasien.php') ? 'text-brand-600' : 'text-gray-400'; ?>"></i> List Pasien
                    </a>
                    <a href="laporan_berobat.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors <?php echo ($current_page == 'laporan_berobat.php') ? 'text-brand-700 bg-brand-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="ph ph-file-text text-lg mr-3 <?php echo ($current_page == 'laporan_berobat.php') ? 'text-brand-600' : 'text-gray-400'; ?>"></i> Data Berobat
                    </a>
                </div>
            </div>
        </nav>
        
        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center px-2">
                <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-sm font-medium text-gray-600 border border-gray-200">MG</div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-700">Mek Gacor</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <main class="flex-1 flex flex-col min-w-0 bg-[#fbfbfb] print:bg-white print:block">
        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8 lg:p-12 print:p-0 print:overflow-visible">
            <div class="max-w-6xl mx-auto print:max-w-full">
