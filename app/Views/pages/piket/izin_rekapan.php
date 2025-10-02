<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="mt-24 px-4 md:px-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-file-alt text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">List Rekap Surat Izin Siswa</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Lihat rekapan surat izin keluar dan masuk siswa</p>
            </div>
        </div>
        
        <!-- Stats Overview -->
        <div class="flex items-center gap-4">
            <div class="bg-white rounded-xl shadow-sm p-3 border border-gray-200">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-lg bg-green-100 text-green-600">
                        <i class="fas fa-file-alt text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Izin</p>
                        <p class="font-semibold text-gray-800"><?= count($surat_izin) + count($surat_izin_masuk) ?> Data</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Grid Layout -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
        <!-- Surat Izin Keluar -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg bg-white/20 mr-3">
                            <i class="fas fa-sign-out-alt text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Surat Izin Keluar</h3>
                            <p class="text-blue-100 text-sm"><?= count($surat_izin) ?> data surat izin</p>
                        </div>
                    </div>
                    <div class="bg-white/20 rounded-lg px-3 py-1">
                        <span class="text-white font-medium text-sm">KELUAR</span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <?php if (empty($surat_izin)): ?>
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-check-circle text-blue-400 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak ada data surat izin keluar</h3>
                        <p class="text-gray-500 text-sm">Belum ada siswa yang mengajukan izin keluar saat ini</p>
                    </div>
                <?php else: ?>
                    <!-- Search -->
                    <div class="relative mb-4">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Cari siswa..." 
                               class="search-keluar pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 w-full">
                    </div>

                    <!-- Table -->
                    <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggaran</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($surat_izin as $izin): ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <!-- siswa -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                        <span class="text-blue-600 font-medium"><?= strtoupper(substr(esc($izin['nama']), 0, 1)) ?></span>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900"><?= esc($izin['nama']) ?></div>
                                                        <div class="text-xs text-gray-500"><?= esc($izin['kelas']) ?> • <?= esc($izin['nisn']) ?></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- tanggal (format: 02 Oktober 2025) -->
                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900">
                                                    <?= date('d F Y', strtotime($izin['waktu_keluar'])) ?>
                                                </div>
                                            </td>

                                            <!-- waktu keluar & kembali -->
                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 space-y-1">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-sign-out-alt w-4 h-4 mr-2 text-blue-500"></i>
                                                        <?= date('H:i', strtotime($izin['waktu_keluar'])) ?>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <i class="fas fa-sign-in-alt w-4 h-4 mr-2 text-green-500"></i>
                                                        <?= date('H:i', strtotime($izin['waktu_kembali'])) ?>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- pelanggaran -->
                                            <td class="px-4 py-3">
                                                <?php if (!empty($izin['pelanggaran'])): ?>
                                                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                                        <?php foreach ($izin['pelanggaran'] as $p): ?>
                                                            <li>
                                                                <?= esc($p['jenis_pelanggaran']) ?> 
                                                                <span class="text-xs text-gray-500">(<?= $p['poin'] ?> poin)</span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php else: ?>
                                                    <span class="text-xs text-gray-500 italic">Tidak ada pelanggaran</span>
                                                <?php endif; ?>
                                            </td>

                                            <!-- aksi -->
                                            <td class="px-4 py-3 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <!-- tombol detail -->
                                                    <button type="button"
                                                        class="btn-detail text-xs bg-gray-100 text-gray-700 font-medium px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-200 transition"
                                                        data-izin='<?= json_encode($izin) ?>'>
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <!-- tombol tambah pelanggaran -->
                                                    <button type="button" 
                                                            class="btn-tambah-pelanggaran text-xs bg-yellow-100 text-yellow-700 font-medium px-3 py-2 rounded-lg border border-yellow-200 hover:bg-yellow-200 transition"
                                                            data-izin-id="<?= $izin['id'] ?>" 
                                                            data-type="keluar">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                    </button>

                                                    <!-- tombol hapus list (izin keluar) -->
                                                    <form action="<?= base_url('rekapan/delete-izin/' . $izin['id']) ?>" method="post" onsubmit="return confirm('Yakin mau hapus surat izin keluar ini?')">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" 
                                                                class="text-xs bg-red-100 text-red-700 font-medium px-3 py-2 rounded-lg border border-red-200 hover:bg-red-200 transition">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                                <?php if (!empty($izin['pelanggaran'])): ?>
                                                    <div class="mt-2 flex justify-end">
                                                        <form action="<?= base_url('rekapan/delete-all-pelanggaran/' . $izin['id']) ?>" method="post" onsubmit="return confirm('Yakin mau hapus semua pelanggaran siswa ini?')">
                                                            <?= csrf_field() ?>
                                                            <button type="submit" 
                                                                    class="text-xs bg-red-50 text-red-700 font-medium px-3 py-2 rounded-lg border border-red-200 hover:bg-red-200 transition">
                                                                <i class="fas fa-ban"></i> Hapus Semua Pelanggaran
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                <?php endif; ?>
            </div>
        </div>

        <!-- Surat Izin Masuk -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg bg-white/20 mr-3">
                            <i class="fas fa-sign-in-alt text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Surat Izin Masuk</h3>
                            <p class="text-orange-100 text-sm"><?= count($surat_izin_masuk) ?> data surat izin</p>
                        </div>
                    </div>
                    <div class="bg-white/20 rounded-lg px-3 py-1">
                        <span class="text-white font-medium text-sm">MASUK</span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <?php if (empty($surat_izin_masuk)): ?>
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-check-circle text-orange-400 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak ada data surat izin masuk</h3>
                        <p class="text-gray-500 text-sm">Belum ada siswa yang mengajukan izin masuk saat ini</p>
                    </div>
                <?php else: ?>
                    <!-- Search -->
                    <div class="relative mb-4">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Cari siswa..." 
                               class="search-masuk pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 w-full">
                    </div>

                    <!-- Table -->
                   <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggaran</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php foreach ($surat_izin_masuk as $izin): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <!-- siswa -->
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-orange-100 rounded-full flex items-center justify-center">
                                                    <span class="text-orange-600 font-medium"><?= strtoupper(substr(esc($izin['nama']), 0, 1)) ?></span>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900"><?= esc($izin['nama']) ?></div>
                                                    <div class="text-xs text-gray-500"><?= esc($izin['kelas']) ?> • <?= esc($izin['nisn']) ?></div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- tanggal -->
                                        <td class="px-4 py-3">
                                            <div class="text-sm text-gray-900">
                                                <?= date('d F Y', strtotime($izin['created_at'] ?? $izin['waktu_masuk'] ?? 'now')) ?>
                                            </div>
                                        </td>

                                        <!-- alasan -->
                                        <td class="px-4 py-3">
                                            <div class="text-sm text-gray-900">
                                                <div class="font-medium mb-1"><?= esc($izin['alasan_terlambat']) ?: 'Tidak ada alasan' ?></div>
                                                <?php if ($izin['tindak_lanjut']): ?>
                                                    <div class="text-xs text-gray-500"><?= esc($izin['tindak_lanjut']) ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </td>

                                        <!-- pelanggaran -->
                                        <td class="px-4 py-3">
                                            <?php if (!empty($izin['pelanggaran'])): ?>
                                                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                                    <?php foreach ($izin['pelanggaran'] as $p): ?>
                                                        <li>
                                                            <?= esc($p['jenis_pelanggaran']) ?> 
                                                            <span class="text-xs text-gray-500">(<?= $p['poin'] ?> poin)</span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php else: ?>
                                                <span class="text-xs text-gray-500 italic">Tidak ada pelanggaran</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- aksi -->
                                        <td class="px-4 py-3 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- tombol detail -->
                                                <button type="button"
                                                    class="btn-detail text-xs bg-gray-100 text-gray-700 font-medium px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-200 transition"
                                                    data-izin='<?= json_encode($izin) ?>'>
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <!-- tombol tambah pelanggaran -->
                                                <button type="button" 
                                                        class="btn-tambah-pelanggaran text-xs bg-yellow-100 text-yellow-700 font-medium px-3 py-2 rounded-lg border border-yellow-200 hover:bg-yellow-200 transition"
                                                        data-izin-id="<?= $izin['id'] ?>" 
                                                        data-type="masuk">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </button>

                                                <!-- tombol hapus izin masuk -->
                                                <form action="<?= base_url('rekapan/delete-izin-masuk/' . $izin['id']) ?>" method="post" onsubmit="return confirm('Yakin mau hapus surat izin masuk ini?')">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" 
                                                            class="text-xs bg-red-100 text-red-700 font-medium px-3 py-2 rounded-lg border border-red-200 hover:bg-red-200 transition">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- hapus pelanggaran -->
                                            <?php if (!empty($izin['pelanggaran'])): ?>
                                                <div class="mt-2 flex justify-end">
                                                    <form action="<?= base_url('rekapan/delete-all-pelanggaran/' . $izin['id']) ?>" method="post" onsubmit="return confirm('Yakin mau hapus semua pelanggaran siswa ini?')">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" 
                                                                class="text-xs bg-red-50 text-red-700 font-medium px-3 py-2 rounded-lg border border-red-200 hover:bg-red-200 transition">
                                                            <i class="fas fa-ban"></i> Hapus Semua Pelanggaran
                                                        </button>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Izin Keluar</p>
                    <p class="text-2xl font-bold"><?= count($surat_izin) ?></p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm">Total Izin Masuk</p>
                    <p class="text-2xl font-bold"><?= count($surat_izin_masuk) ?></p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-sign-in-alt text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Total Keseluruhan</p>
                    <p class="text-2xl font-bold"><?= count($surat_izin) + count($surat_izin_masuk) ?></p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pelanggaran -->
<div id="modalTambahPelanggaran" 
     class="fixed inset-0 hidden bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4">Tambah Pelanggaran</h2>
            
            <form id="formTambahPelanggaran" method="POST">
                <input type="hidden" name="surat_izin_id" id="surat_izin_id_hidden" value="">

                <!-- Keterangan -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan (opsional)</label>
                    <textarea name="keterangan" placeholder="Masukkan keterangan..." 
                              class="w-full p-2 border border-gray-300 rounded-md" rows="3"></textarea>
                </div>

                <!-- 🔎 Search box -->
                <div class="mb-3">
                    <input type="text" id="searchPelanggaran" 
                           placeholder="Cari jenis pelanggaran..." 
                           class="w-full p-2 border border-gray-300 rounded-md">
                </div>

                <!-- Checkbox list pelanggaran -->
                <div id="pelanggaranListContainer" 
                     class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-60 overflow-y-auto border p-3 rounded">
                    <?php foreach ($pelanggaranList as $p): ?>
                        <label class="flex items-center space-x-2 pelanggaran-item">
                            <input type="checkbox" name="pelanggaran_ids[]" value="<?= $p['id'] ?>" 
                                   class="form-checkbox h-4 w-4 text-blue-600">
                            <span>
                                <?= esc($p['jenis_pelanggaran']) ?> 
                                <small class="text-gray-500">(<?= esc($p['kategori']) ?>, <?= $p['poin'] ?> poin)</small>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" onclick="closePelanggaranModal()"
                        class="px-4 py-2 bg-gray-400 rounded text-white hover:bg-gray-500">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 rounded text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Detail -->
<div id="modalDetail" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden">
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B]">
            <h3 class="text-lg font-semibold text-white">Detail Surat Izin</h3>
            <button onclick="closeModal()" class="text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- Body -->
        <div class="p-6 space-y-4" id="modalDetailContent">
            <!-- Data bakal diinject via JS -->
        </div>
        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
            <button onclick="closeModal()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
[x-cloak] {
    display: none !important;
}

.shadow-lg {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.rounded-2xl {
    border-radius: 1rem;
}

.transition-all {
    transition: all 0.3s ease;
}

/* Custom scrollbar */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>



<script>
    // JS untuk filter search pelanggaran
    document.getElementById('searchPelanggaran').addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();
        let items = document.querySelectorAll('#pelanggaranListContainer .pelanggaran-item');
        
        items.forEach(item => {
            let text = item.innerText.toLowerCase();
            item.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Search functionality for each section
    const searchKeluar = document.querySelector('.search-keluar');
    const searchMasuk = document.querySelector('.search-masuk');
    
    if (searchKeluar) {
        searchKeluar.addEventListener('input', function() {
            const value = this.value.toLowerCase().trim();
            const rows = this.closest('.p-6').querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(value) ? '' : 'none';
            });
        });
    }
    
    if (searchMasuk) {
        searchMasuk.addEventListener('input', function() {
            const value = this.value.toLowerCase().trim();
            const rows = this.closest('.p-6').querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(value) ? '' : 'none';
            });
        });
    }
    
    // Tambah Pelanggaran
    document.querySelectorAll(".btn-tambah-pelanggaran").forEach(btn => {
        btn.addEventListener("click", function() {
            let izinId = this.dataset.izinId;
            let type = this.dataset.type;

            document.getElementById("surat_izin_id_hidden").value = izinId;
            
            let typeInput = document.getElementById("type_hidden");
            if (!typeInput) {
                typeInput = document.createElement("input");
                typeInput.type = "hidden";
                typeInput.name = "type";
                typeInput.id = "type_hidden";
                document.getElementById("formTambahPelanggaran").appendChild(typeInput);
            }
            typeInput.value = type;

            let form = document.getElementById("formTambahPelanggaran");
            form.action = `/piket/surat-izin-pelanggaran/${izinId}/store`;

            document.getElementById("modalTambahPelanggaran").classList.remove("hidden");
        });
    });
    
    // Detail Modal
    document.querySelectorAll(".btn-detail").forEach(btn => {
        btn.addEventListener("click", function() {
            let data = JSON.parse(this.dataset.izin);
            openModal(data);
        });
    });
});

function closePelanggaranModal() {
    document.getElementById("modalTambahPelanggaran").classList.add("hidden");
    document.getElementById("formTambahPelanggaran").reset();
}

function openModal(data) {
    let isKeluar = data.type === 'keluar'; // misalnya kamu kasih type di dataset
    let isMasuk = data.type === 'masuk';

    let content = `
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p><strong>Nama:</strong> <span class="font-medium">${data.nama || '-'}</span></p>
                    <p><strong>NISN:</strong> <span class="font-medium">${data.nisn || '-'}</span></p>
                </div>
                <div>
                    ${data.kelas ? `<p><strong>Kelas:</strong> <span class="font-medium">${data.kelas}</span></p>` : ''}
                    <p><strong>Dibuat pada:</strong> <span class="font-medium">${new Date(data.created_at).toLocaleString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' })}</span></p>
                </div>
            </div>
            
            <hr class="border-gray-200">
            
            <div class="space-y-2">
                ${isKeluar ? `
                    ${data.alasan ? `<p><strong>Alasan:</strong> <span class="text-gray-700">${data.alasan}</span></p>` : ''}
                    ${data.waktu_keluar ? `<p><strong>Waktu Keluar:</strong> <span class="font-medium">${new Date('1970-01-01T' + data.waktu_keluar).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</span></p>` : ''}
                    ${data.waktu_kembali ? `<p><strong>Waktu Kembali:</strong> <span class="font-medium">${new Date('1970-01-01T' + data.waktu_kembali).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</span></p>` : ''}
                ` : ''}

                ${isMasuk ? `
                    ${data.alasan_terlambat ? `<p><strong>Alasan Terlambat:</strong> <span class="text-gray-700">${data.alasan_terlambat}</span></p>` : ''}
                    ${data.tindak_lanjut ? `<p><strong>Tindak Lanjut:</strong> <span class="text-gray-700">${data.tindak_lanjut}</span></p>` : ''}
                ` : ''}
            </div>

            <hr class="border-gray-200">
            
            <div>
                <p class="font-semibold text-gray-800 mb-2">Pelanggaran:</p>
                ${data.pelanggaran && data.pelanggaran.length > 0 ? 
                    `<ul class="space-y-1">` + 
                    data.pelanggaran.map(p => 
                        `<li class="flex justify-between items-center p-2 bg-red-50 rounded border border-red-200">
                            <span class="text-red-800">${p.jenis_pelanggaran || '-'}</span>
                            <span class="text-sm text-red-600">${p.kategori || ''} - ${p.poin || 0} poin</span>
                        </li>`
                    ).join('') + 
                    `</ul>` 
                    : 
                    `<p class="text-gray-500 text-center py-2"><i class="fas fa-check-circle text-green-500 mr-2"></i>Tidak ada pelanggaran tercatat</p>`
                }
            </div>
        </div>
    `;

    document.getElementById("modalDetailContent").innerHTML = content;
    document.getElementById("modalDetail").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("modalDetail").classList.add("hidden");
}
</script>

<?= $this->endSection() ?>