<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="p-8">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-6 border-b border-gray-100 gap-4">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                    <i class="fas fa-user-graduate text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Kelola Data Siswa</h1>
                    <p class="text-gray-600 mt-1">Manajemen data siswa dan informasi akademik</p>
                </div>
            </div>

            <!-- Kanan: Tombol Aksi -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Tambah Siswa -->
                <button onclick="openModal('tambahModal')"
                    class="flex items-center gap-2 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white px-5 py-3 rounded-xl hover:shadow-xl transition-all duration-300 shadow-md group">
                    <i class="fas fa-user-plus group-hover:scale-110 transition-transform"></i>
                    Tambah Siswa
                </button>

                <!-- Naikkan Kelas -->
                <form action="<?= base_url('admin/siswa/update_kelas') ?>" method="post"
                    onsubmit="return confirm('Yakin ingin naikkan semua kelas siswa?')" class="inline">
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-3 border border-[#1E5631] text-[#1E5631] hover:bg-[#1E5631] hover:text-white rounded-xl transition-all duration-300 shadow-sm group">
                        <i class="fas fa-arrow-up group-hover:scale-110 transition-transform"></i>
                        Naikkan Kelas
                    </button>
                </form>

                <!-- Hapus Siswa Lulus -->
                <form action="<?= base_url('admin/siswa/hapus_lulus') ?>" method="post"
                    onsubmit="return confirm('Hapus semua siswa yang sudah lulus?')" class="inline">
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-3 border border-red-600 text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition-all duration-300 shadow-sm group">
                        <i class="fas fa-trash-alt group-hover:scale-110 transition-transform"></i>
                        Hapus Lulus
                    </button>
                </form>
            </div>
        </div>

        <!-- Import CSV -->
       <div class="p-6 border-b border-gray-100 bg-gray-50/50">
    <form action="<?= base_url('admin/siswa/import_csv'); ?>" method="post" enctype="multipart/form-data" class="flex flex-col md:flex-row items-start md:items-end gap-4">
        <div class="flex-1">
            <label for="csv_file" class="block mb-2 font-medium text-gray-700">
                Import Siswa dari CSV / Excel
            </label>
            <div class="relative">
                <input type="file" name="csv_file" id="csv_file" accept=".csv,.xls,.xlsx" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all
                           file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 
                           file:text-sm file:font-semibold file:bg-[#1E5631]/10 file:text-[#1E5631] hover:file:bg-[#1E5631]/20">
            </div>
        </div>
        
        <button type="submit"
            class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-xl transition-all duration-300 shadow-md group">
            <i class="fas fa-file-import group-hover:scale-110 transition-transform"></i>
            Upload File
        </button>
    </form>
</div>

    </div>

    <!-- Alert Notification -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl shadow-sm">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <div>
                <p class="font-medium"><?= session()->getFlashdata('success') ?></p>
            </div>
            <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

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

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Table Header with Stats -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <form method="get" class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Siswa</h3>
                    <p class="text-sm text-gray-600">Total <?= count($siswa) ?> siswa terdaftar</p>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Filter Kelas -->
                    <select name="kelas" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                        <option value="">Semua Kelas</option>
                        <option value="10" <?= ($filters['kelas'] == '10') ? 'selected' : '' ?>>Kelas 10</option>
                        <option value="11" <?= ($filters['kelas'] == '11') ? 'selected' : '' ?>>Kelas 11</option>
                        <option value="12" <?= ($filters['kelas'] == '12') ? 'selected' : '' ?>>Kelas 12</option>
                    </select>

                    <!-- Filter Jurusan -->
                    <select name="jurusan" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                        <option value="">Semua Jurusan</option>
                        <option value="SAINTEK" <?= ($filters['jurusan'] == 'SAINTEK') ? 'selected' : '' ?>>SAINTEK</option>
                        <option value="SOSHUM" <?= ($filters['jurusan'] == 'SOSHUM') ? 'selected' : '' ?>>SOSHUM</option>
                        <option value="BAHASA" <?= ($filters['jurusan'] == 'BAHASA') ? 'selected' : '' ?>>BAHASA</option>
                    </select>

                    <!-- Filter Jenis Kelamin -->
                    <select name="jk" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="L" <?= ($filters['jk'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= ($filters['jk'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
                    </select>

                    <!-- Filter Tahun Ajaran -->
                    <select name="tahun" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                        <option value="">Semua Tahun</option>
                        <option value="2024/2025" <?= ($filters['tahun'] == '2024/2025') ? 'selected' : '' ?>>2024/2025</option>
                        <option value="2025/2026" <?= ($filters['tahun'] == '2025/2026') ? 'selected' : '' ?>>2025/2026</option>
                    </select>

                    <!-- Search -->
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" placeholder="Cari NIS/NISM/Nama..." 
                            value="<?= esc($filters['search']) ?>"
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                    </div>

                    <!-- Tombol Filter -->
                    <button type="submit" class="px-4 py-2 bg-[#1E5631] text-white rounded-lg hover:bg-[#174726] transition">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>

                    <!-- Tombol Reset -->
                    <a href="/admin/siswa" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <?php if (!empty($siswa)): ?>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider w-16">No</th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">No Absen</th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Tahun Ajaran</th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Poin</th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $no = 1; foreach ($siswa as $s): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors duration-200 group">
                                <td class="px-6 py-4 text-center font-medium text-gray-500"><?= $no++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900"><?= esc($s['nis']) ?></div>
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
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full <?= ($s['jk'] == 'L' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-pink-100 text-pink-800 border border-pink-200') ?>">
                                        <?= ($s['jk'] == 'L' ? 'Laki-laki' : 'Perempuan') ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                        <?= esc($s['kelas']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                        <?= esc($s['no_absen'] ?? '-') ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-purple-100 text-purple-800 border border-purple-200">
                                        <?= esc($s['jurusan']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($s['tahun_ajaran'] ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex items-center text-sm font-semibold rounded-full bg-[#A4DE02]/20 text-[#1E5631] border border-[#A4DE02]/30">
                                        <i class="fas fa-star text-[#A4DE02] mr-1.5 text-xs"></i>
                                        <?= esc($s['poin']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="/admin/siswa/detail_siswa/<?= $s['id'] ?>" class="p-2.5 text-gray-600 bg-gray-100 rounded-xl hover:bg-[#1E5631] hover:text-white transition-all duration-300" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/admin/siswa/edit_siswa/<?= $s['id'] ?>" class="p-2.5 text-blue-600 bg-blue-100 rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-300" title="Edit Siswa">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="/admin/siswa/hapus/<?= $s['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')" class="p-2.5 text-red-600 bg-red-100 rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300" title="Hapus Siswa">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-16 bg-white rounded-2xl shadow-lg mt-6">
                    <i class="fas fa-user-graduate text-4xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-700">Belum ada data siswa</h3>
                    <p class="text-gray-500 mt-1">Tambahkan siswa pertama atau impor data dari CSV</p>
                    <div class="mt-6 flex gap-4 justify-center">
                        <button onclick="openModal('tambahModal')" class="bg-[#1E5631] text-white px-6 py-2.5 rounded-lg hover:bg-[#145128] transition-colors">
                            <i class="fas fa-user-plus mr-2"></i>Tambah Siswa
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- Pagination -->
<!-- Pagination -->
<?php if ($pager): ?>
    <div class="p-6 border-t border-gray-200 flex justify-center">
        <?= $pager->links('default', 'tailwind_pagination') ?>
    </div>
<?php endif; ?>


    </div>
</div>

<!-- Include Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

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
<!-- Modal Tambah Siswa -->
<div id="tambahModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md border border-[#1E5631]/20 animate-scaleIn">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-xl font-bold text-[#1E5631] flex items-center">
                <i class="fas fa-user-plus mr-2"></i>
                Tambah Siswa
            </h2>
            <button onclick="closeModal('tambahModal')"
                class="text-gray-400 hover:text-gray-600 transition duration-200 p-1 rounded-full hover:bg-gray-100">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <form method="POST" action="/admin/siswa/tambah" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">NIS</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-id-card text-gray-400"></i>
                    </div>
                    <input type="text" name="nis" inputmode="numeric" pattern="\d+"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                        placeholder="Masukkan NIS" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">NISM</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-id-card-alt text-gray-400"></i>
                    </div>
                    <input type="text" name="nism"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                        placeholder="Masukkan NISM (opsional)">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="nama"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                        placeholder="Masukkan nama lengkap" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-venus-mars text-gray-400"></i>
                        </div>
                        <select name="jk"
                            class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white"
                            required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-school text-gray-400"></i>
                        </div>
                        <input type="text" name="kelas"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                            placeholder="Masukkan kelas (contoh: 10.1)" required>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-book text-gray-400"></i>
                        </div>
                        <select name="jurusan"
                            class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white"
                            required>
                            <option value="">Pilih Jurusan</option>
                            <option value="SAINTEK">SAINTEK</option>
                            <option value="SOSHUM">SOSHUM</option>
                            <option value="BAHASA">BAHASA</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No Absen</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-sort-numeric-up text-gray-400"></i>
                        </div>
                        <input type="number" name="no_absen" min="1"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                            placeholder="Masukkan no absen (opsional)">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar text-gray-400"></i>
                        </div>
                        <input type="text" name="tahun_ajaran" placeholder="2024/2025"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Poin Awal</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-star text-gray-400"></i>
                        </div>
                        <input type="number" name="poin" value="0" min="0"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all">
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeModal('tambahModal')"
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition duration-200 font-medium">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 px-4 py-3 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white rounded-xl hover:shadow-lg transition duration-200 font-medium shadow-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script Modal -->
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal(modal.id);
            }
        });
    });

    // Initialize icons
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
<style>
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .animate-scaleIn {
        animation: scaleIn 0.2s ease-out;
    }
    
    .modal {
        backdrop-filter: blur(4px);
    }
</style>

<?= $this->endSection() ?>