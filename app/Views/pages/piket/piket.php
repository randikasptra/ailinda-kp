<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="mt-24 p-6">
    <!-- Header Dashboard -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-chart-line text-[#1E5631]"></i>
            Dashboard Overview
        </h1>
        <p class="text-gray-600">Ringkasan aktivitas dan informasi terbaru</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-gradient-to-br from-[#f0fdf4] to-[#d9f99d] rounded-2xl shadow-lg p-6 border-l-4 border-[#A4DE02] hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 opacity-10">
                <i class="fas fa-envelope-open-text text-[#1E5631] text-6xl"></i>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-envelope-open-text text-[#A4DE02] text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-[#1E5631]">Surat Izin Hari Ini</h2>
                    <p class="text-3xl font-bold text-[#14532d]"><?= esc($totalIzinHariIni) ?></p>
                </div>
            </div>
            <div class="mt-4 text-xs text-[#1E5631]/70">
                <i class="fas fa-clock mr-1"></i> Diperbarui secara real-time
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-gradient-to-br from-[#f0fdf4] to-[#bbf7d0] rounded-2xl shadow-lg p-6 border-l-4 border-[#1E5631] hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 opacity-10">
                <i class="fas fa-user-clock text-[#1E5631] text-6xl"></i>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-user-clock text-[#1E5631] text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-[#1E5631]">Siswa Belum Kembali</h2>
                    <p class="text-3xl font-bold text-[#4ade80]"><?= esc($belumKembali) ?></p>
                </div>
            </div>
            <div class="mt-4 text-xs text-[#1E5631]/70">
                <i class="fas fa-exclamation-circle mr-1"></i> Perlu perhatian
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-gradient-to-br from-[#fef2f2] to-[#fecaca] rounded-2xl shadow-lg p-6 border-l-4 border-red-400 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 opacity-10">
                <i class="fas fa-exclamation-triangle text-red-600 text-6xl"></i>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-red-700">Pelanggaran Hari Ini</h2>
                    <p class="text-3xl font-bold text-red-600"><?= esc($pelanggaranHariIni) ?></p>
                </div>
            </div>
            <div class="mt-4 text-xs text-red-600/70">
                <i class="fas fa-chart-line mr-1"></i> Dibandingkan kemarin
            </div>
        </div>
    </div>

    <!-- Tabel Sanksi -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-history text-[#1E5631]"></i>
                Info Terbaru Surat Izin
            </h2>
            <a href="#" class="text-sm text-[#1E5631] hover:underline flex items-center gap-1">
                Lihat semua <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        
        <div class="overflow-x-auto rounded-xl shadow-sm border border-gray-100">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white">
                        <th class="p-3 text-left font-semibold rounded-tl-xl">Nama Siswa</th>
                        <th class="p-3 text-left font-semibold">Alasan</th>
                        <th class="p-3 text-left font-semibold">Waktu Keluar</th>
                        <th class="p-3 text-left font-semibold rounded-tr-xl">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($izinTerbaru as $izin) : ?>
                    <tr class="border-b border-gray-100 hover:bg-gray-50/80 transition-colors">
                        <td class="p-3 font-medium"><?= esc($izin['nama']) ?></td>
                        <td class="p-3 text-gray-600"><?= esc($izin['alasan']) ?></td>
                        <td class="p-3">
                            <div class="flex items-center gap-1 text-gray-600">
                                <i class="far fa-clock text-xs text-[#1E5631]"></i>
                                <?= esc(date('d M Y H:i', strtotime($izin['waktu_keluar']))) ?>
                            </div>
                        </td>
                        <td class="p-3">
                            <?php 
                            $statusClass = '';
                            if ($izin['status'] == 'pending') {
                                $statusClass = 'bg-yellow-100 text-yellow-800';
                            } else if ($izin['status'] == 'disetujui') {
                                $statusClass = 'bg-green-100 text-green-800';
                            } else {
                                $statusClass = 'bg-red-100 text-red-800';
                            }
                            ?>
                            <span class="px-2 py-1 rounded-full text-xs font-medium <?= $statusClass ?>">
                                <?= esc(ucwords($izin['status'])) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        
        <?php if (empty($izinTerbaru)) : ?>
        <div class="text-center py-8 text-gray-500">
            <i class="fas fa-inbox text-3xl mb-2 opacity-50"></i>
            <p>Tidak ada data surat izin</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-bolt text-[#A4DE02]"></i>
            Akses Cepat
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="/piket/surat_izin" class="p-4 bg-gradient-to-br from-[#f0fdf4] to-[#d9f99d] rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center text-center group">
                <div class="p-3 rounded-xl bg-white shadow-sm mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-file-signature text-[#A4DE02] text-xl"></i>
                </div>
                <span class="font-medium text-[#1E5631]">Input Surat Izin</span>
            </a>
            
            <a href="/piket/izin_masuk_form" class="p-4 bg-gradient-to-br from-[#f0fdf4] to-[#bbf7d0] rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center text-center group">
                <div class="p-3 rounded-xl bg-white shadow-sm mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-envelope-open-text text-[#1E5631] text-xl"></i>
                </div>
                <span class="font-medium text-[#1E5631]">Input Surat Masuk</span>
            </a>
            
            <a href="/piket/konfirmasi_kembali" class="p-4 bg-gradient-to-br from-[#f0fdf4] to-[#a7f3d0] rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center text-center group">
                <div class="p-3 rounded-xl bg-white shadow-sm mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-check-circle text-[#4ade80] text-xl"></i>
                </div>
                <span class="font-medium text-[#1E5631]">Konfirmasi Kembali</span>
            </a>
            
            <a href="/piket/data_siswa" class="p-4 bg-gradient-to-br from-[#f0f9ff] to-[#e0f2fe] rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center text-center group">
                <div class="p-3 rounded-xl bg-white shadow-sm mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-users text-blue-500 text-xl"></i>
                </div>
                <span class="font-medium text-[#1E5631]">Data Siswa</span>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>