<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class=" p-6">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-[#1E5631]">Edit Pelanggaran</h2>

        <form action="<?= site_url('admin/pelanggaran/update/' . $pelanggaran['id']) ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jenis Pelanggaran</label>
                <input type="text" name="jenis_pelanggaran" value="<?= esc($pelanggaran['jenis_pelanggaran']) ?>"
                    class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Poin</label>
                <input type="number" name="poin" value="<?= esc($pelanggaran['poin']) ?>"
                    class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="flex justify-end gap-2">
                <a href="<?= site_url('admin/pelanggaran') ?>" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-[#1E5631] text-white rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>