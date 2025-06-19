<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="mt-24 ml-64 p-6">
    <div class="bg-white shadow rounded-lg p-4">
        <h1 class="text-2xl font-bold mb-4 text-[#1E5631]">Data Siswa</h1>

        <!-- 🔍 FILTER FORM -->
        <form method="get" class="mb-4 flex flex-wrap items-center gap-2">
            <input type="text" name="keyword" value="<?= esc($filter['keyword'] ?? '') ?>"
                placeholder="Cari nama/NISN"
                class="border rounded-lg p-2 w-64" />

            <select name="kelas" class="border rounded-lg p-2">
                <option value="">Semua Kelas</option>
                <?php for ($i = 10; $i <= 12; $i++): ?>
                    <option value="<?= $i ?>" <?= ($filter['kelas'] == $i ? 'selected' : '') ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>

            <select name="jurusan" class="border rounded-lg p-2">
                <option value="">Semua Jurusan</option>
                <option value="SAINTEK" <?= ($filter['jurusan'] == 'SAINTEK' ? 'selected' : '') ?>>SAINTEK</option>
                <option value="SOSHUM" <?= ($filter['jurusan'] == 'SOSHUM' ? 'selected' : '') ?>>SOSHUM</option>
                <option value="BAHASA" <?= ($filter['jurusan'] == 'BAHASA' ? 'selected' : '') ?>>BAHASA</option>
            </select>

            <button type="submit" class="bg-[#1E5631] text-white px-4 py-2 rounded-lg">
                <i data-lucide="search" class="inline-block w-4 h-4 mr-1"></i> Cari
            </button>
            <a href="/piket/data_siswa" class="text-sm text-gray-600 hover:underline">Reset</a>
        </form>

        <!-- 📋 TABEL -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-[#1E5631] text-white">
                    <tr>
                        <th class="px-4 py-2 border">NISN</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Kelas</th>
                        <th class="px-4 py-2 border">Jurusan</th>
                        <th class="px-4 py-2 border">Poin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($siswa)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Tidak ada data ditemukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($siswa as $s): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border"><?= esc($s['nisn']) ?></td>
                                <td class="px-4 py-2 border"><?= esc($s['nama']) ?></td>
                                <td class="px-4 py-2 border"><?= esc($s['kelas']) ?></td>
                                <td class="px-4 py-2 border"><?= esc($s['jurusan']) ?></td>
                                <td class="px-4 py-2 border"><?= esc($s['poin']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
