<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Surat Izin MAN 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #E8F5E9;
            /* Hijau muda */
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

</head>

<body class="flex items-center justify-center min-h-screen px-4">

    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md border-t-4 border-[#1E5631] animate-fade-in">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-[#1E5631] tracking-wide">SISTEM SURAT IZIN</h1>
            <p class="text-sm text-gray-600 mt-1">MAN 1 Kota Tasikmalaya</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded-lg border border-red-300">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- ✅ Arahkan ke /login (bukan /auth/login) -->
        <form method="POST" action="/login" class="space-y-5">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition" required>
            </div>

            <button type="submit" class="w-full bg-[#1E5631] hover:bg-[#145128] text-white font-semibold py-2 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-xs text-gray-500">© <?= date('Y') ?> MAN 1 Kota Tasikmalaya</p>
    </div>

</body>

</html>