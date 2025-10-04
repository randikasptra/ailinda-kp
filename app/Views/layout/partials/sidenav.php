<!-- Modern Header -->
<header class="fixed top-0 left-64 right-0 h-20 bg-white/97 backdrop-blur-xl z-40 flex items-center px-8 border-b border-gray-200/10 shadow-lg">
    <div class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-3">
            <h1 class="text-2xl font-semibold text-gray-800">Selamat datang,</h1>
            <span class="text-2xl font-bold bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] bg-clip-text text-transparent">
                <?= session()->get('username') ?>
            </span>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Active Navigation Indicator -->
            <div class="flex items-center space-x-2 bg-gray-100/80 px-4 py-2 rounded-xl shadow-sm">
                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                <span class="text-sm font-medium text-gray-700">Aktif di: 
                    <span class="font-semibold text-[#1E5631]" id="activeNavIndicator">Dashboard</span>
                </span>
            </div>
            
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] flex items-center justify-center text-white font-semibold shadow-md">
                <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
            </div>
        </div>
    </div>
</header>

<!-- Sidebar -->
<aside class="w-64 h-screen fixed top-0 left-0 bg-gradient-to-b from-[#1E5631] to-[#0c3c22] text-white flex flex-col z-50 shadow-2xl">
    <!-- Logo/Brand -->
    <div class="p-6 pb-4 flex flex-col items-center">
        <div class="w-16 h-16 rounded-xl bg-gradient-to-r from-[#A4DE02] to-[#DDFF73] flex items-center justify-center shadow-xl mb-3">
            <img src="<?= base_url('assets/img/logo-man1.png') ?>" alt="Logo MAN 1" class="w-14 h-14 object-contain rounded-xl transition-transform duration-300 hover:scale-105">
        </div>
        <div class="text-center">
            <div class="font-bold text-white text-xl">MAN 1 Kota Tasikmalaya</div>
            <div class="text-xs text-[#A4DE02]/90 font-medium mt-1">Guru Piket Dashboard</div>
        </div>
    </div>

    <!-- User Profile Mini -->
    <div class="px-4 py-3 border-b border-white/10">
        <div class="flex items-center gap-3 p-2 rounded-lg bg-white/5 backdrop-blur-sm">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#A4DE02] to-[#DDFF73] flex items-center justify-center text-white font-bold text-lg">
                <?= strtoupper(substr(session()->get('username') ?? 'A', 0, 1)) ?>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate"><?= session()->get('username') ?? 'Admin' ?></p>
                <p class="text-xs text-green-200 capitalize"><?= session()->get('email') ?? 'admin' ?></p>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <?php if (session()->get('role') == 'piket'): ?>
            <a href="/dashboard/piket" class="nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/dashboard/piket') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Dashboard">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-home w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Dashboard</span>
                <i class="fas fa-chevron-right w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
            </a>

            <!-- Dropdown untuk Input Surat -->
            <div class="dropdown <?= (current_url(true) == base_url('/piket/izin_masuk_form') || current_url(true) == base_url('/piket/surat_izin')) ? 'open' : '' ?>">
                <div class="dropdown-toggle nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= (current_url(true) == base_url('/piket/izin_masuk_form') || current_url(true) == base_url('/piket/surat_izin')) ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Input Surat">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                            <i class="fas fa-file-alt w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                        </div>
                        <span class="font-medium">Input Surat</span>
                    </div>
                    <i class="fas fa-chevron-right dropdown-icon w-4 h-4 opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
                </div>
                <div class="dropdown-menu <?= (current_url(true) == base_url('/piket/izin_masuk_form') || current_url(true) == base_url('/piket/surat_izin')) ? 'open' : '' ?>">
                    <a href="/piket/izin_masuk_form" class="dropdown-item nav-item flex items-center gap-4 p-4 pl-12 hover:bg-white/10 transition-all duration-300 group hover:shadow-lg <?= current_url(true) == base_url('/piket/izin_masuk_form') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Surat Izin Masuk">
                        <i class="fas fa-envelope-open-text w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                        <span>Surat Izin Masuk</span>
                    </a>
                    <a href="/piket/surat_izin" class="dropdown-item nav-item flex items-center gap-4 p-4 pl-12 hover:bg-white/10 transition-all duration-300 group hover:shadow-lg <?= current_url(true) == base_url('/piket/surat_izin') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Surat Izin Keluar">
                        <i class="fas fa-file-signature w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                        <span>Surat Izin Keluar</span>
                    </a>
                </div>
            </div>

            <a href="/piket/surat_izin_rekapan" class="nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/piket/surat_izin_rekapan') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Tambah Pelanggaran">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-exclamation-triangle w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Tambah Pelanggaran</span>
                <i class="fas fa-chevron-right w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
            </a>
            <a href="/piket/sangsi_siswa" class="nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/piket/surat_izin_rekapan') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Tambah Pelanggaran">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-exclamation-triangle w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Tambah Sanksi</span>
                <i class="fas fa-chevron-right w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
            </a>

            <a href="/piket/data_siswa" class="nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/piket/data_siswa') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Data Siswa">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-users w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Data Siswa</span>
                <i class="fas fa-chevron-right w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
            </a>

        <?php else: ?>
            <a href="/dashboard/bp" class="nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/dashboard/bp') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Dashboard BP">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-home w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Dashboard BP</span>
                <i class="fas fa-chevron-right w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
            </a>
            
            <a href="/bp/rekap_poin" class="nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/bp/rekap_poin') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Rekap Pelanggaran">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i class="fas fa-chart-bar w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Rekap Pelanggaran</span>
                <i class="fas fa-chevron-right w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
            </a>
        <?php endif; ?>
    </nav>

    <!-- Logout -->
    <div class="p-6 border-t border-white/10">
        <a href="/logout" class="flex items-center gap-4 p-4 text-red-200 hover:text-white hover:bg-red-500/20 rounded-2xl transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5">
            <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-red-500/20 shadow-sm">
                <i class="fas fa-sign-out-alt w-5 h-5 group-hover:scale-110 transition-transform"></i>
            </div>
            <span class="font-medium">Logout</span>
            <i class="fas fa-chevron-right w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all"></i>
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
    // Inisialisasi saat DOM siap
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi masuk untuk item menu
        document.querySelectorAll('nav a').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-10px)';
            
            setTimeout(() => {
                item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, 100 + (index * 100));
        });

        // Update active navigation indicator
        function updateActiveNavIndicator() {
            const activeNav = document.querySelector('.nav-item.active');
            const indicator = document.getElementById('activeNavIndicator');
            
            if (activeNav) {
                const navName = activeNav.getAttribute('data-nav-name');
                indicator.textContent = navName;
            }
        }
        
        // Initialize active nav indicator
        updateActiveNavIndicator();
        
        // Update when clicking on nav items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                // Update indicator
                const navName = this.getAttribute('data-nav-name');
                document.getElementById('activeNavIndicator').textContent = navName;
            });
        });

        // Dropdown functionality for sidebar
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
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
    });

    // Hover effects untuk chevron
    document.addEventListener('DOMContentLoaded', function() {
        const groups = document.querySelectorAll('.group');
        groups.forEach(group => {
            group.addEventListener('mouseenter', function() {
                const chevron = this.querySelector('.fa-chevron-right');
                if (chevron) {
                    chevron.style.transform = 'translateX(3px)';
                }
            });
            
            group.addEventListener('mouseleave', function() {
                const chevron = this.querySelector('.fa-chevron-right');
                if (chevron && !this.classList.contains('active')) {
                    chevron.style.transform = 'translateX(0)';
                }
            });
        });
    });
</script>

<style>
    /* Custom styles untuk meningkatkan estetika */
    body {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background-color: #f8fafc;
    }
    
    /* Smooth transitions for all elements */
    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Sidebar scrollbar styling */
    aside::-webkit-scrollbar {
        width: 4px;
    }
    
    aside::-webkit-scrollbar-thumb {
        background: #A4DE02;
        border-radius: 10px;
    }
    
    /* Active menu item styling */
    nav a.active {
        background-color: rgba(255, 255, 255, 0.1) !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    
    nav a.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 60%;
        background-color: #A4DE02;
        border-radius: 0 2px 2px 0;
    }
    
    nav a.active .fa-chevron-right {
        opacity: 1 !important;
        transform: translateX(3px);
    }
    
    /* Hover effects untuk menu items */
    .group:hover .fa-chevron-right {
        transform: translateX(3px);
    }
    
    /* Efek glassmorphism untuk header */
    .backdrop-blur-xl {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
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
        background-color: rgba(255, 255, 255, 0.05);
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