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

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                let html = `
                    <div class="print-area">
                        <h2 class="text-lg font-bold mb-2 text-center">SURAT IZIN KELUAR</h2>
                        <p><b>Nama:</b> ${formData.get('nama')}</p>
                        <p><b>NISN:</b> ${formData.get('nisn')}</p>
                        <p><b>Kelas:</b> ${formData.get('kelas')}</p>
                        <p><b>Poin Pelanggaran:</b> ${formData.get('poin')}</p>
                        <p><b>Alasan:</b> ${formData.get('alasan')}</p>
                        <p><b>Jam Keluar:</b> ${formData.get('waktu_keluar')}</p>
                        <p><b>Jam Kembali:</b> ${formData.get('waktu_kembali')}</p>
                    </div>
                `;
                previewContent.innerHTML = html;
                modal.classList.remove('hidden');
            });

            closeModal.addEventListener('click', () => modal.classList.add('hidden'));

            confirmSubmit.addEventListener('click', () => {
                // programmatic submit: akan submit ke action="<?= base_url('/piket/simpanIzin') ?>"
                form.submit();
            });

            printBtn.addEventListener('click', () => {
                // print hanya konten preview: buka popup baru dan print
                const content = previewContent.innerHTML;
                const w = window.open('', '_blank', 'width=600,height=800');
                w.document.write('<html><head><title>Print Surat Izin</title>');
                w.document.write('<style>@media print {@page { size: 10cm 15cm; margin: 0.5cm; }} body{font-family: serif; font-size:12px;}</style>');
                w.document.write('</head><body>');
                w.document.write(content);
                w.document.write('</body></html>');
                w.document.close();
                w.focus();
                setTimeout(() => { w.print(); w.close(); }, 300);
            });
        </script>
    </div>
</div>

<?= $this->endSection() ?>
