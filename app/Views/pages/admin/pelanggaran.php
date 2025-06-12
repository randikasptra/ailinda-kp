<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="text-xl font-bold mb-4">Kelola Pelanggaran</h1>

<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-200 text-green-800 px-4 py-2 mb-4 rounded">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<table class="table-auto w-full mb-4 border">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Jenis Pelanggaran</th>
            <th class="px-4 py-2">Poin</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pelanggaran as $index => $row): ?>
            <tr class="border-t">
                <td class="px-4 py-2"><?= $index + 1 ?></td>
                <td class="px-4 py-2"><?= esc($row['jenis_pelanggaran']) ?></td>
                <td class="px-4 py-2"><?= esc($row['poin']) ?></td>
                <td class="px-4 py-2">
                    <a href="/admin/pelanggaran/hapus/<?= $row['id'] ?>" class="text-red-600"
                        onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form method="POST" action="/admin/pelanggaran/tambah" class="max-w-md bg-white p-4 rounded shadow">
    <h2 class="text-lg font-semibold mb-2">Tambah Pelanggaran</h2>
    <div class="mb-3">
        <label class="block text-sm font-medium">Jenis Pelanggaran</label>
        <input type="text" name="jenis_pelanggaran" class="w-full border px-3 py-2 rounded" required>
    </div>
    <div class="mb-3">
        <label class="block text-sm font-medium">Poin</label>
        <input type="number" name="poin" class="w-full border px-3 py-2 rounded" required>
    </div>
    <div class="text-right">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </div>
</form>

<?= $this->endSection() ?>