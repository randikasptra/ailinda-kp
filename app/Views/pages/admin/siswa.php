<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="ml-64 p-6">
    <div class="bg-white shadow rounded-lg p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-[#1E5631]">Kelola Data Siswa</h1>
            <button onclick="document.getElementById('tambahModal').classList.remove('hidden')"
                class="bg-green-600 text-white px-4 py-2 rounded flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Siswa
            </button>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 text-green-700 p-2 rounded mb-2">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <table class="min-w-full border border-gray-200">
            <thead class="bg-[#1E5631] text-white">
                <tr>
                    <th class="px-4 py-2 border">NISN</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Kelas</th>
                    <th class="px-4 py-2 border">Jurusan</th>
                    <th class="px-4 py-2 border">Poin</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($siswa as $s): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border"><?= esc($s['nisn']) ?></td>
                        <td class="px-4 py-2 border"><?= esc($s['nama']) ?></td>
                        <td class="px-4 py-2 border"><?= esc($s['kelas']) ?></td>
                        <td class="px-4 py-2 border"><?= esc($s['jurusan']) ?></td>
                        <td class="px-4 py-2 border"><?= esc($s['poin']) ?></td>
                        <td class="px-4 py-2 border flex gap-2">
                            <a href="/admin/siswa/detail_siswa/<?= $s['id'] ?>" class="text-blue-600 hover:underline">
                                <i data-lucide="eye" class="w-4 h-4 inline-block"></i>
                            </a>
                            <a href="/admin/siswa/hapus/<?= $s['id'] ?>" onclick="return confirm('Yakin hapus?')"
                                class="text-red-600 hover:underline">
                                <i data-lucide="trash-2" class="w-4 h-4 inline-block"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<!-- 🧾 Modal Tambah Siswa -->
<div id="tambahModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-[#1E5631]">Tambah Siswa</h2>
        <form method="POST" action="/admin/siswa/tambah">
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">NISN</label>
                <input type="text" name="nisn" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                <input type="text" name="kelas" placeholder="cth: 10 / 11 / 12" class="w-full border px-3 py-2 rounded"
                    required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                <select name="jurusan" class="w-full border px-3 py-2 rounded" required>
                    <option value="SOSHUM">SOSHUM</option>
                    <option value="SAINTEK">SAINTEK</option>
                    <option value="BAHASA">BAHASA</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Poin Awal</label>
                <input type="number" name="poin" class="w-full border px-3 py-2 rounded" value="0">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('tambahModal').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-[#1E5631] text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
<button onclick="document.getElementById('tambahModal').classList.remove('hidden')"
    class="bg-[#1E5631] text-white px-4 py-2 rounded">
    <i data-lucide="plus" class="w-4 h-4 inline-block mr-1"></i> Tambah Siswa
</button>

<script>
    lucide.createIcons();
</script>

<?= $this->endSection() ?>