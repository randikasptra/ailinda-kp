<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="ml-64 p-6">
    <div class="bg-white shadow rounded-lg p-4">
        <h1 class="text-2xl font-bold mb-4 text-[#1E5631]">Data Siswa</h1>
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
                    <?php foreach ($siswa as $s): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border"><?= esc($s['nisn']) ?></td>
                            <td class="px-4 py-2 border"><?= esc($s['nama']) ?></td>
                            <td class="px-4 py-2 border"><?= esc($s['kelas']) ?></td>
                            <td class="px-4 py-2 border"><?= esc($s['jurusan']) ?></td>
                            <td class="px-4 py-2 border"><?= esc($s['poin']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
