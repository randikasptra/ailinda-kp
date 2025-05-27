<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-[#E8F5E9]">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#1E5631] text-white flex flex-col">
        <div class="p-6 font-bold text-2xl border-b border-green-700">
            <span class="text-[#A4DE02]">MAN 1</span> <br> Dashboard
        </div>
        <nav class="flex-1 p-4 space-y-2 text-sm">
            <?php if (session()->get('role') == 'piket'): ?>
                <a href="/dashboard/piket" class="block p-2 rounded hover:bg-[#145128]">Dashboard Piket</a>
                <a href="/surat/izin" class="block p-2 rounded hover:bg-[#145128]">Input Surat Izin</a>
                <a href="/siswa/kembali" class="block p-2 rounded hover:bg-[#145128]">Konfirmasi Kembali</a>
                <a href="/pelanggaran" class="block p-2 rounded hover:bg-[#145128]">Catat Pelanggaran</a>
            <?php else: ?>
                <a href="/dashboard/bp" class="block p-2 rounded hover:bg-[#145128]">Dashboard BP</a>
                <a href="/rekap/pelanggaran" class="block p-2 rounded hover:bg-[#145128]">Rekap Pelanggaran</a>
            <?php endif; ?>
            <a href="/logout" class="block p-2 mt-4 text-red-300 hover:text-white hover:bg-red-600 rounded">Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-[#1E5631]"><?= $title ?? 'Dashboard' ?></h1>
            <p class="text-sm text-gray-600">Halo, <?= session()->get('username') ?> (<?= session()->get('role') ?>)</p>
        </header>

        <section>
            <?= $this->renderSection('content') ?>
        </section>
    </main>
</body>

</html>