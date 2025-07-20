<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/MAN1.png') ?>" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Tambahan untuk animasi opacity */
        #loading-screen {
            transition: opacity 0.5s ease;
        }
    </style>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            lucide.createIcons();
        });
    </script>
</head>

<body class="flex min-h-screen bg-[#F0F9F1] relative">

    <!-- Loading Screen -->
    <div id="loading-screen" class="fixed inset-0 z-50 bg-white flex items-center justify-center">
        <div class="animate-spin rounded-full h-16 w-16 border-4 border-green-500 border-t-transparent"></div>
    </div>

    <!-- Sidebar -->
    <?= $this->include('layout/partials/sidenav_admin') ?>

    <!-- Main Content -->
    <main class="flex-1 p-6 relative">
        <!-- Navbar / Topbar -->
        <?= $this->include('layout/partials/navbar') ?>

        <!-- Content Section -->
        <section class="mt-6">
            <?= $this->renderSection('content') ?>
        </section>
    </main>

    <!-- Script -->
    <script>
        lucide.createIcons();

        // Hilangkan loading screen saat halaman selesai dimuat
        window.addEventListener('load', function () {
            const loader = document.getElementById('loading-screen');
            if (loader) {
                loader.classList.add('opacity-0'); // efek fade out
                setTimeout(() => loader.style.display = 'none', 500); // tunggu efek selesai baru hilang
            }
        });
    </script>
</body>

</html>
