<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="ml-64 grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bg-white rounded-xl shadow p-4 border-l-4 border-[#A4DE02]">
        <h2 class="text-lg font-semibold text-gray-700">Total Pelanggaran Bulan Ini</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-4 border-l-4 border-red-500">
        <h2 class="text-lg font-semibold text-gray-700">Siswa Mendekati DO (≥ 180 Poin)</h2>
    </div>
</div>

<?= $this->endSection() ?>