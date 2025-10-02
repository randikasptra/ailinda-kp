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

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl shadow-sm">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <p class="font-medium"><?= esc(session()->getFlashdata('success')) ?></p>
            <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="flex items-center bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-xl shadow-sm">
            <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
            <p class="font-medium"><?= esc(session()->getFlashdata('error')) ?></p>
            <button class="ml-auto text-red-700 hover:text-red-900" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium">Total Izin Keluar</p>
                    <p class="text-2xl font-bold mt-1"><?= count($surat_izin) ?></p>
                    <p class="text-emerald-200 text-xs mt-2">Surat izin keluar</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-teal-100 text-sm font-medium">Total Izin Masuk</p>
                    <p class="text-2xl font-bold mt-1"><?= count($surat_izin_masuk) ?></p>
                    <p class="text-teal-200 text-xs mt-2">Surat izin masuk</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-sign-in-alt text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Keseluruhan</p>
                    <p class="text-2xl font-bold mt-1"><?= count($surat_izin) + count($surat_izin_masuk) ?></p>
                    <p class="text-green-200 text-xs mt-2">Semua surat izin</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Surat Izin Keluar - Full Width -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-8">
        <!-- Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-white/20 mr-3">
                        <i class="fas fa-sign-out-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Surat Izin Keluar</h3>
                        <p class="text-emerald-100 text-sm"><?= count($surat_izin) ?> data surat izin</p>
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
                    <div class="mx-auto w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-check-circle text-emerald-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak ada data surat izin keluar</h3>
                    <p class="text-gray-500 text-sm">Belum ada siswa yang mengajukan izin keluar saat ini</p>
                </div>
            <?php else: ?>
                <!-- Search -->
                <div class="relative mb-4">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari siswa..." 
                           class="search-keluar pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 w-full">
                </div>

                <!-- Table Container -->
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggaran</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($surat_izin as $izin): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <!-- siswa -->
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                                <span class="text-emerald-600 font-medium"><?= strtoupper(substr(esc($izin['nama']), 0, 1)) ?></span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900"><?= esc($izin['nama']) ?></div>
                                                <div class="text-xs text-gray-500"><?= esc($izin['kelas']) ?> • <?= esc($izin['nisn']) ?></div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- tanggal -->
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?= tglIndo($izin['created_at'] ?? $izin['waktu_keluar'] ?? 'now') ?>
                                        </div>
                                    </td>


                                    <!-- waktu keluar & kembali -->
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 space-y-1">
                                            <div class="flex items-center">
                                                <i class="fas fa-sign-out-alt w-4 h-4 mr-2 text-emerald-500"></i>
                                                <?= date('H:i', strtotime($izin['waktu_keluar'])) ?>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-sign-in-alt w-4 h-4 mr-2 text-green-500"></i>
                                                <?= date('H:i', strtotime($izin['waktu_kembali'])) ?>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- alasan -->
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="break-words"><?= esc($izin['alasan']) ?: 'Tidak ada alasan' ?></div>
                                        </div>
                                    </td>
                             

                                    <!-- pelanggaran -->
                                    <td class="px-4 py-4">
                                        <?php if (!empty($izin['pelanggaran'])): ?>
                                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                                <?php foreach ($izin['pelanggaran'] as $p): ?>
                                                    <li class="break-words max-w-xs">
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
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex flex-col items-end gap-2">
                                            <!-- Baris pertama: tombol utama -->
                                            <div class="flex items-center gap-2">
                                                <!-- tombol detail -->
                                                <button type="button"
                                                    class="btn-detail flex items-center gap-1 text-xs bg-gray-100 text-gray-700 font-medium px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-200 transition"
                                                    data-izin='<?= json_encode($izin) ?>'
                                                    title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="hidden sm:inline">Detail</span>
                                                </button>

                                                <!-- tombol hapus izin keluar -->
                                                <form action="<?= base_url('rekapan/delete-izin/' . $izin['id']) ?>" method="post"
                                                    onsubmit="return confirm('Yakin mau hapus surat izin keluar ini?')">
                                                    <?= csrf_field() ?>
                                                    <button type="submit"
                                                        class="flex items-center gap-1 text-xs bg-red-100 text-red-700 font-medium px-3 py-2 rounded-lg border border-red-200 hover:bg-red-200 transition"
                                                        title="Hapus Izin Keluar">
                                                        <i class="fas fa-trash"></i>
                                                        <span class="hidden sm:inline">Hapus</span>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Baris kedua: tombol pelanggaran -->
                                            <div class="flex items-center gap-2">
                                                <!-- tombol tambah/edit pelanggaran -->
                                                <button type="button"
                                                    class="btn-tambah-pelanggaran flex items-center gap-1 text-xs 
                                                        <?= empty($izin['pelanggaran']) 
                                                                ? 'bg-amber-100 text-amber-700 border border-amber-200 hover:bg-amber-200' 
                                                                : 'bg-blue-100 text-blue-700 border border-blue-200 hover:bg-blue-200' ?>
                                                        font-medium px-3 py-2 rounded-lg transition"
                                                    data-izin-id="<?= $izin['id'] ?>" 
                                                    data-type="keluar"
                                                    data-has-pelanggaran="<?= !empty($izin['pelanggaran']) ? 'true' : 'false' ?>"
                                                    data-pelanggaran-json='<?= json_encode($izin['pelanggaran']) ?>'
                                                    data-keterangan-json='<?= json_encode($izin['pelanggaran'][0]['catatan'] ?? '') ?>'
                                                    title="<?= empty($izin['pelanggaran']) ? 'Tambah Pelanggaran' : 'Edit Pelanggaran' ?>">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    <span><?= empty($izin['pelanggaran']) ? 'Tambah' : 'Edit' ?> Pelanggaran</span>
                                                </button>

                                                <!-- tombol hapus semua pelanggaran (hanya tampil jika ada pelanggaran) -->
                                                <?php if (!empty($izin['pelanggaran'])): ?>
                                                    <form action="<?= base_url('rekapan/delete-all-pelanggaran/' . $izin['id']) ?>" method="post"
                                                        onsubmit="return confirm('Yakin mau hapus semua pelanggaran siswa ini?')">
                                                        <?= csrf_field() ?>
                                                        <button type="submit"
                                                            class="flex items-center gap-1 text-xs bg-red-50 text-red-700 font-medium px-3 py-2 rounded-lg border border-red-200 hover:bg-red-100 transition"
                                                            title="Hapus Semua Pelanggaran">
                                                            <i class="fas fa-ban"></i>
                                                            <span class="hidden sm:inline">Hapus Pelanggaran</span>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Surat Izin Masuk - Full Width -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-white/20 mr-3">
                        <i class="fas fa-sign-in-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Surat Izin Masuk</h3>
                        <p class="text-teal-100 text-sm"><?= count($surat_izin_masuk) ?> data surat izin</p>
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
                    <div class="mx-auto w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-check-circle text-teal-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak ada data surat izin masuk</h3>
                    <p class="text-gray-500 text-sm">Belum ada siswa yang mengajukan izin masuk saat ini</p>
                </div>
            <?php else: ?>
                <!-- Search -->
                <div class="relative mb-4">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari siswa..." 
                           class="search-masuk pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 w-full">
                </div>

                <!-- Table Container -->
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindak Lanjut</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggaran</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($surat_izin_masuk as $izin): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <!-- siswa -->
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-teal-100 rounded-full flex items-center justify-center">
                                                <span class="text-teal-600 font-medium"><?= strtoupper(substr(esc($izin['nama']), 0, 1)) ?></span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900"><?= esc($izin['nama']) ?></div>
                                                <div class="text-xs text-gray-500"><?= esc($izin['kelas']) ?> • <?= esc($izin['nisn']) ?></div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- tanggal -->
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?= tglIndo($izin['created_at'] ?? $izin['waktu_keluar'] ?? 'now') ?>
                                        </div>
                                    </td>

                                    <!-- alasan -->
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="font-medium mb-1 break-words"><?= esc($izin['alasan_terlambat']) ?: 'Tidak ada alasan' ?></div>
                                        </div>
                                    </td>

                                    <!-- tindak lanjut -->
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="break-words"><?= esc($izin['tindak_lanjut']) ?: 'Tidak ada tindak lanjut' ?></div>
                                        </div>
                                    </td>

                                    <!-- pelanggaran -->
                                    <td class="px-4 py-4">
                                        <?php if (!empty($izin['pelanggaran'])): ?>
                                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                                <?php foreach ($izin['pelanggaran'] as $p): ?>
                                                    <li class="break-words max-w-xs">
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
                                   <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex flex-col items-end gap-2">
                                            <!-- Baris pertama: tombol utama -->
                                            <div class="flex items-center gap-2">
                                                <!-- tombol detail -->
                                                <button type="button"
                                                    class="btn-detail flex items-center gap-1 text-xs bg-gray-100 text-gray-700 font-medium px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-200 transition"
                                                    data-izin='<?= json_encode($izin) ?>'
                                                    title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="hidden sm:inline">Detail</span>
                                                </button>

                                                <!-- tombol hapus izin masuk -->
                                                <form action="<?= base_url('rekapan/delete-izin-masuk/' . $izin['id']) ?>" method="post"
                                                    onsubmit="return confirm('Yakin mau hapus surat izin masuk ini?')">
                                                    <?= csrf_field() ?>
                                                    <button type="submit"
                                                        class="flex items-center gap-1 text-xs bg-red-100 text-red-700 font-medium px-3 py-2 rounded-lg border border-red-200 hover:bg-red-200 transition"
                                                        title="Hapus Izin Masuk">
                                                        <i class="fas fa-trash"></i>
                                                        <span class="hidden sm:inline">Hapus</span>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Baris kedua: tombol pelanggaran -->
                                            <div class="flex items-center gap-2">
                                                <!-- tombol tambah/edit pelanggaran -->
                                                <button type="button"
                                                    class="btn-tambah-pelanggaran flex items-center gap-1 text-xs 
                                                        <?= empty($izin['pelanggaran']) 
                                                                ? 'bg-amber-100 text-amber-700 border border-amber-200 hover:bg-amber-200' 
                                                                : 'bg-blue-100 text-blue-700 border border-blue-200 hover:bg-blue-200' ?>
                                                        font-medium px-3 py-2 rounded-lg transition"
                                                    data-izin-id="<?= $izin['id'] ?>" 
                                                    data-type="masuk"
                                                    data-has-pelanggaran="<?= !empty($izin['pelanggaran']) ? 'true' : 'false' ?>"
                                                    data-pelanggaran-json='<?= json_encode($izin['pelanggaran']) ?>'
                                                    data-keterangan-json='<?= json_encode($izin['pelanggaran'][0]['catatan'] ?? '') ?>'
                                                    title="<?= empty($izin['pelanggaran']) ? 'Tambah Pelanggaran' : 'Edit Pelanggaran' ?>">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    <span><?= empty($izin['pelanggaran']) ? 'Tambah' : 'Edit' ?> Pelanggaran</span>
                                                </button>

                                                <!-- tombol hapus semua pelanggaran (hanya tampil jika ada pelanggaran) -->
                                                <?php if (!empty($izin['pelanggaran'])): ?>
                                                    <form action="<?= base_url('rekapan/delete-all-pelanggaran/' . $izin['id']) ?>" method="post"
                                                        onsubmit="return confirm('Yakin mau hapus semua pelanggaran siswa ini?')">
                                                        <?= csrf_field() ?>
                                                        <button type="submit"
                                                            class="flex items-center gap-1 text-xs bg-red-50 text-red-700 font-medium px-3 py-2 rounded-lg border border-red-200 hover:bg-red-100 transition"
                                                            title="Hapus Semua Pelanggaran">
                                                            <i class="fas fa-ban"></i>
                                                            <span class="hidden sm:inline">Hapus Pelanggaran</span>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </div>
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

<!-- Modal Tambah Pelanggaran - revisi -->
<div id="modalTambahPelanggaran" 
     class="fixed inset-0 hidden bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Pelanggaran</h2>
            
            <!-- Preview Section - baru, hidden default -->
            <div class="preview-section hidden mb-4 p-3 bg-red-50 border border-red-200 rounded-md">
                <p class="font-medium text-red-800 mb-2">Pelanggaran Sebelumnya:</p>
                <ul id="previewPelanggaranLama" class="list-disc list-inside text-sm text-red-600 space-y-1"></ul>
            </div>
            
            <form id="formTambahPelanggaran" method="POST" action="<?= base_url('rekapan/store-pelanggaran') ?>">
                <input type="hidden" name="surat_izin_id" id="surat_izin_id_hidden" value="">
                <input type="hidden" name="mode" value="add">

                <!-- Keterangan -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan (opsional)</label>
                    <textarea name="keterangan" placeholder="Masukkan keterangan..." 
                              class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" rows="3"></textarea>
                </div>

                <!-- 🔎 Search box -->
                <div class="mb-3">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="searchPelanggaran" 
                               placeholder="Cari jenis pelanggaran..." 
                               class="w-full pl-10 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                </div>

                <!-- Checkbox list pelanggaran -->
                <div id="pelanggaranListContainer" 
                     class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-60 overflow-y-auto border border-gray-300 p-3 rounded-md">
                    <?php foreach ($pelanggaranList as $p): ?>
                        <label class="flex items-center space-x-2 pelanggaran-item p-2 rounded hover:bg-gray-50 transition-colors">
                            <input type="checkbox" name="pelanggaran_ids[]" value="<?= $p['id'] ?>" 
                                   class="form-checkbox h-4 w-4 text-emerald-600 focus:ring-emerald-500">
                            <span class="text-sm">
                                <?= esc($p['jenis_pelanggaran']) ?> 
                                <small class="text-gray-500 block"><?= esc($p['kategori']) ?> • <?= $p['poin'] ?> poin</small>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" onclick="closePelanggaranModal()"
                        class="px-4 py-2 bg-gray-400 rounded-lg text-white hover:bg-gray-500 transition-colors font-medium">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 rounded-lg text-white hover:bg-emerald-700 transition-colors font-medium">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="modalDetail" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B]">
            <h3 class="text-lg font-semibold text-white">Detail Surat Izin</h3>
            <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <!-- Body -->
        <div class="p-6 space-y-4 max-h-96 overflow-y-auto" id="modalDetailContent">
            <!-- Data bakal diinject via JS -->
        </div>
        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
            <button onclick="closeModal()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium transition-colors">
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

.transition-colors {
    transition: all 0.2s ease-in-out;
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

/* Smooth animations */
.modal-enter {
    opacity: 0;
    transform: scale(0.95);
}

.modal-enter-active {
    opacity: 1;
    transform: scale(1);
    transition: opacity 200ms ease-out, transform 200ms ease-out;
}

/* Improved table styling */
.min-w-full {
    min-width: 100%;
}

.whitespace-nowrap {
    white-space: nowrap;
}

.break-words {
    overflow-wrap: break-word;
    word-break: break-word;
}

.max-w-xs {
    max-width: 20rem;
}

/* Better spacing for table cells */
.px-4.py-4 {
    padding-left: 1rem;
    padding-right: 1rem;
    padding-top: 1rem;
    padding-bottom: 1rem;
}

/* Improved table header styling */
.bg-gray-50 {
    background-color: #f9fafb;
}

/* Better table row hover effect */
.hover\:bg-gray-50:hover {
    background-color: #f9fafb;
}

/* Full width table improvements */
table {
    table-layout: auto;
}

th, td {
    min-width: 120px;
}

/* Specific column widths for better layout */
th:nth-child(1), td:nth-child(1) { /* Siswa */
    min-width: 180px;
}

th:nth-child(2), td:nth-child(2) { /* Tanggal */
    min-width: 140px;
}

th:nth-child(3), td:nth-child(3) { /* Waktu/Alasan */
    min-width: 150px;
}

th:nth-child(4), td:nth-child(4) { /* Alasan/Tindak Lanjut */
    min-width: 200px;
}

th:nth-child(5), td:nth-child(5) { /* Pelanggaran */
    min-width: 200px;
}

th:nth-child(6), td:nth-child(6) { /* Aksi */
    min-width: 140px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modalTambahPelanggaran');
    const form = document.getElementById('formTambahPelanggaran');
    const searchInput = document.getElementById('searchPelanggaran');
    const pelanggaranItems = document.querySelectorAll('.pelanggaran-item input[type="checkbox"]');
    const hiddenIzinId = document.getElementById('surat_izin_id_hidden');
    const title = modal.querySelector('h2');
    const previewList = document.getElementById('previewPelanggaranLama');
    const textareaKeterangan = form.querySelector('textarea[name="keterangan"]');
    const submitBtn = form.querySelector('button[type="submit"]');

    // Fungsi open modal
    function openPelanggaranModal(btn) {
        const izinId = btn.dataset.izinId;
        const type = btn.dataset.type;
        const hasPelanggaran = btn.dataset.hasPelanggaran === 'true';
        const pelanggaranJson = btn.dataset.pelanggaranJson;
        const keteranganJson = btn.dataset.keteranganJson;

        hiddenIzinId.value = izinId;
        form.dataset.type = type; // Simpan type di form untuk POST

        if (hasPelanggaran) {
            // Mode Edit
            title.textContent = 'Edit Pelanggaran';
            submitBtn.textContent = 'Update';
            const pelanggaranLama = JSON.parse(pelanggaranJson);
            const keteranganLama = JSON.parse(keteranganJson) || '';

            // Tampilkan preview list lama
            previewList.innerHTML = pelanggaranLama.map(p => 
                `<li class="text-sm text-red-600">${p.jenis_pelanggaran} (${p.poin} poin)</li>`
            ).join('');
            previewList.closest('.preview-section').classList.remove('hidden');

            // Isi textarea
            textareaKeterangan.value = keteranganLama;

            // Check checkbox yang sudah ada
            const selectedIds = pelanggaranLama.map(p => p.pelanggaran_id);
            pelanggaranItems.forEach(checkbox => {
                if (selectedIds.includes(parseInt(checkbox.value))) {
                    checkbox.checked = true;
                }
            });

            // Tambah hidden input untuk mode edit
            let modeInput = form.querySelector('input[name="mode"]');
            if (!modeInput) {
                modeInput = document.createElement('input');
                modeInput.type = 'hidden';
                modeInput.name = 'mode';
                form.appendChild(modeInput);
            }
            modeInput.value = 'edit';
        } else {
            // Mode Add
            title.textContent = 'Tambah Pelanggaran';
            submitBtn.textContent = 'Simpan';
            previewList.innerHTML = '';
            previewList.closest('.preview-section').classList.add('hidden');
            textareaKeterangan.value = '';
            pelanggaranItems.forEach(checkbox => checkbox.checked = false);

            let modeInput = form.querySelector('input[name="mode"]');
            if (modeInput) modeInput.value = 'add';
        }

        modal.classList.remove('hidden');
    }

    // Event listener tombol tambah/edit
    document.querySelectorAll('.btn-tambah-pelanggaran').forEach(btn => {
        btn.addEventListener('click', () => openPelanggaranModal(btn));
    });

    // Fungsi close modal
    window.closePelanggaranModal = function() {
        modal.classList.add('hidden');
        form.reset();
    };

    // Search functionality
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.pelanggaran-item').forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(query) ? 'flex' : 'none';
        });
    });

    // Submit form - tambah type ke POST
    form.addEventListener('submit', function(e) {
        const typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'type';
        typeInput.value = this.dataset.type;
        this.appendChild(typeInput);
    });

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
    
    // Detail Modal
    document.querySelectorAll(".btn-detail").forEach(btn => {
        btn.addEventListener("click", function() {
            let data = JSON.parse(this.dataset.izin);
            openModal(data);
        });
    });
});

function openModal(data) {
    let isKeluar = data.waktu_keluar !== undefined;
    let isMasuk = data.alasan_terlambat !== undefined;

    let content = `
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nama</p>
                    <p class="font-medium text-gray-900">${data.nama || '-'}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">NISN</p>
                    <p class="font-medium text-gray-900">${data.nisn || '-'}</p>
                </div>
                <div>
                    ${data.kelas ? `
                        <p class="text-sm text-gray-600">Kelas</p>
                        <p class="font-medium text-gray-900">${data.kelas}</p>
                    ` : ''}
                </div>
                <div>
                    <p class="text-sm text-gray-600">Dibuat pada</p>
                    <p class="font-medium text-gray-900">${new Date(data.created_at).toLocaleString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                </div>
            </div>
            
            <hr class="border-gray-200">
            
            <div class="space-y-3">
                ${isKeluar ? `
                    ${data.alasan ? `
                        <div>
                            <p class="text-sm text-gray-600">Alasan</p>
                            <p class="text-gray-900">${data.alasan}</p>
                        </div>
                    ` : ''}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Waktu Keluar</p>
                            <p class="font-medium text-gray-900">${new Date('1970-01-01T' + data.waktu_keluar).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Waktu Kembali</p>
                            <p class="font-medium text-gray-900">${new Date('1970-01-01T' + data.waktu_kembali).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</p>
                        </div>
                    </div>
                ` : ''}

                ${isMasuk ? `
                    ${data.alasan_terlambat ? `
                        <div>
                            <p class="text-sm text-gray-600">Alasan Terlambat</p>
                            <p class="text-gray-900">${data.alasan_terlambat}</p>
                        </div>
                    ` : ''}
                    ${data.tindak_lanjut ? `
                        <div>
                            <p class="text-sm text-gray-600">Tindak Lanjut</p>
                            <p class="text-gray-900">${data.tindak_lanjut}</p>
                        </div>
                    ` : ''}
                ` : ''}
            </div>

            <hr class="border-gray-200">
            
            <div>
                <p class="font-semibold text-gray-800 mb-3">Pelanggaran</p>
                ${data.pelanggaran && data.pelanggaran.length > 0 ? 
                    `<div class="space-y-2">` + 
                    data.pelanggaran.map(p => 
                        `<div class="flex justify-between items-center p-3 bg-red-50 rounded-lg border border-red-200">
                            <div>
                                <span class="font-medium text-red-800">${p.jenis_pelanggaran || '-'}</span>
                                <p class="text-xs text-red-600 mt-1">${p.kategori || ''} • ${p.poin || 0} poin</p>
                            </div>
                        </div>`
                    ).join('') + 
                    `</div>` 
                    : 
                    `<div class="text-center py-4 bg-green-50 rounded-lg border border-green-200">
                        <i class="fas fa-check-circle text-green-500 text-xl mb-2"></i>
                        <p class="text-green-700">Tidak ada pelanggaran tercatat</p>
                    </div>`
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