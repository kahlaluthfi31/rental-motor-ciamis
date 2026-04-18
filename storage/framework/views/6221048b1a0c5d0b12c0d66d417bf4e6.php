<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RMC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <!-- Header Section -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-bold text-purple-800">Dashboard Admin</h2>
                </div>

                <!-- Metrics Cards Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Motor Card -->
                    <div class="bg-white text-gray-900 p-6 rounded-xl shadow-lg border-l-4 border-blue-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xl font-bold"><?php echo e($totalMotors); ?></div>
                                <div class="text-sm text-gray-600 font-medium tracking-wide mt-1">Total Motor</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-motorbike w-12 h-12 text-blue-400">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M19 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M7.5 14h5l4 -4h-10.5m1.5 4l4 -4" />
                                <path d="M13 6h2l1.5 3l2 4" />
                            </svg>
                        </div>
                    </div>

                    <!-- Pending Bookings Card -->
                    <div class="bg-white text-gray-900 p-6 rounded-xl shadow-lg border-l-4 border-green-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xl font-bold"><?php echo e($pendingBookingsCount); ?></div>
                                <div class="text-sm text-gray-600 font-medium tracking-wide mt-1">Pemesanan Baru</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-green-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Total Revenue Card -->
                    <div class="bg-white text-gray-900 p-6 rounded-xl shadow-lg border-l-4 border-yellow-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xl font-bold">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></div>
                                <div class="text-sm text-gray-600 font-medium tracking-wide mt-1">Total Pendapatan</div>
                            </div>
                            <svg class="w-12 h-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Pending Verifications Card -->
                    <div class="bg-white text-gray-900 p-6 rounded-xl shadow-lg border-l-4 border-red-500 transform transition-transform duration-300 hover:scale-[1.02]">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xl font-bold"><?php echo e($pendingVerificationsCount); ?></div>
                                <div class="text-sm text-gray-600 font-medium tracking-wide mt-1">Verifikasi Motor</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- CHART SECTION -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-purple-800">Grafik Penyewaan</h3>
                        <div class="flex space-x-4 items-center">
                            <!-- Dropdown Tahun -->
                            <div class="flex items-center space-x-2">
                                <label class="text-sm text-gray-600">Tahun :</label>
                                <select id="yearFilter" class="w-32 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-200">
                                    <option value="">Loading...</option>
                                </select>
                            </div>

                            <!-- Dropdown Bulan (hanya tampil untuk periode harian) -->
                            <div class="flex items-center space-x-2" id="monthFilterContainer" style="display: none;">
                                <label class="text-sm text-gray-600">Bulan :</label>
                                <select id="monthFilter" class="w-40 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-200">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>

                            <!-- Button Periode -->
                            <div class="flex space-x-2">
                                <button onclick="changePeriod('daily')" class="period-btn bg-purple-100 text-purple-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-200 transition">Harian</button>
                                <button onclick="changePeriod('weekly')" class="period-btn bg-white text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">Mingguan</button>
                                <button onclick="changePeriod('monthly')" class="period-btn bg-white text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">Bulanan</button>
                            </div>
                        </div>
                    </div>

                    <div class="chart-container" style="height: 400px;">
                        <canvas id="rentalChart"></canvas>
                    </div>

                    <!-- PERBANDINGAN SECTION - BARU -->
                    <div id="comparisonSection" class="mt-8 p-6 bg-gray-50 rounded-lg border border-gray-200" style="display: none;">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Perbandingan Penyewaan</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Penyewaan Tertinggi -->
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    <span class="text-green-800 font-semibold">Penyewaan Tertinggi</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span id="highestPeriodLabel" class="text-gray-600">-</span>
                                    <span id="highestRentalCount" class="text-2xl font-bold text-green-700">0</span>
                                </div>
                            </div>

                            <!-- Penyewaan Terendah -->
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                    <span class="text-red-800 font-semibold">Penyewaan Terendah</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span id="lowestPeriodLabel" class="text-gray-600">-</span>
                                    <span id="lowestRentalCount" class="text-2xl font-bold text-red-700">0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                            <div class="text-center">
                                <span class="font-semibold">Total Penyewaan :</span>
                                <span id="totalRentals" class="ml-1">0</span>
                            </div>
                            <div class="text-center">
                                <span class="font-semibold">Rata-rata :</span>
                                <span id="averageRentals" class="ml-1">0</span>
                            </div>
                            <div class="text-center">
                                <span class="font-semibold">Periode Aktif :</span>
                                <span id="activePeriods" class="ml-1">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <h3 class="text-lg font-bold text-purple-800 mb-4">Motor Menunggu Verifikasi</h3>
                    <div class="overflow-x-auto">
                        <?php if($pendingVerifications->isEmpty()): ?>
                        <div class="text-center py-10 text-gray-500 text-base">
                            <p>Tidak ada motor yang menunggu verifikasi saat ini.</p>
                        </div>
                        <?php else: ?>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Motor</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pemilik</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Didaftarkan</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $pendingVerifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="transition-colors duration-150 hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <img class="w-full h-full rounded-full object-cover" src="<?php echo e(asset($motor->photo_url)); ?>" alt="Motor Image">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900"><?php echo e($motor->brand); ?> <?php echo e($motor->type_cc); ?>cc</div>
                                                <div class="text-xs text-gray-500"><?php echo e($motor->plate_number); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo e($motor->owner->name); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo e($motor->owner->email); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <?php echo e($motor->created_at->format('d M Y')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="<?php echo e(route('admin.verifikasi-motor')); ?>" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-full shadow-sm hover:bg-indigo-700 transition-colors duration-200">
                                            Verifikasi
                                        </a>
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
        let rentalChart;
        let currentPeriod = 'daily';
        let currentYear = new Date().getFullYear();
        let currentMonth = new Date().getMonth() + 1;
        let availableYears = [];
        let currentChartData = {
            labels: [],
            data: []
        };

        function getMonthName(monthNumber) {
            const months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            // Pastikan monthNumber adalah number
            const monthNum = parseInt(monthNumber);
            return months[monthNum - 1] || 'Unknown';
        }

        // Function untuk update perbandingan
        function updateComparisonSection(labels, data, period, year, month) {
            const comparisonSection = document.getElementById('comparisonSection');

            // Sembunyikan jika tidak ada data
            if (data.length === 0 || data.every(item => item === 0)) {
                comparisonSection.style.display = 'none';
                return;
            }

            // Tampilkan section
            comparisonSection.style.display = 'block';

            // Cari nilai tertinggi dan terendah
            let maxIndex = 0;
            let minIndex = 0;
            let total = 0;
            let activePeriods = 0;

            for (let i = 0; i < data.length; i++) {
                if (data[i] > data[maxIndex]) maxIndex = i;
                if (data[i] < data[minIndex]) minIndex = i;
                total += data[i];
                if (data[i] > 0) activePeriods++;
            }

            // Format label berdasarkan periode
            function formatPeriodLabel(label, periodType) {
                console.log('Formatting label:', {
                    label,
                    periodType,
                    type: typeof label
                });

                switch (periodType) {
                    case 'daily':
                        return formatDailyLabel(label, year, month);
                    case 'weekly':
                        return `${label}`;
                    case 'monthly':
                        // Handle kedua format: angka (1-12) atau string ("Jan 2024")
                        let monthNum;
                        if (typeof label === 'number') {
                            monthNum = label;
                        } else if (typeof label === 'string') {
                            // Extract angka bulan dari string seperti "Jan 2024"
                            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                            ];
                            const monthAbbr = label.split(' ')[0]; // Ambil "Jan" dari "Jan 2024"
                            monthNum = monthNames.indexOf(monthAbbr) + 1;
                            if (monthNum === 0) monthNum = parseInt(label); // Fallback
                        } else {
                            monthNum = parseInt(label);
                        }
                        console.log('Parsed month number:', monthNum);
                        return getMonthName(monthNum);
                    default:
                        return label;
                }
            }

            function formatDailyLabel(dayLabel, year, month) {
                // Asumsi dayLabel format: "1", "2", etc.
                const day = parseInt(dayLabel);
                const monthName = getMonthName(month);
                return `${day} ${monthName} ${year}`;
            }

            function getMonthName(monthNumber) {
                const months = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                return months[monthNumber - 1] || 'Unknown';
            }

            // Update UI
            document.getElementById('highestPeriodLabel').textContent =
                formatPeriodLabel(labels[maxIndex], period);
            document.getElementById('highestRentalCount').textContent = data[maxIndex];

            document.getElementById('lowestPeriodLabel').textContent =
                formatPeriodLabel(labels[minIndex], period);
            document.getElementById('lowestRentalCount').textContent = data[minIndex];

            document.getElementById('totalRentals').textContent = total;
            document.getElementById('averageRentals').textContent = Math.round(total / data.length * 10) / 10;
            document.getElementById('activePeriods').textContent = `${activePeriods} dari ${data.length} periode`;

            // Update title section berdasarkan periode
            const periodLabels = {
                'daily': 'Harian',
                'weekly': 'Mingguan',
                'monthly': 'Bulanan'
            };

            const monthName = period === 'daily' ? ` - ${getMonthName(month)}` : '';
            document.querySelector('#comparisonSection h4').textContent =
                `Perbandingan Penyewaan ${periodLabels[period]} ${year}${monthName}`;
        }

        // Load available years
        async function loadAvailableYears() {
            try {
                console.log('Loading available years...');
                const response = await fetch('/admin/available-years');

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                availableYears = await response.json();
                console.log('Available years loaded:', availableYears);

                const yearFilter = document.getElementById('yearFilter');
                yearFilter.innerHTML = '';

                if (availableYears.length === 0) {
                    availableYears = [currentYear];
                }

                availableYears.forEach(year => {
                    const option = document.createElement('option');
                    option.value = year;
                    option.textContent = year;
                    option.selected = year == currentYear;
                    yearFilter.appendChild(option);
                });

            } catch (error) {
                console.error('Error loading years:', error);
                // Fallback ke tahun sekarang jika error
                const yearFilter = document.getElementById('yearFilter');
                yearFilter.innerHTML = `<option value="${currentYear}" selected>${currentYear}</option>`;
                availableYears = [currentYear];
            }
        }

        // Function untuk fetch data dari API
        async function fetchChartData(period, year, month) {
            try {
                const url = `/admin/chart-data?period=${period}&year=${year}&month=${month}`;
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                return result;
            } catch (error) {
                console.error('Error fetching chart data:', error);
                return {
                    success: false,
                    error: error.message,
                    labels: [],
                    data: []
                };
            }
        }

        // Function untuk initialize chart
        async function initChart(period = 'daily', year = null, month = null) {
            if (!year) year = currentYear;
            if (!month) month = currentMonth;

            const chartData = await fetchChartData(period, year, month);

            const ctx = document.getElementById('rentalChart').getContext('2d');

            // Destroy existing chart
            if (rentalChart) {
                rentalChart.destroy();
            }

            // Check if we have valid data
            if (!chartData.success || !chartData.labels || !chartData.data) {
                showEmptyChart(ctx, period, year, 'Data tidak tersedia atau terjadi error');
                updateComparisonSection([], [], period, year, month);
                return;
            }

            if (chartData.data.length === 0 || chartData.data.every(item => item === 0)) {
                showEmptyChart(ctx, period, year, 'Tidak ada data penyewaan untuk periode ini');
                updateComparisonSection([], [], period, year, month);
                return;
            }

            console.log('Creating chart with data:', {
                labels: chartData.labels,
                data: chartData.data
            });

            // Simpan data untuk perbandingan
            currentChartData = {
                labels: chartData.labels,
                data: chartData.data
            };

            // Update section perbandingan
            updateComparisonSection(chartData.labels, chartData.data, period, year, month);

            // Create the actual chart
            rentalChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: `Jumlah Penyewaan (${getPeriodLabel(period)} - ${year})`,
                        data: chartData.data,
                        borderColor: '#8B5CF6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#7C3AED',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: '#6B7280',
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(107, 114, 128, 0.1)'
                            },
                            ticks: {
                                color: '#6B7280',
                                stepSize: 1
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Penyewaan',
                                color: '#6B7280'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(107, 114, 128, 0.1)'
                            },
                            ticks: {
                                color: '#6B7280',
                                maxTicksLimit: period === 'monthly' ? 12 : 10
                            }
                        }
                    }
                }
            });
        }

        // Show empty chart with message
        function showEmptyChart(ctx, period, year, message) {
            rentalChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [message],
                    datasets: [{
                        label: `Tidak ada data (${getPeriodLabel(period)} - ${year})`,
                        data: [0],
                        borderColor: '#D1D5DB',
                        backgroundColor: 'rgba(209, 213, 219, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        pointBackgroundColor: '#9CA3AF'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            display: false
                        },
                        x: {
                            display: false
                        }
                    }
                }
            });
        }

        // Helper function untuk label periode
        function getPeriodLabel(period) {
            const labels = {
                'daily': 'Harian',
                'weekly': 'Mingguan',
                'monthly': 'Bulanan'
            };
            return labels[period] || period;
        }

        // Function untuk ganti periode
        async function changePeriod(period) {
            currentPeriod = period;

            // Update button styles
            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.classList.remove('bg-purple-100', 'text-purple-800');
                btn.classList.add('bg-white', 'text-gray-700');
            });

            event.target.classList.add('bg-purple-100', 'text-purple-800');
            event.target.classList.remove('bg-white', 'text-gray-700');

            // Tampilkan/sembunyikan filter bulan
            const monthFilterContainer = document.getElementById('monthFilterContainer');
            if (period === 'daily') {
                monthFilterContainer.style.display = 'flex';
            } else {
                monthFilterContainer.style.display = 'none';
            }

            // Update chart
            await initChart(period, currentYear, currentMonth);
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            loadAvailableYears().then(() => {
                setTimeout(() => {
                    initChart();
                }, 100);
            });

            // Tahun berubah
            document.getElementById('yearFilter').addEventListener('change', function() {
                currentYear = parseInt(this.value);
                console.log('Year changed to:', currentYear);
                initChart(currentPeriod, currentYear, currentMonth);
            });

            // Bulan berubah
            document.getElementById('monthFilter').addEventListener('change', function() {
                currentMonth = parseInt(this.value);
                console.log('Month changed to:', currentMonth);
                if (currentPeriod === 'daily') {
                    initChart(currentPeriod, currentYear, currentMonth);
                }
            });

            // Set default values
            document.getElementById('monthFilter').value = currentMonth;
        });

        // Error boundary
        window.addEventListener('error', function(e) {
            console.error('Global error:', e.error);
        });
    </script>
</body>

</html><?php /**PATH D:\PROJEK PROJEK\rental-motor\rental-motor\resources\views/admin/dashboard-admin.blade.php ENDPATH**/ ?>