<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class=" p-8">
 <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="flex justify-between items-center p-6 border-b border-gray-100">
        <!-- Kiri: Judul -->
        <h1 class="text-2xl font-bold text-[#1E5631] flex items-center gap-2">
            <i data-lucide="users" class="w-6 h-6"></i>
            Kelola Data Siswa
        </h1>

        <!-- Kanan: Tombol Aksi -->
        <div class="flex items-center gap-3">
            <!-- Tambah Siswa -->
            <button onclick="document.getElementById('tambahModal').classList.remove('hidden')"
                class="flex items-center gap-2 bg-[#1E5631] text-white px-4 py-2.5 rounded-lg hover:bg-[#145128]/90 transition duration-200 shadow-sm">
                <i data-lucide="user-plus" class="w-5 h-5"></i>
                Tambah Siswa
            </button>

            <!-- Naikkan Kelas -->
            <form action="<?= base_url('admin/siswa/update_kelas') ?>" method="post"
                onsubmit="return confirm('Yakin ingin naikkan semua kelas siswa?')" class="inline">
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2.5 border border-[#1E5631] text-[#1E5631] hover:bg-[#1E5631]/10 hover:text-[#1E5631] rounded-lg transition duration-200 shadow-sm">
                    <i data-lucide="arrow-up" class="w-5 h-5"></i>
                    Naikkan Kelas
                </button>
            </form>

            <!-- Hapus Siswa Lulus -->
            <form action="<?= base_url('admin/siswa/hapus_lulus') ?>" method="post"
                onsubmit="return confirm('Hapus semua siswa yang sudah lulus?')" class="inline">
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2.5 border border-red-600 text-red-600 hover:bg-red-600/10 hover:text-red-700 rounded-lg transition duration-200 shadow-sm">
                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                    Hapus Siswa Lulus
                </button>
            </form>
        </div>
    </div>

    <!-- Import CSV -->
    <div class="p-6 border-b border-gray-100">
        <form action="<?= base_url('admin/siswa/import_csv'); ?>" method="post" enctype="multipart/form-data">
            <label for="csv_file" class="block mb-2 font-bold text-gray-700">Import Siswa dari CSV</label>
            <div class="flex items-center gap-4">
                <input type="file" name="csv_file" id="csv_file" accept=".csv" required
                    class="border border-gray-300 rounded px-3 py-2 w-full max-w-sm">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200">
                    Upload CSV
                </button>
            </div>
        </form>
    </div>
</div>




    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 my-4 rounded">
            <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        
    <thead class="bg-[#1E5631] text-white">
        <tr>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                <div class="flex items-center">
                    <i data-lucide="hash" class="w-4 h-4 mr-2"></i>
                    No
                </div>
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                <div class="flex items-center">
                    <i data-lucide="id-card" class="w-4 h-4 mr-2"></i>
                    NISN
                </div>
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                <div class="flex items-center">
                    <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                    Nama
                </div>
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                <div class="flex items-center">
                    <i data-lucide="school" class="w-4 h-4 mr-2"></i>
                    Kelas
                </div>
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                <div class="flex items-center">
                    <i data-lucide="book" class="w-4 h-4 mr-2"></i>
                    Jurusan
                </div>
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                <div class="flex items-center">
                    <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                    Tahun Ajaran
                </div>
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                <div class="flex items-center">
                    <i data-lucide="star" class="w-4 h-4 mr-2"></i>
                    Poin
                </div>
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                <div class="flex items-center">
                    <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                    Aksi
                </div>
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        <?php $no = 1; foreach ($siswa as $s): ?>
            <tr class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $no++ ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= esc($s['nisn']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= esc($s['nama']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($s['kelas']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($s['jurusan']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($s['tahun_ajaran']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2.5 py-0.5 rounded-full bg-[#A4DE02]/20 text-[#1E5631] font-medium">
                        <?= esc($s['poin']) ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center gap-3">
                        <a href="/admin/siswa/detail_siswa/<?= $s['id'] ?>"
                            class="text-gray-600 hover:text-[#1E5631] p-2 rounded-full hover:bg-green-50 transition"
                            title="Lihat Detail">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </a>
                        <a href="/admin/siswa/edit_siswa/<?= $s['id'] ?>"
                            class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50 transition"
                            title="Edit Siswa">
                            <i data-lucide="pencil" class="w-5 h-5"></i>
                        </a>
                        <a href="/admin/siswa/hapus/<?= $s['id'] ?>"
                            onclick="return confirm('Yakin hapus siswa ini?')"
                            class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition"
                            title="Hapus Siswa">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

    </div>
</div>
</div>
<!-- Modal Tambah Siswa -->
<div id="tambahModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md border border-[#1E5631]/20">
        <div class="flex justify-between items-center p-6 border-b border-gray-100">
            <h2 class="text-xl font-bold text-[#1E5631] flex items-center gap-2">
                <i data-lucide="user-plus" class="w-5 h-5"></i>
                Tambah Siswa
            </h2>
            <button onclick="document.getElementById('tambahModal').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form method="POST" action="/admin/siswa/tambah" class="p-6">
            <div class="grid grid-cols-1 gap-4">
                <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i data-lucide="id-card" class="w-4 h-4 text-gray-400"></i>
        </div>
        <input type="text" name="nisn" inputmode="numeric" pattern="\d+"
            class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition"
            required>
    </div>
</div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="text" name="nama"
                            class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition"
                            required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="school" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input type="text" name="kelas" placeholder="cth: 10 / 11 / 12"
                                class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition"
                                required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="book" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <select name="jurusan"
                                class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] appearance-none bg-white"
                                required>
                                <option value="SOSHUM">SOSHUM</option>
                                <option value="SAINTEK">SAINTEK</option>
                                <option value="BAHASA">BAHASA</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input type="text" name="tahun_ajaran" placeholder="cth: 2024/2025"
                                class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition"
                                required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Poin Awal</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="star" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input type="number" name="poin" value="0"
                                class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-6">
                <button type="button" onclick="document.getElementById('tambahModal').classList.add('hidden')"
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

<script>
    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>

<?= $this->endSection() ?>