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
            <div class="text-xs text-[#A4DE02]/90 font-medium mt-1">Admin Panel</div>
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
                <p class="text-xs text-green-200 capitalize"><?= session()->get('role') ?? 'admin' ?></p>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <?php if (session()->get('role') == 'admin'): ?>
            <a href="/dashboard/admin" class="nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/dashboard/admin') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Dashboard">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Dashboard</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
            </a>
            
            <a href="/admin/users" class="nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/admin/users') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Kelola Users">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i data-lucide="user-cog" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Kelola Users</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
            </a>
                        
            <div class="dropdown <?= (current_url(true) == base_url('/admin/laporan/keluar') || current_url(true) == base_url('/admin/laporan/masuk')) ? 'open' : '' ?>">
                <div class="dropdown-toggle nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= (current_url(true) == base_url('/admin/laporan/keluar') || current_url(true) == base_url('/admin/laporan/masuk')) ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Laporan">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                            <i data-lucide="file-text" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                        </div>
                        <span class="font-medium">Laporan</span>
                    </div>
                    <i data-lucide="chevron-down" class="dropdown-icon w-4 h-4 ml-auto transition-all duration-300 text-[#A4DE02] transform group-hover:scale-110"></i>
                </div>
                <div class="dropdown-menu <?= (current_url(true) == base_url('/admin/laporan/keluar') || current_url(true) == base_url('/admin/laporan/masuk')) ? 'open' : '' ?>">
                    <a href="/admin/laporan/keluar" class="dropdown-item nav-item flex items-center gap-4 p-4 pl-12 hover:bg-white/10 transition-all duration-300 group hover:shadow-lg <?= current_url(true) == base_url('/admin/laporan/keluar') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Laporan Izin Keluar">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i data-lucide="log-out" class="w-4 h-4 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                        </div>
                        <span class="text-sm">Laporan Izin Keluar</span>
                    </a>
                    <a href="/admin/laporan/masuk" class="dropdown-item nav-item flex items-center gap-4 p-4 pl-12 hover:bg-white/10 transition-all duration-300 group hover:shadow-lg <?= current_url(true) == base_url('/admin/laporan/masuk') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Laporan Izin Masuk">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i data-lucide="log-in" class="w-4 h-4 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                        </div>
                        <span class="text-sm">Laporan Izin Masuk</span>
                    </a>
                    <a href="/admin/laporan/sanksi_siswa" class="dropdown-item nav-item flex items-center gap-4 p-4 pl-12 hover:bg-white/10 transition-all duration-300 group hover:shadow-lg <?= current_url(true) == base_url('/admin/laporan/masuk') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Laporan Izin Masuk">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i data-lucide="file-text" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                        </div>
                        <span class="text-sm">Laporan Sanksi Siswa</span>
                    </a>
                </div>
            </div>

            <a href="/admin/siswa" class="nav-item flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/admin/siswa') ? 'active bg-white/10 shadow-lg' : '' ?>" data-nav-name="Kelola Siswa">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i data-lucide="graduation-cap" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Kelola Siswa</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all text-[#A4DE02] group-hover:translate-x-1"></i>
            </a>

        <?php endif; ?>
    </nav>

    <!-- Logout -->
    <div class="p-6 border-t border-white/10">
        <a href="/logout" class="nav-item flex items-center gap-4 p-4 text-red-200 hover:text-white hover:bg-red-500/20 rounded-2xl transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5" data-nav-name="Logout">
            <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-red-500/20 shadow-sm">
                <i data-lucide="power" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
            </div>
            <span class="font-medium">Logout</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-all"></i>
        </a>
    </div>
</aside>

<!-- Main Content Area -->
<main class="pt-20 min-h-screen bg-gradient-to-br from-gray-50/50 to-gray-100/50 pl-64">
    <!-- Your page content goes here -->
</main>

<script>
    // Inisialisasi saat DOM siap
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Animasi masuk untuk item menu
        document.querySelectorAll('nav a, .dropdown-toggle').forEach((item, index) => {
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
                if (navName) {
                    indicator.textContent = navName;
                }
            }
        }
        
        // Initialize active nav indicator
        updateActiveNavIndicator();
        
        // Update when clicking on nav items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (this.classList.contains('dropdown-toggle')) {
                    e.preventDefault();
                    return;
                }
                
                // Update indicator
                const navName = this.getAttribute('data-nav-name');
                if (navName) {
                    document.getElementById('activeNavIndicator').textContent = navName;
                }
            });
        });

        // Enhanced dropdown functionality
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const dropdown = this.closest('.dropdown');
                const menu = dropdown.querySelector('.dropdown-menu');
                const icon = this.querySelector('.dropdown-icon');
                
                // Close all other dropdowns
                document.querySelectorAll('.dropdown').forEach(d => {
                    if (d !== dropdown) {
                        d.classList.remove('open');
                        const otherIcon = d.querySelector('.dropdown-icon');
                        if (otherIcon) {
                            otherIcon.style.transform = 'rotate(0deg)';
                        }
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('open');
                
                // Rotate chevron icon
                if (icon) {
                    if (dropdown.classList.contains('open')) {
                        icon.style.transform = 'rotate(180deg)';
                    } else {
                        icon.style.transform = 'rotate(0deg)';
                    }
                }
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown').forEach(dropdown => {
                    dropdown.classList.remove('open');
                    const icon = dropdown.querySelector('.dropdown-icon');
                    if (icon) {
                        icon.style.transform = 'rotate(0deg)';
                    }
                });
            }
        });

        // Hover effects untuk menu items
        const groups = document.querySelectorAll('.group');
        groups.forEach(group => {
            group.addEventListener('mouseenter', function() {
                const chevron = this.querySelector('[data-lucide="chevron-right"]');
                if (chevron) {
                    chevron.style.transform = 'translateX(3px)';
                }
            });
            
            group.addEventListener('mouseleave', function() {
                const chevron = this.querySelector('[data-lucide="chevron-right"]');
                if (chevron && !this.classList.contains('active')) {
                    chevron.style.transform = 'translateX(0)';
                }
            });
        });

        // Auto update active nav based on URL
        function updateActiveNavFromURL() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
                item.classList.remove('bg-white/10');
                item.classList.remove('shadow-lg');
            });

            // Find matching nav item
            const activeItem = document.querySelector(`a[href="${currentPath}"]`);
            if (activeItem) {
                activeItem.classList.add('active');
                activeItem.classList.add('bg-white/10');
                activeItem.classList.add('shadow-lg');
                
                // Also activate parent dropdown if exists
                const parentDropdown = activeItem.closest('.dropdown');
                if (parentDropdown) {
                    parentDropdown.classList.add('open');
                    const toggle = parentDropdown.querySelector('.dropdown-toggle');
                    if (toggle) {
                        toggle.classList.add('active');
                        toggle.classList.add('bg-white/10');
                        toggle.classList.add('shadow-lg');
                    }
                }
                
                updateActiveNavIndicator();
            }
        }

        // Initial update from URL
        updateActiveNavFromURL();
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
    .nav-item.active {
        background-color: rgba(255, 255, 255, 0.1) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        position: relative;
    }
    
    .nav-item.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 60%;
        background: linear-gradient(to bottom, #A4DE02, #DDFF73);
        border-radius: 0 2px 2px 0;
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    .nav-item.active [data-lucide="chevron-right"] {
        opacity: 1 !important;
        transform: translateX(3px) !important;
    }
    
    /* Hover effects untuk menu items */
    .group:hover [data-lucide="chevron-right"] {
        transform: translateX(3px) !important;
    }
    
    /* Efek glassmorphism untuk header */
    .backdrop-blur-xl {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    /* Enhanced Dropdown styles */
    .dropdown-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(255, 255, 255, 0.05);
        border-radius: 0 0 1rem 1rem;
        margin: -0.5rem 0 0 0;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-top: none;
    }

    .dropdown.open .dropdown-menu {
        max-height: 200px;
        animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes glow {
        from {
            opacity: 0.7;
            box-shadow: 0 0 5px #A4DE02;
        }
        to {
            opacity: 1;
            box-shadow: 0 0 15px #A4DE02;
        }
    }

    .dropdown-item {
        position: relative;
        font-size: 0.875rem;
    }

    .dropdown-item::before {
        content: '';
        position: absolute;
        left: 2.5rem;
        top: 50%;
        transform: translateY(-50%);
        width: 2px;
        height: 0;
        background: #A4DE02;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .dropdown-item:hover::before,
    .dropdown-item.active::before {
        height: 60%;
    }

    .dropdown.open .dropdown-toggle .dropdown-icon {
        transition: transform 0.3s ease;
    }

    /* Enhanced responsive design */
    @media (max-width: 768px) {
        aside {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        aside.mobile-open {
            transform: translateX(0);
        }
        
        header {
            left: 0;
        }
        
        main {
            padding-left: 0;
        }
    }

    /* Smooth icon transitions */
    [data-lucide] {
        transition: all 0.3s ease;
    }

    /* Enhanced active state for dropdown parent */
    .dropdown.open .dropdown-toggle {
        border-radius: 1rem 1rem 0 0 !important;
    }
</style>