<div class="w-64 h-screen fixed bg-[#1E5631] text-white flex flex-col shadow-lg">
    <div class="p-4 font-bold text-xl border-b border-white">
        Admin Panel
    </div>
    <nav class="flex-1 p-4 space-y-2">
        <a href="<?= base_url('admin/dashboard') ?>" class="block py-2 px-4 hover:bg-[#145128] rounded">Dashboard</a>
        <a href="<?= base_url('admin/users') ?>" class="block py-2 px-4 hover:bg-[#145128] rounded">Kelola Admin</a>
        <a href="<?= base_url('admin/pelanggaran') ?>" class="block py-2 px-4 hover:bg-[#145128] rounded">Kelola Pelanggaran</a>
    </nav>
    <div class="p-4 border-t border-white">
        <a href="<?= base_url('logout') ?>" class="block py-2 px-4 bg-red-600 hover:bg-red-700 rounded text-center">Logout</a>
    </div>
</div>
