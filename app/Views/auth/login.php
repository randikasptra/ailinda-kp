<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Surat Izin MAN 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="icon" href="<?= base_url('assets/img/MAN1.png') ?>" type="image/png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            min-height: 100vh;
        }

        .login-container {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            transform: perspective(1000px) rotateX(0deg);
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
        }

        .login-container:hover {
            box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.2);
            transform: perspective(1000px) rotateX(2deg);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .input-field {
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px -5px rgba(0, 0, 0, 0.1);
        }

        .input-field:focus {
            box-shadow: 0 5px 20px -5px rgba(30, 86, 49, 0.2);
        }

        .btn-login {
            position: relative;
            overflow: hidden;
        }

        .btn-login::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(30deg);
            transition: all 0.4s ease;
        }

        .btn-login:hover::after {
            left: 100%;
        }

        .logo-container {
            filter: drop-shadow(0 5px 10px rgba(30, 86, 49, 0.2));
            transition: all 0.5s ease;
        }

        .logo-container:hover {
            transform: scale(1.05) rotate(-5deg);
            filter: drop-shadow(0 8px 15px rgba(30, 86, 49, 0.3));
        }

        .info-section {
            background: linear-gradient(135deg, #1E5631 0%, #4C9A2B 100%);
            position: relative;
            overflow: hidden;
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .feature-item {
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateX(5px);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen px-4 py-8">
    <div class="login-container bg-white rounded-2xl w-full max-w-5xl flex flex-col md:flex-row animate-fade-in">
        <!-- Left Section - Information -->
        <div class="info-section text-white p-8 md:p-12 md:w-1/2 flex flex-col justify-center">
            <div class="mb-8 animate-fade-in" style="animation-delay: 0.2s">
                <div class="logo-container mb-6 w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                    <img src="<?= base_url('assets/img/logo-man1.png') ?>" alt="MAN 1 Logo" class="w-16 h-16 object-contain" id="school-logo">
                </div>
                <h1 class="text-3xl font-bold mb-2">SISTEM SURAT IZIN</h1>
                <p class="text-lg opacity-90">MAN 1 Kota Tasikmalaya</p>
            </div>

            <div class="space-y-6 animate-fade-in" style="animation-delay: 0.4s">
                <div class="feature-item flex items-start">
                    <div class="bg-white/20 p-2 rounded-lg mr-4 flex-shrink-0">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-1">Aman & Terpercaya</h3>
                        <p class="opacity-80 text-sm">Sistem terjamin keamanannya dengan enkripsi data</p>
                    </div>
                </div>

                <div class="feature-item flex items-start">
                    <div class="bg-white/20 p-2 rounded-lg mr-4 flex-shrink-0">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-1">Cepat & Efisien</h3>
                        <p class="opacity-80 text-sm">Proses pengajuan surat izin lebih cepat dan mudah</p>
                    </div>
                </div>

                <div class="feature-item flex items-start">
                    <div class="bg-white/20 p-2 rounded-lg mr-4 flex-shrink-0">
                        <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-1">Monitoring Real-time</h3>
                        <p class="opacity-80 text-sm">Pantau status pengajuan surat secara real-time</p>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-white/20 animate-fade-in" style="animation-delay: 0.6s">
                <p class="text-sm opacity-80">"Mewujudkan pendidikan berkualitas dengan sistem yang terintegrasi"</p>
            </div>
        </div>

        <!-- Right Section - Login Form -->
        <div class="bg-white p-8 md:p-12 md:w-1/2 flex flex-col justify-center">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg flex items-start animate-fade-in" style="animation-delay: 0.2s">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 animate-pulse"></i>
                    <div>
                        <p class="text-red-700 font-medium"><?= session()->getFlashdata('error') ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mb-8 animate-fade-in" style="animation-delay: 0.3s">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Masuk ke Akun Anda</h2>
                <p class="text-gray-600">Silakan masukkan kredensial Anda untuk mengakses sistem</p>
            </div>

            <form method="POST" action="/login" class="space-y-6">
                <!-- Email Field with Enhanced Icon -->
                <div class="animate-fade-in" style="animation-delay: 0.4s">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <input type="email" name="email"
                            class="input-field w-full pl-12 pr-4 py-3 border border-gray-200/70 rounded-xl focus:ring-2 focus:ring-[#A4DE02]/50 focus:border-[#A4DE02] outline-none bg-white/70 backdrop-blur-sm"
                            placeholder="Masukkan email" required>
                        <div class="input-icon-container absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="at-sign" class="input-icon w-5 h-5 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Password Field with Enhanced Icon -->
                <div class="animate-fade-in" style="animation-delay: 0.5s">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password"
                            class="input-field w-full pl-12 pr-4 py-3 border border-gray-200/70 rounded-xl focus:ring-2 focus:ring-[#A4DE02]/50 focus:border-[#A4DE02] outline-none bg-white/70 backdrop-blur-sm"
                            placeholder="Masukkan password" required>
                        <div class="input-icon-container absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="key" class="input-icon w-5 h-5 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between animate-fade-in" style="animation-delay: 0.6s">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-[#1E5631] focus:ring-[#A4DE02] border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-600">Ingat saya</label>
                    </div>
                    <!-- <a href="#" class="text-sm font-medium text-[#1E5631] hover:text-[#4C9A2B] transition-colors">
                        Lupa password?
                    </a> -->
                </div>

                <button type="submit"
                    class="btn-login w-full text-white font-semibold py-3.5 rounded-xl flex items-center justify-center bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] hover:from-[#145128] hover:to-[#3D7C1F] transition-all duration-300 shadow-lg hover:shadow-xl animate-fade-in" style="animation-delay: 0.7s">
                    <i data-lucide="log-in" class="w-5 h-5 mr-2"></i>
                    <span class="relative z-10">Masuk</span>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-200/30 animate-fade-in" style="animation-delay: 0.8s">
                <p class="text-center text-xs text-gray-500">© <?= date('Y') ?> MAN 1 Kota Tasikmalaya. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        
        // Add ripple effect to login button
        document.querySelector('.btn-login').addEventListener('click', function(e) {
            let x = e.clientX - e.target.getBoundingClientRect().left;
            let y = e.clientY - e.target.getBoundingClientRect().top;
            
            let ripples = document.createElement('span');
            ripples.style.left = x + 'px';
            ripples.style.top = y + 'px';
            this.appendChild(ripples);
            
            setTimeout(() => {
                ripples.remove();
            }, 1000);
        });
    </script>
</body>

</html>