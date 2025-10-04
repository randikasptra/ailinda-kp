<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="mt-24 px-4 md:px-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-list text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Rekapan Sanksi Siswa</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Lihat daftar sanksi pelanggaran siswa</p>
            </div>
        </div>
        
    </div>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl shadow-sm">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <p class="font-medium"><?= esc(session()->getFlashdata('success')) ?></p>
            <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    <!-- Filter dan Search -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-8">
        <div class="px-6 py-4 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B]">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-filter mr-2"></i>
                Filter Data
            </h3>
        </div>
        <div class="p-6">
            <form method="get" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="keyword" value="<?= esc($keyword ?? '') ?>" placeholder="Cari nama/NIS/pelanggaran..."
                       class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                <input type="date" name="start_date" value="<?= esc($startDate ?? '') ?>" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                <input type="date" name="end_date" value="<?= esc($endDate ?? '') ?>" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                <button type="submit" class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white px-4 py-3 rounded-xl font-medium hover:shadow-lg transition-all">
                    <i class="fas fa-search mr-2"></i> Filter
                </button>
                <a href="<?= base_url('admin/laporan/sanksi_siswa') ?>" class="text-center bg-gray-500 text-white px-4 py-3 rounded-xl font-medium hover:bg-gray-600 transition-all">Reset</a>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B]">
            <h3 class="text-lg font-semibold text-white flex items-center justify-between">
                <span><i class="fas fa-table mr-2"></i> Daftar Sanksi Siswa</span>
                <span class="text-sm"><?= count($sanksiData) ?> data</span>
            </h3>
        </div>
        <div class="p-6">
            <?php if (empty($sanksiData)): ?>
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak ada data sanksi</h3>
                    <p class="text-gray-500">Belum ada sanksi siswa yang tercatat</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggaran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($sanksiData as $sanksi): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-full flex items-center justify-center">
                                                <span class="text-white font-medium"><?= strtoupper(substr($sanksi['nama'], 0, 1)) ?></span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900"><?= esc($sanksi['nama']) ?></div>
                                                <div class="text-xs text-gray-500"><?= esc($sanksi['nis']) ?> • <?= esc($sanksi['kelas']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?= esc($sanksi['jenis_pelanggaran']) ?>
                                            <div class="text-xs text-gray-500"><?= esc($sanksi['kategori']) ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            <?= $sanksi['poin'] ?> poin
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= date('d M Y', strtotime($sanksi['tanggal_pelanggaran'])) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <?= esc($sanksi['keterangan'] ?: 'Tidak ada') ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">

                                        <!-- Detail Button -->
                                        <button 
                                            type="button"
                                            class="text-blue-600 hover:text-blue-900"
                                            onclick="openDetailModal(<?= htmlspecialchars(json_encode($sanksi), ENT_QUOTES, 'UTF-8') ?>)">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>

                                        <!-- Edit Button -->
                                        <!-- <button 
                                            type="button"
                                            class="text-indigo-600 hover:text-indigo-900"
                                            onclick="openEditModal(<?= htmlspecialchars(json_encode($sanksi), ENT_QUOTES, 'UTF-8') ?>)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button> -->
                                        <button type="button" 
                                            onclick='openEditModal(<?= json_encode($sanksi, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'
                                            class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>


                                        <!-- Delete Button -->
                                        <form action="<?= site_url('sanksi/delete/' . $sanksi['sanksi_ids'][0]) ?>" 
                                            method="post" class="inline"
                                            onsubmit="return confirm('Yakin mau hapus semua pelanggaran tanggal ini untuk siswa ini?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>

                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- MODAL DETAIL -->
<!-- MODAL DETAIL -->
<div id="detailModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 scale-95 opacity-0"
         id="modalContent">
        <!-- Modal Header -->
        <div class="relative p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-eye text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Detail Sanksi</h2>
                        <p class="text-sm text-gray-600 mt-1">Informasi lengkap mengenai sanksi</p>
                    </div>
                </div>
                <button onclick="closeModal('detailModal')" 
                        class="w-8 h-8 flex items-center justify-center bg-white/80 hover:bg-white text-gray-500 hover:text-gray-700 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md border border-gray-200">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6 max-h-[60vh] overflow-y-auto">
            <div id="detailContent" class="space-y-4">
                <!-- Content will be dynamically inserted here -->
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    <span>Pastikan informasi sudah sesuai</span>
                </div>
                <div class="flex space-x-3">
                    <button onclick="closeModal('detailModal')" 
                            class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200 font-medium flex items-center space-x-2 shadow-sm hover:shadow">
                        <i class="fas fa-times mr-2"></i>
                        <span>Tutup</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced modal functions with animations
function showDetailModal(data) {
    const modal = document.getElementById('detailModal');
    const modalContent = document.getElementById('modalContent');
    const detailContent = document.getElementById('detailContent');
    
    // Populate content
    detailContent.innerHTML = generateDetailContent(data);
    
    // Show modal with animation
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 50);
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    const modalContent = document.getElementById('modalContent');
    
    // Hide with animation
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function generateDetailContent(data) {
    // Customize this function based on your data structure
    return `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Student Info -->
            <div class="bg-blue-50/50 rounded-xl p-4 border border-blue-100">
                <div class="flex items-center space-x-2 mb-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-graduate text-blue-600 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Informasi Siswa</h3>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nama:</span>
                        <span class="font-medium text-gray-800">${data.nama || '-'}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kelas:</span>
                        <span class="font-medium text-gray-800">${data.kelas || '-'}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">NIS:</span>
                        <span class="font-medium text-gray-800">${data.nis || '-'}</span>
                    </div>
                </div>
            </div>

            <!-- Violation Info -->
            <div class="bg-amber-50/50 rounded-xl p-4 border border-amber-100">
                <div class="flex items-center space-x-2 mb-3">
                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-amber-600 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Pelanggaran</h3>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jenis:</span>
                        <span class="font-medium text-gray-800">${data.jenis_pelanggaran || '-'}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Poin:</span>
                        <span class="font-medium text-gray-800 ${data.poin > 50 ? 'text-red-600' : 'text-amber-600'}">
                            ${data.poin || '0'} Poin
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-medium ${data.status === 'Aktif' ? 'text-green-600' : 'text-gray-600'}">
                            ${data.status || '-'}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Date & Time -->
            <div class="bg-purple-50/50 rounded-xl p-4 border border-purple-100">
                <div class="flex items-center space-x-2 mb-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-purple-600 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Waktu Kejadian</h3>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal:</span>
                        <span class="font-medium text-gray-800">${data.tanggal || '-'}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Waktu:</span>
                        <span class="font-medium text-gray-800">${data.waktu || '-'}</span>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="bg-gray-50/50 rounded-xl p-4 border border-gray-100">
                <div class="flex items-center space-x-2 mb-3">
                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clipboard-list text-gray-600 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Keterangan Tambahan</h3>
                </div>
                <div class="text-sm">
                    <p class="text-gray-700 leading-relaxed">${data.keterangan || 'Tidak ada keterangan tambahan'}</p>
                </div>
            </div>
        </div>

        <!-- Action Timeline -->
        <div class="mt-6 pt-4 border-t border-gray-200">
            <h4 class="font-semibold text-gray-800 mb-3 flex items-center space-x-2">
                <i class="fas fa-history text-gray-500"></i>
                <span>Riwayat Tindakan</span>
            </h4>
            <div class="space-y-3">
                <div class="flex items-center space-x-3 text-sm">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <span class="text-gray-600">Dilaporkan oleh:</span>
                    <span class="font-medium text-gray-800">${data.pelapor || 'Sistem'}</span>
                    <span class="text-gray-400 text-xs">${data.tanggal_lapor || data.tanggal}</span>
                </div>
                ${data.tanggal_verifikasi ? `
                <div class="flex items-center space-x-3 text-sm">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <span class="text-gray-600">Diverifikasi:</span>
                    <span class="font-medium text-gray-800">${data.verifikator || 'Admin'}</span>
                    <span class="text-gray-400 text-xs">${data.tanggal_verifikasi}</span>
                </div>
                ` : ''}
            </div>
        </div>
    `;
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target.id === 'detailModal') {
        closeModal('detailModal');
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('detailModal');
    }
});
</script>

<style>
/* Smooth scrolling for modal content */
#detailContent {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

#detailContent::-webkit-scrollbar {
    width: 6px;
}

#detailContent::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

#detailContent::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

#detailContent::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Animation for modal backdrop */
#detailModal {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Hover effects */
.bg-blue-50\/50:hover, .bg-amber-50\/50:hover, .bg-purple-50\/50:hover, .bg-gray-50\/50:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease;
}
</style>

<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg w-11/12 md:w-2/3 p-6 max-h-[90vh] overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
            <i class="fas fa-edit mr-2 text-indigo-500"></i> Edit Pelanggaran
        </h2>

        <form id="editForm" method="post" action="<?= site_url('sanksi/update-pelanggaran') ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="siswa_id" id="editSiswaId">
            <input type="hidden" name="tanggal_pelanggaran" id="editTanggal">

            <!-- Pelanggaran Sebelumnya -->
            <div id="pelanggaranSebelumnya" class="mb-3 p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                <strong>Pelanggaran Sebelumnya:</strong>
                <ul id="listPelanggaranSebelumnya" class="list-disc pl-4"></ul>
            </div>

            <!-- Keterangan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan (opsional)</label>
                <textarea name="keterangan" id="editKeterangan"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-400"
                    rows="3"></textarea>
            </div>

            <!-- Pilih Pelanggaran -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih/Ubah Pelanggaran</label>
                <div id="editPelanggaranList" 
                     class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-64 overflow-y-auto border p-2 rounded-xl">
                    <?php foreach ($pelanggaran as $p): ?>
                        <label class="flex items-center space-x-2 border-b pb-1">
                            <input type="checkbox" name="pelanggaran_ids[]" value="<?= $p['id'] ?>" class="pelanggaranCheckbox">
                            <span><?= $p['jenis_pelanggaran'] ?> 
                                <small class="text-gray-500">(<?= $p['kategori'] ?> - <?= $p['poin'] ?> poin)</small>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeModal('editModal')"
                    class="px-4 py-2 bg-gray-500 text-white rounded-xl hover:bg-gray-600">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</div>





<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg w-11/12 md:w-2/3 p-6 max-h-[90vh] overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
            <i class="fas fa-edit mr-2 text-indigo-500"></i> Edit Pelanggaran
        </h2>

        <form id="editForm" method="post" action="<?= site_url('sanksi/update-pelanggaran') ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="siswa_id" id="editSiswaId">
            <input type="hidden" name="tanggal_pelanggaran" id="editTanggal">

            <!-- 🔴 Pelanggaran Sebelumnya -->
            <div id="pelanggaranSebelumnya" class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                <strong>Pelanggaran Sebelumnya:</strong>
                <ul id="listPelanggaranSebelumnya" class="list-disc pl-4"></ul>
            </div>

            <!-- 📝 Keterangan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan (opsional)</label>
                <textarea name="keterangan" id="editKeterangan"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-400"
                    rows="3"></textarea>
            </div>

            <!-- ✅ Pilih/Ubah Pelanggaran -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tambah / Ubah Pelanggaran</label>
                <div id="editPelanggaranList"
                     class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-64 overflow-y-auto border p-2 rounded-xl bg-gray-50">
                    <?php foreach ($pelanggaran as $p): ?>
                        <label class="flex items-center space-x-2 border-b pb-1">
                            <input type="checkbox" name="pelanggaran_ids[]" value="<?= $p['id'] ?>" class="pelanggaranCheckbox">
                            <span><?= $p['jenis_pelanggaran'] ?> 
                                <small class="text-gray-500">(<?= $p['kategori'] ?> - <?= $p['poin'] ?> poin)</small>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <p class="text-xs text-gray-500 mt-1">Centang untuk menambah pelanggaran baru.</p>
            </div>

            <!-- 🔘 Tombol -->
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeModal('editModal')"
                    class="px-4 py-2 bg-gray-500 text-white rounded-xl hover:bg-gray-600">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(data) {
        // Isi hidden input
        document.getElementById("editSiswaId").value = data.siswa_id;
        document.getElementById("editTanggal").value = data.tanggal_pelanggaran;
        document.getElementById("editKeterangan").value = data.keterangan || "";

        // 🔹 Tampilkan pelanggaran sebelumnya
        const listPrev = document.getElementById("listPelanggaranSebelumnya");
        listPrev.innerHTML = "";

        if (data.pelanggaran_list && data.pelanggaran_list.length > 0) {
            data.pelanggaran_list.forEach(function(item) {
                let li = document.createElement("li");
                li.classList.add("flex", "items-center", "justify-between", "mb-1");

                li.innerHTML = `
                    <span>${item.jenis_pelanggaran} 
                        <span class="text-xs text-gray-500">(Poin: ${item.poin})</span>
                    </span>
                    <label class="text-xs text-red-600 flex items-center space-x-1">
                        <input type="checkbox" name="hapus_ids[]" value="${item.sanksi_id}" class="h-3 w-3 text-red-500">
                        <span>Hapus</span>
                    </label>
                `;
                listPrev.appendChild(li);
            });
        } else {
            listPrev.innerHTML = `<li class="text-gray-500 italic">Tidak ada pelanggaran sebelumnya.</li>`;
        }

        // 🔹 Reset semua checkbox pelanggaran (buat nambah baru)
        document.querySelectorAll(".pelanggaranCheckbox").forEach(cb => {
            cb.checked = false;
        });

        // 🔹 Tampilkan modal
        document.getElementById("editModal").classList.remove("hidden");
    }

    function closeModal(id) {
        document.getElementById(id).classList.add("hidden");
    }
</script>





<script>
function openDetailModal(data) {
    const modal = document.getElementById('detailModal');
    const content = document.getElementById('detailContent');

    content.innerHTML = `
        <p><strong>Nama:</strong> ${data.nama}</p>
        <p><strong>NIS:</strong> ${data.nis}</p>
        <p><strong>Kelas:</strong> ${data.kelas}</p>
        <p><strong>Tanggal:</strong> ${data.tanggal_pelanggaran}</p>
        <p><strong>Pelanggaran:</strong> ${data.jenis_pelanggaran}</p>
        <p><strong>Kategori:</strong> ${data.kategori}</p>
        <p><strong>Total Poin:</strong> ${data.poin}</p>
        <p><strong>Keterangan:</strong> ${data.keterangan}</p>
    `;

    modal.classList.remove('hidden');
}


function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
</script>


<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?= $this->endSection() ?>
