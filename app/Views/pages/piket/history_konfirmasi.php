<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class=" mt-16 px-8 py-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800"><?= esc($title) ?></h1>
            <p class="text-gray-500 mt-1">Riwayat konfirmasi kedatangan kembali siswa</p>
        </div>
        <div class="flex gap-4 items-center">
            <form action="<?= base_url('/piket/history_konfirmasi/hapus_hari_ini') ?>" method="post">
                <?= csrf_field() ?>
                <button type="submit" onclick="return confirm('Hapus semua data izin hari ini?')"
                    class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700">
                    Hapus Semua Hari Ini
                </button>
            </form>
            <form method="get" action="<?= base_url('piket/history_konfirmasi') ?>" class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                </div>
                <input type="text" name="keyword" placeholder="Cari siswa..." value="<?= esc($_GET['keyword'] ?? '') ?>"
                    class="pl-10 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] w-64">
            </form>
        </div>
    </div>

    <!-- History Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#1E5631] to-[#2E7D32]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Jam Keluar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Jadwal Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Aktual Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Poin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Dicatat</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white/90 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($historyList as $row): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-[#1E5631]/10 rounded-full flex items-center justify-center">
                                        <span class="text-[#1E5631] font-medium"><?= strtoupper(substr(esc($row['nama']), 0, 1)) ?></span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?= esc($row['nama']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full"><?= esc($row['kelas']) ?></span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <i data-lucide="log-out" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <?= esc($row['waktu_keluar']) ?>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <i data-lucide="calendar-clock" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <?= esc($row['waktu_kembali']) ?>
                            </td>
                            <td class="px-6 py-4">
                                <i data-lucide="clock" class="w-4 h-4 mr-1 <?= empty($row['waktu_kembali_siswa']) ? 'text-red-400' : 'text-green-500' ?>"></i>
                                <span class="<?= empty($row['waktu_kembali_siswa']) ? 'text-red-500' : 'text-gray-700' ?>">
                                    <?= esc($row['waktu_kembali_siswa'] ?? 'Belum kembali') ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <?php if (empty($row['waktu_kembali_siswa'])): ?>
                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Belum Kembali</span>
                                <?php elseif (strtotime($row['waktu_kembali_siswa']) > strtotime($row['waktu_kembali'])): ?>
                                    <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Terlambat</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Tepat Waktu</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="relative group">
                                    <span class="px-2 py-1 text-xs font-medium <?= ($row['total_poin'] ?? 0) > 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?> rounded-full cursor-pointer">
                                        <?= esc($row['total_poin'] ?? 0) ?> poin
                                    </span>
                                    <span class="absolute left-0 mt-2 w-48 bg-gray-800 text-white text-xs rounded py-2 px-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
                                        <?= esc($row['pelanggaran'] ?? 'Tidak ada pelanggaran') ?>
                                    </span>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <?= esc($row['updated_at']) ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="<?= base_url('piket/history_konfirmasi/delete/' . $row['id']) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="text-red-600 hover:underline text-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 hidden z-50 bg-black/50 flex items-center justify-center">
        <form method="post" id="editForm" class="bg-white rounded-xl p-6 w-full max-w-lg shadow-xl">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="edit_id">
            <div class="mb-4">
                <label class="text-sm font-medium">Nama</label>
                <input type="text" name="nama" id="edit_nama" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-4">
                <label class="text-sm font-medium">Kelas</label>
                <input type="text" name="kelas" id="edit_kelas" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-4">
                <label class="text-sm font-medium">Jam Kembali Siswa</label>
                <input type="time" name="waktu_kembali_siswa" id="edit_waktu" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-[#1E5631] text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        function openEditModal(id) {
            fetch("<?= base_url('piket/history_konfirmasi/edit/') ?>" + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_nama').value = data.nama;
                    document.getElementById('edit_kelas').value = data.kelas;
                    document.getElementById('edit_waktu').value = data.waktu_kembali_siswa;
                    document.getElementById('editForm').action = "<?= base_url('piket/history_konfirmasi/update/') ?>" + id;
                    document.getElementById('editModal').classList.remove('hidden');
                });
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</div>
<?= $this->endSection() ?>