<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="bg-white p-6 rounded-xl shadow-md max-w-2xl mx-auto border-t-4 border-[#A4DE02]">
    <h2 class="text-2xl font-bold text-[#1E5631] mb-4">Form Input Surat Izin</h2>

    <form action="/piket/surat-izin" method="post" class="space-y-4">
        <?= csrf_field() ?>

        <div>
            <label for="nama" class="block text-sm font-semibold text-gray-600 mb-1">Nama Siswa</label>
            <input type="text" name="nama" id="nama" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#A4DE02] focus:outline-none">
        </div>

        <div>
            <label for="kelas" class="block text-sm font-semibold text-gray-600 mb-1">Kelas</label>
            <input type="text" name="kelas" id="kelas" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#A4DE02] focus:outline-none">
        </div>

        <div>
            <label for="alasan" class="block text-sm font-semibold text-gray-600 mb-1">Alasan Izin</label>
            <textarea name="alasan" id="alasan" rows="3" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#A4DE02] focus:outline-none"></textarea>
        </div>

        <div>
            <label for="waktu_kembali" class="block text-sm font-semibold text-gray-600 mb-1">Waktu Kembali</label>
            <input type="time" name="waktu_kembali" id="waktu_kembali" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#A4DE02] focus:outline-none">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-[#1E5631] text-white px-6 py-2 rounded-lg hover:bg-[#145128] transition">Kirim Izin</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>