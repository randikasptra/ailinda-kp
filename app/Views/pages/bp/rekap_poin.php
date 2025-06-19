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
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#1E5631] to-[#2E7D32]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Poin</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($siswaList as $siswa): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900"><?= esc($siswa['nama']) ?></td>
                            <td class="px-6 py-4"><?= esc($siswa['kelas']) ?></td>
                            <td class="px-6 py-4"><?= esc($siswa['jurusan']) ?></td>
                            <td class="px-6 py-4 font-semibold text-red-600"><?= esc($siswa['poin']) ?> poin</td>
                            <td class="px-6 py-4 text-right">
                                <a href="<?= base_url('bp/hapus-poin/' . $siswa['id']) ?>" 
                                   class="text-sm text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition"
                                   onclick="return confirm('Yakin ingin menghapus poin siswa ini?')">
                                   Hapus Poin
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>