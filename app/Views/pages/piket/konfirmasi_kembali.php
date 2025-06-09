<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="ml-64">
    <h1 class="text-xl font-bold mb-4">Konfirmasi Kembali Siswa</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (empty($izinList)): ?>
        <p class="text-gray-500">Semua siswa telah kembali.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white shadow rounded-lg">
                <thead class="bg-[#1E5631] text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Kelas</th>
                        <th class="px-4 py-2 text-left">Jam Keluar</th>
                        <th class="px-4 py-2 text-left">Jam Kembali</th>
                        <th class="px-4 py-2 text-left">Waktu Kembali Siswa</th>
                        <th class="px-4 py-2 text-left">Sanksi</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($izinList as $izin): ?>
                        <tr class="border-b">
                            <form action="<?= base_url('piket/catat-pelanggaran') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="izin_id" value="<?= esc($izin['id']) ?>">
                                <td class="px-4 py-2"><?= esc($izin['nama']) ?></td>
                                <td class="px-4 py-2"><?= esc($izin['kelas']) ?></td>
                                <td class="px-4 py-2"><?= esc($izin['waktu_keluar']) ?></td>
                                <td class="px-4 py-2"><?= esc($izin['waktu_kembali']) ?></td>
                                <td class="px-4 py-2">
                                    <input type="time" name="waktu_kembali_siswa" required class="border rounded-lg px-2 py-1 text-sm w-full">
                                </td>
                                <td class="px-4 py-2">
                                    <div style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; border-radius: 8px; padding: 8px; background: #f9f9f9;">
                                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 8px;">
                                            <?php foreach ($pelanggaran as $p): ?>
                                                <label style="display: flex; align-items: center; gap: 6px; cursor: pointer; background: #fff; padding: 6px 8px; border-radius: 6px; box-shadow: 0 0 2px rgba(0,0,0,0.1); font-size: 14px;">
                                                    <input type="checkbox" name="pelanggaran_id[]" value="<?= $p['id'] ?>">
                                                    <?= esc($p['jenis_pelanggaran']) ?> (<?= $p['poin'] ?> poin)
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <button type="submit" class="bg-[#1E5631] text-white px-3 py-1 rounded-lg hover:bg-[#145128] text-sm">
                                        Konfirmasi
                                    </button>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
