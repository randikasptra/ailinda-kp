<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="mt-24 px-4 md:px-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-user-slash text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tambah Sanksi Siswa</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Input data siswa yang menerima sanksi pelanggaran</p>
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

    <!-- Form Sanksi Siswa -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B]">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>
                Form Input Sanksi Siswa
            </h2>
        </div>
        <div class="p-6">
            <form action="<?= base_url('piket/store-sanksi-siswa') ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>

                <!-- Data Siswa Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIS <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                            <input type="text" name="nis" value="<?= old('nis') ?>" required
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                                   placeholder="Masukkan NIS siswa">
                            <?php if ($errors['nis'] ?? false): ?>
                                <p class="mt-1 text-sm text-red-600"><?= esc($errors['nis']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIS M (Opsional)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-badge text-gray-400"></i>
                            </div>
                            <input type="text" name="nism" value="<?= old('nism') ?>"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                                   placeholder="Masukkan NIS M siswa">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="nama" value="<?= old('nama') ?>" required
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                                   placeholder="Masukkan nama lengkap siswa">
                            <?php if ($errors['nama'] ?? false): ?>
                                <p class="mt-1 text-sm text-red-600"><?= esc($errors['nama']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-graduation-cap text-gray-400"></i>
                            </div>
                            <input type="text" name="kelas" value="<?= old('kelas') ?>"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                                   placeholder="Contoh: 10.01">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Absen</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-hashtag text-gray-400"></i>
                            </div>
                            <input type="number" name="no_absen" value="<?= old('no_absen') ?>"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                                   placeholder="Masukkan nomor absen">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-venus-mars text-gray-400"></i>
                            </div>
                            <select name="jk" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" <?= old('jk') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= old('jk') === 'P' ? 'selected' : '' ?>>Perempuan</option>
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
                            <select name="jurusan" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                                <option value="">Pilih Jurusan</option>
                                <option value="SOSHUM" <?= old('jurusan') === 'SOSHUM' ? 'selected' : '' ?>>SOS HUM</option>
                                <option value="SAINTEK" <?= old('jurusan') === 'SAINTEK' ? 'selected' : '' ?>>SAIN TEK</option>
                                <option value="BAHASA" <?= old('jurusan') === 'BAHASA' ? 'selected' : '' ?>>BAHASA</option>
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
                            <input type="text" name="tahun_ajaran" value="<?= old('tahun_ajaran') ?>"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                                   placeholder="Contoh: 2024/2025">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Poin Sanksi (Default: 0)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-star text-gray-400"></i>
                            </div>
                            <input type="number" name="poin" value="<?= old('poin', 0) ?>" min="0"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                                   placeholder="Masukkan total poin sanksi">
                        </div>
                    </div>
                </div>

                <!-- Pelanggaran Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Jenis Pelanggaran</label>
                    <div class="relative mb-3">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="searchPelanggaranSanksi" 
                               placeholder="Cari jenis pelanggaran..." 
                               class="w-full pl-10 p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                    </div>
                    <div id="pelanggaranListContainerSanksi" 
                         class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-48 overflow-y-auto border border-gray-300 p-3 rounded-xl">
                        <?php if (isset($pelanggaranList) && !empty($pelanggaranList)): ?>
                            <?php foreach ($pelanggaranList as $p): ?>
                                <label class="flex items-center space-x-2 pelanggaran-item-sanksi p-2 rounded hover:bg-gray-50 transition-colors cursor-pointer" data-pelanggaran-id="<?= $p['id'] ?>">
                                    <input type="checkbox" name="pelanggaran_ids[]" value="<?= $p['id'] ?>" 
                                           class="form-checkbox h-4 w-4 text-[#1E5631] focus:ring-[#1E5631]">
                                    <span class="text-sm">
                                        <?= esc($p['jenis_pelanggaran']) ?> 
                                        <small class="text-gray-500 block"><?= esc($p['kategori']) ?> • <?= $p['poin'] ?> poin</small>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="col-span-full text-center text-gray-500">Tidak ada data pelanggaran tersedia.</p>
                        <?php endif; ?>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Pilih satu atau lebih pelanggaran. Total poin akan dihitung otomatis.</p>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <a href="<?= base_url('piket/sanksi-siswa') ?>" 
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition duration-200 font-medium text-center flex items-center justify-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white rounded-xl hover:shadow-lg transition duration-200 font-medium shadow-md flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        Simpan Sanksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
/* Custom scrollbar for pelanggaran list */
#pelanggaranListContainerSanksi::-webkit-scrollbar {
    width: 6px;
}

#pelanggaranListContainerSanksi::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

#pelanggaranListContainerSanksi::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

#pelanggaranListContainerSanksi::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Search functionality for pelanggaran
    const searchPelanggaranSanksi = document.getElementById('searchPelanggaranSanksi');
    const pelanggaranItemsSanksi = document.querySelectorAll('.pelanggaran-item-sanksi');
    
    searchPelanggaranSanksi.addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();
        pelanggaranItemsSanksi.forEach(item => {
            let text = item.innerText.toLowerCase();
            item.style.display = text.includes(keyword) ? '' : 'none';
        });
    });

    // Auto-calculate poin on checkbox change
    const checkboxes = document.querySelectorAll('input[name="pelanggaran_ids[]"]');
    const poinInput = document.querySelector('input[name="poin"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let totalPoin = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const label = cb.closest('.pelanggaran-item-sanksi');
                    const poinText = label.querySelector('small').textContent.match(/(\d+) poin/);
                    if (poinText) {
                        totalPoin += parseInt(poinText[1]);
                    }
                }
            });
            poinInput.value = totalPoin;
        });
    });
});
</script>

<?= $this->endSection() ?>