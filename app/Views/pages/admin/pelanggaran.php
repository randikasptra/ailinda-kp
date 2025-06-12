<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>
<div class="ml-64">

    <div class="flex items-center justify-between mb-6 ">
        <h1 class="text-2xl font-bold text-[#1E5631]">Kelola Pelanggaran</h1>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="flex items-center gap-2 bg-[#1E5631] text-white px-4 py-2 rounded hover:bg-green-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pelanggaran
        </button>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- TABEL -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden ">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#1E5631] text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Jenis Pelanggaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Poin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($pelanggaran as $index => $row): ?>
                    <tr>
                        <td class="px-6 py-4"><?= $index + 1 ?></td>
                        <td class="px-6 py-4"><?= esc($row['jenis_pelanggaran']) ?></td>
                        <td class="px-6 py-4"><?= esc($row['poin']) ?></td>
                        <td class="px-6 py-4">
                            <a href="/admin/pelanggaran/hapus/<?= $row['id'] ?>"
                                onclick="return confirm('Yakin hapus pelanggaran ini?')"
                                class="flex items-center text-red-600 hover:underline gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <!-- MODAL TAMBAH -->
    <div id="modalTambah"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 ml-64">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-[#1E5631]">Tambah Pelanggaran</h2>
                <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="text-gray-600 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="/admin/pelanggaran/tambah" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pelanggaran</label>
                    <input type="text" name="jenis_pelanggaran"
                        class="w-full border px-3 py-2 rounded focus:ring focus:ring-green-200" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Poin</label>
                    <input type="number" name="poin"
                        class="w-full border px-3 py-2 rounded focus:ring focus:ring-green-200" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-[#1E5631] text-white rounded hover:bg-green-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>