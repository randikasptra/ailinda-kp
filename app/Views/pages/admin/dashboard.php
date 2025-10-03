<?= $this->extend('layout/dashboard_admin') ?>

<?= $this->section('content') ?>

<div class="mt-20 p-8">
    <!-- Header Dashboard -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-chart-dashboard text-[#1E5631]"></i>
            Dashboard Admin
        </h1>
        <p class="text-gray-600">Ringkasan data dan statistik sistem</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card: User -->
        <div class="bg-gradient-to-br from-[#f0fdf4] to-[#d9f99d] rounded-2xl shadow-lg p-6 border-l-4 border-[#A4DE02] hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 opacity-10">
                <i class="fas fa-user-cog text-[#1E5631] text-6xl"></i>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-user-cog text-[#A4DE02] text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-[#1E5631]">Total User</h2>
                    <p class="text-3xl font-bold text-[#14532d]"><?= esc($totalUser) ?></p>
                </div>
            </div>
            <div class="mt-4 text-xs text-[#1E5631]/70 flex items-center">
                <i class="fas fa-users mr-1"></i> Admin dan Pengguna Sistem
            </div>
        </div>

        <!-- Card: Siswa -->
        <div class="bg-gradient-to-br from-[#f0f9ff] to-[#e0f2fe] rounded-2xl shadow-lg p-6 border-l-4 border-blue-400 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 opacity-10">
                <i class="fas fa-user-graduate text-blue-600 text-6xl"></i>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-user-graduate text-blue-500 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-blue-900">Total Siswa</h2>
                    <p class="text-3xl font-bold text-blue-800"><?= esc($totalSiswa) ?></p>
                </div>
            </div>
            <div class="mt-4 text-xs text-blue-600/70 flex items-center">
                <i class="fas fa-chart-line mr-1"></i> Seluruh siswa terdaftar
            </div>
        </div>

        <!-- Card: Pelanggaran -->
        <div class="bg-gradient-to-br from-[#fef2f2] to-[#fecaca] rounded-2xl shadow-lg p-6 border-l-4 border-red-400 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 opacity-10">
                <i class="fas fa-exclamation-triangle text-red-600 text-6xl"></i>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-2 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-red-700">Total Pelanggaran</h2>
                    <p class="text-3xl font-bold text-red-600"><?= esc($totalPelanggaran) ?></p>
                </div>
            </div>
            <div class="mt-4 text-xs text-red-600/70 flex items-center">
                <i class="fas fa-history mr-1"></i> Data historis pelanggaran
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Pelanggaran by Kategori -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-chart-pie text-[#1E5631]"></i>
                Pelanggaran Berdasarkan Kategori
            </h2>
            <canvas id="pelanggaranChart" class="w-full h-64"></canvas>
        </div>

        <!-- Siswa by Kelas -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-chart-bar text-[#1E5631]"></i>
                Distribusi Siswa Berdasarkan Kelas
            </h2>
            <canvas id="siswaChart" class="w-full h-64"></canvas>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-bolt text-[#A4DE02]"></i>
            Akses Cepat
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="/admin/users" class="p-4 bg-gradient-to-br from-[#f0fdf4] to-[#d9f99d] rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center text-center group">
                <div class="p-3 rounded-xl bg-white shadow-sm mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-user-cog text-[#A4DE02] text-xl"></i>
                </div>
                <span class="font-medium text-[#1E5631]">Kelola User</span>
            </a>
            
            <a href="/admin/siswa" class="p-4 bg-gradient-to-br from-[#f0f9ff] to-[#e0f2fe] rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center text-center group">
                <div class="p-3 rounded-xl bg-white shadow-sm mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-user-graduate text-blue-500 text-xl"></i>
                </div>
                <span class="font-medium text-[#1E5631]">Kelola Siswa</span>
            </a>
            
            <a href="/admin/pelanggaran" class="p-4 bg-gradient-to-br from-[#fef2f2] to-[#fecaca] rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center text-center group">
                <div class="p-3 rounded-xl bg-white shadow-sm mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                </div>
                <span class="font-medium text-[#1E5631]">Kelola Pelanggaran</span>
            </a>
            
            <a href="/admin/laporan" class="p-4 bg-gradient-to-br from-[#faf5ff] to-[#e9d5ff] rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center text-center group">
                <div class="p-3 rounded-xl bg-white shadow-sm mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-chart-bar text-purple-500 text-xl"></i>
                </div>
                <span class="font-medium text-[#1E5631]">Laporan</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <!-- <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-history text-[#1E5631]"></i>
            Aktivitas Terbaru
        </h2>
        
        <div class="space-y-4">
            <?php foreach ($recentActivities as $activity): ?>
                <div class="flex items-center gap-4 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                    <div class="p-2 rounded-full <?= $activity['type'] === 'user' ? 'bg-green-100 text-green-600' : ($activity['type'] === 'siswa' ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-600') ?>">
                        <i class="fas <?= $activity['type'] === 'user' ? 'fa-user-plus' : ($activity['type'] === 'siswa' ? 'fa-user-graduate' : 'fa-exclamation-triangle') ?> text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium"><?= esc($activity['description']) ?></p>
                        <p class="text-sm text-gray-500"><?= date('d M Y H:i', strtotime($activity['created_at'])) ?></p>
                    </div>
                    <span class="px-2 py-1 <?= $activity['type'] === 'user' ? 'bg-green-100 text-green-800' : ($activity['type'] === 'siswa' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') ?> text-xs rounded-full">
                        <?= ucfirst($activity['type']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div> -->
</div>

<!-- Include Font Awesome and Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();

        // Pelanggaran Chart
        const pelanggaranChart = new Chart(document.getElementById('pelanggaranChart'), {
            type: 'pie',
            data: {
                labels: <?= json_encode(array_column($pelanggaranData, 'kategori')) ?>,
                datasets: [{
                    data: <?= json_encode(array_column($pelanggaranData, 'jumlah')) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Pelanggaran'
                    }
                }
            }
        });

        // Siswa Chart
        const siswaChart = new Chart(document.getElementById('siswaChart'), {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($siswaData, 'kelas')) ?>,
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: <?= json_encode(array_column($siswaData, 'jumlah')) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Siswa'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Kelas'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Siswa per Kelas'
                    }
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>