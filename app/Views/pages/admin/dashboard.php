<?= $this->extend('layout/dashboard') ?>

<?= $this->extend('layout/dashboard_admin') ?>

<?= $this->section('content') ?>

<div class="ml-64 grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white rounded-xl shadow p-4 border-l-4 border-[#A4DE02]">
        <h2 class="text-lg font-semibold text-gray-700">Total Admin</h2>
        <p class="text-3xl font-bold text-[#1E5631]"><?= esc($totalAdmin) ?></p>
    </div>

    <div class="bg-white rounded-xl shadow p-4 border-l-4 border-[#FACC15]">
        <h2 class="text-lg font-semibold text-gray-700">Total Siswa</h2>
        <p class="text-3xl font-bold text-yellow-600"><?= esc($totalSiswa) ?></p>
    </div>

    <div class="bg-white rounded-xl shadow p-4 border-l-4 border-[#EF4444]">
        <h2 class="text-lg font-semibold text-gray-700">Total Pelanggaran</h2>
        <p class="text-3xl font-bold text-red-600"><?= esc($totalPelanggaran) ?></p>
    </div>
</div>

<?= $this->endSection() ?>