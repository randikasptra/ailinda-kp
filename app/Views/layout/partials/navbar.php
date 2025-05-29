<header class="ml-64 p-6 sticky top-0 z-10 bg-white shadow-md rounded-lg p-4 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-[#1E5631]"><?= $title ?? 'Dashboard' ?></h1>
        <p class="text-sm text-gray-600">Halo, <?= session()->get('username') ?> (<?= session()->get('role') ?>)</p>
    </div>
</header>
