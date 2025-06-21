<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="ml-64 mt-16 px-8 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800"><?= esc($title) ?></h1>
            <p class="text-gray-500 mt-1">Lihat dan kelola rekap poin pelanggaran siswa</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#1E5631] to-[#2a7c3f] text-white">
                    <tr>
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
                    <?php foreach ($siswaList as $siswa): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900"><?= esc($siswa['nisn']) ?></td>
                            <td class="px-6 py-4 font-medium text-gray-900"><?= esc($siswa['nama']) ?></td>
                            <td class="px-6 py-4"><?= esc($siswa['kelas']) ?></td>
                            <td class="px-6 py-4"><?= esc($siswa['jurusan']) ?></td>
                            <td class="px-6 py-4"><?= esc($siswa['tahun_ajaran']) ?></td>
                            <td class="px-6 py-4 font-semibold text-red-600"><?= esc($siswa['poin']) ?> poin</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <a href="<?= base_url('bp/hapus-poin/' . $siswa['id']) ?>" 
                                       class="p-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition"
                                       onclick="return confirm('Yakin ingin menghapus poin siswa ini?')"
                                       title="Hapus Poin">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
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

<?= $this->endSection() ?>