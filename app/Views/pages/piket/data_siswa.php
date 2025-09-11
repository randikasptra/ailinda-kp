<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="mt-24 p-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-user-graduate text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Data Siswa</h1>
                <p class="text-gray-600 mt-1">Kelola dan pantau data siswa secara lengkap</p>
            </div>
        </div>
        
      
    </div>

    <!-- Stats Overview -->
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
                        <?= !empty($siswa) ? count(array_filter($siswa, function($s) { return strpos($s['kelas'], '12') === 0; })) : '0' ?>
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
                        <?= !empty($siswa) ? count(array_filter($siswa, function($s) { return strpos($s['kelas'], '10') === 0; })) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-user-plus text-amber-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-filter text-[#1E5631] mr-2"></i>
            Filter Data
        </h2>
        
        <form method="get" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="keyword" value="<?= esc($filter['keyword'] ?? '') ?>"
                        placeholder="Cari nama/NISN"
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
                            <option value="<?= $i ?>" <?= ($filter['kelas'] == $i ? 'selected' : '') ?>>
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
                <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-book text-gray-400"></i>
                    </div>
                    <select name="jurusan" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                        <option value="">Semua Jurusan</option>
                        <option value="SAINTEK" <?= ($filter['jurusan'] == 'SAINTEK' ? 'selected' : '') ?>>SAINTEK</option>
                        <option value="SOSHUM" <?= ($filter['jurusan'] == 'SOSHUM' ? 'selected' : '') ?>>SOSHUM</option>
                        <option value="BAHASA" <?= ($filter['jurusan'] == 'BAHASA' ? 'selected' : '') ?>>BAHASA</option>
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
                Menampilkan <?= count($siswa) ?> hasil
                <?php if (!empty($filter['keyword']) || !empty($filter['kelas']) || !empty($filter['jurusan'])): ?>
                    dengan filter yang dipilih
                <?php endif; ?>
            </span>
            <a href="/piket/data_siswa" class="text-sm text-[#1E5631] hover:underline flex items-center">
                <i class="fas fa-sync-alt mr-1"></i> Reset Filter
            </a>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Table Header -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Siswa</h3>
                    <p class="text-sm text-gray-600">Total <?= count($siswa) ?> siswa ditemukan</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-id-card mr-2"></i>
                                NISN
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                Nama
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-school mr-2"></i>
                                Kelas
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-book mr-2"></i>
                                Jurusan
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-star mr-2"></i>
                                Poin
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($siswa)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <i class="fas fa-search text-4xl mb-4 opacity-50"></i>
                                    <p class="text-lg font-medium mb-1">Tidak ada data ditemukan</p>
                                    <p class="text-sm">Coba ubah filter pencarian Anda</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($siswa as $s): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900"><?= esc($s['nisn']) ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-full flex items-center justify-center text-white font-bold shadow-md mr-3">
                                            <?= strtoupper(substr($s['nama'], 0, 1)) ?>
                                        </div>
                                        <div class="font-medium text-gray-900"><?= esc($s['nama']) ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                        <?= esc($s['kelas']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-purple-100 text-purple-800 border border-purple-200">
                                        <?= esc($s['jurusan']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
    </div>
</div>

<!-- Include Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
function exportToExcel() {
    // Simple export functionality - in real implementation, you might want to use a library like SheetJS
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
</style>

<?= $this->endSection() ?>