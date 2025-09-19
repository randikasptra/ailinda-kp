<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
        <div class="flex items-center mb-6">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-user-graduate text-white text-2xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-[#1E5631]">Detail Siswa</h2>
                <p class="text-gray-600 mt-1">Informasi lengkap data siswa</p>
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-32 flex items-center">
                    <i class="fas fa-id-card text-[#1E5631] mr-2"></i> NIS:
                </span>
                <span class="font-medium text-gray-900"><?= esc($siswa['nis']) ?></span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-32 flex items-center">
                    <i class="fas fa-id-card-alt text-[#1E5631] mr-2"></i> NISM:
                </span>
                <span class="font-medium text-gray-900"><?= esc($siswa['nism'] ?? '-') ?></span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-32 flex items-center">
                    <i class="fas fa-user text-[#1E5631] mr-2"></i> Nama:
                </span>
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-full flex items-center justify-center text-white font-bold shadow-md mr-3">
                        <?= strtoupper(substr($siswa['nama'], 0, 1)) ?>
                    </div>
                    <span class="font-medium text-gray-900"><?= esc($siswa['nama']) ?></span>
                </div>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-32 flex items-center">
                    <i class="fas fa-venus-mars text-[#1E5631] mr-2"></i> Jenis Kelamin:
                </span>
                <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full <?= ($siswa['jk'] == 'L' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-pink-100 text-pink-800 border border-pink-200') ?>">
                    <?= ($siswa['jk'] == 'L' ? 'Laki-laki' : 'Perempuan') ?>
                </span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-32 flex items-center">
                    <i class="fas fa-school text-[#1E5631] mr-2"></i> Kelas:
                </span>
                <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                    <?= esc($siswa['kelas']) ?>
                </span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-32 flex items-center">
                    <i class="fas fa-sort-numeric-up text-[#1E5631] mr-2"></i> No Absen:
                </span>
                <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                    <?= esc($siswa['no_absen'] ?? '-') ?>
                </span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-32 flex items-center">
                    <i class="fas fa-book text-[#1E5631] mr-2"></i> Jurusan:
                </span>
                <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-purple-100 text-purple-800 border border-purple-200">
                    <?= esc($siswa['jurusan']) ?>
                </span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-32 flex items-center">
                    <i class="fas fa-calendar-alt text-[#1E5631] mr-2"></i> Tahun Ajaran:
                </span>
                <span class="px-3 py-1.5 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                    <?= esc($siswa['tahun_ajaran'] ?? '-') ?>
                </span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-32 flex items-center">
                    <i class="fas fa-star text-[#1E5631] mr-2"></i> Poin:
                </span>
                <span class="px-3 py-1.5 inline-flex items-center text-sm font-semibold rounded-full <?= ($siswa['poin'] > 0 ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-green-100 text-green-800 border border-green-200') ?>">
                    <i class="fas fa-star text-xs mr-1.5 <?= ($siswa['poin'] > 0 ? 'text-red-500' : 'text-green-500') ?>"></i>
                    <?= esc($siswa['poin']) ?>
                </span>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="<?= site_url('admin/siswa') ?>" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition duration-200 font-medium text-center">
                Kembali
            </a>
            <a href="/admin/siswa/edit_siswa/<?= $siswa['id'] ?>" class="flex-1 px-4 py-3 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white rounded-xl hover:shadow-lg transition duration-200 font-medium text-center shadow-md">
                Edit Siswa
            </a>
        </div>
    </div>
</div>

<!-- Include Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<style>
.rounded-2xl {
    border-radius: 1rem;
}

.transition-all {
    transition: all 0.3s ease;
}

.shadow-lg {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
</style>

<?= $this->endSection() ?>