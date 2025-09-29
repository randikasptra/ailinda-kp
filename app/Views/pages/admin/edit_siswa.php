<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-2">
                <div class="p-3 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl shadow-lg">
                    <i class="fas fa-user-edit text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?= $title ?></h1>
                    <p class="text-gray-600 mt-1">Edit data siswa dengan informasi yang lengkap</p>
                </div>
            </div>
            
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-gray-500">
                <a href="<?= base_url('admin/dashboard') ?>" class="hover:text-emerald-600 transition-colors">
                    <i class="fas fa-home mr-1"></i>Dashboard
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="<?= base_url('admin/siswa') ?>" class="hover:text-emerald-600 transition-colors">
                    Data Siswa
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-emerald-600 font-medium">Edit Siswa</span>
            </nav>
        </div>

        <!-- Alert Messages -->
        <?php if (session()->has('success')): ?>
            <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-sm"></i>
                    </div>
                    <div class="text-green-800 font-medium"><?= session('success') ?></div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if (session()->has('errors')): ?>
            <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-2xl shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
                    </div>
                    <div class="text-red-800 font-medium">Terjadi kesalahan</div>
                </div>
                <ul class="space-y-1 text-red-700 text-sm">
                    <?php foreach (session('errors') as $error): ?>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-circle text-2xs"></i>
                            <?= esc($error) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-emerald-500 to-green-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-graduate text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Informasi Siswa</h2>
                            <p class="text-emerald-100 text-sm">Lengkapi data siswa dengan benar</p>
                        </div>
                    </div>
                    <div class="text-white/80 text-sm">
                        ID: <span class="font-mono bg-white/20 px-2 py-1 rounded"><?= $siswa['id'] ?></span>
                    </div>
                </div>
            </div>

            <form action="<?= base_url('admin/siswa/update/' . $siswa['id']) ?>" method="post" class="p-6">
                <?= csrf_field() ?>

                <!-- Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Column 1 -->
                    <div class="space-y-6">
                        <!-- Identitas Section -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-id-card text-emerald-600"></i>
                                Identitas Siswa
                            </h3>
                            
                            <div class="space-y-4">
                                <!-- NIS -->
                                <div>
                                    <label for="nis" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <i class="fas fa-hashtag text-gray-400 text-xs"></i>
                                        NIS
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-id-badge text-gray-400"></i>
                                        </div>
                                        <input type="text" name="nis" id="nis" value="<?= esc(old('nis', $siswa['nis'])) ?>" 
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 bg-white"
                                            required>
                                    </div>
                                </div>

                                <!-- NISM -->
                                <div>
                                    <label for="nism" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <i class="fas fa-hashtag text-gray-400 text-xs"></i>
                                        NISM (Opsional)
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-id-card-alt text-gray-400"></i>
                                        </div>
                                        <input type="text" name="nism" id="nism" value="<?= esc(old('nism', $siswa['nism'] ?? '')) ?>" 
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 bg-white">
                                    </div>
                                </div>

                                <!-- Nama Siswa -->
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <i class="fas fa-user text-gray-400 text-xs"></i>
                                        Nama Lengkap
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-signature text-gray-400"></i>
                                        </div>
                                        <input type="text" name="nama" id="nama" value="<?= esc(old('nama', $siswa['nama'])) ?>" 
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 bg-white"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kelas & Absen Section -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-school text-emerald-600"></i>
                                Kelas & Absensi
                            </h3>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Kelas -->
                                <div>
                                    <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-chalkboard text-gray-400"></i>
                                        </div>
                                        <input type="text" name="kelas" id="kelas" value="<?= esc(old('kelas', $siswa['kelas'] ?? '')) ?>"
                                            placeholder="10.01"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 bg-white"
                                            required>
                                    </div>
                                </div>

                                <!-- No Absen -->
                                <div>
                                    <label for="no_absen" class="block text-sm font-medium text-gray-700 mb-2">No Absen</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-list-ol text-gray-400"></i>
                                        </div>
                                        <input type="number" name="no_absen" id="no_absen" value="<?= esc(old('no_absen', $siswa['no_absen'] ?? '')) ?>" 
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 bg-white">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="space-y-6">
                        <!-- Akademik Section -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-graduation-cap text-emerald-600"></i>
                                Informasi Akademik
                            </h3>
                            
                            <div class="space-y-4">
                                <!-- Jurusan -->
                                

                                <!-- Tahun Ajaran -->
                                <div>
                                    <label for="tahun_ajaran" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <i class="fas fa-calendar text-gray-400 text-xs"></i>
                                        Tahun Ajaran
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calendar-alt text-gray-400"></i>
                                        </div>
                                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" value="<?= esc(old('tahun_ajaran', $siswa['tahun_ajaran'] ?? '')) ?>" 
                                            placeholder="2024/2025"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 bg-white"
                                            required>
                                    </div>
                                </div>

                                <!-- Poin -->
                                <div>
                                    <label for="poin" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <i class="fas fa-star text-gray-400 text-xs"></i>
                                        Poin Pelanggaran
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-chart-line text-gray-400"></i>
                                        </div>
                                        <input type="number" name="poin" id="poin" value="<?= esc(old('poin', $siswa['poin'] ?? 0)) ?>" 
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 bg-white">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Section -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-user-friends text-emerald-600"></i>
                                Informasi Personal
                            </h3>
                            
                            <div class="space-y-4">
                                <!-- Jenis Kelamin -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <i class="fas fa-venus-mars text-gray-400 text-xs"></i>
                                        Jenis Kelamin
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                        <select name="jk" id="jk" 
                                            class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 appearance-none bg-white transition-all duration-300">
                                            <option value="" <?= !old('jk', $siswa['jk']) ? 'selected' : '' ?>>Pilih Jenis Kelamin</option>
                                            <option value="L" <?= old('jk', $siswa['jk']) === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                            <option value="P" <?= old('jk', $siswa['jk']) === 'P' ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Info -->
                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-3">
                                    <div class="flex items-center gap-2 text-blue-800">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="text-sm font-medium">Terakhir Diupdate</span>
                                    </div>
                                    <div class="text-xs text-blue-600 mt-1">
                                        <?= date('d M Y H:i', strtotime($siswa['updated_at'] ?? 'now')) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-8 mt-8 border-t border-gray-200">
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        Pastikan data yang diisi sudah benar
                    </div>
                    
                    <div class="flex gap-3">
                        <a href="<?= base_url('/admin/siswa') ?>" 
                            class="flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 shadow-sm hover:shadow-md">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" 
                            class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-green-600 text-white rounded-xl hover:from-emerald-600 hover:to-green-700 transition-all duration-300 shadow-md hover:shadow-lg group"
                            onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan?');">
                            <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add focus effects to form elements
    const formElements = document.querySelectorAll('input, select, textarea');
    
    formElements.forEach(element => {
        element.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-emerald-500/20');
        });
        
        element.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-emerald-500/20');
        });
    });

    // Real-time validation feedback
    const requiredFields = document.querySelectorAll('input[required], select[required]');
    
    requiredFields.forEach(field => {
        field.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.add('border-green-500');
                this.classList.remove('border-red-500');
            } else {
                this.classList.add('border-red-500');
                this.classList.remove('border-green-500');
            }
        });
    });

    // Auto-format tahun ajaran
    const tahunAjaranInput = document.getElementById('tahun_ajaran');
    if (tahunAjaranInput) {
        tahunAjaranInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9\/]/g, '');
            
            // Auto-format to XXXX/XXXX pattern
            if (value.length === 4 && !value.includes('/')) {
                value = value + '/';
            }
            
            e.target.value = value;
        });
    }
});
</script>

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

/* Custom select arrow */
select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
}

/* Remove default arrow for custom styling */
select::-ms-expand {
    display: none;
}
</style>

<?= $this->endSection() ?>