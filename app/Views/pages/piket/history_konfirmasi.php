<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>


<div class="ml-64 p-6">
    <h1 class="text-2xl font-semibold mb-4"><?= esc($title) ?></h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg text-sm">
            <thead class="bg-[#1E5631] text-white">
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Jam Keluar</th>
                    <th class="px-4 py-2">Jam Kembali (Dijadwalkan)</th>
                    <th class="px-4 py-2">Jam Kembali Siswa</th>
                    <th class="px-4 py-2">Poin Pelanggaran</th>
                    <th class="px-4 py-2">Waktu Dicatat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historyList as $row): ?>
                    <tr class="border-b">
                        <td class="px-4 py-2"><?= esc($row['nama']) ?></td>
                        <td class="px-4 py-2"><?= esc($row['kelas']) ?></td>
                        <td class="px-4 py-2"><?= esc($row['waktu_keluar']) ?></td>
                        <td class="px-4 py-2"><?= esc($row['waktu_kembali']) ?></td>
                        <td class="px-4 py-2"><?= esc($row['waktu_kembali_siswa'] ?? 0) ?></td>
                        <td class="px-4 py-2"><?= esc($row['poin_pelanggaran'] ?? 0) ?> poin</td>
                        <td class="px-4 py-2"><?= esc($row['updated_at']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
