<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Penyewaan Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Custom styles for Poppins font and a subtle fade-in animation */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Define the fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
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

<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 md:p-10 rounded-xl shadow-2xl w-full max-w-md animate-fade-in border border-gray-200">
        <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Daftar Akun Baru</h1>

        <?php if($errors->any()): ?>
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
            <ul class="list-disc list-inside space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-5">
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name"
                    class="appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 ease-in-out"
                    value="<?php echo e(old('name')); ?>" required autofocus>
            </div>

            <div class="mb-5">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email"
                    class="appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 ease-in-out"
                    value="<?php echo e(old('email')); ?>" required>
            </div>

            <div class="mb-5">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password"
                    class="appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 ease-in-out"
                    required>
            </div>

            <div class="mb-6">
                <label for="password-confirm" class="block text-gray-700 text-sm font-semibold mb-2">Konfirmasi Password</label>
                <input type="password" id="password-confirm" name="password_confirmation"
                    class="appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 ease-in-out"
                    required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-3">Daftar sebagai:</label>
                <div class="flex flex-col md:flex-row md:space-x-6 space-y-2 md:space-y-0">
                    <div class="flex items-center">
                        <input type="radio" id="penyewa" name="role" value="penyewa" class="form-radio h-4 w-4 text-blue-600 focus:ring-blue-500 transition duration-150 ease-in-out" checked>
                        <label for="penyewa" class="ml-2 text-gray-700 font-medium cursor-pointer">Penyewa</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="pemilik" name="role" value="pemilik" class="form-radio h-4 w-4 text-blue-600 focus:ring-blue-500 transition duration-150 ease-in-out">
                        <label for="pemilik" class="ml-2 text-gray-700 font-medium cursor-pointer">Pemilik Motor</label>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 w-full transition duration-200 ease-in-out transform hover:scale-105 shadow-md">
                    Daftar
                </button>
            </div>
        </form>

        <p class="text-center text-gray-600 text-sm mt-8">
            Sudah punya akun? <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:text-blue-800 font-semibold transition duration-200 ease-in-out">Login di sini</a>
        </p>
    </div>
</body>

</html><?php /**PATH D:\PROJEK PROJEK\rental-motor\rental-motor\resources\views/auth/register.blade.php ENDPATH**/ ?>