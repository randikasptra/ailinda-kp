<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="mt-24 px-4 md:px-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-chart-line text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Laporan Rekap Surat Izin</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Analisis dan monitoring data surat izin siswa</p>
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="flex items-center gap-4">
            <div class="bg-white rounded-xl shadow-sm p-3 border border-gray-200">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-lg bg-green-100 text-green-600">
                        <i class="fas fa-file-alt text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Data</p>
                        <p class="font-semibold text-gray-800"><?= (count($izinKeluar ?? []) + count($izinMasuk ?? [])) ?> Records</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
        <div class="flex items-center mb-4">
            <div class="p-2 rounded-lg bg-green-100 text-green-600 mr-3">
                <i class="fas fa-filter text-sm"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Filter Laporan</h2>
        </div>
        
        <form method="get" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Tanggal Mulai -->
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-day text-green-500 mr-1"></i> Dari Tanggal
                </label>
                <input type="date" name="start_date" id="start_date" 
                       value="<?= esc(service('request')->getGet('start_date')) ?>" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
            </div>
            
            <!-- Tanggal Akhir -->
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-day text-green-500 mr-1"></i> Sampai Tanggal
                </label>
                <input type="date" name="end_date" id="end_date" 
                       value="<?= esc(service('request')->getGet('end_date')) ?>" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
            </div>
            
            <!-- Jenis Surat -->
            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-alt text-green-500 mr-1"></i> Jenis Surat
                </label>
                <select name="jenis" id="jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                    <option value="all" <?= ($jenis ?? 'all') == 'all' ? 'selected' : '' ?>>Semua Jenis</option>
                    <option value="keluar" <?= ($jenis ?? 'all') == 'keluar' ? 'selected' : '' ?>>Surat Keluar</option>
                    <option value="masuk" <?= ($jenis ?? 'all') == 'masuk' ? 'selected' : '' ?>>Surat Masuk</option>
                </select>
            </div>
            
            <!-- Pencarian Nama -->
            <div>
                <label for="search_nama" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-search text-green-500 mr-1"></i> Cari Siswa
                </label>
                <input type="text" name="search_nama" id="search_nama" 
                       value="<?= esc(service('request')->getGet('search_nama')) ?>" 
                       placeholder="Masukkan nama siswa" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row items-end gap-2 lg:col-span-5">
                <button type="submit" name="filter" value="1" 
                        class="flex-1 bg-gradient-to-r from-green-600 to-green-700 text-white px-4 py-2 rounded-lg hover:from-green-700 hover:to-green-800 transition-all shadow-sm flex items-center justify-center gap-2">
                    <i class="fas fa-filter text-sm"></i>
                    Terapkan
                </button>
                <button type="submit" name="export" value="1" 
                        class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-2 rounded-lg hover:from-green-600 hover:to-green-700 transition-all shadow-sm flex items-center justify-center gap-2">
                    <i class="fas fa-file-excel text-sm"></i>
                    Export
                </button>
                <a href="<?= base_url('admin/laporan') ?>" 
                   class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 text-white px-4 py-2 rounded-lg hover:from-gray-600 hover:to-gray-700 transition-all shadow-sm flex items-center justify-center gap-2">
                    <i class="fas fa-refresh text-sm"></i>
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Izin Keluar -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Izin Keluar</p>
                    <p class="text-2xl font-bold mt-1"><?= count($izinKeluar ?? []) ?></p>
                    <p class="text-green-200 text-xs mt-2">Data surat keluar</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Total Izin Masuk -->
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium">Total Izin Masuk</p>
                    <p class="text-2xl font-bold mt-1"><?= count($izinMasuk ?? []) ?></p>
                    <p class="text-emerald-200 text-xs mt-2">Data surat masuk</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-sign-in-alt text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Total Keseluruhan -->
        <div class="bg-gradient-to-r from-lime-500 to-lime-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-lime-100 text-sm font-medium">Total Keseluruhan</p>
                    <p class="text-2xl font-bold mt-1"><?= count($izinKeluar ?? []) + count($izinMasuk ?? []) ?></p>
                    <p class="text-lime-200 text-xs mt-2">Semua data surat</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekap Izin Keluar -->
    <?php if (empty($jenis) || $jenis == 'all' || $jenis == 'keluar'): ?>
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-8">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-white/20 mr-3">
                        <i class="fas fa-sign-out-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Rekap Izin Keluar</h3>
                        <p class="text-green-100 text-sm"><?= count($izinKeluar ?? []) ?> data surat izin keluar</p>
                    </div>
                </div>
                <div class="bg-white/20 rounded-lg px-3 py-1">
                    <span class="text-white font-medium text-sm">KELUAR</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <?php if (!empty($izinKeluar)): ?>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-hashtag text-gray-400 mr-1"></i> No
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-user text-gray-400 mr-1"></i> Siswa
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-calendar text-gray-400 mr-1"></i> Tanggal
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-clock text-gray-400 mr-1"></i> Waktu
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-comment text-gray-400 mr-1"></i> Alasan
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-exclamation-triangle text-gray-400 mr-1"></i> Pelanggaran
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-star text-gray-400 mr-1"></i> Total Poin
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $no = 1; foreach ($izinKeluar as $izin): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= $no++ ?>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-green-100 rounded-full flex items-center justify-center">
                                                <span class="text-green-600 font-medium text-sm"><?= strtoupper(substr(esc($izin['nama']), 0, 1)) ?></span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900"><?= esc($izin['nama']) ?></div>
                                                <div class="text-xs text-gray-500"><?= esc($izin['nisn']) ?> • <?= esc($izin['kelas']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= date('d F Y', strtotime($izin['created_at'])) ?>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 space-y-1">
                                            <div class="flex items-center">
                                                <i class="fas fa-sign-out-alt w-3 h-3 mr-2 text-green-500"></i>
                                                <?= esc($izin['waktu_keluar']) ?>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-sign-in-alt w-3 h-3 mr-2 text-emerald-500"></i>
                                                <?= esc($izin['waktu_kembali']) ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="break-words"><?= esc($izin['alasan']) ?: '-' ?></div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="break-words"><?= $izin['pelanggaran_list'] ?: '-' ?></div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $izin['total_poin'] > 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?>">
                                            <i class="fas fa-star mr-1 text-xs"></i>
                                            <?= $izin['total_poin'] ?: 0 ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <div class="mx-auto w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-inbox text-green-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak ada data izin keluar</h3>
                    <p class="text-gray-500 text-sm">Tidak ada data yang sesuai dengan filter yang dipilih</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Rekap Izin Masuk -->
    <?php if (empty($jenis) || $jenis == 'all' || $jenis == 'masuk'): ?>
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-white/20 mr-3">
                        <i class="fas fa-sign-in-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Rekap Izin Masuk</h3>
                        <p class="text-emerald-100 text-sm"><?= count($izinMasuk ?? []) ?> data surat izin masuk</p>
                    </div>
                </div>
                <div class="bg-white/20 rounded-lg px-3 py-1">
                    <span class="text-white font-medium text-sm">MASUK</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <?php if (!empty($izinMasuk)): ?>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-hashtag text-gray-400 mr-1"></i> No
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-user text-gray-400 mr-1"></i> Siswa
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-calendar text-gray-400 mr-1"></i> Tanggal
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-comment text-gray-400 mr-1"></i> Alasan Terlambat
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-tasks text-gray-400 mr-1"></i> Tindak Lanjut
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-exclamation-triangle text-gray-400 mr-1"></i> Pelanggaran
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-star text-gray-400 mr-1"></i> Total Poin
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $no = 1; foreach ($izinMasuk as $izin): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= $no++ ?>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                                <span class="text-emerald-600 font-medium text-sm"><?= strtoupper(substr(esc($izin['nama']), 0, 1)) ?></span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900"><?= esc($izin['nama']) ?></div>
                                                <div class="text-xs text-gray-500"><?= esc($izin['nisn']) ?> • <?= esc($izin['kelas']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= date('d F Y', strtotime($izin['created_at'])) ?>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="break-words"><?= esc($izin['alasan_terlambat']) ?: '-' ?></div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="break-words"><?= esc($izin['tindak_lanjut']) ?: '-' ?></div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="break-words"><?= $izin['pelanggaran_list'] ?: '-' ?></div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $izin['total_poin'] > 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?>">
                                            <i class="fas fa-star mr-1 text-xs"></i>
                                            <?= $izin['total_poin'] ?: 0 ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <div class="mx-auto w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-inbox text-emerald-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak ada data izin masuk</h3>
                    <p class="text-gray-500 text-sm">Tidak ada data yang sesuai dengan filter yang dipilih</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
[x-cloak] {
    display: none !important;
}

.shadow-lg {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.rounded-2xl {
    border-radius: 1rem;
}

.transition-colors {
    transition: all 0.2s ease-in-out;
}

.transition-all {
    transition: all 0.3s ease;
}

/* Custom scrollbar */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Improved table styling */
.min-w-full {
    min-width: 100%;
}

.whitespace-nowrap {
    white-space: nowrap;
}

.break-words {
    overflow-wrap: break-word;
    word-break: break-word;
}

.max-w-xs {
    max-width: 20rem;
}

/* Better spacing for table cells */
.px-4.py-4 {
    padding-left: 1rem;
    padding-right: 1rem;
    padding-top: 1rem;
    padding-bottom: 1rem;
}

/* Improved table header styling */
.bg-gray-50 {
    background-color: #f9fafb;
}

/* Better table row hover effect */
.hover\:bg-gray-50:hover {
    background-color: #f9fafb;
}

/* Gradient text effect */
.gradient-text {
    background: linear-gradient(135deg, #1E5631, #4C9A2B);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Set default dates if not set
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    
    if (!startDate.value) {
        const today = new Date();
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        startDate.value = firstDay.toISOString().split('T')[0];
    }
    
    if (!endDate.value) {
        const today = new Date();
        endDate.value = today.toISOString().split('T')[0];
    }
    
    // Add some interactive effects
    const filterButtons = document.querySelectorAll('button[type="submit"]');
    filterButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-1px)';
        });
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>

<?= $this->endSection() ?>