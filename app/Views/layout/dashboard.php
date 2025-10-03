<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            lucide.createIcons();
        });
    </script>

        <!-- SweetAlert2 CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine.js CDN (wajib ditaruh di <head> atau sebelum penutup </body>) -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<link rel="icon" href="<?= base_url('assets/img/logo-man1.png') ?>" type="image/png">
</head>

<body class="flex min-h-screen bg-[#F0F9F1]">

    <!-- Sidebar -->
    <?= $this->include('layout/partials/sidenav') ?>

    <!-- Main Content -->
    <main class="flex-1 p-6 relative">
        <!-- Navbar / Topbar -->
        <?= $this->include('layout/partials/navbar') ?>

        <!-- Content Section -->
        <section class="mt-6">
            <?= $this->renderSection('content') ?>
        </section>
    </main>





    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cek apakah ada flashdata dari CI
        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '<?= session()->getFlashdata('success') ?>',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '<?= session()->getFlashdata('error') ?>',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        <?php endif; ?>
    });
</script>



    

</body>

</html>