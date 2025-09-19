<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="p-4 sm:p-8">
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h1 class="text-2xl font-bold text-[#1E5631] flex items-center gap-2">
                <i data-lucide="user-cog" class="w-6 h-6"></i>
                <?= $title ?>
            </h1>
        </div>

        <!-- Menampilkan pesan sukses atau error -->
        <?php if (session()->has('success')): ?>
            <div class="p-4 mx-6 mt-4 bg-green-100 text-green-700 rounded-lg">
                <?= session('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('errors')): ?>
            <div class="p-4 mx-6 mt-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/siswa/update/' . $siswa['id']) ?>" method="post" class="p-6 space-y-5" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan perubahan?');">
            <!-- CSRF Token -->
            <?= csrf_field() ?>

            <!-- NIS -->
            <div>
                <label for="nis" class="block text-sm font-medium text-gray-700 mb-2">NIS</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="hash" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="text" name="nis" id="nis" value="<?= esc(old('nis', $siswa['nis'])) ?>" 
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition" required>
                </div>
            </div>

            <!-- NISM -->
            <div>
                <label for="nism" class="block text-sm font-medium text-gray-700 mb-2">NISM (Opsional)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="hash" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="text" name="nism" id="nism" value="<?= esc(old('nism', $siswa['nism'] ?? '')) ?>" 
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition">
                </div>
            </div>

            <!-- Nama Siswa -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Siswa</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="text" name="nama" id="nama" value="<?= esc(old('nama', $siswa['nama'])) ?>" 
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition" required>
                </div>
            </div>

            <!-- Kelas -->
            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="school" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="text" name="kelas" id="kelas" value="<?= esc(old('kelas', $siswa['kelas'] ?? '')) ?>"
                        placeholder="Contoh: 10.01"
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition" required>
                </div>
            </div>

            <!-- No Absen -->
            <div>
                <label for="no_absen" class="block text-sm font-medium text-gray-700 mb-2">No Absen</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="list" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="number" name="no_absen" id="no_absen" value="<?= esc(old('no_absen', $siswa['no_absen'] ?? '')) ?>" 
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition">
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="users" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <select name="jk" id="jk" 
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] appearance-none bg-white">
                        <option value="" <?= !old('jk', $siswa['jk']) ? 'selected' : '' ?>>Pilih Jenis Kelamin</option>
                        <option value="L" <?= old('jk', $siswa['jk']) === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= old('jk', $siswa['jk']) === 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Jurusan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="book" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <select name="jurusan" id="jurusan" 
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] appearance-none bg-white" required>
                        <option value="" <?= !old('jurusan', $siswa['jurusan']) ? 'selected' : '' ?>>Pilih Jurusan</option>
                        <option value="SOSHUM" <?= old('jurusan', $siswa['jurusan']) === 'SOSHUM' ? 'selected' : '' ?>>SOSHUM</option>
                        <option value="SAINTEK" <?= old('jurusan', $siswa['jurusan']) === 'SAINTEK' ? 'selected' : '' ?>>SAINTEK</option>
                        <option value="BAHASA" <?= old('jurusan', $siswa['jurusan']) === 'BAHASA' ? 'selected' : '' ?>>BAHASA</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Tahun Ajaran -->
            <div>
                <label for="tahun_ajaran" class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="text" name="tahun_ajaran" id="tahun_ajaran" value="<?= esc(old('tahun_ajaran', $siswa['tahun_ajaran'] ?? '')) ?>" 
                        placeholder="Contoh: 2024/2025"
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition" required>
                </div>
            </div>

            <!-- Poin -->
            <div>
                <label for="poin" class="block text-sm font-medium text-gray-700 mb-2">Poin</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="star" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="number" name="poin" id="poin" value="<?= esc(old('poin', $siswa['poin'] ?? 0)) ?>" 
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4 gap-4">
                <a href="<?= base_url('/admin/siswa') ?>" class="flex items-center px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition shadow-md">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Kembali
                </a>
                <button type="submit" 
                    class="flex items-center px-5 py-2.5 bg-[#1E5631] text-white rounded-lg hover:bg-[#145128] transition shadow-md">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>

<?= $this->endSection() ?>