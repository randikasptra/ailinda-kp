<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>
<div class="ml-64">

    <h1 class="text-2xl font-bold mb-4"><?= $title ?></h1>

    <form action="<?= base_url('admin/siswa/update/' . $siswa['id']) ?>" method="post" class="space-y-4">
        <div>
            <label for="nama" class="block">Nama Siswa</label>
            <input type="text" name="nama" id="nama" value="<?= esc($siswa['nama']) ?>"
                class="w-full border p-2 rounded">
        </div>
        <div>
            <label for="kelas" class="block">Kelas</label>
            <input type="text" name="kelas" id="kelas" value="<?= esc($siswa['kelas']) ?>"
                class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Jurusan</label>
            <select name="jurusan" id="jurusan" class="w-full border px-3 py-2 rounded" required>
                <option value="SOSHUM" <?= $siswa['jurusan'] === 'SOSHUM' ? 'selected' : '' ?>>SOSHUM</option>
                <option value="SAINTEK" <?= $siswa['jurusan'] === 'SAINTEK' ? 'selected' : '' ?>>SAINTEK</option>
                <option value="BAHASA" <?= $siswa['jurusan'] === 'BAHASA' ? 'selected' : '' ?>>BAHASA</option>
            </select>
        </div>
        <div>
            <label for="poin" class="block">Poin</label>
            <input type="number" name="poin" id="poin" value="<?= esc($siswa['poin']) ?>"
                class="w-full border p-2 rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>

</div>
<?= $this->endSection() ?>