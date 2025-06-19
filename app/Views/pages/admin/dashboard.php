<?= $this->extend('layout/dashboard_admin') ?>

<?= $this->section('content') ?>

<div class="mt-20 p-8">
   <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card: Admin -->
    <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-xl transition duration-300">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-full bg-white shadow-inner">
                <i data-lucide="user-cog" class="w-6 h-6 text-green-700"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-green-900">Total Admin</h2>
                <p class="text-2xl font-bold text-green-800"><?= esc($totalAdmin) ?></p>
            </div>
        </div>
    </div>

    <!-- Card: Siswa -->
    <div class="bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-xl transition duration-300">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-full bg-white shadow-inner">
                <i data-lucide="users" class="w-6 h-6 text-yellow-700"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-yellow-900">Total Siswa</h2>
                <p class="text-2xl font-bold text-yellow-800"><?= esc($totalSiswa) ?></p>
            </div>
        </div>
    </div>

    <!-- Card: Pelanggaran -->
    <div class="bg-gradient-to-br from-red-100 to-red-200 rounded-xl shadow-md p-6 border-l-4 border-red-500 hover:shadow-xl transition duration-300">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-full bg-white shadow-inner">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-700"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-red-900">Total Pelanggaran</h2>
                <p class="text-2xl font-bold text-red-800"><?= esc($totalPelanggaran) ?></p>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>

<?= $this->endSection() ?>