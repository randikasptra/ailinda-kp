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
            
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] flex items-center justify-center text-white font-semibold shadow-md">
                <?= substr(session()->get('username'), 0, 1) ?>
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
    
    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <?php if (session()->get('role') == 'admin'): ?>
            <a href="/dashboard/admin" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/dashboard/admin') ? 'bg-white/10 shadow-lg' : '' ?>">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Dashboard</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-[#A4DE02]"></i>
            </a>
            
            <a href="/admin/users" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/admin/users') ? 'bg-white/10 shadow-lg' : '' ?>">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i data-lucide="user-cog" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Kelola Users</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-[#A4DE02]"></i>
            </a>
            
            <a href="/admin/pelanggaran" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/admin/pelanggaran') ? 'bg-white/10 shadow-lg' : '' ?>">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i data-lucide="shield-alert" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Pelanggaran</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-[#A4DE02]"></i>
            </a>
            
            <a href="/admin/siswa" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5 <?= current_url(true) == base_url('/admin/siswa') ? 'bg-white/10 shadow-lg' : '' ?>">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-[#A4DE02]/20 shadow-sm">
                    <i data-lucide="graduation-cap" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Kelola Siswa</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-[#A4DE02]"></i>
            </a>
        <?php endif; ?>
    </nav>

    <!-- Logout -->
    <div class="p-6 border-t border-white/10">
        <a href="/logout" class="flex items-center gap-4 p-4 text-red-200 hover:text-white hover:bg-red-500/20 rounded-2xl transition-all duration-300 group hover:shadow-lg transform hover:-translate-y-0.5">
            <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-xl group-hover:bg-red-500/20 shadow-sm">
                <i data-lucide="power" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
            </div>
            <span class="font-medium">Logout</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
        </a>
    </div>
</aside>

<!-- Main Content Offset -->
<div class="ml-64 pt-20"></div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
        
        // Tambahkan efek animasi untuk item menu saat halaman dimuat
        document.querySelectorAll('nav a').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-10px)';
            
            setTimeout(() => {
                item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, 100 + (index * 100));
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
    
    /* Hover effects untuk menu items */
    .group:hover .lucide-chevron-right {
        transform: translateX(3px);
    }
    
    /* Efek glassmorphism untuk header */
    .backdrop-blur-xl {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
</style>