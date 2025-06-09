<aside class="w-64 h-screen fixed top-0 left-0 bg-[#1E5631] text-white flex flex-col shadow-lg z-50">
    <div class="p-6 text-2xl font-bold border-b border-green-700">
        <span class="text-[#A4DE02]">MAN 1</span> <br> Admin Panel
    </div>
    <nav class="flex-1 p-4 space-y-2 text-sm overflow-y-auto">
        <?php if (session()->get('role') == 'admin'): ?>
            <a href="/dashboard/admin" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="home" class="w-4 h-4"></i> Dashboard Admin
            </a>
            <a href="/admin/users" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="user-plus" class="w-4 h-4"></i> Kelola Admin
            </a>
            <a href="/admin/pelanggaran" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="alert-triangle" class="w-4 h-4"></i> Kelola Pelanggaran
            </a>
            <a href="/admin/data_siswa" class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#145128]">
                <i data-lucide="users" class="w-4 h-4"></i> Data Siswa
            </a>
        <?php endif; ?>
    </nav>

    <div class="p-4">
        <a href="/logout" class="flex items-center gap-2 p-2 text-red-300 hover:text-white hover:bg-red-600 rounded-lg">
            <i data-lucide="log-out" class="w-4 h-4"></i> Logout
        </a>
    </div>
</aside>
