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

    <!-- FORM PENCARIAN SISWA -->
    <div class="mb-6 bg-gray-50 p-5 rounded-xl border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
            <i class="fas fa-search mr-2 text-[#1E5631]"></i>
            Pencarian Siswa
        </h3>
        <form method="get" action="<?= base_url('piket/sanksi-siswa') ?>" class="flex flex-col md:flex-row gap-3">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="keyword" value="<?= esc($keyword ?? '') ?>" placeholder="Cari berdasarkan NIS atau Nama..."
                       class="pl-10 w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all duration-200" />
            </div>
            <button type="submit" class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-lg">
                <i class="fas fa-search text-white mr-2"></i>
                Cari
            </button>
        </form>
    </div>

    <!-- DROPDOWN PILIHAN SISWA (JIKA DUPLIKAT NAMA) -->
    <?php if (!empty($siswaList) && count($siswaList) > 1): ?>
        <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-xl">
            <p class="font-medium mb-2">Beberapa siswa ditemukan. Pilih salah satu:</p>
            <ul class="list-disc pl-6 space-y-2">
                <?php foreach ($siswaList as $s): ?>
                    <li>
                        <a href="<?= base_url('piket/sanksi-siswa?nis=' . $s['nis']) ?>"
                           class="text-[#1E5631] hover:underline font-semibold">
                            <?= esc($s['nama']) ?> (<?= esc($s['nis']) ?>) - <?= esc($s['kelas']) ?> 
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- FORM INPUT SANKSI (SELALU ADA) -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B]">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Form Input Sanksi Siswa
            </h2>
        </div>

        <div class="p-6">
            <form action="<?= base_url('piket/sanksi-siswa/store') ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>

                <!-- Data Siswa (Auto-filled dan disable jika $siswa ada) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIS <span class="text-red-500">*</span></label>
                        <input type="text" name="nis" value="<?= esc($siswa['nis'] ?? old('nis')) ?>" <?= isset($siswa) ? 'readonly' : '' ?>
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all <?= isset($siswa) ? 'bg-gray-100' : '' ?>"
                               placeholder="Masukkan NIS siswa">
                        <?php if (isset($errors['nis'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= esc($errors['nis']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="<?= esc($siswa['nama'] ?? old('nama')) ?>" <?= isset($siswa) ? 'readonly' : '' ?>
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all <?= isset($siswa) ? 'bg-gray-100' : '' ?>"
                               placeholder="Masukkan nama lengkap siswa">
                        <?php if (isset($errors['nama'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= esc($errors['nama']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <input type="text" name="kelas" value="<?= esc($siswa['kelas'] ?? old('kelas')) ?>" <?= isset($siswa) ? 'readonly' : '' ?>
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all <?= isset($siswa) ? 'bg-gray-100' : '' ?>"
                               placeholder="Contoh: 10.01">
                    </div>
                    <!-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                        <select name="jurusan" <?= isset($siswa) ? 'disabled' : '' ?> class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none <?= isset($siswa) ? 'bg-gray-100' : '' ?>">
                            <option value="">Pilih Jurusan</option>
                            <option value="SOSHUM" <?= ($siswa['jurusan'] ?? old('jurusan')) === 'SOSHUM' ? 'selected' : '' ?>>SOS HUM</option>
                            <option value="SAINTEK" <?= ($siswa['jurusan'] ?? old('jurusan')) === 'SAINTEK' ? 'selected' : '' ?>>SAIN TEK</option>
                            <option value="BAHASA" <?= ($siswa['jurusan'] ?? old('jurusan')) === 'BAHASA' ? 'selected' : '' ?>>BAHASA</option>
                        </select>
                    </div> -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Absen</label>
                        <input type="number" name="no_absen" value="<?= esc($siswa['no_absen'] ?? old('no_absen')) ?>" <?= isset($siswa) ? 'readonly' : '' ?>
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all <?= isset($siswa) ? 'bg-gray-100' : '' ?>"
                               placeholder="Masukkan nomor absen">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                        <select name="jk" <?= isset($siswa) ? 'disabled' : '' ?> class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none <?= isset($siswa) ? 'bg-gray-100' : '' ?>">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" <?= ($siswa['jk'] ?? old('jk')) === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= ($siswa['jk'] ?? old('jk')) === 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" value="<?= esc($siswa['tahun_ajaran'] ?? old('tahun_ajaran')) ?>" <?= isset($siswa) ? 'readonly' : '' ?>
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all <?= isset($siswa) ? 'bg-gray-100' : '' ?>"
                               placeholder="Contoh: 2024/2025">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Poin Saat Ini</label>
                        <input type="number" value="<?= esc($siswa['poin'] ?? old('poin', 0)) ?>" readonly
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100">
                    </div>
                </div>

                <!-- Pilihan Pelanggaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Jenis Pelanggaran <span class="text-red-500">*</span></label>
                    <div class="relative mb-3">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="searchPelanggaranSanksi" placeholder="Cari pelanggaran..."
                               class="w-full pl-10 p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50">
                    </div>
                    <div id="pelanggaranListContainerSanksi"
                         class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-48 overflow-y-auto border border-gray-300 p-3 rounded-xl">
                        <?php foreach ($pelanggaranList as $p): ?>
                            <label class="flex items-center space-x-2 pelanggaran-item-sanksi p-2 rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="pelanggaran_ids[]" value="<?= $p['id'] ?>"
                                       class="form-checkbox h-4 w-4 text-[#1E5631] focus:ring-[#1E5631]">
                                <span class="text-sm">
                                    <?= esc($p['jenis_pelanggaran']) ?>
                                    <small class="text-gray-500 block"><?= esc($p['kategori']) ?> • <?= esc($p['poin']) ?> poin</small>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Pilih satu atau lebih pelanggaran. Total poin akan dihitung otomatis.</p>
                    <?php if (isset($errors['pelanggaran_ids'])): ?>
                        <p class="mt-1 text-sm text-red-600"><?= esc($errors['pelanggaran_ids']) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan (Opsional)</label>
                    <textarea name="keterangan" rows="3" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#1E5631]/50"><?= old('keterangan') ?></textarea>
                </div>

                <!-- Total Poin -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Total Poin Sanksi</label>
                    <input type="number" name="poin" readonly value="0"
                           class="w-full bg-gray-100 px-4 py-3 rounded-xl border border-gray-300">
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white rounded-xl font-medium shadow-md hover:shadow-lg">
                        <i class="fas fa-save mr-2"></i> Simpan Sanksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Filter pelanggaran
    const search = document.getElementById('searchPelanggaranSanksi');
    const items = document.querySelectorAll('.pelanggaran-item-sanksi');
    const poinInput = document.querySelector('input[name="poin"]');

    if (search) {
        search.addEventListener('input', () => {
            const keyword = search.value.toLowerCase();
            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(keyword) ? '' : 'none';
            });
        });
    }

    // Hitung total poin otomatis
    const checkboxes = document.querySelectorAll('input[name="pelanggaran_ids[]"]');
    checkboxes.forEach(cb => cb.addEventListener('change', () => {
        let total = 0;
        checkboxes.forEach(c => {
            if (c.checked) {
                const poin = c.closest('label').querySelector('small').textContent.match(/(\d+)\s*poin/);
                if (poin) total += parseInt(poin[1]);
            }
        });
        poinInput.value = total;
    }));
});
</script>

<?= $this->endSection() ?>