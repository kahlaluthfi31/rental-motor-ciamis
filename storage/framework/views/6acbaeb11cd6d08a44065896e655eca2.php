<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - RMC By Kahla Luthfiyah Halim</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- cdn flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <!-- end cdn flowbite -->
    <!-- untuk font poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 flex h-screen overflow-hidden">
    <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="flex-1 flex flex-col overflow-y-auto">
        <main class="flex-1">
            <div class="p-6">
                <div class="w-full p-6 bg-white rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-purple-800 mb-6">Pemesanan</h2>
                    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
                        <?php if($allBookings->isEmpty()): ?>
                        <div class="text-center py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 mx-auto text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada riwayat pemesanan.</h3>
                            <p class="mt-1 text-sm text-gray-500">Silakan sewa motor untuk melihat riwayat pemesanan di sini.</p>
                        </div>
                        <?php else: ?>
                        <!-- TAMBAHKAN FILTER STATUS -->
                        <div class="mb-4 flex space-x-2">
                            <span class="text-sm font-medium text-gray-700">Filter Status :</span>
                            <button class="status-filter px-2 py-1 text-xs rounded bg-gray-200" data-status="all">Semua</button>
                            <button class="status-filter px-2 py-1 text-xs rounded bg-yellow-100" data-status="pending">Menunggu</button>
                            <button class="status-filter px-2 py-1 text-xs rounded bg-green-100" data-status="disetujui">Disetujui</button>
                            <button class="status-filter px-2 py-1 text-xs rounded bg-blue-100" data-status="selesai">Selesai</button>
                            <button class="status-filter px-2 py-1 text-xs rounded bg-red-100" data-status="dibatalkan">Dibatalkan</button>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Motor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Periode Sewa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $allBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="booking-row" data-status="<?php echo e($booking->status); ?>">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <?php if($booking->motor): ?>
                                                <img class="h-10 w-10 rounded-full" src="<?php echo e(asset($booking->motor->photo_url)); ?>" alt="">
                                                <?php else: ?>
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-xs text-gray-500">No Image</span>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php if($booking->motor): ?>
                                                    <?php echo e($booking->motor->brand); ?> <?php echo e($booking->motor->type_cc); ?>cc
                                                    <?php else: ?>
                                                    Motor tidak ditemukan
                                                    <?php endif; ?>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    <?php if($booking->motor): ?>
                                                    <?php echo e($booking->motor->plate_number); ?>

                                                    <?php else: ?>
                                                    -
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo e(\Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y')); ?> - <?php echo e(\Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Rp <?php echo e(number_format($booking->total_biaya, 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if($booking->status == 'pending'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu Pembayaran
                                        </span>
                                        <?php elseif($booking->status == 'disetujui'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Disetujui
                                        </span>
                                        <?php elseif($booking->status == 'selesai'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Selesai
                                        </span>
                                        <?php elseif($booking->status == 'dibatalkan'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Dibatalkan
                                        </span>
                                        <?php else: ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            <?php echo e($booking->status); ?>

                                        </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <?php if($booking->status == 'pending'): ?>
                                        <form action="<?php echo e(route('penyewa.cancelBooking', $booking->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-900">Batal</button>
                                        </form>
                                        <?php else: ?>
                                        <span class="text-gray-400">-</span>
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
    <script>
        // Filter status booking
        document.querySelectorAll('.status-filter').forEach(button => {
            button.addEventListener('click', function() {
                const status = this.getAttribute('data-status');

                // Update button styles
                document.querySelectorAll('.status-filter').forEach(btn => {
                    btn.classList.remove('bg-indigo-600', 'text-white');
                    btn.classList.add('bg-gray-200');
                });
                this.classList.remove('bg-gray-200');
                this.classList.add('bg-indigo-600', 'text-white');

                // Filter rows
                document.querySelectorAll('.booking-row').forEach(row => {
                    if (status === 'all') {
                        row.style.display = '';
                    } else {
                        row.style.display = row.getAttribute('data-status') === status ? '' : 'none';
                    }
                });
            });
        });
    </script>
    <script>
        const startDateInput = document.getElementById('tanggal_mulai');
        const endDateInput = document.getElementById('tanggal_selesai');
        const durationTypeSelect = document.getElementById('duration_type');
        const totalPriceElement = document.getElementById('total-price');
        const priceInputElement = document.getElementById('price-input');

        // Ambil elemen yang berisi atribut data
        const motorRatesElement = document.getElementById('motor-rates');

        const rates = {
            harian: parseFloat(motorRatesElement.dataset.harian),
            mingguan: parseFloat(motorRatesElement.dataset.mingguan),
            bulanan: parseFloat(motorRatesElement.dataset.bulanan),
        };

        function calculateTotalPrice() {
            // ... Logika perhitungan harga tetap sama ...
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const durationType = durationTypeSelect.value;

            if (!startDate || !endDate || startDate > endDate) {
                totalPriceElement.textContent = 'Rp 0';
                priceInputElement.value = 0;
                return;
            }

            const oneDay = 1000 * 60 * 60 * 24;
            const diffInTime = endDate.getTime() - startDate.getTime();
            const diffInDays = Math.round(diffInTime / oneDay) + 1;

            let total = 0;

            if (durationType === 'harian') {
                total = diffInDays * rates.harian;
            } else if (durationType === 'mingguan') {
                const weeks = Math.ceil(diffInDays / 7);
                total = weeks * rates.mingguan;
            } else if (durationType === 'bulanan') {
                const months = Math.ceil(diffInDays / 30);
                total = months * rates.bulanan;
            }

            totalPriceElement.textContent = 'Rp ' + total.toLocaleString('id-ID');
            priceInputElement.value = total;
        }

        startDateInput.addEventListener('change', calculateTotalPrice);
        endDateInput.addEventListener('change', calculateTotalPrice);
        durationTypeSelect.addEventListener('change', calculateTotalPrice);
    </script>
</body>

</html><?php /**PATH D:\PROJEK PROJEK\rental-motor\rental-motor\resources\views/penyewa/pemesanan.blade.php ENDPATH**/ ?>