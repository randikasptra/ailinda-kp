<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="mt-24 px-8">
    <h1 class="text-2xl font-bold mb-6">Laporan Rekap Surat Izin</h1>

    <!-- Rekap Izin Keluar -->
    <h2 class="text-xl font-semibold mb-3">Izin Keluar</h2>
    <table class="table-auto w-full border border-gray-300 mb-8">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-2">No</th>
                <th class="border px-2 py-2">Nama</th>
                <th class="border px-2 py-2">NISN</th>
                <th class="border px-2 py-2">Kelas</th>
                <th class="border px-2 py-2">Tanggal</th>
                <th class="border px-2 py-2">Waktu Keluar</th>
                <th class="border px-2 py-2">Waktu Kembali</th>
                <th class="border px-2 py-2">Alasan</th>
                <th class="border px-2 py-2">Pelanggaran</th>
                <th class="border px-2 py-2">Total Poin</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($izinKeluar as $izin): ?>
                <tr>
                    <td class="border px-2 py-2"><?= $no++ ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['nama']) ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['nisn']) ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['kelas']) ?></td>
                    <td class="border px-2 py-2"><?= date('d-m-Y', strtotime($izin['created_at'])) ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['waktu_keluar']) ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['waktu_kembali']) ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['alasan']) ?></td>
                    <td class="border px-2 py-2">
                        <?= $izin['pelanggaran_list'] ?: '-' ?>
                    </td>
                    <td class="border px-2 py-2 text-center">
                        <?= $izin['total_poin'] ?: 0 ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Rekap Izin Masuk -->
    <h2 class="text-xl font-semibold mb-3">Izin Masuk</h2>
    <table class="table-auto w-full border border-gray-300 mb-8">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-2">No</th>
                <th class="border px-2 py-2">Nama</th>
                <th class="border px-2 py-2">NISN</th>
                <th class="border px-2 py-2">Kelas</th>
                <th class="border px-2 py-2">Tanggal</th>
                <th class="border px-2 py-2">Alasan Terlambat</th>
                <th class="border px-2 py-2">Tindak Lanjut</th>
                <th class="border px-2 py-2">Pelanggaran</th>
                <th class="border px-2 py-2">Total Poin</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($izinMasuk as $izin): ?>
                <tr>
                    <td class="border px-2 py-2"><?= $no++ ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['nama']) ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['nisn']) ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['kelas']) ?></td>
                    <td class="border px-2 py-2"><?= date('d-m-Y', strtotime($izin['created_at'])) ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['alasan_terlambat']) ?></td>
                    <td class="border px-2 py-2"><?= esc($izin['tindak_lanjut']) ?></td>
                    <td class="border px-2 py-2">
                        <?= $izin['pelanggaran_list'] ?: '-' ?>
                    </td>
                    <td class="border px-2 py-2 text-center">
                        <?= $izin['total_poin'] ?: 0 ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
