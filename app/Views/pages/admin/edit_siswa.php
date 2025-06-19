<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class=" p-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h1 class="text-2xl font-bold text-[#1E5631] flex items-center gap-2">
                <i data-lucide="user-cog" class="w-6 h-6"></i>
                <?= $title ?>
            </h1>
        </div>

        <form action="<?= base_url('admin/siswa/update/' . $siswa['id']) ?>" method="post" class="p-6 space-y-5">
            <!-- Nama Siswa -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Siswa</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="text" name="nama" id="nama" value="<?= esc($siswa['nama']) ?>" 
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition" required>
                </div>
            </div>

            <!-- Kelas -->
            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="school" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="text" name="kelas" id="kelas" value="<?= esc($siswa['kelas']) ?>"
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition" required>
                </div>
            </div>

            <!-- Jurusan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="book" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <select name="jurusan" id="jurusan" 
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] appearance-none bg-white" required>
                        <option value="SOSHUM" <?= $siswa['jurusan'] === 'SOSHUM' ? 'selected' : '' ?>>SOSHUM</option>
                        <option value="SAINTEK" <?= $siswa['jurusan'] === 'SAINTEK' ? 'selected' : '' ?>>SAINTEK</option>
                        <option value="BAHASA" <?= $siswa['jurusan'] === 'BAHASA' ? 'selected' : '' ?>>BAHASA</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Poin -->
            <div>
                <label for="poin" class="block text-sm font-medium text-gray-700 mb-2">Poin</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="star" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="number" name="poin" id="poin" value="<?= esc($siswa['poin']) ?>"
                        class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4">
                <button type="submit" 
                    class="flex items-center px-5 py-2.5 bg-[#1E5631] text-white rounded-lg hover:bg-[#145128] transition shadow-md">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>

<?= $this->endSection() ?>