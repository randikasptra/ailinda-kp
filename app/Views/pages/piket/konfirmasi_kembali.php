<?= $this->extend('layout/dashboard_confirm_kembali') ?>
<?= $this->section('content') ?>

<div class="mt-24 px-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-user-check text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Konfirmasi Kembali Siswa</h1>
                <p class="text-gray-600 mt-1">Kelola konfirmasi kedatangan kembali siswa</p>
            </div>
        </div>
        
        <!-- Stats Overview -->
        <div class="flex items-center gap-4">
            <div class="bg-white rounded-xl shadow-sm p-3 border border-gray-200">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-lg bg-green-100 text-green-600">
                        <i class="fas fa-users text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Menunggu Konfirmasi</p>
                        <p class="font-semibold text-gray-800"><?= count($izinList) ?> Siswa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl shadow-sm">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <div>
                <p class="font-medium"><?= esc(session()->getFlashdata('success')) ?></p>
            </div>
            <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    <!-- Empty State -->
    <?php if (empty($izinList)): ?>
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <div class="mx-auto w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-check-circle text-green-500 text-4xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Semua siswa telah kembali</h3>
            <p class="text-gray-500 mb-6">Tidak ada siswa yang perlu dikonfirmasi saat ini</p>
            <div class="bg-green-50 rounded-xl p-4 max-w-md mx-auto">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-green-500 mr-3"></i>
                    <p class="text-sm text-green-700">Sistem akan secara otomatis menampilkan siswa yang perlu dikonfirmasi ketika ada yang keluar</p>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Student List Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Table Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Siswa Menunggu Konfirmasi</h3>
                        <p class="text-sm text-gray-600">Total <?= count($izinList) ?> siswa perlu dikonfirmasi</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Cari siswa..." 
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                        </div>
                    </div>
                </div>
            </div>

           <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-2"></i>
                                    Nama Siswa
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-id-card mr-2"></i>
                                    NIS
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-school mr-2"></i>
                                    Kelas
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Jam Keluar
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Jam Kembali
                                </div>
                            </th>
                            <!-- <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    Waktu Kembali
                                </div>
                            </th> -->
                            <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    Sanksi
                                </div>
                            </th>
                            <th class="px-6 py-4 text-right text-sm font-medium uppercase tracking-wider">
                                <div class="flex items-center justify-end">
                                    <i class="fas fa-cog mr-2"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($izinList as $izin): ?>
                            <tr x-data="pelanggaranModal()" x-init>
                                <!-- Kolom Nama -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-[#1E5631]/10 rounded-full flex items-center justify-center">
                                            <span class="text-[#1E5631] font-medium"><?= strtoupper(substr(esc($izin['nama']), 0, 1)) ?></span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?= esc($izin['nama']) ?></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Kolom NIS -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full"><?= esc($izin['nisn']) ?></span>
                                </td>

                                <!-- Kolom Kelas -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full"><?= esc($izin['kelas']) ?></span>
                                </td>

                                <!-- Kolom Jam Keluar -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i data-lucide="clock" class="w-4 h-4 mr-1 text-gray-400"></i>
                                        <?= esc($izin['waktu_keluar']) ?>
                                    </div>
                                </td>

                                <!-- Kolom Jam Kembali -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i data-lucide="clock" class="w-4 h-4 mr-1 text-gray-400"></i>
                                        <?= esc($izin['waktu_kembali']) ?>
                                    </div>
                                </td>

                                <!-- Kolom Waktu Kembali Siswa -->
                                <!-- <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="<?= base_url('piket/catat-pelanggaran') ?>" method="post" class="flex flex-col gap-2" id="form-<?= $izin['id'] ?>">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="izin_id" value="<?= esc($izin['id']) ?>">

                                        <div class="relative w-40">
                                            <input type="time" name="waktu_kembali_siswa" required
                                                class="pl-10 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] w-full">
                                        </div>
                                </td> -->

                                <!-- Kolom Sanksi -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="relative">
                                        <button type="button" @click="open = true"
                                            class="text-sm bg-[#1E5631]/10 text-[#1E5631] font-medium px-4 py-2 rounded-lg border border-[#1E5631]/30 hover:bg-[#1E5631]/20 transition">
                                            Pilih Pelanggaran
                                        </button>

                                        <div class="mt-1 flex flex-wrap gap-2">
                                            <template x-for="(item, index) in selected" :key="item.id">
                                                <span class="inline-flex items-center bg-[#1E5631] text-white text-xs font-medium rounded-full px-3 py-1">
                                                    <span x-text="item.jenis_pelanggaran"></span>
                                                    <button type="button" @click="remove(index)" class="ml-2 hover:text-gray-200">&times;</button>
                                                </span>
                                            </template>
                                        </div>

                                        <template x-for="s in selected" :key="s.id">
                                            <input type="hidden" name="pelanggaran_id[]" :value="s.id" form="form-<?= $izin['id'] ?>">
                                        </template>
                                    </div>
                                </td>

                                <!-- Kolom Aksi -->
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-[#1E5631] to-[#2E7D32] hover:from-[#145128] hover:to-[#1B5E20] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1E5631]/50 transition-all">
                                        <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                                        Konfirmasi
                                    </button>
                                    </form>

                                    <!-- Modal -->
                                    <div x-show="open"
                                        class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center px-4"
                                        x-transition>
                                        <div @click.away="open = false"
                                            class="bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">

                                            <div class="flex justify-between items-center mb-4">
                                                <h2 class="text-xl font-semibold text-[#1E5631]">Pilih Pelanggaran</h2>
                                                <button @click="open = false" class="text-gray-400 hover:text-red-500 text-xl">&times;</button>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <template x-for="p in list" :key="p.id">
                                                    <div @click="toggle(p)"
                                                        class="p-3 border rounded-lg hover:bg-[#f4fdf6] cursor-pointer transition shadow-sm flex flex-col justify-between h-full">
                                                        <div class="text-sm font-semibold text-gray-800 break-words whitespace-normal leading-snug">
                                                            <span x-text="p.jenis_pelanggaran"></span>
                                                        </div>
                                                        <div class="flex justify-between items-center mt-2">
                                                            <span class="text-xs text-gray-500" x-text="p.poin + ' poin'"></span>
                                                            <template x-if="isSelected(p)">
                                                                <i class="text-green-500 font-bold">&#10003;</i>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>


<script>
function pelanggaranModal() {
    return {
        open: false,
        // pakai nama yang dikirim controller, dan fallback ke array kosong supaya aman
        list: <?= json_encode($pelanggarans ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>,
        selected: [],
        toggle(p) {
            let index = this.selected.findIndex(item => item.id === p.id);
            if (index === -1) this.selected.push(p);
            else this.selected.splice(index, 1);
        },
        isSelected(p) {
            return this.selected.some(item => item.id === p.id);
        },
        remove(index) {
            this.selected.splice(index, 1);
        }
    }
}

// Initialize icons
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>

<style>
[x-cloak] {
    display: none !important;
}

.shadow-lg {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.rounded-2xl {
    border-radius: 1rem;
}

.transition-all {
    transition: all 0.3s ease;
}
</style>

<?= $this->endSection() ?>