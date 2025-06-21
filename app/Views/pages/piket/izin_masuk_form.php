<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-4 text-[#1E5631] flex items-center gap-2">
        <i data-lucide="log-in" class="w-6 h-6"></i>
        Form Surat Izin Masuk
    </h1>
    <form action="<?= base_url('/piket/izin-masuk/submit') ?>" method="POST" class="space-y-4">
        <!-- Pilih Nama Siswa -->
        <div>
            <label class="block mb-1 font-medium">Nama Siswa</label>
            <select name="nama" id="nama" class="w-full border px-3 py-2 rounded" required onchange="isiDataSiswa()">
                <option value="">-- Pilih Siswa --</option>
                <?php foreach ($siswa as $s): ?>
                    <option value="<?= esc($s['nama']) ?>" 
                        data-nisn="<?= esc($s['nisn']) ?>"
                        data-kelas="<?= esc($s['kelas']) ?>"
                        data-jurusan="<?= esc($s['jurusan']) ?>"
                        data-tahun="<?= esc($s['tahun_ajaran']) ?>"
                        data-poin="<?= esc($s['poin']) ?>">
                        <?= esc($s['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- NISN -->
        <input type="hidden" name="nisn" id="nisn">
        <input type="hidden" name="kelas" id="kelas">
        <input type="hidden" name="jurusan" id="jurusan">
        <input type="hidden" name="tahun_ajaran" id="tahun_ajaran">
        <input type="hidden" name="poin_awal" id="poin_awal">

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">NISN</label>
                <input type="text" id="nisn_show" class="w-full border px-3 py-2 rounded bg-gray-100" disabled>
            </div>
            <div>
                <label class="block mb-1 font-medium">Kelas</label>
                <input type="text" id="kelas_show" class="w-full border px-3 py-2 rounded bg-gray-100" disabled>
            </div>
            <div>
                <label class="block mb-1 font-medium">Jurusan</label>
                <input type="text" id="jurusan_show" class="w-full border px-3 py-2 rounded bg-gray-100" disabled>
            </div>
            <div>
                <label class="block mb-1 font-medium">Tahun Ajaran</label>
                <input type="text" id="tahun_ajaran_show" class="w-full border px-3 py-2 rounded bg-gray-100" disabled>
            </div>
        </div>

        <!-- Alasan Terlambat -->
        <div>
            <label class="block mb-1 font-medium">Alasan Terlambat</label>
            <textarea name="alasan" rows="2" class="w-full border px-3 py-2 rounded" required></textarea>
        </div>

        <!-- Tindak Lanjut -->
        <div>
            <label class="block mb-1 font-medium">Tindak Lanjut</label>
            <textarea name="tindak_lanjut" rows="2" class="w-full border px-3 py-2 rounded"></textarea>
        </div>

        <!-- Dropdown Pelanggaran -->
        <div>
            <label class="block mb-1 font-medium">Pelanggaran</label>
            <select name="poin" id="poin" class="w-full border px-3 py-2 rounded" required onchange="updatePoinTotal()">
                <option value="">-- Pilih Pelanggaran --</option>
                <?php foreach ($pelanggaran as $p): ?>
                    <option value="<?= esc($p['poin']) ?>">
                        <?= esc($p['jenis_pelanggaran']) ?> (<?= esc($p['poin']) ?> poin)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Total Poin Akhir -->
        <div>
            <label class="block mb-1 font-medium">Total Poin Setelah Ditambah</label>
            <input type="text" id="poin_total" class="w-full border px-3 py-2 rounded bg-gray-100 font-semibold text-red-600" readonly>
        </div>

        <!-- Submit -->
        <div class="pt-4 text-right">
            <button type="submit" class="bg-[#1E5631] text-white px-5 py-2 rounded hover:bg-[#145128]">
                <i data-lucide="printer" class="inline w-4 h-4 mr-1"></i> Cetak & Tambah Poin
            </button>
        </div>
    </form>
</div>

<script>
    function isiDataSiswa() {
        const select = document.getElementById('nama');
        const selected = select.options[select.selectedIndex];

        const nisn = selected.getAttribute('data-nisn');
        const kelas = selected.getAttribute('data-kelas');
        const jurusan = selected.getAttribute('data-jurusan');
        const tahun = selected.getAttribute('data-tahun');
        const poin = parseInt(selected.getAttribute('data-poin')) || 0;

        document.getElementById('nisn').value = nisn;
        document.getElementById('kelas').value = kelas;
        document.getElementById('jurusan').value = jurusan;
        document.getElementById('tahun_ajaran').value = tahun;
        document.getElementById('poin_awal').value = poin;

        document.getElementById('nisn_show').value = nisn;
        document.getElementById('kelas_show').value = kelas;
        document.getElementById('jurusan_show').value = jurusan;
        document.getElementById('tahun_ajaran_show').value = tahun;

        updatePoinTotal();
    }

    function updatePoinTotal() {
        const poin_awal = parseInt(document.getElementById('poin_awal').value) || 0;
        const pelanggaran = parseInt(document.getElementById('poin').value) || 0;
        const total = poin_awal + pelanggaran;

        document.getElementById('poin_total').value = total + " poin";
    }
</script>

<?= $this->endSection() ?>