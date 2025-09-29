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
    <div class="p-6 pb-4 border-b border-green-700/40 flex flex-col items-center">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-r from-[#A4DE02] to-[#DDFF73] flex items-center justify-center shadow-xl mb-3">
            <img src="<?= base_url('assets/img/logo-man1.png') ?>" alt="Logo MAN 1" class="w-14 h-14 object-contain rounded-2xl transition-transform duration-300 hover:scale-105">
        </div>
        <div class="text-center">
            <div class="text-2xl font-extrabold tracking-tight">
                <span class="bg-gradient-to-r from-[#A4DE02] to-[#DDFF73] bg-clip-text text-transparent">MAN 1 Kota Tasikmalaya</span>
            </div>
            <div class="text-sm font-medium text-gray-200 mt-1.5">Guru Piket Dashboard</div>
        </div>
    </div>

    <!-- User Profile Mini -->
    <div class="px-4 py-3 border-b border-green-700/30">
        <div class="flex items-center gap-3 p-2 rounded-lg bg-white/5 backdrop-blur-sm">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#A4DE02] to-[#DDFF73] flex items-center justify-center text-white font-bold text-lg">
                <?= strtoupper(substr(session()->get('username') ?? 'A', 0, 1)) ?>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate"><?= session()->get('username') ?? 'Admin' ?></p>
                <p class="text-xs text-green-200 capitalize"><?= session()->get('role') ?? 'admin' ?></p>
                <p class="text-xs text-gray-300 truncate"><?= session()->get('email') ?? 'admin@example.com' ?></p>
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
            
            <!-- Dropdown untuk Input Surat -->
            <div class="dropdown <?= (current_url(true) == base_url('/piket/izin_masuk_form') || current_url(true) == base_url('/piket/surat_izin')) ? 'open' : '' ?>">
                <div class="dropdown-toggle flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= (current_url(true) == base_url('/piket/izin_masuk_form') || current_url(true) == base_url('/piket/surat_izin')) ? 'bg-[#145128] shadow-lg' : '' ?>">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                            <i class="fas fa-file-alt w-5 h-5 text-[#A4DE02]"></i>
                        </div>
                        <span class="font-medium">Input Surat</span>
                    </div>
                    <i class="fas fa-chevron-right dropdown-icon text-xs text-gray-400 group-hover:text-[#A4DE02]"></i>
                </div>
                <div class="dropdown-menu <?= (current_url(true) == base_url('/piket/izin_masuk_form') || current_url(true) == base_url('/piket/surat_izin')) ? 'open' : '' ?>">
                    <a href="/piket/izin_masuk_form" class="dropdown-item <?= current_url(true) == base_url('/piket/izin_masuk_form') ? 'active' : '' ?>">
                        <i class="fas fa-envelope-open-text dropdown-item-icon"></i>
                        <span>Surat Izin Masuk</span>
                    </a>
                    <a href="/piket/surat_izin" class="dropdown-item <?= current_url(true) == base_url('/piket/surat_izin') ? 'active' : '' ?>">
                        <i class="fas fa-file-signature dropdown-item-icon"></i>
                        <span>Surat Izin Keluar</span>
                    </a>
                </div>
            </div>
            
            <!-- <a href="/piket/konfirmasi_kembali" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/piket/konfirmasi_kembali') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/piket/konfirmasi_kembali') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-check-circle w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Konfirmasi Kembali</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a> -->
            <a href="/piket/konfirmasi_pelanggaran" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/admin/pelanggaran') ? 'bg-white/10 shadow-lg' : '' ?>">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i data-lucide="shield-alert" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Pelanggaran</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-[#A4DE02]"></i>
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
            <a href="/dashboard/bp" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/bp') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/bp') ? 'page' : 'false' ?>">
                <div class="p-2 rounded-xl bg-[#A4DE02]/10 group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-home w-5 h-5 text-[#A4DE02]"></i>
                </div>
                <span class="font-medium">Dashboard BP</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-[#A4DE02] transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
            <a href="/bp/rekap_poin" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-[#145128]/90 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/rekap_poin') ? 'bg-[#145128] shadow-lg' : '' ?>" aria-current="<?= current_url(true) == base_url('/rekap_poin') ? 'page' : 'false' ?>">
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

    // Dropdown functionality for sidebar
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const dropdown = this.closest('.dropdown');
            const menu = dropdown.querySelector('.dropdown-menu');
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown').forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('open');
                    d.querySelector('.dropdown-menu').classList.remove('open');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('open');
            menu.classList.toggle('open');
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown').forEach(dropdown => {
                dropdown.classList.remove('open');
                dropdown.querySelector('.dropdown-menu').classList.remove('open');
            });
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

    /* Dropdown styles */
    .dropdown {
        position: relative;
    }
    
    .dropdown-toggle {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
    }
    
    .dropdown-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        background-color: rgba(20, 81, 40, 0.5);
        border-radius: 0 0 12px 12px;
        margin-top: -8px;
        padding: 0 16px;
    }
    
    .dropdown-menu.open {
        max-height: 200px;
        padding: 8px 16px 16px;
    }
    
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 8px;
        color: #e2e8f0;
        text-decoration: none;
        margin-bottom: 4px;
        font-size: 14px;
    }
    
    .dropdown-item:hover {
        background-color: rgba(164, 222, 2, 0.1);
    }
    
    .dropdown-item.active {
        background-color: rgba(164, 222, 2, 0.2);
        color: #A4DE02;
    }
    
    .dropdown-icon {
        transition: transform 0.3s ease;
    }
    
    .dropdown.open .dropdown-icon {
        transform: rotate(90deg);
    }
    
    .dropdown-item-icon {
        width: 16px;
        text-align: center;
    }
</style>