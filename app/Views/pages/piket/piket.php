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
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium">Total Izin Keluar</p>
                    <p class="text-2xl font-bold mt-1"><?= $total_izin_keluar ?></p>
                    <p class="text-emerald-200 text-xs mt-2">Surat izin keluar hari ini</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-teal-100 text-sm font-medium">Total Izin Masuk</p>
                    <p class="text-2xl font-bold mt-1"><?= $total_izin_masuk ?></p>
                    <p class="text-teal-200 text-xs mt-2">Surat izin masuk hari ini</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-sign-in-alt text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Keseluruhan</p>
                    <p class="text-2xl font-bold mt-1"><?= $total_izin_keluar + $total_izin_masuk ?></p>
                    <p class="text-green-200 text-xs mt-2">Semua surat izin hari ini</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Sanksi -->

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
            
            <a href="/piket/surat_izin_rekapan" class="p-4 bg-gradient-to-br from-[#f0fdf4] to-[#a7f3d0] rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center text-center group">
                <div class="p-3 rounded-xl bg-white shadow-sm mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-check-circle text-[#4ade80] text-xl"></i>
                </div>
                <span class="font-medium text-[#1E5631]">Rekapan Data Siswa</span>
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