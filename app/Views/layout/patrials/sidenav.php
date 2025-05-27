<aside class="w-64 bg-[#1E5631] text-white flex flex-col shadow-lg z-10">
    <div class="p-6 text-2xl font-bold border-b border-green-700">
        <span class="text-[#A4DE02]">MAN 1</span> <br> Dashboard
    </div>
    <nav class="flex-1 p-4 space-y-2 text-sm">
        <?php if (session()->get('role') == 'piket'): ?>
            <a href="/dashboard/piket" class="block p-2 rounded-lg hover:bg-[#145128]">🏠 Dashboard Piket</a>
            <a href="/piket/surat-izin" class="block p-2 rounded-lg hover:bg-[#145128]">📝 Input Surat Izin</a>
            <a href="/piket/konfirmasi-kembali" class="block p-2 rounded-lg hover:bg-[#145128]">🔄 Konfirmasi Kembali</a>
            <a href="/piket/catat-pelanggaran" class="block p-2 rounded-lg hover:bg-[#145128]">⚠️ Catat Pelanggaran</a>
        <?php else: ?>
            <a href="/dashboard/bp" class="block p-2 rounded-lg hover:bg-[#145128]">🏠 Dashboard BP</a>
            <a href="/bp/rekap" class="block p-2 rounded-lg hover:bg-[#145128]">📊 Rekap Pelanggaran</a>
        <?php endif; ?>
        <a href="/logout" class="block p-2 mt-4 text-red-300 hover:text-white hover:bg-red-600 rounded-lg">🚪 Logout</a>
    </nav>
</aside>