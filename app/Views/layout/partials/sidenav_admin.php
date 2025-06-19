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
<aside class="w-64 h-screen fixed top-0 left-0 bg-gradient-to-b from-[#1E5631] to-[#0d3b21] text-white flex flex-col z-50 shadow-xl">
    <!-- Logo/Brand -->
    <div class="p-6 pb-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-[#A4DE02] flex items-center justify-center text-[#1E5631] font-bold text-xl">
                M1
            </div>
            <div>
                <div class="font-bold text-white">MAN 1</div>
                <div class="text-xs text-[#A4DE02]/80">Admin Panel</div>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <?php if (session()->get('role') == 'admin'): ?>
            <a href="/dashboard/admin" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <div class="w-8 h-8 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Dashboard</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            
            <a href="/admin/users" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <div class="w-8 h-8 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="user-cog" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Kelola Users</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            
            <a href="/admin/pelanggaran" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <div class="w-8 h-8 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="shield-alert" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Pelanggaran</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            
            <a href="/admin/siswa" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <div class="w-8 h-8 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-[#A4DE02]/20">
                    <i data-lucide="graduation-cap" class="w-5 h-5 text-[#A4DE02] group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="font-medium">Kelola Siswa</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
        <?php endif; ?>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-white/10">
        <a href="/logout" class="flex items-center gap-3 p-3 text-red-200 hover:text-white hover:bg-red-500/20 rounded-xl transition-all duration-300 group">
            <div class="w-8 h-8 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-red-500/20">
                <i data-lucide="power" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
            </div>
            <span class="font-medium">Logout</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
        </a>
    </div>
</aside>

<!-- Main Content Offset -->
<div class="ml-64 pt-16"></div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>