<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50/30 px-4 py-6">
    <!-- Header Section -->
    <div class="mb-8 mt-14">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl shadow-lg flex items-center justify-center">
                        <i class="fas fa-history text-white text-xl"></i>
                    </div>
                    <div class="absolute -top-1 -right-1 w-5 h-5 bg-amber-500 rounded-full flex items-center justify-center">
                        <span class="text-xs text-white font-bold"><?= count($historyList) + count($suratMasukList) ?></span>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?= esc($title) ?></h1>
                    <p class="text-gray-600 mt-1">Riwayat konfirmasi kedatangan kembali siswa dan surat masuk</p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                <!-- Search Form -->
                <form method="get" action="<?= base_url('piket/history_konfirmasi') ?>" class="relative flex-1 sm:flex-none">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                        <i class="fas fa-search text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" name="keyword" placeholder="Cari siswa/nama..." value="<?= esc($_GET['keyword'] ?? '') ?>"
                        class="w-full sm:w-64 pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 shadow-sm">
                </form>
                
                <!-- Delete Today's Data -->
                <form action="<?= base_url('/piket/history_konfirmasi/hapus_hari_ini') ?>" method="post" class="flex-1 sm:flex-none">
                    <?= csrf_field() ?>
                    <button type="submit" onclick="return confirm('Hapus semua data konfirmasi hari ini?')"
                        class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-rose-500 to-red-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 shadow-md group">
                        <i class="fas fa-trash-alt group-hover:scale-110 transition-transform text-sm"></i>
                        <span class="font-medium">Hapus Hari Ini</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
        <!-- Total History -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Riwayat</p>
                    <p class="text-2xl font-bold text-gray-900"><?= count($historyList) ?></p>
                </div>
                <div class="p-3 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 text-white shadow-md">
                    <i class="fas fa-list-ol text-lg"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <span class="text-xs text-gray-500">Semua konfirmasi</span>
            </div>
        </div>
        
        <!-- On Time -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Tepat Waktu</p>
                    <p class="text-2xl font-bold text-emerald-600">
                        <?= !empty($historyList) ? count(array_filter($historyList, function($row) {
                            return !empty($row['waktu_kembali_siswa']) && strtotime($row['waktu_kembali_siswa']) <= strtotime($row['waktu_kembali']);
                        })) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 text-white shadow-md">
                    <i class="fas fa-check-circle text-lg"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <span class="text-xs text-emerald-600 font-medium">Siswa tepat waktu</span>
            </div>
        </div>
        
        <!-- Late -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Terlambat</p>
                    <p class="text-2xl font-bold text-amber-600">
                        <?= !empty($historyList) ? count(array_filter($historyList, function($row) {
                            return !empty($row['waktu_kembali_siswa']) && strtotime($row['waktu_kembali_siswa']) > strtotime($row['waktu_kembali']);
                        })) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-md">
                    <i class="fas fa-clock text-lg"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <span class="text-xs text-amber-600 font-medium">Keterlambatan</span>
            </div>
        </div>

        <!-- Total Surat Masuk -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Surat Masuk</p>
                    <p class="text-2xl font-bold text-indigo-600"><?= count($suratMasukList) ?></p>
                </div>
                <div class="p-3 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-md">
                    <i class="fas fa-inbox text-lg"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <span class="text-xs text-indigo-600 font-medium">Total surat izin</span>
            </div>
        </div>

        <!-- Today's Letters -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Hari Ini</p>
                    <p class="text-2xl font-bold text-rose-600">
                        <?= !empty($suratMasukList) ? count(array_filter($suratMasukList, function($row) {
                            return date('Y-m-d', strtotime($row['created_at'])) == date('Y-m-d');
                        })) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 text-white shadow-md">
                    <i class="fas fa-calendar-day text-lg"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <span class="text-xs text-rose-600 font-medium">Surat hari ini</span>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="mb-6">
        <div class="flex space-x-1 bg-white rounded-2xl p-1 shadow-sm border border-gray-100 w-max">
            <button id="tab-konfirmasi" class="tab-button px-6 py-3 rounded-xl font-medium transition-all duration-300 bg-gradient-to-r from-emerald-500 to-green-600 text-white shadow-md">
                <i class="fas fa-sign-out-alt mr-2"></i>Surat Izin Keluar
            </button>
            <button id="tab-surat" class="tab-button px-6 py-3 rounded-xl font-medium text-gray-600 hover:text-gray-900 transition-all duration-300">
                <i class="fas fa-sign-in-alt mr-2"></i>Surat Izin Masuk
            </button>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="space-y-6">
        <!-- Riwayat Konfirmasi Section -->
        <div id="section-konfirmasi" class="content-section bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-sign-out-alt text-emerald-600"></i>
                            Riwayat Konfirmasi Kembali
                        </h2>
                        <p class="text-gray-600 text-sm mt-1">Data surat keluar dan konfirmasi kedatangan siswa</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        Total: <span class="font-semibold text-gray-900"><?= count($historyList) ?> data</span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <?php if (empty($historyList)): ?>
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-inbox text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data riwayat</h3>
                        <p class="text-gray-600 max-w-md mx-auto">Belum ada konfirmasi kedatangan siswa yang tercatat untuk saat ini.</p>
                    </div>
                <?php else: ?>
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Poin</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($historyList as $index => $row): ?>
                                <tr class="hover:bg-gray-50/80 transition-colors duration-200 group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                                <?= strtoupper(substr(esc($row['nama']), 0, 1)) ?>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900"><?= esc($row['nama']) ?></div>
                                                <div class="text-xs text-gray-500">NIS: <?= esc($row['nisn'] ?? $row['nis'] ?? '-') ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <?= esc($row['kelas']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2 text-sm">
                                                <i class="fas fa-sign-out-alt text-gray-400 text-xs"></i>
                                                <span class="text-gray-600"><?= esc($row['waktu_keluar']) ?></span>
                                            </div>
                                            <div class="flex items-center gap-2 text-sm">
                                                <i class="fas fa-sign-in-alt text-gray-400 text-xs"></i>
                                                <span class="<?= empty($row['waktu_kembali_siswa']) ? 'text-rose-600' : 'text-gray-600' ?>">
                                                    <?= esc($row['waktu_kembali_siswa'] ?? 'Belum kembali') ?>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if (empty($row['waktu_kembali_siswa'])): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                                <i class="fas fa-times-circle mr-1"></i> Belum Kembali
                                            </span>
                                        <?php elseif (strtotime($row['waktu_kembali_siswa']) > strtotime($row['waktu_kembali'])): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                <i class="fas fa-clock mr-1"></i> Terlambat
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                <i class="fas fa-check-circle mr-1"></i> Tepat Waktu
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="relative inline-block" x-data="{ open: false }">
                                            <button @click="open = !open" 
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                    <?= ($row['total_poin'] ?? 0) > 0 
                                                        ? 'bg-rose-100 text-rose-800 hover:bg-rose-200' 
                                                        : 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' ?> 
                                                    transition-colors duration-200">
                                                <i class="fas fa-star mr-1 text-xs"></i>
                                                <?= esc($row['total_poin'] ?? 0) ?>
                                            </button>
                                            <?php if (!empty($row['pelanggaran'])): ?>
                                                <div x-show="open" @click.away="open = false" x-transition
                                                    class="absolute z-10 w-48 mt-2 bg-gray-900 text-white text-xs rounded-lg shadow-lg p-3">
                                                    <div class="font-semibold mb-2">Pelanggaran:</div>
                                                    <ul class="space-y-1">
                                                        <?php foreach (explode(',', $row['pelanggaran']) as $pel): ?>
                                                            <li class="flex items-start gap-2">
                                                                <i class="fas fa-circle text-2xs mt-1 flex-shrink-0"></i>
                                                                <span><?= esc(trim($pel)) ?></span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <a href="<?= base_url('piket/history_konfirmasi/delete/' . $row['id']) ?>"
                                                onclick="return confirm('Yakin hapus data ini?')"
                                                class="p-2 text-rose-600 bg-rose-50 rounded-lg hover:bg-rose-100 transition-colors duration-200"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt text-sm"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <!-- Surat Izin Masuk Section -->
        <div id="section-surat" class="content-section bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-sign-in-alt text-indigo-600"></i>
                            Surat Izin Masuk (Terlambat)
                        </h2>
                        <p class="text-gray-600 text-sm mt-1">Data surat izin masuk siswa yang terlambat</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        Total: <span class="font-semibold text-gray-900"><?= count($suratMasukList) ?> data</span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <?php if (empty($suratMasukList)): ?>
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-envelope text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada surat izin</h3>
                        <p class="text-gray-600 max-w-md mx-auto">Belum ada data surat izin masuk yang tercatat untuk saat ini.</p>
                    </div>
                <?php else: ?>
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alasan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tindak Lanjut</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($suratMasukList as $index => $row): ?>
                                <tr class="hover:bg-gray-50/80 transition-colors duration-200 group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                                <?= strtoupper(substr(esc($row['nama']), 0, 1)) ?>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900"><?= esc($row['nama']) ?></div>
                                                <div class="text-xs text-gray-500">NISN: <?= esc($row['nisn'] ?? '-') ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <?= esc($row['kelas']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-xs">
                                            <div class="text-sm text-gray-900 line-clamp-2"><?= esc($row['alasan_terlambat'] ?? '-') ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-xs">
                                            <div class="text-sm text-gray-900 line-clamp-2"><?= esc($row['tindak_lanjut'] ?? '-') ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <a href="<?= base_url('piket/surat_izin_masuk/delete/' . $row['id']) ?>"
                                                onclick="return confirm('Yakin hapus surat izin masuk ini?')"
                                                class="p-2 text-rose-600 bg-rose-50 rounded-lg hover:bg-rose-100 transition-colors duration-200"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt text-sm"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabs = {
        'tab-konfirmasi': 'section-konfirmasi',
        'tab-surat': 'section-surat'
    };

    // Initialize first tab as active
    document.getElementById('tab-konfirmasi').classList.add('active');
    document.getElementById('section-konfirmasi').classList.remove('hidden');

    // Add click events to tabs
    Object.keys(tabs).forEach(tabId => {
        document.getElementById(tabId).addEventListener('click', function() {
            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(tab => {
                tab.classList.remove('active', 'bg-gradient-to-r', 'from-emerald-500', 'to-green-600', 'text-white', 'shadow-md');
                tab.classList.add('text-gray-600', 'hover:text-gray-900');
            });

            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.add('hidden');
            });

            // Activate clicked tab
            this.classList.remove('text-gray-600', 'hover:text-gray-900');
            this.classList.add('active', 'bg-gradient-to-r', 'from-emerald-500', 'to-green-600', 'text-white', 'shadow-md');

            // Show corresponding section
            document.getElementById(tabs[tabId]).classList.remove('hidden');
        });
    });

    // Add hover effects to table rows
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-1px)';
            this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.05)';
        });

        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.shadow-sm {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.rounded-2xl {
    border-radius: 1rem;
}

.transition-all {
    transition: all 0.3s ease;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
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
    background: #d1d5db;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}
</style>

<?= $this->endSection() ?>