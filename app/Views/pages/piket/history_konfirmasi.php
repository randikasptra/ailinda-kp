<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="ml-64 mt-16 px-8 py-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800"><?= esc($title) ?></h1>
            <p class="text-gray-500 mt-1">Riwayat konfirmasi kedatangan kembali siswa</p>
        </div>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
            </div>
            <input type="text" placeholder="Cari siswa..." class="pl-10 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] w-64">
        </div>
    </div>

    <!-- History Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#1E5631] to-[#2E7D32]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Nama Siswa</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Kelas</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Jam Keluar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Jadwal Kembali</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Aktual Kembali</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Poin</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Dicatat</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($historyList as $row): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-[#1E5631]/10 rounded-full flex items-center justify-center">
                                    <span class="text-[#1E5631] font-medium"><?= strtoupper(substr(esc($row['nama']), 0, 1)) ?></span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900"><?= esc($row['nama']) ?></div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full"><?= esc($row['kelas']) ?></span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center">
                                <i data-lucide="log-out" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <?= esc($row['waktu_keluar']) ?>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center">
                                <i data-lucide="calendar-clock" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <?= esc($row['waktu_kembali']) ?>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i data-lucide="clock" class="w-4 h-4 mr-1 <?= empty($row['waktu_kembali_siswa']) ? 'text-red-400' : 'text-green-500' ?>"></i>
                                <span class="<?= empty($row['waktu_kembali_siswa']) ? 'text-red-500' : 'text-gray-700' ?>">
                                    <?= esc($row['waktu_kembali_siswa'] ?? 'Belum kembali') ?>
                                </span>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if (empty($row['waktu_kembali_siswa'])): ?>
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Belum Kembali</span>
                            <?php elseif (strtotime($row['waktu_kembali_siswa']) > strtotime($row['waktu_kembali'])): ?>
                                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Terlambat</span>
                            <?php else: ?>
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Tepat Waktu</span>
                            <?php endif; ?>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium <?= ($row['poin_pelanggaran'] ?? 0) > 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?> rounded-full">
                                <?= esc($row['poin_pelanggaran'] ?? 0) ?> poin
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <?= esc($row['updated_at']) ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-500">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium"><?= count($historyList) ?></span> hasil
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Sebelumnya
                </button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Selanjutnya
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>