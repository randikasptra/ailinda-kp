<?php
// tailwind_pagination.php (safe version)
// Menampilkan pagination hanya jika ada lebih dari 1 link (halaman)
$links = $pager->links();

if (!empty($links) && count($links) > 1): ?>
<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-2 py-4">
    <!-- First & Prev (opsional, hanya jika method tersedia dan menghasilkan URI) -->
    <?php if (method_exists($pager, 'getFirst') && method_exists($pager, 'getPreviousPage') && $pager->getPreviousPage()): ?>
        <a href="<?= esc($pager->getFirst()) ?>" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">&laquo;</a>
        <a href="<?= esc($pager->getPreviousPage()) ?>" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">Prev</a>
    <?php endif; ?>

    <!-- Nomor halaman -->
    <?php foreach ($links as $link) : ?>
        <?php if (!empty($link['active'])) : ?>
            <span class="px-3 py-1 rounded-lg bg-[#1E5631] text-white"><?= $link['title'] ?></span>
        <?php else : ?>
            <a href="<?= esc($link['uri']) ?>"
               class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700"><?= $link['title'] ?></a>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Next & Last (opsional) -->
    <?php if (method_exists($pager, 'getNextPage') && method_exists($pager, 'getLast') && $pager->getNextPage()): ?>
        <a href="<?= esc($pager->getNextPage()) ?>" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">Next</a>
        <a href="<?= esc($pager->getLast()) ?>" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">&raquo;</a>
    <?php endif; ?>
</nav>
<?php endif; ?>
