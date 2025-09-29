<?php
$this->extend('layout/dashboard');
$this->section('content');

// Get current page from URL, default to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Records per page
$offset = ($page - 1) * $limit;
$total_records = count($siswa);
$total_pages = ceil($total_records / $limit);
?>

<div class="mt-24 p-6 lg:p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-user-graduate text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Data Siswa</h1>
                <p class="text-gray-600 mt-1">Pantau data siswa untuk keperluan piket</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-[#f0fdf4] to-[#d9f99d] rounded-2xl shadow-lg p-5 border-l-4 border-[#A4DE02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#1E5631]">Total Siswa</p>
                    <p class="text-2xl font-bold text-[#14532d]"><?= count($siswa) ?></p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-users text-[#A4DE02] text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#f0f9ff] to-[#e0f2fe] rounded-2xl shadow-lg p-5 border-l-4 border-blue-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-900">Rata-rata Poin</p>
                    <p class="text-2xl font-bold text-blue-800">
                        <?= !empty($siswa) ? round(array_sum(array_column($siswa, 'poin')) / count($siswa), 1) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-star text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#faf5ff] to-[#e9d5ff] rounded-2xl shadow-lg p-5 border-l-4 border-purple-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-purple-900">Siswa Kelas 12</p>
                    <p class="text-2xl font-bold text-purple-800">
                        <?= !empty($siswa) ? count(array_filter($siswa, fn($s) => strpos($s['kelas'], '12') === 0)) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-graduation-cap text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#fffbeb] to-[#fef3c7] rounded-2xl shadow-lg p-5 border-l-4 border-amber-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-amber-900">Siswa Baru</p>
                    <p class="text-2xl font-bold text-amber-800">
                        <?= !empty($siswa) ? count(array_filter($siswa, fn($s) => strpos($s['kelas'], '10') === 0)) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-user-plus text-amber-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-filter text-[#1E5631] mr-2"></i>
            Filter Data
        </h2>
        
        <form method="get" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="keyword" value="<?= esc($filters['keyword'] ?? '') ?>"
                        placeholder="Cari nama/NIS/NISM"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-school text-gray-400"></i>
                    </div>
                    <select name="kelas" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                        <option value="">Semua Kelas</option>
                        <?php for ($i = 10; $i <= 12; $i++): ?>
                            <option value="<?= $i ?>" <?= ($filters['kelas'] == $i ? 'selected' : '') ?>>
                                Kelas <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>

  

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-venus-mars text-gray-400"></i>
                    </div>
                    <select name="jk" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="L" <?= ($filters['jk'] == 'L' ? 'selected' : '') ?>>Laki-laki</option>
                        <option value="P" <?= ($filters['jk'] == 'P' ? 'selected' : '') ?>>Perempuan</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar-alt text-gray-400"></i>
                    </div>
                    <select name="tahun" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                        <option value="">Semua Tahun</option>
                        <option value="2023/2024" <?= ($filters['tahun'] == '2023/2024' ? 'selected' : '') ?>>2023/2024</option>
                        <option value="2024/2025" <?= ($filters['tahun'] == '2024/2025' ? 'selected' : '') ?>>2024/2025</option>
                        <option value="2025/2026" <?= ($filters['tahun'] == '2025/2026' ? 'selected' : '') ?>>2025/2026</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Poin Pelanggaran</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-star text-gray-400"></i>
                    </div>
                    <select name="poin" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                        <option value="">Semua Poin</option>
                        <option value="0-50" <?= ($filters['poin'] == '0-50' ? 'selected' : '') ?>>0-50</option>
                        <option value="51-100" <?= ($filters['poin'] == '51-100' ? 'selected' : '') ?>>51-100</option>
                        <option value=">100" <?= ($filters['poin'] == '>100' ? 'selected' : '') ?>>Lebih dari 100</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white px-4 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 shadow-md group">
                    <i class="fas fa-filter group-hover:scale-110 transition-transform mr-2"></i>
                    Terapkan Filter
                </button>
            </div>
        </form>

        <div class="mt-4 flex justify-between items-center">
            <span class="text-sm text-gray-600">
                Menampilkan <?= min($limit, count($siswa)) ?> dari <?= $total_records ?> hasil
                <?php if (!empty($filters['keyword']) || !empty($filters['kelas']) ||  !empty($filters['jk']) || !empty($filters['tahun']) || !empty($filters['poin'])): ?>
                    dengan filter yang dipilih
                <?php endif; ?>
            </span>
            <a href="/piket/data_siswa" class="text-sm text-[#1E5631] hover:underline flex items-center">
                <i class="fas fa-sync-alt mr-1"></i> Reset Filter
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Siswa</h3>
                    <p class="text-sm text-gray-600">Total <?= $total_records ?> siswa ditemukan</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto overflow-y-auto max-h-[60vh] max-w-full">
            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                <thead class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white sticky top-0 z-10">
                    <tr>
                        <th class="w-12 px-4 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-list-ol mr-2"></i>
                                No
                            </div>
                        </th>
                        <th class="w-24 px-4 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-id-card mr-2"></i>
                                NIS
                            </div>
                        </th>
                        <th class="w-48 px-4 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                Nama
                            </div>
                        </th>
                        <th class="w-28 px-4 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-venus-mars mr-2"></i>
                                Jenis Kelamin
                            </div>
                        </th>
                        <th class="w-24 px-4 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-school mr-2"></i>
                                Kelas
                            </div>
                        </th>
                        <th class="w-24 px-4 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-sort-numeric-up mr-2"></i>
                                No Absen
                            </div>
                        </th>
                        <th class="w-28 px-4 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                Tahun Ajaran
                            </div>
                        </th>
                        <th class="w-24 px-4 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-star mr-2"></i>
                                Poin
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($siswa)): ?>
                        <?php if (isset($loading) && $loading): ?>
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <tr class="animate-pulse">
                                    <td class="px-4 py-4 whitespace-nowrap"><div class="h-4 bg-gray-200 rounded"></div></td>
                                    <td class="px-4 py-4 whitespace-nowrap"><div class="h-4 bg-gray-200 rounded"></div></td>
                                    <td class="px-4 py-4"><div class="flex items-center"><div class="h-10 w-10 bg-gray-200 rounded-full mr-3"></div><div class="h-4 bg-gray-200 rounded w-2/3"></div></div></td>
                                    <td class="px-4 py-4 whitespace-nowrap"><div class="h-4 bg-gray-200 rounded"></div></td>
                                    <td class="px-4 py-4 whitespace-nowrap"><div class="h-4 bg-gray-200 rounded"></div></td>
                                    <td class="px-4 py-4 whitespace-nowrap"><div class="h-4 bg-gray-200 rounded"></div></td>
                                    <td class="px-4 py-4 whitespace-nowrap"><div class="h-4 bg-gray-200 rounded"></div></td>
                                    <td class="px-4 py-4 whitespace-nowrap"><div class="h-4 bg-gray-200 rounded"></div></td>
                                    <td class="px-4 py-4 whitespace-nowrap"><div class="h-4 bg-gray-200 rounded"></div></td>
                                </tr>
                            <?php endfor; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="px-4 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <i class="fas fa-search text-4xl mb-4 opacity-50"></i>
                                        <p class="text-lg font-medium mb-1">Tidak ada data ditemukan</p>
                                        <p class="text-sm">Coba ubah filter pencarian Anda</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php foreach (array_slice($siswa, $offset, $limit) as $index => $s): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900"><?= $offset + $index + 1 ?></div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900"><?= esc($s['nis']) ?></div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-full flex items-center justify-center text-white font-bold shadow-md mr-3">
                                            <?= strtoupper(substr($s['nama'], 0, 1)) ?>
                                        </div>
                                        <div class="font-medium text-gray-900 truncate"><?= esc($s['nama']) ?></div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full <?= ($s['jk'] == 'L' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-pink-100 text-pink-800 border border-pink-200') ?>">
                                        <?= ($s['jk'] == 'L' ? 'Laki-laki' : 'Perempuan') ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                        <?= esc($s['kelas']) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                        <?= esc($s['no_absen'] ?? '-') ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <?= esc($s['tahun_ajaran'] ?? '-') ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex items-center text-sm font-semibold rounded-full <?= ($s['poin'] > 0 ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-green-100 text-green-800 border border-green-200') ?>">
                                        <i class="fas fa-star text-xs mr-1.5 <?= ($s['poin'] > 0 ? 'text-red-500' : 'text-green-500') ?>"></i>
                                        <?= esc($s['poin']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls -->
        <?php if ($total_pages > 1): ?>
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-600">
                        Halaman <?= $page ?> dari <?= $total_pages ?>
                    </div>
                    <div class="flex items-center gap-2">
                        <?php
                        // Build query string for filters
                        $query_string = http_build_query(array_filter([
                            'keyword' => $filters['keyword'] ?? null,
                            'kelas' => $filters['kelas'] ?? null,
                            'jk' => $filters['jk'] ?? null,
                            'tahun' => $filters['tahun'] ?? null,
                            'poin' => $filters['poin'] ?? null,
                        ]));
                        ?>

                        <!-- Previous Button -->
                        <a href="/piket/data_siswa?page=<?= max(1, $page - 1) ?>&<?= $query_string ?>"
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 <?= $page <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>"
                           <?= $page <= 1 ? 'onclick="return false;"' : '' ?>>
                            <i class="fas fa-chevron-left mr-2"></i> Sebelumnya
                        </a>

                        <!-- Page Numbers -->
                        <div class="flex gap-1">
                            <?php
                            $start_page = max(1, $page - 2);
                            $end_page = min($total_pages, $page + 2);
                            if ($start_page > 1) {
                                echo '<a href="/piket/data_siswa?page=1&' . $query_string . '" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200">1</a>';
                                if ($start_page > 2) {
                                    echo '<span class="px-3 py-1.5 text-gray-500">...</span>';
                                }
                            }
                            for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <a href="/piket/data_siswa?page=<?= $i ?>&<?= $query_string ?>"
                                   class="px-3 py-1.5 rounded-xl transition-all duration-200 <?= $i == $page ? 'bg-[#1E5631] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor;
                            if ($end_page < $total_pages) {
                                if ($end_page < $total_pages - 1) {
                                    echo '<span class="px-3 py-1.5 text-gray-500">...</span>';
                                }
                                echo '<a href="/piket/data_siswa?page=' . $total_pages . '&' . $query_string . '" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200">' . $total_pages . '</a>';
                            }
                            ?>
                        </div>

                        <!-- Next Button -->
                        <a href="/piket/data_siswa?page=<?= min($total_pages, $page + 1) ?>&<?= $query_string ?>"
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 <?= $page >= $total_pages ? 'opacity-50 cursor-not-allowed' : '' ?>"
                           <?= $page >= $total_pages ? 'onclick="return false;"' : '' ?>>
                            Selanjutnya <i class="fas fa-chevron-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
    function exportToExcel() {
        alert('Fitur export Excel akan mengunduh data siswa dalam format spreadsheet.');
        // window.location.href = '/piket/export_excel'; // Uncomment and implement this endpoint
    }

    // Initialize icons
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>

<style>
    .rounded-2xl {
        border-radius: 1rem;
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .shadow-lg {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Custom scrollbar */
    .overflow-x-auto::-webkit-scrollbar,
    .overflow-y-auto::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track,
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb,
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #4C9A2B;
        border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover,
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #1E5631;
    }

    /* Firefox scrollbar */
    .overflow-x-auto,
    .overflow-y-auto {
        scrollbar-width: thin;
        scrollbar-color: #4C9A2B #f1f1f1;
    }
</style>

<?= $this->endSection() ?>