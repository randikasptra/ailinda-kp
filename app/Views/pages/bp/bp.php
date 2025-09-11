<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class=" mt-24 px-8 space-y-8">

    <h1 class="text-2xl font-bold text-gray-800">Dashboard Bimbingan & Penyuluhan</h1>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl shadow p-4 border-l-4 border-[#A4DE02]">
            <h2 class="text-lg font-semibold text-gray-700">Total Pelanggaran Bulan Ini</h2>
            <p class="text-3xl mt-2 font-bold text-[#1E5631]"><?= $totalPelanggaranBulanIni ?? 0 ?></p>
        </div>

        <div class="bg-white rounded-xl shadow p-4 border-l-4 border-red-500">
            <h2 class="text-lg font-semibold text-gray-700">Siswa Mendekati DO (≥ 100 Poin)</h2>
            <p class="text-3xl mt-2 font-bold text-red-600"><?= $jumlahSiswaMendekatiDO ?? 0 ?></p>
        </div>
    </div>

    <!-- Top Siswa -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b">
            <h2 class="text-lg font-semibold text-gray-700">Siswa dengan Poin Tertinggi</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Poin</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($topSiswa as $s): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?= esc($s['nama']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= esc($s['kelas']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-red-600"><?= esc($s['poin']) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t text-right">
            <a href="<?= base_url('bp/rekap_poin') ?>"
                class="inline-block bg-[#1E5631] text-white text-sm px-4 py-2 rounded hover:bg-[#17442a]">Lihat Rekap
                Lengkap</a>
        </div>
    </div>

</div>

<?= $this->endSection() ?>