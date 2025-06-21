<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class=" p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631] flex items-center gap-2">
            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
            Kelola Pelanggaran
        </h1>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="flex items-center gap-2 bg-[#1E5631] text-white px-4 py-2.5 rounded-lg hover:bg-[#145128] transition shadow-md">
            <i data-lucide="plus-circle" class="w-5 h-5"></i>
            Tambah Pelanggaran
        </button>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="flex items-center bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#1E5631] text-white">
                <tr>
                    <th scope="col"
                        class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider whitespace-nowrap">
                        <div class="flex items-center">
                            No
                        </div>
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider whitespace-nowrap">
                        <div class="flex items-center">
                            <i data-lucide="alert-octagon" class="w-4 h-4 mr-2"></i>
                            Jenis Pelanggaran
                        </div>
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider whitespace-nowrap">
                        <div class="flex items-center">
                            <i data-lucide="star" class="w-4 h-4 mr-2"></i>
                            Poin
                        </div>
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider whitespace-nowrap">
                        <div class="flex items-center">
                            <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                            Aksi
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($pelanggaran as $index => $row): ?>
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4"><?= $index + 1 ?></td>
                        <td class="px-6 py-4 font-medium text-gray-900"><?= esc($row['jenis_pelanggaran']) ?></td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-0.5 rounded-full bg-[#A4DE02]/20 text-[#1E5631] font-medium">
                                <?= esc($row['poin']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <!-- Detail Modal Trigger -->
                                <button
                                    onclick="showDetailModal('<?= esc($row['jenis_pelanggaran']) ?>', <?= $row['poin'] ?>)"
                                    class="text-gray-600 hover:text-[#1E5631] p-2 rounded-full hover:bg-green-50 transition"
                                    title="Detail">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>

                                <!-- Edit Link -->
                                <a href="/admin/pelanggaran/edit/<?= $row['id'] ?>"
                                    class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50 transition"
                                    title="Edit">
                                    <i data-lucide="pencil" class="w-5 h-5"></i>
                                </a>

                                <!-- Hapus -->
                                <a href="/admin/pelanggaran/hapus/<?= $row['id'] ?>"
                                    onclick="return confirm('Yakin hapus pelanggaran ini?')"
                                    class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition"
                                    title="Hapus">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <!-- MODAL TAMBAH -->
    <div id="modalTambah" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 border border-[#1E5631]/20">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-[#1E5631] flex items-center gap-2">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    Tambah Pelanggaran
                </h2>
                <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600 transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form action="/admin/pelanggaran/tambah" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="alert-octagon" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="text" name="jenis_pelanggaran"
                            class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition"
                            required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Poin</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="star" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="number" name="poin"
                            class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition"
                            required>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                        class="flex items-center px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i data-lucide="x" class="w-4 h-4 mr-1"></i>
                        Batal
                    </button>
                    <button type="submit"
                        class="flex items-center px-4 py-2.5 bg-[#1E5631] text-white rounded-lg hover:bg-[#145128] transition shadow-md">
                        <i data-lucide="save" class="w-4 h-4 mr-1"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div id="modalDetail" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 border border-[#1E5631]/20">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-[#1E5631] flex items-center gap-2">
                    <i data-lucide="info" class="w-5 h-5"></i>
                    Detail Pelanggaran
                </h2>
                <button onclick="document.getElementById('modalDetail').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600 transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs text-gray-500 uppercase tracking-wider">Jenis Pelanggaran</label>
                    <p id="detailJenis" class="text-gray-800 font-medium mt-1 flex items-center">
                        <i data-lucide="alert-octagon" class="w-4 h-4 mr-2 text-gray-500"></i>
                        <span class="text-lg"></span>
                    </p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 uppercase tracking-wider">Poin</label>
                    <p id="detailPoin" class="text-gray-800 font-medium mt-1 flex items-center">
                        <i data-lucide="star" class="w-4 h-4 mr-2 text-gray-500"></i>
                        <span class="text-lg"></span>
                    </p>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button onclick="document.getElementById('modalDetail').classList.add('hidden')"
                    class="flex items-center px-4 py-2.5 bg-[#1E5631] text-white rounded-lg hover:bg-[#145128] transition shadow-md">
                    <i data-lucide="check" class="w-4 h-4 mr-1"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script Lucide & Detail Modal -->
<script>
    function showDetailModal(jenis, poin) {
        document.getElementById('detailJenis').lastChild.textContent = jenis;
        document.getElementById('detailPoin').lastChild.textContent = poin;
        document.getElementById('modalDetail').classList.remove('hidden');
    }

    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>

<?= $this->endSection() ?>