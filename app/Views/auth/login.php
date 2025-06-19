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

    <?php if (session()->getFlashdata('error')): ?>
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
        <form method="POST" action="/login" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M2.94 6.06a2 2 0 012.828 0L10 10.293l4.232-4.233a2 2 0 112.828 2.828l-5.657 5.657a2 2 0 01-2.828 0L2.94 8.889a2 2 0 010-2.828z" />
                        </svg>
                    </div>
                    <input type="email" name="email"
                        class="input-field w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] outline-none"
                        placeholder="Masukkan email" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="password" name="password"
                        class="input-field w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] outline-none"
                        placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit"
                class="btn-primary w-full text-white font-semibold py-3 rounded-lg flex items-center justify-center bg-[#1E5631] hover:bg-[#145128]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-xs text-gray-500">© <?= date('Y') ?> MAN 1 Kota Tasikmalaya</p>
    </div>

</body>

</html>