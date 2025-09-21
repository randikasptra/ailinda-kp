<?php
// tailwind_pagination.php
// Template pagination Tailwind untuk CodeIgniter (menggunakan PagerRenderer)
if ($pager->getPageCount() > 1) :
    $currentPage = $pager->getCurrentPageNumber();
    $totalPages  = $pager->getPageCount();
    $maxPages    = 10;

    // Atur berapa banyak link di kiri/kanan (opsional)
    $pager->setSurroundCount((int) floor($maxPages / 2));

    // Ambil array links yang berisi ['uri' => ..., 'title' => ..., 'active' => bool]
    $links = $pager->links();
?>
<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-2 py-4">
    <!-- First -->
    <?php if ($currentPage > 1) : ?>
        <a href="<?= esc($pager->getFirst()) ?>" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">&laquo;</a>
    <?php endif; ?>

    <!-- Prev -->
    <?php if ($pager->hasPreviousPage() && $pager->getPreviousPage()) : ?>
        <a href="<?= esc($pager->getPreviousPage()) ?>" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">Prev</a>
    <?php endif; ?>

    <!-- Page Numbers (dari $pager->links()) -->
    <?php foreach ($links as $link) : ?>
        <?php if ($link['active']) : ?>
            <span class="px-3 py-1 rounded-lg bg-[#1E5631] text-white"><?= $link['title'] ?></span>
        <?php else : ?>
            <a href="<?= esc($link['uri']) ?>" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700"><?= $link['title'] ?></a>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Next -->
    <?php if ($pager->hasNextPage() && $pager->getNextPage()) : ?>
        <a href="<?= esc($pager->getNextPage()) ?>" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">Next</a>
    <?php endif; ?>

    <!-- Last -->
    <?php if ($currentPage < $totalPages) : ?>
        <a href="<?= esc($pager->getLast()) ?>" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">&raquo;</a>
    <?php endif; ?>
</nav>
<?php endif; ?>
