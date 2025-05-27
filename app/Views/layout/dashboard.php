<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module">
        import {
            createIcons,
            icons
        } from "https://unpkg.com/lucide@latest/dist/lucide.js";
        window.addEventListener("DOMContentLoaded", () => createIcons({
            icons
        }));
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
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
</body>

</html>