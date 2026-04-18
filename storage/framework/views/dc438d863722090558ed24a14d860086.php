<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Renter - RMC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .scroll-container::-webkit-scrollbar {
            width: 8px;
        }

        .scroll-container::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 4px;
        }

        .scroll-container::-webkit-scrollbar-track {
            background-color: #f1f5f9;
        }
    </style>
</head>

<body class="bg-gray-50 flex h-screen overflow-hidden">
    <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="flex-1 flex flex-col overflow-y-auto scroll-container">
        <main class="flex-1 p-6 lg:p-10">
            <div class="space-y-8">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-purple-800">Dashboard Penyewa</h2>
                        <div class="pt-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-purple-800 rounded-lg flex flex-col md:flex-row items-center justify-between">
                            <div>
                                <p class="text-xs md:text-sm font-semibold mb-2 opacity-80 uppercase tracking-wide">INGIN MENDAPAT PENGHASILAN TAMBAHAN?</p>
                                <p class="text-sm md:text-base font-medium opacity-90">Titipkan motor Anda dan biarkan kami yang mengelolanya.</p>
                            </div>
                            <a href="<?php echo e(route('register', ['role' => 'pemilik'])); ?>" title="Login sebagai pemilik" class="mt-6 md:mt-0 bg-white text-purple-800 font-bold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition-colors duration-200 transform hover:scale-105">
                                Menjadi Pemilik
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Motor Tersedia</h3>
                                <p class="text-xl font-extrabold text-gray-900 mt-2"><?php echo e($motorTersedia); ?></p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-500 opacity-70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-motorbike">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M19 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M7.5 14h5l4 -4h-10.5m1.5 4l4 -4" />
                                <path d="M13 6h2l1.5 3l2 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Penyewaan Aktif</h3>
                                <p class="text-xl font-extrabold text-gray-900 mt-2"><?php echo e($penyewaanAktif); ?></p>
                            </div>
                            <svg class="w-12 h-12 text-green-500 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-indigo-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Pesanan</h3>
                                <p class="text-xl font-extrabold text-gray-900 mt-2"><?php echo e($totalPenyewaan); ?></p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-indigo-500 opacity-70" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold mb-6 text-purple-800">Motor Paling Sering Disewa</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Merek & Tipe
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nomor Polisi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Jumlah Sewa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__empty_1 = true; $__currentLoopData = $popularMotors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="transition-colors duration-150 hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <?php if($motor->photo_url): ?>
                                            <img class="h-10 w-10 rounded-full mr-4" src="<?php echo e(asset($motor->photo_url)); ?>" alt="">
                                            <?php else: ?>
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-4">
                                                <span class="text-xs text-gray-500">No Image</span>
                                            </div>
                                            <?php endif; ?>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900"><?php echo e($motor->brand); ?></div>
                                                <div class="text-xs text-gray-500"><?php echo e($motor->type_cc); ?>cc</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <?php echo e($motor->plate_number); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">
                                        <?php echo e($motor->rentals_count); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <?php if($motor->status == 'tersedia'): ?>
                                        <a href="<?php echo e(route('penyewa.cari-motor')); ?>" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200">
                                            Sewa
                                        </a>
                                        <?php else: ?>
                                        <span class="text-gray-400 cursor-not-allowed">
                                            Disewa
                                        </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-base text-gray-500">
                                        Belum ada data penyewaan.
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('[data-carousel]');
            if (carousel) {
                new Flowbite.Carousel(carousel);
            }
        });
    </script>
</body>

</html><?php /**PATH D:\PROJEK PROJEK\rental-motor\rental-motor\resources\views/penyewa/dashboard-penyewa.blade.php ENDPATH**/ ?>