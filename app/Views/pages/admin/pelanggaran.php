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
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Rekapan Surat Izin Siswa</h1>
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

    <!-- Tab Navigation -->
    <ul class="flex border-b border-gray-200 mb-6" role="tablist">
        <li class="mr-1">
            <a class="inline-block px-4 py-2 text-sm font-medium text-gray-600 bg-white border-t border-x border-gray-200 rounded-t-lg active:bg-gray-50 active:text-[#1E5631]" 
               id="keluar-tab" data-toggle="tab" href="#keluar" role="tab">Surat Izin Keluar</a>
        </li>
        <li class="mr-1">
            <a class="inline-block px-4 py-2 text-sm font-medium text-gray-600 bg-white border-t border-x border-gray-200 rounded-t-lg active:bg-gray-50 active:text-[#1E5631]" 
               id="masuk-tab" data-toggle="tab" href="#masuk" role="tab">Surat Izin Masuk</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="izinTabContent">
        <!-- Surat Izin Keluar -->
        <div class="tab-pane fade show active" id="keluar" role="tabpanel">
            <?php if (empty($surat_izin)): ?>
                <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center">
                    <div class="mx-auto w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-2">Tidak ada data surat izin keluar</h3>
                    <p class="text-gray-500 text-sm md:text-base mb-6">Belum ada siswa yang mengajukan izin keluar saat ini</p>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <!-- Table Header -->
                    <div class="bg-gray-50 px-4 md:px-6 py-4 border-b border-gray-200">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Daftar Surat Izin Keluar</h3>
                                <p class="text-sm text-gray-600">Total <?= count($surat_izin) ?> data</p>
                            </div>
                            <div class="relative w-full md:w-auto">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" placeholder="Cari siswa..." 
                                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] w-full md:w-64">
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white">
                                <tr>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Nama Siswa</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">NISN</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Kelas</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Alasan</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Waktu Keluar</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Waktu Kembali</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Pelanggaran</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-right text-xs md:text-sm font-medium uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($surat_izin as $izin): ?>
                                    <tr x-data="pelanggaranModal(<?= json_encode($pelanggarans ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>, <?= json_encode($izin['pelanggaran'] ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>)">
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-[#1E5631]/10 rounded-full flex items-center justify-center">
                                                    <span class="text-[#1E5631] font-medium"><?= strtoupper(substr(esc($izin['nama']), 0, 1)) ?></span>
                                                </div>
                                                <div class="ml-3 md:ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?= esc($izin['nama']) ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full"><?= esc($izin['nisn']) ?></span>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full"><?= esc($izin['kelas']) ?></span>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-normal text-sm text-gray-500">
                                            <?= esc($izin['alasan']) ?>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <i class="fas fa-clock w-4 h-4 mr-1 text-gray-400"></i>
                                                <?= esc($izin['waktu_keluar']) ?>
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <i class="fas fa-clock w-4 h-4 mr-1 text-gray-400"></i>
                                                <?= esc($izin['waktu_kembali']) ?: '-' ?>
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <div class="mt-1 flex flex-wrap gap-2">
                                                <template x-for="(item, index) in selected" :key="item.id">
                                                    <span class="inline-flex items-center bg-[#1E5631] text-white text-xs font-medium rounded-full px-2 py-1">
                                                        <span x-text="item.jenis_pelanggaran"></span>
                                                        <button type="button" @click="remove(index)" class="ml-1 hover:text-gray-200">&times;</button>
                                                    </span>
                                                </template>
                                                <?php if (empty($izin['pelanggaran']) && !isset($selected) || empty($selected)): ?>
                                                    <span class="text-gray-500 text-sm">Tidak ada pelanggaran</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-right">
                                            <form action="<?= base_url('piket/surat_izin_pelanggaran/' . $izin['id']) ?>" method="post" id="form-<?= $izin['id'] ?>">
                                                <?= csrf_field() ?>
                                                <div class="flex items-center gap-2">
                                                    <!-- Aksi Detail -->
                                                    <button type="button" 
                                                            @click="openDetailModal(<?= htmlspecialchars(json_encode($izin), ENT_QUOTES, 'UTF-8') ?>)"
                                                            class="text-xs bg-blue-100 text-blue-600 font-medium px-2 py-1 rounded-lg border border-blue-200 hover:bg-blue-200 transition">
                                                        <i class="fas fa-eye mr-1"></i> Detail
                                                    </button>
                                                    
                                                    <!-- Aksi Edit -->
                                                    <a href="<?= base_url('piket/surat_izin/edit/' . $izin['id']) ?>"
                                                       class="text-xs bg-yellow-100 text-yellow-600 font-medium px-2 py-1 rounded-lg border border-yellow-200 hover:bg-yellow-200 transition">
                                                        <i class="fas fa-edit mr-1"></i> Edit
                                                    </a>
                                                    
                                                    <!-- Aksi Hapus -->
                                                    <button type="button" 
                                                            @click="openDeleteModal(<?= $izin['id'] ?>, '<?= esc($izin['nama']) ?>')"
                                                            class="text-xs bg-red-100 text-red-600 font-medium px-2 py-1 rounded-lg border border-red-200 hover:bg-red-200 transition">
                                                        <i class="fas fa-trash mr-1"></i> Hapus
                                                    </button>
                                                </div>
                                                <div class="mt-1">
                                                    <template x-for="s in selected" :key="s.id">
                                                        <input type="hidden" name="pelanggaran_id[]" :value="s.id" form="form-<?= $izin['id'] ?>">
                                                    </template>
                                                    <button type="submit"
                                                            class="mt-1 inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-[#1E5631] to-[#2E7D32] hover:from-[#145128] hover:to-[#1B5E20] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1E5631]/50 transition-all">
                                                        <i class="fas fa-check-circle w-3 h-3 mr-1"></i> Simpan
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Surat Izin Masuk -->
        <div class="tab-pane fade" id="masuk" role="tabpanel">
            <?php if (empty($surat_izin_masuk)): ?>
                <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center">
                    <div class="mx-auto w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-2">Tidak ada data surat izin masuk</h3>
                    <p class="text-gray-500 text-sm md:text-base mb-6">Belum ada siswa yang mengajukan izin masuk saat ini</p>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <!-- Table Header -->
                    <div class="bg-gray-50 px-4 md:px-6 py-4 border-b border-gray-200">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Daftar Surat Izin Masuk</h3>
                                <p class="text-sm text-gray-600">Total <?= count($surat_izin_masuk) ?> data</p>
                            </div>
                            <div class="relative w-full md:w-auto">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" placeholder="Cari siswa..." 
                                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] w-full md:w-64">
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white">
                                <tr>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Nama Siswa</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">NISN</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Kelas</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Alasan Terlambat</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Tindak Lanjut</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Pelanggaran</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-right text-xs md:text-sm font-medium uppercase tracking-wider">Aksi</th>
                                    <th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium uppercase tracking-wider">Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($surat_izin_masuk as $izin): ?>
                                    <tr x-data="pelanggaranModal(<?= json_encode($pelanggarans ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>, <?= json_encode($izin['pelanggaran'] ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>)">
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-[#1E5631]/10 rounded-full flex items-center justify-center">
                                                    <span class="text-[#1E5631] font-medium"><?= strtoupper(substr(esc($izin['nama']), 0, 1)) ?></span>
                                                </div>
                                                <div class="ml-3 md:ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?= esc($izin['nama']) ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full"><?= esc($izin['nisn']) ?></span>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full"><?= esc($izin['kelas']) ?></span>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-normal text-sm text-gray-500">
                                            <?= esc($izin['alasan_terlambat']) ?: '-' ?>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-normal text-sm text-gray-500">
                                            <?= esc($izin['tindak_lanjut']) ?: '-' ?>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <div class="mt-1 flex flex-wrap gap-2">
                                                <template x-for="(item, index) in selected" :key="item.id">
                                                    <span class="inline-flex items-center bg-[#1E5631] text-white text-xs font-medium rounded-full px-2 py-1">
                                                        <span x-text="item.jenis_pelanggaran"></span>
                                                        <button type="button" @click="remove(index)" class="ml-1 hover:text-gray-200">&times;</button>
                                                    </span>
                                                </template>
                                                <?php if (empty($izin['pelanggaran']) && !isset($selected) || empty($selected)): ?>
                                                    <span class="text-gray-500 text-sm">Tidak ada pelanggaran</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-right">
                                            <form action="<?= base_url('piket/surat_izin_masuk_pelanggaran/' . $izin['id']) ?>" method="post" id="form-masuk-<?= $izin['id'] ?>">
                                                <?= csrf_field() ?>
                                                <div class="flex items-center gap-2">
                                                    <!-- Aksi Detail -->
                                                    <button type="button" 
                                                            @click="openDetailModal(<?= htmlspecialchars(json_encode($izin), ENT_QUOTES, 'UTF-8') ?>)"
                                                            class="text-xs bg-blue-100 text-blue-600 font-medium px-2 py-1 rounded-lg border border-blue-200 hover:bg-blue-200 transition">
                                                        <i class="fas fa-eye mr-1"></i> Detail
                                                    </button>
                                                    
                                                    <!-- Aksi Edit -->
                                                    <a href="<?= base_url('piket/surat_izin_masuk/edit/' . $izin['id']) ?>"
                                                       class="text-xs bg-yellow-100 text-yellow-600 font-medium px-2 py-1 rounded-lg border border-yellow-200 hover:bg-yellow-200 transition">
                                                        <i class="fas fa-edit mr-1"></i> Edit
                                                    </a>
                                                    
                                                    
                                                    <!-- Aksi Hapus -->
                                                    <button type="button" 
                                                            @click="openDeleteModal(<?= $izin['id'] ?>, '<?= esc($izin['nama']) ?>', 'masuk')"
                                                            class="text-xs bg-red-100 text-red-600 font-medium px-2 py-1 rounded-lg border border-red-200 hover:bg-red-200 transition">
                                                        <i class="fas fa-trash mr-1"></i> Hapus
                                                    </button>
                                                </div>
                                                <div class="mt-1">
                                                    <template x-for="s in selected" :key="s.id">
                                                        <input type="hidden" name="pelanggaran_id[]" :value="s.id" form="form-masuk-<?= $izin['id'] ?>">
                                                    </template>
                                                    <button type="submit"
                                                            class="mt-1 inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-[#1E5631] to-[#2E7D32] hover:from-[#145128] hover:to-[#1B5E20] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1E5631]/50 transition-all">
                                                        <i class="fas fa-check-circle w-3 h-3 mr-1"></i> Simpan
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar w-4 h-4 mr-1 text-gray-400"></i>
                                                <?= date('d-m-Y H:i', strtotime($izin['created_at'])) ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- Modal Pilih Pelanggaran -->
                            <div x-show="open" x-cloak
                                 class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center px-2"
                                 x-transition>
                                <div @click.away="open = false"
                                     class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[70vh] overflow-y-auto p-4">
                                    <!-- Header -->
                                    <div class="flex justify-between items-center mb-2">
                                        <h2 class="text-base font-semibold text-[#1E5631]">Pilih Pelanggaran</h2>
                                        <button @click="open = false" 
                                                class="text-gray-400 hover:text-red-500 text-lg">&times;</button>
                                    </div>
                                    <!-- List Pelanggaran -->
                                    <div class="grid grid-cols-1 gap-2">
                                        <template x-for="p in list" :key="p.id">
                                            <div @click="toggle(p)"
                                                 class="p-2 border rounded-md hover:bg-[#f4fdf6] cursor-pointer transition shadow-sm flex flex-col justify-between h-full"
                                                 :class="{'bg-green-50 border-green-400': isSelected(p)}">
                                                <div class="text-xs font-medium text-gray-800 break-words whitespace-normal leading-tight">
                                                    <span x-text="p.jenis_pelanggaran"></span>
                                                </div>
                                                <div class="flex justify-between items-center mt-1">
                                                    <span class="text-xs text-gray-500" 
                                                          x-text="p.kategori + ' - ' + p.poin + ' poin'"></span>
                                                    <template x-if="isSelected(p)">
                                                        <i class="text-green-500 font-bold text-sm">&#10003;</i>
                                                    </template>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div x-data="{ detailModal: false, selectedIzin: null }" x-cloak>
    <!-- Modal Overlay -->
    <div x-show="detailModal" 
         class="fixed inset-0 bg-black/50 z-[60] flex items-center justify-center px-4 transition-opacity duration-300"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto"
             @click.away="detailModal = false"
             x-show="detailModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white p-6 rounded-t-2xl">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold">Detail Surat Izin</h2>
                        <p class="text-green-100 mt-1" x-text="selectedIzin ? (selectedIzin.alasan_terlambat ? 'Izin Masuk' : 'Izin Keluar') : ''"></p>
                    </div>
                    <button @click="detailModal = false" class="text-white hover:text-green-200 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6" x-show="selectedIzin">
                <!-- Info Siswa -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-graduate text-[#1E5631] mr-2"></i>
                        Informasi Siswa
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                            <p class="text-gray-800 font-medium" x-text="selectedIzin.nama"></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">NISN</label>
                            <p class="text-gray-800 font-medium" x-text="selectedIzin.nisn"></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Kelas</label>
                            <p class="text-gray-800 font-medium" x-text="selectedIzin.kelas"></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tanggal Dibuat</label>
                            <p class="text-gray-800 font-medium" x-text="formatDate(selectedIzin.created_at)"></p>
                        </div>
                    </div>
                </div>

                <!-- Detail Izin -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-file-alt text-[#1E5631] mr-2"></i>
                        Detail Izin
                    </h3>
                    <div class="space-y-4">
                        <!-- Untuk Izin Keluar -->
                        <template x-if="!selectedIzin.alasan_terlambat">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Alasan Izin</label>
                                    <p class="text-gray-800" x-text="selectedIzin.alasan || '-'"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Waktu Keluar</label>
                                    <p class="text-gray-800" x-text="selectedIzin.waktu_keluar || '-'"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Waktu Kembali</label>
                                    <p class="text-gray-800" x-text="selectedIzin.waktu_kembali || '-'"></p>
                                </div>
                            </div>
                        </template>

                        <!-- Untuk Izin Masuk -->
                        <template x-if="selectedIzin.alasan_terlambat">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Alasan Terlambat</label>
                                    <p class="text-gray-800" x-text="selectedIzin.alasan_terlambat || '-'"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Tindak Lanjut</label>
                                    <p class="text-gray-800" x-text="selectedIzin.tindak_lanjut || '-'"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Pelanggaran -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-exclamation-triangle text-[#1E5631] mr-2"></i>
                        Pelanggaran
                    </h3>
                    <div x-show="selectedIzin.pelanggaran && selectedIzin.pelanggaran.length > 0">
                        <div class="space-y-2">
                            <template x-for="pelanggaran in selectedIzin.pelanggaran" :key="pelanggaran.id">
                                <div class="flex items-center justify-between p-3 bg-red-50 border border-red-200 rounded-lg">
                                    <div>
                                        <p class="font-medium text-red-800" x-text="pelanggaran.jenis_pelanggaran"></p>
                                        <p class="text-sm text-red-600" x-text="pelanggaran.kategori + ' - ' + pelanggaran.poin + ' poin'"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div x-show="!selectedIzin.pelanggaran || selectedIzin.pelanggaran.length === 0" class="text-center py-4">
                        <i class="fas fa-check-circle text-green-500 text-2xl mb-2"></i>
                        <p class="text-gray-500">Tidak ada pelanggaran</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-2xl flex justify-end">
                <button @click="detailModal = false" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors font-medium">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div x-data="{ deleteModal: false, deleteId: null, deleteName: '', deleteType: 'keluar' }" x-cloak>
    <div x-show="deleteModal" 
         class="fixed inset-0 bg-black/50 z-[60] flex items-center justify-center px-4 transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md"
             @click.away="deleteModal = false"
             x-show="deleteModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Hapus Surat Izin</h3>
                        <p class="text-gray-600 text-sm mt-1">Anda yakin ingin menghapus data ini?</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-user text-red-600 mr-3"></i>
                        <div>
                            <p class="font-medium text-red-800" x-text="deleteName"></p>
                            <p class="text-sm text-red-600 mt-1" x-text="deleteType === 'keluar' ? 'Surat Izin Keluar' : 'Surat Izin Masuk'"></p>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mt-4">
                    Data yang sudah dihapus tidak dapat dikembalikan. Pastikan data yang akan dihapus sudah benar.
                </p>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-2xl flex justify-end gap-3">
                <button @click="deleteModal = false" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors font-medium">
                    Batal
                </button>
                <form :action="getDeleteUrl()" method="POST" class="inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Alpine.js for Modal -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

<!-- Bootstrap JS for Tabs -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

.tab-pane {
    display: none;
}

.tab-pane.show.active {
    display: block;
}
</style>



<?= $this->endSection() ?>