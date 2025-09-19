<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="mt-16 px-8 py-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-history text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800"><?= esc($title) ?></h1>
                <p class="text-gray-600 mt-1">Riwayat konfirmasi kedatangan kembali siswa</p>
            </div>
        </div>
        
        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center">
            <!-- Hapus Semua Hari Ini -->
            <form action="<?= base_url('/piket/history_konfirmasi/hapus_hari_ini') ?>" method="post">
                <?= csrf_field() ?>
                <button type="submit" onclick="return confirm('Hapus semua data izin hari ini?')"
                    class="flex items-center gap-2 px-4 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-300 shadow-md group">
                    <i class="fas fa-trash-alt group-hover:scale-110 transition-transform"></i>
                    Hapus Semua Hari Ini
                </button>
            </form>
            
            <!-- Form Pencarian -->
            <form method="get" action="<?= base_url('piket/history_konfirmasi') ?>" class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="keyword" placeholder="Cari siswa..." value="<?= esc($_GET['keyword'] ?? '') ?>"
                    class="pl-10 border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] w-full md:w-64 transition-all">
            </form>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-[#f0fdf4] to-[#d9f99d] rounded-2xl shadow-lg p-5 border-l-4 border-[#A4DE02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#1E5631]">Total Riwayat</p>
                    <p class="text-2xl font-bold text-[#14532d]"><?= count($historyList) ?></p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-list-ol text-[#A4DE02] text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#f0f9ff] to-[#e0f2fe] rounded-2xl shadow-lg p-5 border-l-4 border-blue-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-900">Tepat Waktu</p>
                    <p class="text-2xl font-bold text-blue-800">
                        <?= !empty($historyList) ? count(array_filter($historyList, function($row) {
                            return !empty($row['waktu_kembali_siswa']) && strtotime($row['waktu_kembali_siswa']) <= strtotime($row['waktu_kembali']);
                        })) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-check-circle text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#fffbeb] to-[#fef3c7] rounded-2xl shadow-lg p-5 border-l-4 border-amber-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-amber-900">Terlambat</p>
                    <p class="text-2xl font-bold text-amber-800">
                        <?= !empty($historyList) ? count(array_filter($historyList, function($row) {
                            return !empty($row['waktu_kembali_siswa']) && strtotime($row['waktu_kembali_siswa']) > strtotime($row['waktu_kembali']);
                        })) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-clock text-amber-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#fef2f2] to-[#fecaca] rounded-2xl shadow-lg p-5 border-l-4 border-red-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-red-700">Belum Kembali</p>
                    <p class="text-2xl font-bold text-red-600">
                        <?= !empty($historyList) ? count(array_filter($historyList, function($row) {
                            return empty($row['waktu_kembali_siswa']);
                        })) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-times-circle text-red-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Table Header -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Riwayat Konfirmasi</h3>
                    <p class="text-sm text-gray-600">Total <?= count($historyList) ?> entri ditemukan</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                Nama Siswa
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-school mr-2"></i>
                                Kelas
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Jam Keluar
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Jadwal Kembali
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2"></i>
                                Aktual Kembali
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-status mr-2"></i>
                                Status
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-star mr-2"></i>
                                Poin
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-calendar mr-2"></i>
                                Dicatat
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-cog mr-2"></i>
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($historyList as $row): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                            <!-- Kolom Nama -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-full flex items-center justify-center text-white font-bold shadow-md mr-4">
                                        <?= strtoupper(substr(esc($row['nama']), 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900"><?= esc($row['nama']) ?></div>
                                        <div class="text-sm text-gray-500">NIS: <?= esc($row['nis'] ?? '-') ?></div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Kolom Kelas -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                    <?= esc($row['kelas']) ?>
                                </span>
                            </td>
                            
                            <!-- Kolom Jam Keluar -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-sign-out-alt text-gray-400 mr-2"></i>
                                    <?= esc($row['waktu_keluar']) ?>
                                </div>
                            </td>
                            
                            <!-- Kolom Jadwal Kembali -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-calendar-check text-gray-400 mr-2"></i>
                                    <?= esc($row['waktu_kembali']) ?>
                                </div>
                            </td>
                            
                            <!-- Kolom Aktual Kembali -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm <?= empty($row['waktu_kembali_siswa']) ? 'text-red-600' : 'text-gray-600' ?>">
                                    <i class="fas fa-clock mr-2 <?= empty($row['waktu_kembali_siswa']) ? 'text-red-400' : 'text-green-500' ?>"></i>
                                    <?= esc($row['waktu_kembali_siswa'] ?? 'Belum kembali') ?>
                                </div>
                            </td>
                            
                            <!-- Kolom Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if (empty($row['waktu_kembali_siswa'])): ?>
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                        <i class="fas fa-times-circle mr-1"></i> Belum Kembali
                                    </span>
                                <?php elseif (strtotime($row['waktu_kembali_siswa']) > strtotime($row['waktu_kembali'])): ?>
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-amber-100 text-amber-800 border border-amber-200">
                                        <i class="fas fa-clock mr-1"></i> Terlambat
                                    </span>
                                <?php else: ?>
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                        <i class="fas fa-check-circle mr-1"></i> Tepat Waktu
                                    </span>
                                <?php endif; ?>
                            </td>
                            
                            <!-- Kolom Poin -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative" x-data="{ open: false }">
                                    <button 
                                        @click="open = !open" 
                                        class="px-3 py-1.5 inline-flex items-center text-xs font-semibold rounded-full 
                                            <?= ($row['total_poin'] ?? 0) > 0 
                                                ? 'bg-red-100 text-red-800 border border-red-200' 
                                                : 'bg-green-100 text-green-800 border border-green-200' ?>">
                                        <i class="fas fa-star text-xs mr-1"></i>
                                        <?= esc($row['total_poin'] ?? 0) ?> poin
                                    </button>

                                    <?php if (!empty($row['pelanggaran'])): ?>
                                    <div 
                                        x-show="open" 
                                        @click.away="open = false"
                                        x-transition
                                        class="absolute top-full left-1/2 -translate-x-1/2 mt-2 
                                            w-max max-w-xs bg-gray-800 text-white text-sm 
                                            rounded-xl py-2 px-3 z-10 shadow-lg">
                                        <div class="font-medium mb-1">Pelanggaran:</div>
                                        <ul class="list-disc list-inside space-y-1 text-xs">
                                            <?php foreach (explode(',', $row['pelanggaran']) as $pel): ?>
                                                <li><?= esc(trim($pel)) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </td>

                            
                            <!-- Kolom Dicatat -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-calendar text-gray-400 mr-2"></i>
                                    <?= esc($row['updated_at']) ?>
                                </div>
                            </td>
                            
                            <!-- Kolom Aksi -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="<?= base_url('piket/history_konfirmasi/delete/' . $row['id']) ?>"
                                        onclick="return confirm('Yakin hapus data ini?')"
                                        class="p-2 text-red-600 bg-red-100 rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300 group/btn"
                                        title="Hapus">
                                        <i class="fas fa-trash-alt group-hover/btn:scale-110 transition-transform"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Empty State -->
        <?php if (empty($historyList)): ?>
        <div class="text-center py-16">
            <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-700">Tidak ada data riwayat</h3>
            <p class="text-gray-500 mt-1">Belum ada riwayat konfirmasi yang tercatat</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Include Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
// Initialize icons
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>

<style>
.shadow-lg {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.rounded-2xl {
    border-radius: 1rem;
}

.transition-all {
    transition: all 0.3s ease;
}
</style>

<?= $this->endSection() ?>