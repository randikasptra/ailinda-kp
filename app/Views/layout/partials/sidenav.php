<!-- Modern Header -->
<header class="fixed top-0 left-64 right-0 h-16 bg-white/95 backdrop-blur-lg z-40 flex items-center px-6 border-b border-gray-200/20 shadow-sm">
    <div class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-2">
            <h1 class="text-xl font-semibold text-gray-800">Welcome back,</h1>
            <span class="text-xl font-bold bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] bg-clip-text text-transparent">
                <?= session()->get('username') ?>
            </span>
        </div>
        
       
    </div>
</header>

<!-- Sidebar -->
<aside class="w-64 h-screen fixed top-0 left-0 bg-gradient-to-b from-[#1E5631] to-[#0C3A1D] text-white flex flex-col shadow-xl z-50">
    <!-- Brand Header -->
    <div class="p-5 pb-4 border-b border-green-700/30">
        <div class="text-2xl font-bold tracking-tight">
            <span class="bg-gradient-to-r from-[#A4DE02] to-[#DDFF73] bg-clip-text text-transparent">MAN 1</span>
            <div class="text-sm font-medium text-gray-300 mt-1">Administration Dashboard</div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <?php if (session()->get('role') == 'piket'): ?>
            <a href="/dashboard/piket" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145128]/80 transition group">
                <div class="p-1.5 rounded-lg bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="home" class="w-4 h-4 text-[#A4DE02]"></i>
                </div>
                <span>Dashboard Piket</span>
            </a>
            <a href="/piket/surat_izin" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145128]/80 transition group">
                <div class="p-1.5 rounded-lg bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="file-plus" class="w-4 h-4 text-[#A4DE02]"></i>
                </div>
                <span>Input Surat Izin</span>
            </a>
            <!-- <a href="/piket/izin_masuk_form" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145128]/80 transition group">
                <div class="p-1.5 rounded-lg bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="file-plus" class="w-4 h-4 text-[#A4DE02]"></i>
                </div>
                <span>Input Surat Masuk</span>
            </a> -->
            <a href="/piket/konfirmasi_kembali" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145128]/80 transition group">
                <div class="p-1.5 rounded-lg bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="check-circle" class="w-4 h-4 text-[#A4DE02]"></i>
                </div>
                <span>Konfirmasi Kembali</span>
            </a>
            <a href="/piket/history_konfirmasi" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145128]/80 transition group">
                <div class="p-1.5 rounded-lg bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="history" class="w-4 h-4 text-[#A4DE02]"></i>
                </div>
                <span>Riwayat Konfirmasi</span>
            </a>
            <a href="/piket/data_siswa" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145128]/80 transition group">
                <div class="p-1.5 rounded-lg bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="users" class="w-4 h-4 text-[#A4DE02]"></i>
                </div>
                <span>Data Siswa</span>
            </a>
        <?php else: ?>
            <a href="bp" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145128]/80 transition group">
                <div class="p-1.5 rounded-lg bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="home" class="w-4 h-4 text-[#A4DE02]"></i>
                </div>
                <span>Dashboard BP</span>
            </a>
            <a href="rekap_poin" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145128]/80 transition group">
                <div class="p-1.5 rounded-lg bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="bar-chart" class="w-4 h-4 text-[#A4DE02]"></i>
                </div>
                <span>Rekap Pelanggaran</span>
            </a>
        <?php endif; ?>
    </nav>

    <!-- Logout -->
    <div class="px-3 py-4 border-t border-green-700/30">
        <a href="/logout" class="flex items-center gap-3 p-3 rounded-xl hover:bg-red-600/90 transition group">
            <div class="p-1.5 rounded-lg bg-red-500/10 group-hover:bg-red-500/20">
                <i data-lucide="log-out" class="w-4 h-4 text-red-300 group-hover:text-white"></i>
            </div>
            <span class="text-red-300 group-hover:text-white">Logout</span>
        </a>
    </div>
</aside>

<!-- Main Content Area -->
<main class=" pt-16 min-h-screen bg-gray-50/50">
    <!-- Your page content goes here -->
</main>