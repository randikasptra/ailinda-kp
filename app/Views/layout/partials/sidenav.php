<!-- Modern Header -->
<header class="fixed top-0 left-64 right-0 h-20 bg-white/95 backdrop-blur-xl z-40 flex items-center px-8 border-b border-gray-200/10 shadow-lg">
    <div class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-3">
            <h1 class="text-2xl font-semibold text-gray-800">Selamat datang,</h1>
            <span class="text-2xl font-bold bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] bg-clip-text text-transparent">
                <?= session()->get('username') ?>
            </span>
        </div>
        
        <div class="flex items-center space-x-4">
            <div class="relative">
                <button id="profileDropdown" class="flex items-center space-x-2 focus:outline-none" aria-haspopup="true" aria-expanded="false">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] flex items-center justify-center text-white font-semibold">
                        <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                    </div>
                </button>
                <div id="profileMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 hidden z-50">
                    <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                    <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Sidebar -->
<aside class="w-64 h-screen fixed top-0 left-0 bg-gradient-to-b from-[#1E5631] to-[#0C3A1D] text-white flex flex-col shadow-2xl z-50">
    <!-- Brand Header -->
    <div class="p-6 pb-4 border-b border-green-700/20">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-[#A4DE02] to-[#DDFF73] flex items-center justify-center shadow-lg">
                <span class="text-[#1E5631] font-bold text-lg">M</span>
            </div>
            <div>
                <div class="text-xl font-bold tracking-tight">
                    <span class="bg-gradient-to-r from-[#A4DE02] to-[#DDFF73] bg-clip-text text-transparent">MAN 1</span>
                </div>
                <div class="text-xs font-medium text-gray-300 mt-1">Administration Dashboard</div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <?php if (session()->get('role') == 'piket'): ?>
            <a href="/dashboard/piket" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/dashboard/piket') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/dashboard/piket') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-home w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Dashboard Piket</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
            <a href="/piket/izin_masuk_form" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/piket/izin_masuk_form') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/piket/izin_masuk_form') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-envelope-open-text w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Input Surat Izin Masuk</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
            <a href="/piket/surat_izin" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/piket/surat_izin') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/piket/surat_izin') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-file-signature w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Input Surat Izin Keluar</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
            <a href="/piket/konfirmasi_kembali" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/piket/konfirmasi_kembali') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/piket/konfirmasi_kembali') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-check-circle w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Konfirmasi Kembali</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
            <a href="/piket/history_konfirmasi" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/piket/history_konfirmasi') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/piket/history_konfirmasi') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-history w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Riwayat Konfirmasi</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
            <a href="/piket/data_siswa" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/piket/data_siswa') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/piket/data_siswa') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-users w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Data Siswa</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
        <?php else: ?>
            <a href="/bp" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/bp') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/bp') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-home w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Dashboard BP</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
            <a href="/rekap_poin" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/rekap_poin') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/rekap_poin') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-chart-bar w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Rekap Pelanggaran</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
        <?php endif; ?>
    </nav>

    <!-- Logout -->
    <div class="px-4 py-6 border-t border-green-700/20">
        <a href="/logout" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-red-600/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5" aria-label="Logout">
            <div class="p-2 rounded-xl bg-red-500/10 group-hover:bg-red-500/20 shadow-sm">
                <i class="fas fa-sign-out-alt w-5 h-5 text-red-300 group-hover:text-white"></i>
            </div>
            <span class="font-medium text-red-300 group-hover:text-white">Logout</span>
            <i class="fas fa-chevron-right ml-auto text-xs text-red-300 group-hover:text-white transition-transform duration-300 group-hover:translate-x-1"></i>
        </a>
    </div>
</aside>

<!-- Main Content Area -->
<main class="pt-20 min-h-screen bg-gradient-to-br from-gray-50/50 to-gray-100/50 pl-64">
    <!-- Your page content goes here -->
</main>

<!-- Include Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
    // Toggle dropdown menu
    document.getElementById('profileDropdown').addEventListener('click', function () {
        const menu = document.getElementById('profileMenu');
        menu.classList.toggle('hidden');
        this.setAttribute('aria-expanded', menu.classList.contains('hidden') ? 'false' : 'true');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('profileMenu');
        const button = document.getElementById('profileDropdown');
        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
            dropdown.classList.add('hidden');
            button.setAttribute('aria-expanded', 'false');
        }
    });
</script>

<style>
    /* Custom styles for modern appearance */
    body {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background-color: #f8fafc;
    }
    
    /* Smooth transitions for all elements */
    * {
        transition: all 0.3s ease;
    }
    
    /* Sidebar scrollbar styling */
    aside::-webkit-scrollbar {
        width: 6px;
    }
    
    aside::-webkit-scrollbar-thumb {
        background: #A4DE02;
        border-radius: 10px;
    }
    
    aside::-webkit-scrollbar-track {
        background: #0C3A1D;
    }
    
    /* Active menu item styling */
    nav a[aria-current="page"] {
        background-color: #145128;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        aside {
            width: 60px;
        }
        aside .font-medium {
            display: none;
        }
        aside .fa-chevron-right {
            display: none;
        }
        header {
            left: 60px;
        }
        main {
            padding-left: 60px;
        }
    }
</style>