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
    <!-- Alpine.js CDN (wajib ditaruh di <head> atau sebelum penutup </body>) -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


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
function pelanggaranModal() {
    return {
        open: false,
        selected: [],
        list: <?= json_encode($pelanggarans, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>,

        toggle(item) {
            const index = this.selected.findIndex(p => p.id === item.id);
            if (index > -1) {
                this.selected.splice(index, 1);
            } else {
                this.selected.push(item);
            }
        },

        isSelected(item) {
            return this.selected.some(p => p.id === item.id);
        },

        remove(index) {
            this.selected.splice(index, 1);
        }
    };
}
</script>

    <script>
        function pelanggaranDropdown() {
            return {
                open: false,
                selected: [],
                list: <?= json_encode($pelanggarans) ?>,
                toggle(p) {
                    if (this.isSelected(p)) {
                        this.selected = this.selected.filter(item => item.id !== p.id);
                    } else {
                        this.selected.push(p);
                    }
                },
                remove(index) {
                    this.selected.splice(index, 1);
                },
                isSelected(p) {
                    return this.selected.some(item => item.id === p.id);
                }
            }
        }
    </script>
    

</body>

</html>