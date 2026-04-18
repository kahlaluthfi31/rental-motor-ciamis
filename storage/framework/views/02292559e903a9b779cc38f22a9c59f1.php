<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Motor - RMC</title>
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
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            500: '#a855f7',
                            600: '#9333ea',
                            700: '#7c3aed',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 flex h-screen overflow-hidden">
    <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="flex-1 flex flex-col overflow-y-auto">
        <main class="flex-1 p-6 lg:p-10">
            <div class="max-w-7xl mx-auto space-y-8">
                <!-- Header Section with Purple Title -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                    <h1 class="text-lg font-bold text-purple-800">Verifikasi Motor</h1>
                </div>

                <!-- Alert Messages -->
                <?php if(session('success')): ?>
                <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-xl shadow-sm" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-xl shadow-sm" role="alert">
                    <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                </div>
                <?php endif; ?>

                <!-- Content Section -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <?php if($pendingMotors->isEmpty()): ?>
                    <div class="text-center py-10">
                        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-4 text-xl font-medium text-gray-900">Tidak ada motor yang menunggu verifikasi.</h3>
                        <p class="mt-1 text-sm text-gray-500">Anda dapat memverifikasi motor yang didaftarkan oleh pemilik di halaman ini.</p>
                    </div>
                    <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Motor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Pemilik
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Harga (/hari)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $pendingMotors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="transition-colors duration-150 hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" src="<?php echo e(asset($motor->photo_url)); ?>" alt="<?php echo e($motor->brand); ?>">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php echo e($motor->brand); ?> <?php echo e($motor->type_cc); ?>cc
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    <?php echo e($motor->plate_number); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php echo e($motor->owner->name); ?>

                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?php echo e($motor->owner->email); ?>

                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Rp <?php echo e(number_format($motor->price_day, 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu Verifikasi
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <!-- Dropdown Button - PERBAIKAN: ID unik per motor -->
                                        <button id="dropdownMenuIconButton-<?php echo e($motor->id); ?>"
                                            data-dropdown-toggle="dropdownDots-<?php echo e($motor->id); ?>"
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-full hover:bg-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown menu - PERBAIKAN: ID unik per motor -->
                                        <div id="dropdownDots-<?php echo e($motor->id); ?>"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownMenuIconButton-<?php echo e($motor->id); ?>">
                                                <li>
                                                    <button type="button"
                                                        data-modal-target="detail-modal-<?php echo e($motor->id); ?>"
                                                        data-modal-toggle="detail-modal-<?php echo e($motor->id); ?>"
                                                        class="detail-btn block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        Detail Motor
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button"
                                                        data-modal-target="set-price-modal-<?php echo e($motor->id); ?>"
                                                        data-modal-toggle="set-price-modal-<?php echo e($motor->id); ?>"
                                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        Setujui
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="py-2">
                                                <form action="<?php echo e(route('admin.verifikasi.reject', $motor->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit"
                                                        onclick="return confirm('Anda yakin akan menolak motor ini?');"
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <?php $__currentLoopData = $pendingMotors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div id="set-price-modal-<?php echo e($motor->id); ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-xl shadow-lg transform transition-all duration-300 ease-in-out scale-100 dark:bg-gray-800">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t-xl dark:border-gray-600">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        Tetapkan Harga Sewa
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition-colors duration-200" data-modal-toggle="set-price-modal-<?php echo e($motor->id); ?>">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <form action="<?php echo e(route('admin.verifikasi.approve', $motor->id)); ?>" method="POST" class="p-4 md:p-5">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="price_day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Harian</label>
                            <input type="number" name="price_day" min="1" id="price_day" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="price_week" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Mingguan</label>
                            <input type="number" name="price_week" id="price_week" min="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="price_month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Bulanan</label>
                            <input type="number" name="price_month" id="price_month" min="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors duration-200 dark:bg-purple-700 dark:hover:bg-purple-800 dark:focus:ring-purple-800">Simpan dan Setujui</button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Modal Detail untuk setiap motor -->
    <?php $__currentLoopData = $pendingMotors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!-- Detail Modal -->
    <div id="detail-modal-<?php echo e($motor->id); ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow-lg border border-gray-200">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Detail Motor - <?php echo e($motor->brand); ?> <?php echo e($motor->type_cc); ?>cc
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="detail-modal-<?php echo e($motor->id); ?>">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Foto Motor -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Foto Motor</h4>
                            <img class="w-full h-64 object-cover rounded-lg border border-gray-200" src="<?php echo e(asset($motor->photo_url)); ?>" alt="Foto Motor">
                        </div>

                        <!-- Foto STNK -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Foto STNK</h4>
                            <?php if($motor->dokumen_kepemilikan): ?>
                            <img class="w-full h-64 object-contain rounded-lg border border-gray-200 bg-gray-50" src="<?php echo e(asset($motor->dokumen_kepemilikan)); ?>" alt="Foto STNK" id="stnk-image-<?php echo e($motor->id); ?>">
                            <div class="mt-2 flex space-x-2">
                                <a href="<?php echo e(asset($motor->dokumen_kepemilikan)); ?>" download="STNK-<?php echo e($motor->plate_number); ?>.jpg" class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded">Lihat Dokumen (STNK/SIM)</a>
                            </div>
                            <?php else: ?>
                            <div class="w-full h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                                <span class="text-gray-500">Foto STNK tidak tersedia</span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Informasi Detail -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Informasi Motor</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Brand/Type :</span>
                                    <span class="font-medium"><?php echo e($motor->brand); ?> <?php echo e($motor->type_cc); ?>cc</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Plat Nomor :</span>
                                    <span class="font-medium"><?php echo e($motor->plate_number); ?></span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Informasi Pemilik</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nama :</span>
                                    <span class="font-medium"><?php echo e($motor->owner->name); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email :</span>
                                    <span class="font-medium"><?php echo e($motor->owner->email); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Telepon :</span>
                                    <span class="font-medium"><?php echo e($motor->owner->phone ?? '-'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button data-modal-hide="detail-modal-<?php echo e($motor->id); ?>" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script>
        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown-btn')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.add('hidden');
                    });
                }
            });

            // Toggle dropdown
            document.querySelectorAll('.dropdown-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdownMenu = this.nextElementSibling;

                    // Hide all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== dropdownMenu) {
                            menu.classList.add('hidden');
                        }
                    });

                    // Toggle current dropdown
                    dropdownMenu.classList.toggle('hidden');
                });
            });

            // Modal functionality
            window.toggleModal = function(modalId) {
                const modal = document.getElementById(modalId);
                modal.classList.toggle('hidden');
            };

            // Close modal when clicking outside
            document.querySelectorAll('[data-modal-hide]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const modalId = this.getAttribute('data-modal-hide');
                    const modal = document.getElementById(modalId);
                    modal.classList.add('hidden');
                });
            });
        });

        // Zoom functionality for STNK image
        function zoomImage(imageId) {
            const img = document.getElementById(imageId);
            if (img.classList.contains('zoom-in')) {
                img.classList.remove('zoom-in');
                img.classList.add('zoom-out');
                img.style.transform = 'scale(1)';
            } else {
                img.classList.remove('zoom-out');
                img.classList.add('zoom-in');
                img.style.transform = 'scale(1.5)';
            }
        }
    </script>
</body>

</html>
<?php /**PATH D:\PROJEK PROJEK\rental-motor\rental-motor\resources\views/admin/verifikasi-motor.blade.php ENDPATH**/ ?>