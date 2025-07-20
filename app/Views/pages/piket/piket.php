<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="ml-64 mt-24 p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
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

    <!-- Tabel Sanksi -->
    <div class="bg-white rounded-xl shadow-lg p-6">
      
        <div class="overflow-x-auto">
           <div class="mt-6">
    <h2 class="text-lg font-bold mb-2">Info Terbaru Surat Izin</h2>
    <table class="w-full border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Nama Siswa</th>
                <th class="p-2 border">Alasan</th>
                <th class="p-2 border">Waktu Keluar</th>
                <th class="p-2 border">Status</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($izinTerbaru as $izin) : ?>
    <tr>
        <td class="p-2 border"><?= esc($izin['nama']) ?></td>
        <td class="p-2 border"><?= esc($izin['alasan']) ?></td>
        <td class="p-2 border"><?= esc(date('d M Y H:i', strtotime($izin['waktu_keluar']))) ?></td>
        <td class="p-2 border"><?= esc(ucwords($izin['status'])) ?></td>
    </tr>
<?php endforeach ?>

        </tbody>
    </table>
</div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
