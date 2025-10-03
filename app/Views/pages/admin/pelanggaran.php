<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="p-8 mt-14">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Pelanggaran</h1>
                <p class="text-gray-600 mt-1">Manajemen data jenis pelanggaran dan poin</p>
            </div>
        </div>
        <button onclick="openModal('modalTambah')"
            class="flex items-center bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white px-6 py-3 rounded-xl hover:shadow-xl transition-all duration-300 shadow-md group">
            <i class="fas fa-plus-circle mr-3 group-hover:scale-110 transition-transform"></i>
            Tambah Pelanggaran
        </button>
    </div>

    <!-- Alert Notification -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl shadow-sm">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <div>
                <p class="font-medium"><?= session()->getFlashdata('success') ?></p>
            </div>
            <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="flex items-center bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-xl shadow-sm">
            <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
            <div>
                <p class="font-medium"><?= session()->getFlashdata('error') ?></p>
            </div>
            <button class="ml-auto text-red-700 hover:text-red-900" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php elseif (session()->getFlashdata('warning')): ?>
        <div class="flex items-center bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-xl shadow-sm">
            <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mr-3"></i>
            <div>
                <p class="font-medium"><?= session()->getFlashdata('warning') ?></p>
            </div>
            <button class="ml-auto text-yellow-700 hover:text-yellow-900" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-[#f0fdf4] to-[#d9f99d] rounded-2xl shadow-lg p-5 border-l-4 border-[#A4DE02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#1E5631]">Total Jenis Pelanggaran</p>
                    <p class="text-2xl font-bold text-[#14532d]"><?= count($pelanggaran) ?></p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-list-ol text-[#A4DE02] text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#f0f9ff] to-[#e0f2fe] rounded-2xl shadow-lg p-5 border-l-4 border-blue-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-900">Poin Tertinggi</p>
                    <p class="text-2xl font-bold text-blue-800">
                        <?= !empty($pelanggaran) ? max(array_column($pelanggaran, 'poin')) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-arrow-up text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#fef2f2] to-[#fecaca] rounded-2xl shadow-lg p-5 border-l-4 border-red-400">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-red-700">Poin Terendah</p>
                    <p class="text-2xl font-bold text-red-600">
                        <?= !empty($pelanggaran) ? min(array_column($pelanggaran, 'poin')) : '0' ?>
                    </p>
                </div>
                <div class="p-3 rounded-xl bg-white shadow-sm">
                    <i class="fas fa-arrow-down text-red-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Table Header with Stats and Filters -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <form method="get" class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Jenis Pelanggaran</h3>
                    <p class="text-sm text-gray-600">Total <?= count($pelanggaran) ?> jenis pelanggaran</p>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Filter Kategori -->
                    <select name="kategori" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                        <option value="">Semua Kategori</option>
                        <option value="Ringan" <?= ($filters['kategori'] ?? '') == 'Ringan' ? 'selected' : '' ?>>Ringan</option>
                        <option value="Sedang" <?= ($filters['kategori'] ?? '') == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                        <option value="Berat" <?= ($filters['kategori'] ?? '') == 'Berat' ? 'selected' : '' ?>>Berat</option>
                    </select>

                    <!-- Filter Poin -->
                    <select name="poin" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                        <option value="">Semua Poin</option>
                        <option value="0-10" <?= ($filters['poin'] ?? '') == '0-10' ? 'selected' : '' ?>>0-10 Poin</option>
                        <option value="11-20" <?= ($filters['poin'] ?? '') == '11-20' ? 'selected' : '' ?>>11-20 Poin</option>
                        <option value=">20" <?= ($filters['poin'] ?? '') == '>20' ? 'selected' : '' ?>>>20 Poin</option>
                    </select>

                    <!-- Search -->
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" placeholder="Cari jenis pelanggaran..." 
                            value="<?= esc($filters['search'] ?? '') ?>"
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                    </div>

                    <!-- Tombol Filter -->
                    <button type="submit" class="px-4 py-2 bg-[#1E5631] text-white rounded-lg hover:bg-[#174726] transition">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>

                    <!-- Tombol Reset -->
                    <a href="/admin/pelanggaran" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
            <?php if (!empty($pelanggaran)): ?>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider w-16">
                                No
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    Jenis Pelanggaran
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-tags mr-2"></i>
                                    Kategori
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-star mr-2"></i>
                                    Poin
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-cog mr-2"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($pelanggaran as $index => $row): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors duration-200 group">
                                <td class="px-6 py-4 text-center font-medium text-gray-500">
                                    <?= $index + 1 ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-xl bg-red-100 text-red-600 mr-3">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="font-semibold text-gray-900">
                                            <?= esc($row['jenis_pelanggaran']) ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    <?= !empty($row['kategori']) ? esc($row['kategori']) : '<span class="text-gray-400 italic">Tidak ada</span>' ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1.5 inline-flex items-center text-sm font-semibold rounded-full bg-[#A4DE02]/20 text-[#1E5631] border border-[#A4DE02]/30">
                                        <i class="fas fa-star text-[#A4DE02] mr-1.5 text-xs"></i>
                                        <?= esc($row['poin']) ?> Poin
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <!-- Tombol Detail -->
                                        <button
                                            onclick="showDetailModal('<?= esc($row['jenis_pelanggaran']) ?>', <?= $row['poin'] ?>, '<?= esc($row['kategori'] ?? '') ?>')"
                                            class="p-2.5 text-gray-600 bg-gray-100 rounded-xl hover:bg-[#1E5631] hover:text-white transition-all duration-300 group/btn"
                                            title="Detail">
                                            <i class="fas fa-eye group-hover/btn:scale-110 transition-transform"></i>
                                        </button>

                                        <!-- Tombol Edit (sekarang modal) -->
                                        <button
                                            onclick="showEditModal(<?= $row['id'] ?>, '<?= esc($row['jenis_pelanggaran']) ?>', '<?= esc($row['kategori'] ?? '') ?>', <?= $row['poin'] ?>)"
                                            class="p-2.5 text-blue-600 bg-blue-100 rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-300 group/btn"
                                            title="Edit">
                                            <i class="fas fa-pencil-alt group-hover/btn:scale-110 transition-transform"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <a href="/admin/pelanggaran/hapus/<?= $row['id'] ?>"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggaran ini?')"
                                            class="p-2.5 text-red-600 bg-red-100 rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300 group/btn"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt group-hover/btn:scale-110 transition-transform"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-16 bg-white rounded-2xl shadow-lg mt-6">
                    <i class="fas fa-exclamation-triangle text-4xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-700">Belum ada data pelanggaran</h3>
                    <p class="text-gray-500 mt-1">Tambahkan jenis pelanggaran pertama untuk memulai</p>
                    <button onclick="openModal('modalTambah')" class="mt-4 bg-[#1E5631] text-white px-6 py-2.5 rounded-lg hover:bg-[#145128] transition-colors">
                        <i class="fas fa-plus-circle mr-2"></i>Tambah Pelanggaran
                    </button>
                </div>
            <?php endif; ?>
        </div>


        <!-- Back to Top Button -->
        <button id="backToTop" class="fixed bottom-8 right-8 bg-[#1E5631] text-white p-3 rounded-full shadow-lg hover:bg-[#174726] transition-all duration-300 hidden">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>


    <!-- MODAL TAMBAH -->
    <div id="modalTambah" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md border border-[#1E5631]/20 animate-scaleIn">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-[#1E5631] flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Tambah Pelanggaran
                </h2>
                <button onclick="closeModal('modalTambah')"
                    class="text-gray-400 hover:text-gray-600 transition duration-200 p-1 rounded-full hover:bg-gray-100">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <form action="/admin/pelanggaran/tambah" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-exclamation-triangle text-gray-400"></i>
                        </div>
                        <input type="text" name="jenis_pelanggaran"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                            placeholder="Masukkan jenis pelanggaran" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <select name="kategori"
                            class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                            <option value="">Pilih Kategori</option>
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Berat">Berat</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Poin</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-star text-gray-400"></i>
                        </div>
                        <input type="number" name="poin" min="1"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                            placeholder="Masukkan poin" required>
                    </div>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal('modalTambah')"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition duration-200 font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white rounded-xl hover:shadow-lg transition duration-200 font-medium shadow-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div id="modalDetail" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md border border-[#1E5631]/20 animate-scaleIn">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-[#1E5631] flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Detail Pelanggaran
                </h2>
                <button onclick="closeModal('modalDetail')"
                    class="text-gray-400 hover:text-gray-600 transition duration-200 p-1 rounded-full hover:bg-gray-100">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Jenis Pelanggaran</label>
                        <p id="detailJenis" class="text-gray-800 font-semibold"></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Kategori</label>
                        <p id="detailKategori" class="text-gray-800 font-semibold"></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Poin</label>
                        <p id="detailPoin" class="text-gray-800 font-semibold"></p>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <button type="button" onclick="closeModal('modalDetail')"
                    class="w-full px-4 py-3 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white rounded-xl hover:shadow-lg transition duration-200 font-medium shadow-md">
                    Tutup
                </button>
            </div>
        </div>
    </div>



     <!-- MODAL EDIT -->
    <div id="modalEdit" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md border border-[#1E5631]/20 animate-scaleIn">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-[#1E5631] flex items-center">
                    <i class="fas fa-pencil-alt mr-2"></i>
                    Edit Pelanggaran
                </h2>
                <button onclick="closeModal('modalEdit')"
                    class="text-gray-400 hover:text-gray-600 transition duration-200 p-1 rounded-full hover:bg-gray-100">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <!-- <form id="editForm" action="" method="POST" class="space-y-4"> -->
                <form id="editForm" action="" method="post">
    <?= csrf_field() ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-exclamation-triangle text-gray-400"></i>
                        </div>
                        <input type="text" name="jenis_pelanggaran" id="editJenis"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                            placeholder="Masukkan jenis pelanggaran" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <select name="kategori" id="editKategori"
                            class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                            <option value="">Pilih Kategori</option>
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Berat">Berat</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Poin</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-star text-gray-400"></i>
                        </div>
                        <input type="number" name="poin" id="editPoin" min="1"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                            placeholder="Masukkan poin" required>
                    </div>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal('modalEdit')"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition duration-200 font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white rounded-xl hover:shadow-lg transition duration-200 font-medium shadow-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <!-- Script Modal and Back to Top -->
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function showDetailModal(jenis, poin, kategori) {
            document.getElementById('detailJenis').textContent = jenis;
            document.getElementById('detailKategori').textContent = kategori || 'Tidak ada kategori';
            document.getElementById('detailPoin').textContent = poin + ' Poin';
            openModal('modalDetail');
        }

        // Close modal when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal(modal.id);
                }
            });
        });

        // Back to Top Button Logic
        const backToTopButton = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Initialize icons
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>

    <script>
        function showEditModal(id, jenis, kategori, poin) {
            let form = document.getElementById('editForm');
            form.action = "<?= site_url('admin/pelanggaran/updatePelanggaran') ?>/" + id;
            form.method = "post"; 

            document.getElementById('editJenis').value = jenis;
            document.getElementById('editKategori').value = kategori;
            document.getElementById('editPoin').value = poin;

            console.log("Form action =>", form.action); // debug
            openModal('modalEdit');
        }


    </script>

    <style>
        .rounded-2xl {
            border-radius: 1rem;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .shadow-lg {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .animate-scaleIn {
            animation: scaleIn 0.2s ease-out;
        }
        
        .modal {
            backdrop-filter: blur(4px);
        }
    </style>

    <?= $this->endSection() ?>