<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div id="modalSuccess" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-sm">
            <h3 class="text-xl font-bold text-green-600 mb-2">Berhasil!</h3>
            <p class="text-gray-700"><?= session()->getFlashdata('success') ?></p>
            <button onclick="document.getElementById('modalSuccess').style.display='none'"
                class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tutup</button>
        </div>
    </div>
<?php endif; ?>

<style>
    @media print {
        @page { size: 8.2cm auto; margin: 0; }  /* tambahin dikit jadi 8.2 cm */
        body {
            margin: 0;
            padding: 0;
        }
        .print-area {
            width: 7.8cm;  /* kasih space kanan biar ga kepotong */
            margin: 0 auto;
            font-family: 'Times New Roman', serif;
            font-size: 11px;
            padding: 4px 6px; /* kanan kiri ada buffer */
            box-sizing: border-box;
        }
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; padding: 1px 0; }
    }
</style>




<div class="print-area">
    <div class="mt-12 p-6">
    <div class="bg-white p-6 rounded-xl shadow-md max-w-3xl mx-auto border-t-4 border-[#A4DE02]">
        <h2 class="text-2xl font-bold text-[#1E5631] mb-4">Pencarian Siswa</h2>

        <!-- PENCARIAN SISWA -->
        <form method="get" action="<?= base_url('piket/surat_izin') ?>" class="mb-6 flex gap-2">
            <input type="text" name="keyword" value="<?= esc($keyword ?? '') ?>" placeholder="Cari berdasarkan NISN atau Nama..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#A4DE02] focus:outline-none" />
            <button type="submit"
                class="bg-[#1E5631] text-white px-4 py-2 rounded-lg hover:bg-[#145128] transition">Cari</button>
        </form>

        <h2 class="text-2xl font-bold text-[#1E5631] mb-4">Form Input Surat Izin</h2>

        <!-- FORM INPUT SURAT IZIN -->
        <form id="formSuratIzin" action="<?= base_url('/piket/simpanIzin') ?>" method="post" class="space-y-4">
            <?= csrf_field() ?>

            <?php if (!empty($siswaList) && count($siswaList) > 1): ?>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Pilih Siswa</label>
                    <select onchange="location.href='<?= base_url('piket/surat_izin?keyword=' . urlencode($keyword)) ?>&nisn=' + this.value"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white">
                        <option value="">-- Pilih salah satu --</option>
                        <?php foreach ($siswaList as $s): ?>
                            <option value="<?= $s['nisn'] ?>" <?= ($siswa['nisn'] ?? '') === $s['nisn'] ? 'selected' : '' ?>>
                                <?= esc($s['nama']) ?> (<?= esc($s['nisn']) ?> - <?= esc($s['kelas']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama</label>
                    <input type="text" name="nama" value="<?= esc($siswa['nama'] ?? '') ?>" readonly
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">NISN</label>
                    <input type="text" name="nisn" value="<?= esc($siswa['nisn'] ?? '') ?>" <?= isset($siswa) ? 'readonly' : '' ?>
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Kelas</label>
                <input type="text" name="kelas" value="<?= esc($siswa['kelas'] ?? '') ?>" readonly
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Poin Pelanggaran</label>
                <input type="text" name="poin" value="<?= esc($siswa['poin'] ?? '') ?>" readonly
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100" />
            </div>

            <div>
                <label for="alasan" class="block text-sm font-semibold text-gray-600 mb-1">Alasan Izin</label>
                <textarea name="alasan" id="alasan" rows="3" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#A4DE02] focus:outline-none"><?= old('alasan') ?></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="waktu_keluar" class="block text-sm font-semibold text-gray-600 mb-1">Jam Keluar</label>
                    <input type="time" name="waktu_keluar" id="waktu_keluar" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#A4DE02] focus:outline-none" />
                </div>
                <div>
                    <label for="waktu_kembali" class="block text-sm font-semibold text-gray-600 mb-1">Jam Kembali</label>
                    <input type="time" name="waktu_kembali" id="waktu_kembali" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#A4DE02] focus:outline-none" />
                </div>
            </div>

            <div class="text-right">
                <button type="submit"
                    class="bg-[#1E5631] text-white px-6 py-2 rounded-lg hover:bg-[#145128] transition">Kirim Izin</button>
            </div>
        </form>

        <!-- Modal Preview -->
        <div id="modalPreview" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white w-full max-w-2xl rounded-xl shadow-lg p-6 relative">
                <button type="button" id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">✕</button>

                <div id="previewContent" class="space-y-3 text-gray-800 text-sm"></div>

                <div class="mt-4 flex justify-end gap-2">
                    <button id="printPreview" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Print</button>
                    <button type="button" id="confirmSubmit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Kirim ke Backend</button>
                </div>
            </div>
        </div>

        <script>
                const form = document.getElementById('formSuratIzin');
                const modal = document.getElementById('modalPreview');
                const closeModal = document.getElementById('closeModal');
                const previewContent = document.getElementById('previewContent');
                const confirmSubmit = document.getElementById('confirmSubmit');
                const printBtn = document.getElementById('printPreview');

                // Tutup modal
                closeModal.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });

                // Kirim ke backend
                confirmSubmit.addEventListener('click', () => {
                    const formData = new FormData(form);

                    fetch('/surat-izin/store', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                             window.location.href = '/piket/konfirmasi_kembali';
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Terjadi kesalahan saat mengirim data!');
                    });
                });


            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(form);

                if (!formData.get('nama') || !formData.get('nisn') || !formData.get('alasan') || 
                    !formData.get('waktu_keluar') || !formData.get('waktu_kembali')) {
                    alert('Harap lengkapi semua field yang diperlukan!');
                    return;
                }

                previewContent.innerHTML = `
                    <h2 class="text-lg font-bold text-center mb-2">Preview Surat</h2>
                    <p><b>Nama:</b> ${formData.get('nama')}</p>
                    <p><b>NISN:</b> ${formData.get('nisn')}</p>
                    <p><b>Kelas:</b> ${formData.get('kelas')}</p>
                    <p><b>Alasan:</b> ${formData.get('alasan')}</p>
                    <p><b>Jam Keluar:</b> ${formData.get('waktu_keluar')}</p>
                    <p><b>Jam Kembali:</b> ${formData.get('waktu_kembali')}</p>
                `;
                modal.classList.remove('hidden');
            });

            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
                previewContent.innerHTML = '';
            });

            // Print versi rapi
            printBtn.addEventListener('click', () => {
                const formData = new FormData(form);

                const content = `
                    <div class="print-area" style="font-size:9px; line-height:1.3;">
                       <!-- Kop Surat -->
                <div style="display:flex; align-items:center; border-bottom:1px solid #000; padding-bottom:2px; margin-bottom:4px;">
                    <img src="<?= base_url('assets/img/logo-man1.png') ?>" 
                        alt="Logo" 
                        style="width:28px; height:auto; margin-right:4px; margin-left:2px;">
                    <div style="flex:1; text-align:center; white-space:normal; word-wrap:break-word;">
                        <div style="font-size:9.5px; font-weight:bold; line-height:1;">KEMENTERIAN AGAMA</div>
                        <div style="font-size:8.5px; font-weight:600; line-height:1.2;">MAN 1 KOTA TASIKMALAYA</div>
                        <div style="font-size:6px; line-height:1.1;">Jl. Letnan Harun No. 30, Kota Tasikmalaya, Jawa Barat 46115</div>
                        <div style="font-size:6px; line-height:1.1;">Telp: (0265) 331336 – Email: man1kotatasik@gmail.com</div>
                    </div>
                </div>


                        <div style="text-align:center; font-weight:bold; text-decoration:underline; margin:4px 0; font-size:11px;">
                            SURAT IZIN KELUAR
                        </div>

                        <p style="margin:3px 0;">Yang bertanda tangan di bawah ini menerangkan <br> bahwa:</p>
                        <table style="font-size:9px;">
                            <tr><td style="width:28%;">Nama</td><td>: ${formData.get('nama')}</td></tr>
                            <tr><td>NISN</td><td>: ${formData.get('nisn')}</td></tr>
                            <tr><td>Kelas</td><td>: ${formData.get('kelas')}</td></tr>
                            <tr><td>Alasan</td><td>: ${formData.get('alasan')}</td></tr>
                            <tr><td>Jam Keluar</td><td>: ${formData.get('waktu_keluar')}</td></tr>
                            <tr><td>Jam Kembali</td><td>: ${formData.get('waktu_kembali')}</td></tr>
                            <tr><td>Tanggal</td><td>: <?= date('d M Y') ?></td></tr>
                        </table>

                        <p style="margin:4px 0; text-align:justify; font-size:9px;">
                            Diberikan izin keluar dari madrasah karena <br>alasan tersebut di atas.<br>
                            Demikian surat ini dibuat agar dapat <br> dipergunakan sebagaimana mestinya.
                        </p>

                        <div style="display:flex; justify-content:space-between; margin-top:12px;">
                            <div style="text-align:center; width:45%; font-size:9px;">
                                <p style="margin-bottom:28px;">Petugas Piket</p>
                                <span>( ......................... )</span>
                            </div>
                            <div style="text-align:center; width:45%; font-size:9px;">
                                <p>Tasikmalaya, <?= date('d M Y') ?></p>
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

    </div>
</div>
</div>


<?= $this->endSection() ?>
