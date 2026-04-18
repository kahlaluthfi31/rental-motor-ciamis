<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - RMC</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="flex-1 flex flex-col overflow-hidden">
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto scroll-container">
            <div class="space-y-5">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-bold text-purple-800">Dashboard Pemilik</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-indigo-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Jumlah Motor Terdaftar</h3>
                        <p class="text-lg font-extrabold text-gray-900 mt-2"><?php echo e($totalMotors); ?></p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Motor Tersedia</h3>
                        <p class="text-lg font-extrabold text-gray-900 mt-2"><?php echo e($availableMotors); ?></p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-purple-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Bagi Hasil (70%)</h3>
                        <p class="text-lg font-extrabold text-gray-900 mt-2">Rp <?php echo e(number_format($totalOwnerShare, 0, ',', '.')); ?></p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <h2 class="text-lg font-bold text-purple-800 mb-6">Daftar Motor Saya</h2>
                    <div class="overflow-x-auto">
                        <?php if($motors->isEmpty()): ?>
                        <div class="text-center py-10 text-gray-500 text-base">
                            <p>Anda belum mendaftarkan motor. Silakan tambahkan motor baru.</p>
                        </div>
                        <?php else: ?>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Motor
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Plat Nomor
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $motors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="transition-colors duration-150 hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-12 h-12">
                                                <img class="w-full h-full rounded-full object-cover" src="<?php echo e(asset($motor->photo_url)); ?>" alt="Motor Image" />
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-semibold text-gray-900"><?php echo e($motor->brand); ?></p>
                                                <p class="text-xs text-gray-500"><?php echo e($motor->type_cc); ?>cc</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <?php echo e($motor->plate_number); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <?php if($motor->status == 'tersedia'): ?>
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">
                                            Tersedia
                                        </span>
                                        <?php elseif($motor->status == 'disewa'): ?>
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-orange-800 bg-orange-200 rounded-full">
                                            Disewa
                                        </span>
                                        <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">
                                            Menunggu Verifikasi
                                        </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html><?php /**PATH D:\PROJEK PROJEK\rental-motor\rental-motor\resources\views/pemilik/dashboard-pemilik.blade.php ENDPATH**/ ?>