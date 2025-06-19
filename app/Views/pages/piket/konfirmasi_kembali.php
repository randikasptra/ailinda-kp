<?= $this->extend('layout/dashboard_confirm_kembali') ?>
<?= $this->section('content') ?>

<div class="ml-64 mt-24 px-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Konfirmasi Kembali Siswa</h1>
            <p class="text-gray-500 mt-1">Kelola konfirmasi kedatangan kembali siswa</p>
        </div>
    </div>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mr-2"></i>
                <p class="text-green-700 font-medium"><?= esc(session()->getFlashdata('success')) ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Empty State -->
    <?php if (empty($izinList)): ?>
        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i data-lucide="check" class="w-12 h-12 text-green-500"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-800 mb-1">Semua siswa telah kembali</h3>
            <p class="text-gray-500">Tidak ada siswa yang perlu dikonfirmasi saat ini</p>
        </div>
    <?php else: ?>
        <!-- Student List Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-[#1E5631] to-[#2E7D32]">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Nama
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Kelas
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Jam
                                Keluar</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Jam
                                Kembali</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Waktu
                                Kembali Siswa</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">
                                Sanksi</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-white/90 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                   <tbody class="bg-white divide-y divide-gray-200">
    <?php foreach ($izinList as $izin): ?>
        <tr x-data="pelanggaranModal()" x-init>
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

            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full"><?= esc($izin['kelas']) ?></span>
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div class="flex items-center">
                    <i data-lucide="clock" class="w-4 h-4 mr-1 text-gray-400"></i>
                    <?= esc($izin['waktu_keluar']) ?>
                </div>
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div class="flex items-center">
                    <i data-lucide="clock" class="w-4 h-4 mr-1 text-gray-400"></i>
                    <?= esc($izin['waktu_kembali']) ?>
                </div>
            </td>

            <td colspan="3" class="px-6 py-4 whitespace-nowrap">
                <form action="<?= base_url('piket/catat-pelanggaran') ?>" method="post" class="flex flex-col gap-2">
                    <?= csrf_field() ?>
                    <input type="hidden" name="izin_id" value="<?= esc($izin['id']) ?>">

                    <div class="flex gap-2">
                        <div class="relative w-40">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="clock" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input type="time" name="waktu_kembali_siswa" required
                                class="pl-10 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] w-full">
                        </div>

                        <div class="relative">
                            <button type="button" @click="open = true"
                                class="text-sm bg-[#1E5631]/10 text-[#1E5631] font-medium px-4 py-2 rounded-lg border border-[#1E5631]/30 hover:bg-[#1E5631]/20 transition">
                                Pilih Pelanggaran
                            </button>

                            <!-- Selected Badge -->
                            <div class="mt-1 flex flex-wrap gap-2">
                                <template x-for="(item, index) in selected" :key="item.id">
                                    <span
                                        class="inline-flex items-center bg-[#1E5631] text-white text-xs font-medium rounded-full px-3 py-1">
                                        <span x-text="item.jenis_pelanggaran"></span>
                                        <button type="button" @click="remove(index)"
                                            class="ml-2 hover:text-gray-200">&times;</button>
                                    </span>
                                </template>
                            </div>

                            <!-- Hidden input -->
                            <template x-for="s in selected" :key="s.id">
                                <input type="hidden" name="pelanggaran_id[]" :value="s.id">
                            </template>
                        </div>

                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-[#1E5631] to-[#2E7D32] hover:from-[#145128] hover:to-[#1B5E20] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1E5631]/50 transition-all">
                            <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                            Konfirmasi
                        </button>
                    </div>
                </form>

                <!-- Modal -->
                <div x-show="open"
                    class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center px-4"
                    x-transition>
                    <div @click.away="open = false"
                        class="bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-[#1E5631]">Pilih Pelanggaran</h2>
                            <button @click="open = false"
                                class="text-gray-400 hover:text-red-500 text-xl">&times;</button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <template x-for="p in list" :key="p.id">
                                <div @click="toggle(p)"
                                    class="p-3 border rounded-lg hover:bg-[#f4fdf6] cursor-pointer transition shadow-sm flex justify-between items-start">
                                    <div>
                                        <div class="text-sm font-semibold text-gray-800" x-text="p.jenis_pelanggaran"></div>
                                        <div class="text-xs text-gray-500" x-text="p.poin + ' poin'"></div>
                                    </div>
                                    <template x-if="isSelected(p)">
                                        <i class="text-green-500 font-bold">&#10003;</i>
                                    </template>
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

<?= $this->endSection() ?>