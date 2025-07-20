<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>


<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="ml-64 mt-12 p-6">
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
    <!-- <form action="<?= base_url('/piket/simpan_izin') ?>" method="post" class="space-y-4"> -->

    <form action="<?= base_url('/piket/surat_izin') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>

        <?php if (count($siswaList) > 1): ?>
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

</div>
</div>

<?= $this->endSection() ?>