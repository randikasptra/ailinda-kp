<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="mt-24 px-8 space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-hands-helping text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Bimbingan & Penyuluhan</h1>
                <p class="text-gray-600 mt-1">Monitor dan kelola data pelanggaran siswa</p>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="flex items-center gap-3">
            <a href="<?= base_url('bp/rekap_poin') ?>"
                class="flex items-center gap-2 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white px-5 py-3 rounded-xl hover:shadow-xl transition-all duration-300 shadow-md group">
                <i class="fas fa-chart-bar group-hover:scale-110 transition-transform"></i>
                Lihat Rekap Lengkap
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pelanggaran Bulan Ini -->
        <div class="bg-gradient-to-br from-[#f0fdf4] to-[#d9f99d] rounded-2xl shadow-lg p-6 border-l-4 border-[#A4DE02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#1E5631]">Total Pelanggaran Bulan Ini</p>
                    <p class="text-3xl font-bold text-[#14532d]"><?= $totalPelanggaranBulanIni ?? 0 ?></p>
                    <p class="text-xs text-[#1E5631]/70 mt-1"><?= date('F Y') ?></p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-exclamation-triangle text-[#A4DE02] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Siswa Mendekati DO -->
        <div class="bg-gradient-to-br from-[#fef2f2] to-[#fecaca] rounded-2xl shadow-lg p-6 border-l-4 border-red-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-red-700">Siswa Mendekati DO (≥ 100 Poin)</p>
                    <p class="text-3xl font-bold text-red-600"><?= $jumlahSiswaMendekatiDO ?? 0 ?></p>
                    <p class="text-xs text-red-600/70 mt-1">Perlu perhatian khusus</p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-user-times text-red-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Rata-rata Poin -->
        <div class="bg-gradient-to-br from-[#f0f9ff] to-[#e0f2fe] rounded-2xl shadow-lg p-6 border-l-4 border-blue-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-900">Rata-rata Poin Siswa</p>
                    <p class="text-3xl font-bold text-blue-800">
                        <?= !empty($topSiswa) ? round(array_sum(array_column($topSiswa, 'poin')) / count($topSiswa), 1) : '0' ?>
                    </p>
                    <p class="text-xs text-blue-600/70 mt-1">Seluruh siswa</p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-star text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Siswa Bermasalah -->
        <div class="bg-gradient-to-br from-[#fffbeb] to-[#fef3c7] rounded-2xl shadow-lg p-6 border-l-4 border-amber-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-amber-900">Siswa dengan Poin > 50</p>
                    <p class="text-3xl font-bold text-amber-800">
                        <?= !empty($topSiswa) ? count(array_filter($topSiswa, function($s) { return $s['poin'] > 50; })) : '0' ?>
                    </p>
                    <p class="text-xs text-amber-600/70 mt-1">Perlu bimbingan</p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-users text-amber-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Siswa dengan Poin Tertinggi -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Table Header -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                        Siswa dengan Poin Tertinggi
                    </h2>
                    <p class="text-sm text-gray-600"><?= count($topSiswa) ?> siswa dengan poin tertinggi</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Cari siswa..." 
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                    </div>
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
                                <i class="fas fa-star mr-2"></i>
                                Poin
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Status
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($topSiswa as $s): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-full flex items-center justify-center text-white font-bold shadow-md mr-3">
                                        <?= strtoupper(substr($s['nama'], 0, 1)) ?>
                                    </div>
                                    <div class="font-medium text-gray-900"><?= esc($s['nama']) ?></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                    <?= esc($s['kelas']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1.5 inline-flex items-center text-sm font-semibold rounded-full 
                                    <?= $s['poin'] >= 100 ? 'bg-red-100 text-red-800 border border-red-200' : 
                                       ($s['poin'] >= 50 ? 'bg-amber-100 text-amber-800 border border-amber-200' : 
                                       'bg-green-100 text-green-800 border border-green-200') ?>">
                                    <i class="fas fa-star text-xs mr-1.5 
                                        <?= $s['poin'] >= 100 ? 'text-red-500' : 
                                           ($s['poin'] >= 50 ? 'text-amber-500' : 
                                           'text-green-500') ?>"></i>
                                    <?= esc($s['poin']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full 
                                    <?= $s['poin'] >= 100 ? 'bg-red-100 text-red-800 border border-red-200' : 
                                       ($s['poin'] >= 50 ? 'bg-amber-100 text-amber-800 border border-amber-200' : 
                                       'bg-green-100 text-green-800 border border-green-200') ?>">
                                    <?= $s['poin'] >= 100 ? 'Kritis' : 
                                       ($s['poin'] >= 50 ? 'Perhatian' : 
                                       'Aman') ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <?php if (empty($topSiswa)): ?>
        <div class="text-center py-12">
            <i class="fas fa-check-circle text-4xl text-green-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-700">Tidak ada data pelanggaran</h3>
            <p class="text-gray-500 mt-1">Semua siswa memiliki catatan yang baik</p>
        </div>
        <?php endif; ?>

        <!-- Table Footer -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-600">
                    Menampilkan <?= count($topSiswa) ?> siswa dengan poin tertinggi
                </p>
                <a href="<?= base_url('bp/rekap_poin') ?>"
                    class="flex items-center gap-2 bg-[#1E5631] text-white px-4 py-2 rounded-xl hover:bg-[#145128] transition-all duration-300 shadow-sm group">
                    <i class="fas fa-chart-bar group-hover:scale-110 transition-transform"></i>
                    Lihat Rekap Lengkap
                </a>
            </div>
        </div>
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
.rounded-2xl {
    border-radius: 1rem;
}

.transition-all {
    transition: all 0.3s ease;
}

.shadow-lg {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
</style>

<?= $this->endSection() ?>