<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white rounded-xl shadow p-4 border-l-4 border-[#A4DE02]">
        <h2 class="text-lg font-semibold text-gray-700">Surat Izin Hari Ini</h2>
        <p class="text-3xl font-bold text-[#1E5631]">12</p>
    </div>

    <div class="bg-white rounded-xl shadow p-4 border-l-4 border-[#1E5631]">
        <h2 class="text-lg font-semibold text-gray-700">Siswa Belum Kembali</h2>
        <p class="text-3xl font-bold text-[#A4DE02]">4</p>
    </div>

    <div class="bg-white rounded-xl shadow p-4 border-l-4 border-red-400">
        <h2 class="text-lg font-semibold text-gray-700">Pelanggaran Hari Ini</h2>
        <p class="text-3xl font-bold text-red-500">3</p>
    </div>
</div>

<?= $this->endSection() ?>