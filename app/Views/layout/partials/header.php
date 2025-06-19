<!-- Header -->
<header
    class="ml-64 sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow px-8 py-4 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-[#1E5631]"><?= $title ?? 'Dashboard' ?></h1>
        <p class="text-sm text-gray-600">Halo, <span class="font-medium"><?= session()->get('username') ?></span>
            (<?= session()->get('role') ?>)</p>
    </div>
    <div class="flex items-center gap-4">
        <button class="relative p-2 rounded-full hover:bg-gray-100 transition">
            <i data-lucide="bell" class="w-5 h-5 text-gray-600"></i>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-ping"></span>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>
        <div
            class="w-9 h-9 rounded-full bg-gradient-to-br from-[#1E5631] to-[#A4DE02] flex items-center justify-center text-white font-semibold shadow">
            <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
        </div>
    </div>
</header>