<?php
// File: app/Views/pages/admin/dashboard.php
?>

<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="ml-64">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-green-500">
        <div class="flex items-center">
            <i data-lucide="users" class="w-8 h-8 text-green-500 mr-4"></i>
            <div>
                <h3 class="text-sm text-gray-500">Total Pengguna</h3>
                <p class="text-2xl font-bold text-gray-700"><?= $totalUsers ?? 0 ?></p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-blue-500">
        <div class="flex items-center">
            <i data-lucide="file-text" class="w-8 h-8 text-blue-500 mr-4"></i>
            <div>
                <h3 class="text-sm text-gray-500">Surat Izin Hari Ini</h3>
                <p class="text-2xl font-bold text-gray-700"><?= $izinHariIni ?? 0 ?></p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-red-500">
        <div class="flex items-center">
            <i data-lucide="alert-triangle" class="w-8 h-8 text-red-500 mr-4"></i>
            <div>
                <h3 class="text-sm text-gray-500">Pelanggaran Hari Ini</h3>
                <p class="text-2xl font-bold text-gray-700"><?= $pelanggaranHariIni ?? 0 ?></p>
            </div>
        </div>
    </div>
</div>

<div class="mt-10">
    <h2 class="text-xl font-bold mb-4 text-gray-700">Aktivitas Terbaru</h2>
    <div class="bg-white rounded-xl shadow p-4">
        <ul class="divide-y divide-gray-200 text-sm">
            <?php if (!empty($logs)): ?>
                <?php foreach ($logs as $log): ?>
                    <li class="py-2">
                        <strong><?= $log['user'] ?></strong> <?= $log['activity'] ?>
                        <span class="text-gray-400 text-xs float-right"><?= $log['timestamp'] ?></span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="py-2 text-gray-500">Belum ada aktivitas.</li>
            <?php endif; ?>
        </ul>
    </div>
</div>
</div>

<?= $this->endSection() ?>