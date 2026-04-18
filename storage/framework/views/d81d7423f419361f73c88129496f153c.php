<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Penyewaan Motor</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Adjusting the gradient background */
        .bg-login {
            background-image: linear-gradient(to right, rgba(63, 29, 216, 0.9), rgba(29, 78, 216, 0.2)), url('app/foto/foto-ciamis.jpg');
            background-size: cover;
            background-position: center;
        }

        /* Custom animation for the forms */
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

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>

<body>
    <div class="grid min-h-screen w-full grid-cols-12 overflow-hidden">
        <div class="z-3 col-span-12 md:col-span-7 flex p-8 md:p-16 text-white bg-login">
            <div class="w-full flex flex-col justify-center items-center md:items-start text-center md:text-left">
                <h1 class="my-8 text-5xl md:text-6xl lg:text-7xl leading-tight font-extrabold text-white animate-fade-in">
                    Jelajahi Kota Ciamis Dengan Bebas
                </h1>
                <p class="mb-4 md:mb-6 text-lg md:text-xl font-medium text-gray-200 animate-fade-in">
                    Belum punya akun?
                </p>
                <a href="/register"
                    class="group flex items-center justify-center h-12 px-6 rounded-full text-blue-600 bg-white shadow-lg font-semibold transform-gpu transition-all duration-300 hover:scale-105 hover:shadow-xl animate-fade-in">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-3 flex-none text-blue-600 group-hover:text-blue-800 transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    <span class="text-sm md:text-base">Sign Up</span>
                </a>
            </div>
        </div>

        <div class="z-3 col-span-12 md:col-span-5 flex rounded-tl-[44px] bg-white relative">
            <div class="z-10 w-full flex items-center justify-center p-8">
                <div class="z-4 w-full max-w-sm lg:max-w-md">

                    <div class="mb-16 text-center md:text-left">
                        <h1 class="text-4xl font-extrabold text-blue-600 tracking-tight">RMC</h1>
                        <p class="text-sm text-gray-500 mt-1">Rental Motor Ciamis</p>
                    </div>

                    <h2 class="mb-8 text-3xl font-bold text-gray-800 text-center md:text-left">
                        Selamat Datang Kembali
                    </h2>

                    <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                        <?php echo csrf_field(); ?>

                        <div class="relative">
                            <input type="email" name="email" placeholder=" " required
                                class="w-full peer border-b-2 border-gray-300 px-2 py-4 text-lg font-small text-gray-800 transition duration-300 focus:outline-none" />
                            <label for="email"
                                class="absolute left-2 top-4 text-gray-500 transition-all duration-300 transform origin-left-bottom peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-8 peer-focus:scale-75 peer-focus:text-blue-600 peer-valid:-translate-y-8 peer-valid:scale-75 peer-valid:text-blue-600">
                                Email
                            </label>
                        </div>

                        <div class="relative">
                            <input type="password" name="password" placeholder=" " required
                                class="w-full peer border-b-2 border-gray-300 px-2 py-4 text-lg font-small text-gray-800 transition duration-300 focus:outline-none" />
                            <label for="password"
                                class="absolute left-2 top-4 text-gray-500 transition-all duration-300 transform origin-left-bottom peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-8 peer-focus:scale-75 peer-focus:text-blue-600 peer-valid:-translate-y-8 peer-valid:scale-75 peer-valid:text-blue-600">
                                Password
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-2 text-gray-600">
                                <input type="checkbox" name="remember"
                                    class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" />
                                <span class="text-sm md:text-base font-medium">Ingat Saya</span>
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full transform-gpu rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-4 font-bold text-white transition-all duration-300 hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Masuk
                        </button>
                    </form>

                    <?php if($errors->any()): ?>
                    <div class="mt-8 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg shadow-md">
                        <ul class="list-none space-y-2">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-start">
                                <span class="mr-2 text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <?php echo e($error); ?>

                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                    <div class="mt-8 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg shadow-md">
                        <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>

                    <?php if(session('success')): ?>
                    <div class="mt-8 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md">
                        <?php echo e(session('success')); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH D:\PROJEK PROJEK\rental-motor\rental-motor\resources\views/auth/login.blade.php ENDPATH**/ ?>