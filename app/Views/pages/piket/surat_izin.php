<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div id="modalSuccess" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 transition-opacity duration-300">
        <div class="bg-white p-6 rounded-xl shadow-2xl text-center max-w-sm mx-4 border-l-4 border-green-500 transform scale-100 transition-transform duration-300">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Berhasil!</h3>
            <p class="text-gray-600 mb-4"><?= session()->getFlashdata('success') ?></p>
            <button onclick="document.getElementById('modalSuccess').style.display='none'" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                Tutup
            </button>
        </div>
    </div>
<?php endif; ?>

<style>
    @media print {
        @page { 
            size: 8.2cm auto; 
            margin: 0; 
        }
        body {
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .print-area {
            width: 7.8cm;
            margin: 0 auto;
            font-family: 'Times New Roman', serif;
            font-size: 11px;
            padding: 4px 6px;
            box-sizing: border-box;
        }
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; padding: 1px 0; }
        .no-print { display: none !important; }
    }
    
    /* Animasi untuk modal */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideIn {
        from { transform: translateY(-10px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    .modal-animation {
        animation: fadeIn 0.3s ease-out;
    }
    
    .modal-content-animation {
        animation: slideIn 0.3s ease-out;
    }
</style>

<div class="print-area">
    <div class="p-4 md:p-6 mt-24">
        <div class="bg-white p-6 rounded-2xl shadow-lg max-w-4xl mx-auto border-l-4 border-[#4CAF50]">
            <div class="flex items-center mb-6">
                <div class="bg-[#4CAF50] p-3 rounded-xl mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Formulir Surat Izin Keluar</h2>
                    <p class="text-gray-600">Keluar masuk siswa selama jam sekolah</p>
                </div>
            </div>

            <!-- PENCARIAN SISWA -->
            <div class="mb-8 bg-gray-50 p-5 rounded-xl border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#4CAF50] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Pencarian Siswa
                </h3>
                <form method="get" action="<?= base_url('piket/surat_izin') ?>" class="flex flex-col md:flex-row gap-3">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="keyword" value="<?= esc($keyword ?? '') ?>" placeholder="Cari berdasarkan NISN atau Nama..."
                            class="pl-10 w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent focus:outline-none transition-all duration-200" />
                    </div>
                    <button type="submit" class="bg-[#4CAF50] text-white px-6 py-3 rounded-xl hover:bg-[#3d8b40] transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari
                    </button>
                </form>
            </div>

            <!-- FORM INPUT SURAT IZIN -->
            <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                        <svg class="w-5 h-5 text-[#4CAF50] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Form Input Surat Izin
                    </h3>
                    <button type="button" id="btnTambahManual" 
                        class="bg-[#2196F3] text-white px-4 py-2 rounded-xl hover:bg-[#0b7dda] transition-all duration-200 flex items-center shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Manual
                    </button>
                </div>

                <form id="formSuratIzin" action="<?= base_url('/piket/simpanIzin') ?>" method="post" class="space-y-5">
                    <?= csrf_field() ?>

                    <?php if (!empty($siswaList) && count($siswaList) > 1): ?>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Siswa</label>
                            <div class="relative">
                                <select onchange="location.href='<?= base_url('piket/surat_izin?keyword=' . urlencode($keyword)) ?>&nis=' + this.value"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white appearance-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent focus:outline-none transition-all duration-200 pr-10">
                                    <option value="">-- Pilih salah satu --</option>
                                    <?php foreach ($siswaList as $s): ?>
                                        <option value="<?= $s['nis'] ?>" <?= ($siswa['nis'] ?? '') === $s['nis'] ? 'selected' : '' ?>>
                                            <?= esc($s['nama']) ?> (<?= esc($s['nis']) ?> - <?= esc($s['kelas']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                            <input type="text" name="nama" value="<?= esc($siswa['nama'] ?? '') ?>" readonly
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none transition-all duration-200" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                            <input type="text" name="nis" value="<?= esc($siswa['nis'] ?? '') ?>" <?= isset($siswa) ? 'readonly' : '' ?>
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none transition-all duration-200" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                            <input type="text" name="kelas" value="<?= esc($siswa['kelas'] ?? '') ?>" readonly
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50 focus:outline-none transition-all duration-200" />
                        </div>
                        
                    </div>

                    <div>
                        <label for="alasan" class="block text-sm font-medium text-gray-700 mb-2">Alasan Izin</label>
                        <textarea name="alasan" id="alasan" rows="3" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent focus:outline-none transition-all duration-200" placeholder="Masukkan alasan izin"><?= old('alasan') ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="waktu_keluar" class="block text-sm font-medium text-gray-700 mb-2">Jam Keluar</label>
                            <div class="relative">
                                <input type="time" name="waktu_keluar" id="waktu_keluar" required
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent focus:outline-none transition-all duration-200" />
                            </div>
                        </div>
                        <div>
                            <label for="waktu_kembali" class="block text-sm font-medium text-gray-700 mb-2">Jam Kembali</label>
                            <div class="relative">
                                <input type="time" name="waktu_kembali" id="waktu_kembali" required
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent focus:outline-none transition-all duration-200" />
                            </div>
                        </div>
                    </div>

                    <div class="text-right pt-4">
                        <button type="submit"
                            class="bg-[#4CAF50] text-white px-8 py-3 rounded-xl hover:bg-[#3d8b40] transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-lg inline-flex">
                            <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                            Kirim Izin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div id="modalPreview" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50 modal-animation p-4">
    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl p-6 relative modal-content-animation">
        <button type="button" id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition-colors duration-200 bg-gray-100 hover:bg-gray-200 rounded-full p-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 text-[#4CAF50] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Preview Surat Izin
        </h3>

        <div id="previewContent" class="space-y-3 text-gray-800 text-sm bg-gray-50 p-4 rounded-lg"></div>

        <div class="mt-6 flex justify-end gap-3">
            <button id="printPreview" class="px-5 py-2.5 bg-[#2196F3] text-white rounded-xl hover:bg-[#0b7dda] transition-colors duration-200 flex items-center shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z"></path>
                </svg>
                Print
            </button>
            <button type="button" id="confirmSubmit" class="px-5 py-2.5 bg-[#4CAF50] text-white rounded-xl hover:bg-[#3d8b40] transition-colors duration-200 flex items-center shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Konfirmasi
            </button>
        </div>
    </div>
</div>

<!-- Modal Tambah Manual -->
<div id="modalManual" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50 modal-animation p-4">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-6 relative modal-content-animation">
        <button type="button" id="closeManual" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition-colors duration-200 bg-gray-100 hover:bg-gray-200 rounded-full p-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h2 class="text-xl font-bold text-gray-800 mb-5 flex items-center">
            <svg class="w-6 h-6 text-[#2196F3] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Surat Manual
        </h2>

        <form id="formManual" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" name="nama" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#2196F3] focus:border-transparent focus:outline-none transition-all duration-200" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                <input type="text" name="nis" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#2196F3] focus:border-transparent focus:outline-none transition-all duration-200" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                <input type="text" name="kelas" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#2196F3] focus:border-transparent focus:outline-none transition-all duration-200" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan</label>
                <textarea name="alasan" rows="2" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#2196F3] focus:border-transparent focus:outline-none transition-all duration-200" required></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Keluar</label>
                    <input type="time" name="waktu_keluar" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#2196F3] focus:border-transparent focus:outline-none transition-all duration-200" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Kembali</label>
                    <input type="time" name="waktu_kembali" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#2196F3] focus:border-transparent focus:outline-none transition-all duration-200" required>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <!-- Tombol Print -->
                <button type="button" id="printManual" 
                    class="px-5 py-2.5 bg-[#2196F3] text-white rounded-xl hover:bg-[#0b7dda] transition-colors duration-200 flex items-center shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z"/>
                    </svg>
                    Print
                </button>

                <!-- Tombol Simpan ke Database -->
                <button type="submit" id="saveManual"
                    class="px-5 py-2.5 bg-[#4CAF50] text-white rounded-xl hover:bg-[#3e8e41] transition-colors duration-200 flex items-center shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan ke Database
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    // --- Tambah Surat Manual ---
    const btnTambahManual = document.getElementById('btnTambahManual');
    const modalManual = document.getElementById('modalManual');
    const closeManual = document.getElementById('closeManual');
    const formManual = document.getElementById('formManual');
    const printManual = document.getElementById('printManual');

    btnTambahManual.addEventListener('click', () => {
        modalManual.classList.remove('hidden');
    });

    closeManual.addEventListener('click', () => {
        modalManual.classList.add('hidden');
        formManual.reset();
    });

    // Print dari modal manual
    printManual.addEventListener('click', () => {
        const formData = new FormData(formManual);

        const content = `
            <div style="font-size:9px; line-height:1.3;">
                <!-- Kop Surat -->
                <div style="display:flex; align-items:center; border-bottom:1px solid #000; padding-bottom:2px; margin-bottom:4px; ">
                    <img src="<?= base_url('assets/img/logo-man1.png') ?>" style="width:28px; height:auto;">
                    <div style="flex:1; margin-left:8px;">
                        <div style="font-size:11px; font-weight:bold; margin-left:4px">KEMENTERIAN AGAMA</div>
                        <div style="font-size:10px; font-weight:600;">MAN 1 KOTA TASIKMALAYA</div>
                        <div style="font-size:7px; margin-left:8px;">Jl. Kh. Busthomi, Awipari Cibeuruem</div>
                    </div>
                </div>

                <div style="margin-left:42px; font-weight:bold; text-decoration:underline; font-size:10px; ">
                    SURAT IZIN KELUAR
                </div>

                <p style="margin:3px 0; font-size:10px">
                    Yang bertanda tangan di bawah ini menerangkan bahwa:
                </p> <br>

                <table style="font-size:10px; width:100%; border-collapse:collapse;">
                    <tr><td style="width:28%;">Nama</td><td>: ${formData.get('nama')}</td></tr>
                    <tr><td>NISN</td><td>: ${formData.get('nisn') || formData.get('nis')}</td></tr>
                    <tr><td>Kelas</td><td>: ${formData.get('kelas')}</td></tr>
                    <tr><td>Alasan</td><td>: ${formData.get('alasan')}</td></tr>
                    <tr><td>Jam Keluar</td><td>: ${formData.get('waktu_keluar')}</td></tr>
                    <tr><td>Jam Kembali</td><td>: ${formData.get('waktu_kembali')}</td></tr>
                    <tr><td>Tanggal</td><td>: <?= date('d M Y') ?></td></tr>
                </table><br>

                <p style="margin:4px 0; font-size:11px">
                    Diijinkan untuk keluar kelas<br> pada jam ${formData.get('waktu_keluar')} s.d ${formData.get('waktu_kembali')}<br>
                    karena alasan tersebut di atas.<br><br>
                    Demikian surat ini dibuat agar dapat dipergunakan sebagaimana mestinya.
                </p>

                <div style="display:flex; margin-top:18px; font-size:9px; margin-left:-10px">
                    <div style="text-align:center; width:45%;">
                        <p style="margin-bottom:28px;">Petugas Piket</p>
                        <span>( ......................... )</span>
                    </div>
                    <div style="text-align:center; width:45%;">
                        <p style="margin-bottom:28px;">Bagian Kesiswaan</p>
                        <span>( ......................... )</span>
                    </div>
                </div>
            </div>
        `;

        const w = window.open('', '_blank', 'width=500,height=800');
        w.document.write(`
            <html>
            <head>
                <title>Print Surat Izin</title>
                <style>
                    @media print {
                        @page { size: 8cm 12cm; margin: 0; }
                        body { margin:0; padding:8px; font-family: Arial, sans-serif; }
                        table td { vertical-align: top; }
                    }
                </style>
            </head>
            <body>${content}</body>
            </html>
        `);
        w.document.close();
        w.focus();
        setTimeout(() => { w.print(); w.close(); }, 500);
    });

    // Simpan manual ke DB
    formManual.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(formManual);

        // Pastikan nisn tetap terkirim (fallback ke nis kalau nisn kosong)
        if (!formData.get('nisn') && formData.get('nis')) {
            formData.append('nisn', formData.get('nis'));
        }

        fetch('/surat-izin/store', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                modalManual.classList.add('hidden');
                formManual.reset();
                window.location.href = '/piket/surat_izin_rekapan';
            } else {
                alert(data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Gagal menyimpan surat izin manual!');
        });
    });

    // --- Form otomatis ---
    const form = document.getElementById('formSuratIzin');
    const modal = document.getElementById('modalPreview');
    const closeModal = document.getElementById('closeModal');
    const previewContent = document.getElementById('previewContent');
    const confirmSubmit = document.getElementById('confirmSubmit');
    const printBtn = document.getElementById('printPreview');

    // Tutup modal
    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
        previewContent.innerHTML = '';
    });

    // Kirim ke backend
    confirmSubmit.addEventListener('click', () => {
        const formData = new FormData(form);

        // fallback nis → nisn
        if (!formData.get('nisn') && formData.get('nis')) {
            formData.append('nisn', formData.get('nis'));
        }

        fetch('/surat-izin/store', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = '/piket/surat_izin_rekapan';
            } else {
                alert(data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat mengirim data!');
        });
    });

    // Preview sebelum simpan
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);

        if (!formData.get('nama') || (!formData.get('nisn') && !formData.get('nis')) || !formData.get('alasan') || 
            !formData.get('waktu_keluar') || !formData.get('waktu_kembali')) {
            alert('Harap lengkapi semua field yang diperlukan!');
            return;
        }

        previewContent.innerHTML = `
            <h2 class="text-lg font-bold text-center mb-2">Preview Surat</h2>
            <p><b>Nama:</b> ${formData.get('nama')}</p>
            <p><b>NISN:</b> ${formData.get('nisn') || formData.get('nis')}</p>
            <p><b>Kelas:</b> ${formData.get('kelas')}</p>
            <p><b>Alasan:</b> ${formData.get('alasan')}</p>
            <p><b>Jam Keluar:</b> ${formData.get('waktu_keluar')}</p>
            <p><b>Jam Kembali:</b> ${formData.get('waktu_kembali')}</p>
        `;
        modal.classList.remove('hidden');
    });

    // Print versi rapi
    printBtn.addEventListener('click', () => {
        const formData = new FormData(form);

        const content = `
            <div style="font-size:9px; line-height:1.3;">
                <!-- Kop Surat -->
                <div style="display:flex; align-items:center; border-bottom:1px solid #000; padding-bottom:2px; margin-bottom:4px; ">
                    <img src="<?= base_url('assets/img/logo-man1.png') ?>" style="width:28px; height:auto;">
                    <div style="flex:1; margin-left:8px;">
                        <div style="font-size:11px; font-weight:bold; margin-left:4px">KEMENTERIAN AGAMA</div>
                        <div style="font-size:10px; font-weight:600;">MAN 1 KOTA TASIKMALAYA</div>
                        <div style="font-size:7px; margin-left:8px;">Jl. Kh. Busthomi, Awipari Cibeuruem</div>
                    </div>
                </div>

                <div style="margin-left:42px; font-weight:bold; text-decoration:underline; font-size:10px;">
                    SURAT IZIN KELUAR
                </div>

                <p style="margin:3px 0; font-size:10px">
                    Yang bertanda tangan di bawah ini menerangkan bahwa:
                </p> 

                <table style="font-size:10px; width:100%; border-collapse:collapse;">
                    <tr><td style="width:28%;">Nama</td><td>: ${formData.get('nama')}</td></tr>
                    <tr><td>NISN</td><td>: ${formData.get('nisn') || formData.get('nis')}</td></tr>
                    <tr><td>Kelas</td><td>: ${formData.get('kelas')}</td></tr>
                    <tr><td>Alasan</td><td>: ${formData.get('alasan')}</td></tr>
                    <tr><td>Jam Keluar</td><td>: ${formData.get('waktu_keluar')}</td></tr>
                    <tr><td>Jam Kembali</td><td>: ${formData.get('waktu_kembali')}</td></tr>
                    <tr><td>Tanggal</td><td>: <?= date('d M Y') ?></td></tr>
                </table><br>

                <p style="margin:4px 0; font-size:11px">
                    Diijinkan untuk keluar kelas pada jam ${formData.get('waktu_keluar')} s.d ${formData.get('waktu_kembali')}
                    karena alasan tersebut di atas.<br><br>
                    Demikian surat ini dibuat agar dapat dipergunakan sebagaimana mestinya.
                </p>

                <div style="display:flex; margin-top:18px; font-size:9px; margin-left:-10px">
                    <div style="text-align:center; width:45%;">
                        <p style="margin-bottom:28px;">Petugas Piket</p>
                        <span>( ......................... )</span>
                    </div>
                    <div style="text-align:center; width:45%;">
                        <p style="margin-bottom:28px;">Bagian Kesiswaan</p>
                        <span>( ......................... )</span>
                    </div>
                </div>
            </div>
        `;

        const w = window.open('', '_blank', 'width=500,height=800');
        w.document.write(`
            <html>
            <head>
                <title>Print Surat Izin</title>
                <style>
                    @media print {
                        @page { size: 8cm 12cm; margin: 0; }
                        body { margin:0; padding:0; }
                    }
                </style>
            </head>
            <body>${content}</body>
            </html>
        `);
        w.document.close();
        w.focus();
        setTimeout(() => { w.print(); w.close(); }, 500);
    });
</script>



<?= $this->endSection() ?>
