<aside class="w-64 bg-[#1E5631] text-white flex flex-col shadow-lg z-10 relative">
    <div class="p-6 text-2xl font-bold border-b border-green-700">
        <span class="text-[#A4DE02]">MAN 1</span> <br> Dashboard
    </div>
    <nav class="flex-1 p-4 space-y-2 text-sm">
        <?php if (session()->get('role') == 'piket'): ?>
            <a href="/dashboard/piket" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="home" class="w-4 h-4"></i> Dashboard Piket
            </a>
            <a href="/piket/surat_izin" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="file-plus" class="w-4 h-4"></i> Input Surat Izin
            </a>
            <a href="/piket/konfirmasi-kembali" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="check-circle" class="w-4 h-4"></i> Konfirmasi Kembali
            </a>
            <a href="/piket/catat-pelanggaran" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="alert-triangle" class="w-4 h-4"></i> Catat Pelanggaran
            </a>
        <?php else: ?>
            <a href="/dashboard/bp" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="home" class="w-4 h-4"></i> Dashboard BP
            </a>
            <a href="/bp/rekap" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="bar-chart" class="w-4 h-4"></i> Rekap Pelanggaran
            </a>
        <?php endif; ?>
    </nav>

    <!-- Logout di sudut bawah -->
    <div class="absolute bottom-0 w-full p-4">
        <a href="/logout" class="flex items-center gap-2 p-2 text-red-300 hover:text-white hover:bg-red-600 rounded-lg">
            <i data-lucide="log-out" class="w-4 h-4"></i> Logout
        </a>
    </div>
</aside>