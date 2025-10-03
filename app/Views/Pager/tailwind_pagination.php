<?php
// Ambil info halaman
$page        = $pager->getCurrentPageNumber();
$total_pages = $pager->getPageCount();
?>

<div class="px-6 py-4 border-t border-gray-200">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <!-- Info halaman -->
        <div class="text-sm text-gray-600">
            Halaman <?= $page ?> dari <?= $total_pages ?>
        </div>

        <!-- Tombol navigasi -->
        <div class="flex items-center gap-2">
            <!-- Tombol Sebelumnya -->
            <a href="<?= $pager->getPreviousPage() ?>"
               class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 <?= $page <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>"
               <?= $page <= 1 ? 'onclick="return false;"' : '' ?>>
                <i class="fas fa-chevron-left mr-2"></i> Sebelumnya
            </a>

            <!-- Nomor Halaman -->
            <div class="flex gap-1">
                <?php
                $start = max(1, $page - 2);
                $end   = min($total_pages, $page + 2);

                if ($start > 1) {
                    echo '<a href="' . $pager->getPageURI(1) . '" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200">1</a>';
                    if ($start > 2) {
                        echo '<span class="px-3 py-1.5 text-gray-500">...</span>';
                    }
                }

                for ($i = $start; $i <= $end; $i++): ?>
                    <a href="<?= $pager->getPageURI($i) ?>"
                       class="px-3 py-1.5 rounded-xl transition-all duration-200 <?= $i == $page ? 'bg-[#1E5631] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor;

                if ($end < $total_pages) {
                    if ($end < $total_pages - 1) {
                        echo '<span class="px-3 py-1.5 text-gray-500">...</span>';
                    }
                    echo '<a href="' . $pager->getPageURI($total_pages) . '" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200">' . $total_pages . '</a>';
                }
                ?>
            </div>

            <!-- Tombol Selanjutnya -->
            <a href="<?= $pager->getNextPage() ?>"
               class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 <?= $page >= $total_pages ? 'opacity-50 cursor-not-allowed' : '' ?>"
               <?= $page >= $total_pages ? 'onclick="return false;"' : '' ?>>
                Selanjutnya <i class="fas fa-chevron-right ml-2"></i>
            </a>
        </div>
    </div>
</div>
