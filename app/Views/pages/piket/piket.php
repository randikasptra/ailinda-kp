<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="ml-64 mt-24 p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-gradient-to-br from-[#f0fdf4] to-[#d9f99d] rounded-xl shadow-lg p-5 border-l-4 border-[#A4DE02] hover:shadow-xl transition-all">
            <h2 class="text-lg font-semibold text-[#1E5631]">Surat Izin Hari Ini</h2>
            <p class="text-3xl font-bold text-[#14532d]"><?= esc($totalIzinHariIni) ?></p>
        </div>

        <!-- Card 2 -->
        <div class="bg-gradient-to-br from-[#f0fdf4] to-[#bbf7d0] rounded-xl shadow-lg p-5 border-l-4 border-[#1E5631] hover:shadow-xl transition-all">
            <h2 class="text-lg font-semibold text-[#1E5631]">Siswa Belum Kembali</h2>
            <p class="text-3xl font-bold text-[#4ade80]"><?= esc($belumKembali) ?></p>
        </div>

        <!-- Card 3 -->
        <div class="bg-gradient-to-br from-[#fef2f2] to-[#fecaca] rounded-xl shadow-lg p-5 border-l-4 border-red-400 hover:shadow-xl transition-all">
            <h2 class="text-lg font-semibold text-red-700">Pelanggaran Hari Ini</h2>
            <p class="text-3xl font-bold text-red-600"><?= esc($pelanggaranHariIni) ?></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
