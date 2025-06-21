<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class=" p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-[#1E5631]">Detail Siswa</h2>

        <div class="space-y-3">
            <div>
                <span class="font-semibold text-gray-700">NISN:</span>
                <span><?= esc($siswa['nisn']) ?></span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Nama:</span>
                <span><?= esc($siswa['nama']) ?></span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Kelas:</span>
                <span><?= esc($siswa['kelas']) ?></span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Jurusan:</span>
                <span><?= esc($siswa['jurusan']) ?></span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Tahun Ajaran:</span>
                <span><?= esc($siswa['tahun_ajaran']) ?></span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Poin:</span>
                <span><?= esc($siswa['poin']) ?></span>
            </div>
        </div>

        <div class="mt-6">
            <a href="<?= site_url('admin/siswa') ?>" class="px-4 py-2 bg-gray-300 rounded">Kembali</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>