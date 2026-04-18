<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Motor - RMC</title>
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
    @include('partials.sidebar')
    <div class="flex-1 flex flex-col overflow-y-auto">
        <main class="flex-1">
            <div class="p-6">
                <div class="max-w-8xl p-6 bg-white rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-purple-800 mb-6">Cari dan Sewa Motor</h2>

                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <form action="{{ route('penyewa.cari-motor') }}" method="GET" class="flex flex-wrap md:flex-nowrap items-center gap-4">
                            <div class="flex-1 w-full md:w-auto">
                                <label for="brand_search" class="block text-sm font-medium text-gray-700">Cari Merk</label>
                                <input type="text" id="brand_search" name="brand" placeholder="e.g., Honda, Yamaha" class="mt-1 block w-full rounded-md" value="{{ request('brand') }}">
                            </div>

                            <div class="flex-1 w-full md:w-auto">
                                <label for="type_cc" class="block text-sm font-medium text-gray-700">Pilih Tipe (cc)</label>
                                <select id="type_cc" name="type_cc" class="mt-1 block w-full rounded-md">
                                    <option value="" {{ request('type_cc') == '' ? 'selected' : '' }}>Semua</option>
                                    <option value="100" {{ request('type_cc') == '100' ? 'selected' : '' }}>100cc</option>
                                    <option value="125" {{ request('type_cc') == '125' ? 'selected' : '' }}>125cc</option>
                                    <option value="150" {{ request('type_cc') == '150' ? 'selected' : '' }}>150cc</option>
                                </select>
                            </div>

                            <div class="flex-1 w-full md:w-auto">
                                <label for="price_range" class="block text-sm font-medium text-gray-700">Harga Harian</label>
                                <select id="price_range" name="price_range" class="mt-1 block w-full rounded-md">
                                    <option value="" {{ request('price_range') == '' ? 'selected' : '' }}>Semua Harga</option>
                                    <option value="<100000" {{ request('price_range') == '<100000' ? 'selected' : '' }}>
                                        < Rp 100.000 </option>
                                    <option value="100000-150000" {{ request('price_range') == '100000-150000' ? 'selected' : '' }}> Rp 100.000 - Rp 150.000 </option>
                                    <option value=">150000" {{ request('price_range') == '>150000' ? 'selected' : '' }}> > Rp 150.000 </option>
                                </select>
                            </div>

                            <div class="flex-1 w-full md:w-auto flex gap-2">
                                <button type="submit" class="w-full h-10 bg-purple-600 text-white rounded-md font-semibold hover:bg-purple-500 transition-colors duration-200">
                                    Cari
                                </button>
                                <button type="button" onclick="resetFilter()" class="w-full h-10 bg-gray-400 text-white rounded-md font-semibold hover:bg-gray-500 transition-colors duration-200">
                                    Reset
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse ($motors as $motor)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <img class="w-full h-48 object-cover" src="{{ asset($motor->photo_url) }}" alt="{{ $motor->brand }}">
                            <div class="p-4">
                                <h4 class="text-xl font-bold text-gray-900">{{ $motor->brand }}</h4>
                                <p class="text-gray-500 mt-1">Tipe : {{ $motor->type_cc }}cc</p>
                                <p class="text-gray-500">Plat : {{ $motor->plate_number }}</p>
                                <p class="text-gray-500 text-sm mt-1">
                                    @if($motor->bookings_count > 0)
                                    Sudah disewa {{ $motor->bookings_count }} kali
                                    @else
                                    Belum pernah disewa
                                    @endif
                                </p>

                                <button type="button"
                                    class="mt-4 inline-block w-full bg-purple-600 text-white text-center py-2 rounded-lg font-semibold hover:bg-purple-500 transition-colors duration-200"
                                    data-motor-id="{{ $motor->id }}"
                                    data-motor-brand="{{ $motor->brand }}"
                                    data-motor-type="{{ $motor->type_cc }}"
                                    data-motor-plate="{{ $motor->plate_number }}"
                                    data-motor-photo="{{ asset($motor->photo_url) }}"
                                    data-motor-harian="{{ $motor->rentalRates->harian ?? 0 }}"
                                    data-motor-mingguan="{{ $motor->rentalRates->mingguan ?? 0 }}"
                                    data-motor-bulanan="{{ $motor->rentalRates->bulanan ?? 0 }}"
                                    onclick="openBookingModal(this)">
                                    Sewa Sekarang
                                </button>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24 mx-auto text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                            </svg>
                            <p class="text-gray-600 text-lg font-medium mt-4">Tidak ada data motor yang tersedia.</p>
                        </div>
                        @endforelse
                    </div>

                    <div id="booking-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeBookingModal()"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                                <div class="bg-white p-6 sm:p-8">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 w-full sm:mt-0 sm:text-left">
                                            <h3 class="text-2xl font-bold text-gray-900 border-b pb-4 mb-4" id="modal-title">
                                                Detail Pemesanan
                                            </h3>
                                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                                                <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
                                                    <img id="modal-motor-photo" class="h-auto rounded-lg mb-4 shadow-md" src="" alt="Foto Motor">
                                                </div>

                                                <div class="p-4 bg-gray-50 rounded-lg shadow-inner">
                                                    <h4 id="modal-motor-brand" class="text-xl font-bold text-gray-800 mb-1"></h4>
                                                    <p id="modal-motor-plate" class="text-gray-500 text-sm mb-4"></p>
                                                    <div class="space-y-3">
                                                        <div>
                                                            <h5 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Harga Sewa</h5>
                                                            <ul class="list-none space-y-1 mt-1 text-gray-700">
                                                                <li class="flex items-center gap-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h8M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                    </svg>
                                                                    <span class="font-medium">Harian :</span> Rp <span id="modal-harian-rate"></span>
                                                                </li>
                                                                <li class="flex items-center gap-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h8M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                    </svg>
                                                                    <span class="font-medium">Mingguan :</span> Rp <span id="modal-mingguan-rate"></span>
                                                                </li>
                                                                <li class="flex items-center gap-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h8M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                    </svg>
                                                                    <span class="font-medium">Bulanan :</span> Rp <span id="modal-bulanan-rate"></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form id="booking-form" action="" method="POST" class="mt-6 p-4 border rounded-lg shadow-md">
                                                @csrf
                                                <input type="hidden" name="motor_id" id="modal-motor-id">

                                                <div class="mb-4">
                                                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" required class="mt-1 block w-full rounded-md shadow-sm">
                                                </div>

                                                <div class="mb-4">
                                                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" required class="mt-1 block w-full rounded-md shadow-sm">
                                                </div>

                                                <div class="mb-4">
                                                    <label for="duration_type" class="block text-sm font-medium text-gray-700">Tipe Durasi</label>
                                                    <select id="duration_type" name="duration_type" required class="mt-1 block w-full rounded-md shadow-sm">
                                                        <option value="daily">Harian</option>
                                                        <option value="weekly">Mingguan</option>
                                                        <option value="monthly">Bulanan</option>
                                                    </select>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700">Total Harga</label>
                                                    <input type="hidden" id="price-input" name="total_biaya">
                                                    <p id="total-price" class="text-xl font-extrabold text-purple-600 mt-1">Rp 0</p>
                                                </div>

                                                <button type="submit" class="w-full py-3 px-4 rounded-lg shadow-md text-sm font-bold text-white bg-purple-600 hover:bg-purple-700 transition-colors duration-200">
                                                    Pesan Sekarang
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-100 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeBookingModal()">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        // script untuk form pemesanan
        function formatDate(date) {
            const d = new Date(date);
            let month = '' + (d.getMonth() + 1);
            let day = '' + d.getDate();
            const year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }

        // Fungsi untuk menghitung total harga
        function calculateTotalPrice() {
            const startDate = new Date(document.getElementById('tanggal_mulai').value);
            const endDate = new Date(document.getElementById('tanggal_selesai').value);
            const durationType = document.getElementById('duration_type').value;

            // Handle invalid dates
            if (!startDate || !endDate || startDate >= endDate || isNaN(startDate) || isNaN(endDate)) {
                document.getElementById('total-price').textContent = 'Rp 0';
                document.getElementById('price-input').value = 0;
                return;
            }

            // Hitung selisih hari
            const diffTime = endDate.getTime() - startDate.getTime();
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            // Handle case where rates are not numbers
            let harianRate, mingguanRate, bulananRate;

            try {
                harianRate = parseFloat(document.getElementById('modal-harian-rate').textContent.replace(/[^\d]/g, ''));
                mingguanRate = parseFloat(document.getElementById('modal-mingguan-rate').textContent.replace(/[^\d]/g, ''));
                bulananRate = parseFloat(document.getElementById('modal-bulanan-rate').textContent.replace(/[^\d]/g, ''));
            } catch (e) {
                document.getElementById('total-price').textContent = 'Rp 0';
                document.getElementById('price-input').value = 0;
                return;
            }

            // Ensure rates are valid numbers
            if (isNaN(harianRate)) harianRate = 0;
            if (isNaN(mingguanRate)) mingguanRate = 0;
            if (isNaN(bulananRate)) bulananRate = 0;

            let rate = 0;
            switch (durationType) {
                case 'daily':
                    rate = harianRate;
                    break;
                case 'weekly':
                    rate = mingguanRate;
                    break;
                case 'monthly':
                    rate = bulananRate;
                    break;
            }

            // Hitung total biaya
            let totalPrice = 0;
            switch (durationType) {
                case 'daily':
                    totalPrice = rate * diffDays;
                    break;
                case 'weekly':
                    totalPrice = rate * Math.ceil(diffDays / 7);
                    break;
                case 'monthly':
                    totalPrice = rate * Math.ceil(diffDays / 30);
                    break;
            }

            // Update tampilan
            document.getElementById('total-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
            document.getElementById('price-input').value = totalPrice;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('tanggal_mulai');
            const endDateInput = document.getElementById('tanggal_selesai'); // PERBAIKAN
            const durationTypeSelect = document.getElementById('duration_type');
            const allDurationOptions = durationTypeSelect.querySelectorAll('option');

            // 1. Atur tanggal mulai default dan tanggal minimal hari ini
            const today = new Date();
            const formattedToday = formatDate(today);
            startDateInput.value = formattedToday;
            startDateInput.min = formattedToday;

            // 2. Atur tanggal minimal untuk tanggal selesai (besok)
            const tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);
            endDateInput.min = formatDate(tomorrow);
            endDateInput.value = formatDate(tomorrow); // Set default ke besok

            // Fungsi untuk mengupdate batasan tanggal selesai dan opsi durasi
            // Fungsi untuk mengupdate batasan tanggal selesai dan opsi durasi
            function updateDateAndDuration() {
                // Atur tanggal minimal untuk tanggal selesai (hari setelah tanggal mulai)
                const startDay = new Date(startDateInput.value);
                const minEndDate = new Date(startDay);
                minEndDate.setDate(startDay.getDate() + 1);
                endDateInput.min = formatDate(minEndDate);

                // Jika tanggal selesai kurang dari tanggal minimal, atur ke tanggal minimal
                if (endDateInput.value && new Date(endDateInput.value) < minEndDate) {
                    endDateInput.value = formatDate(minEndDate);
                }

                // Hitung selisih hari
                const startDateValue = new Date(startDateInput.value);
                const endDateValue = new Date(endDateInput.value);

                // Pastikan tanggal selesai lebih besar dari tanggal mulai
                if (endDateValue <= startDateValue) {
                    // Reset ke minimal jika tidak valid
                    const newEndDate = new Date(startDateValue);
                    newEndDate.setDate(startDateValue.getDate() + 1);
                    endDateInput.value = formatDate(newEndDate);
                    return;
                }

                // PERBAIKAN: Panggil fungsi updateDurationOptions
                updateDurationOptions();
            }

            // Fungsi untuk mengupdate opsi durasi berdasarkan selisih tanggal
            function updateDurationOptions() {
                const startDate = new Date(document.getElementById('tanggal_mulai').value);
                const endDate = new Date(document.getElementById('tanggal_selesai').value);
                const durationTypeSelect = document.getElementById('duration_type');

                if (!startDate || !endDate || startDate >= endDate || isNaN(startDate) || isNaN(endDate)) {
                    // Reset ke default jika tanggal belum lengkap atau invalid
                    resetDurationOptions();
                    return;
                }

                // Hitung selisih hari
                const diffTime = endDate.getTime() - startDate.getTime();
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // Simpan semua opsi asli (jika belum disimpan)
                if (!window.originalDurationOptions) {
                    window.originalDurationOptions = durationTypeSelect.innerHTML;
                }

                // Bersihkan dropdown
                durationTypeSelect.innerHTML = '';

                // Tambahkan opsi berdasarkan kondisi
                if (diffDays < 7) {
                    // Kurang dari 7 hari: hanya Harian
                    durationTypeSelect.innerHTML = '<option value="daily">Harian</option>';
                } else if (diffDays >= 7 && diffDays < 30) {
                    // 7-29 hari: Harian dan Mingguan
                    durationTypeSelect.innerHTML = `
            <option value="daily">Harian</option>
            <option value="weekly">Mingguan</option>
        `;
                } else {
                    // 30 hari atau lebih: Semua opsi
                    durationTypeSelect.innerHTML = window.originalDurationOptions;
                }

                // Set nilai default berdasarkan kondisi
                if (diffDays < 7) {
                    durationTypeSelect.value = 'daily';
                } else if (diffDays >= 7 && diffDays < 30) {
                    durationTypeSelect.value = 'weekly'; // Default mingguan untuk rentang ini
                } else {
                    durationTypeSelect.value = 'monthly'; // Default bulanan untuk rentang panjang
                }

                // Hitung ulang harga setelah perubahan
                calculateTotalPrice();
            }

            // Fungsi untuk reset opsi durasi ke default
            function resetDurationOptions() {
                const durationTypeSelect = document.getElementById('duration_type');
                if (window.originalDurationOptions) {
                    durationTypeSelect.innerHTML = window.originalDurationOptions;
                }
                durationTypeSelect.value = 'daily';
            }

            // Event listeners
            // Event listeners - GANTI yang sudah ada dengan ini
            document.getElementById('tanggal_mulai').addEventListener('change', function() {
                updateDateAndDuration();
                updateDurationOptions(); // Tambahkan ini
                calculateTotalPrice();
            });

            document.getElementById('tanggal_selesai').addEventListener('change', function() {
                updateDateAndDuration();
                updateDurationOptions(); // Tambahkan ini
                calculateTotalPrice();
            });

            document.getElementById('duration_type').addEventListener('change', calculateTotalPrice);

            // Panggil saat halaman dimuat pertama kali
            updateDateAndDuration();
        });

        // Fungsi untuk membuka modal booking
        function openBookingModal(button) {
            try {
                console.log('Opening booking modal...');

                // Ambil data dari data attributes
                const motorId = button.getAttribute('data-motor-id');
                const motorBrand = button.getAttribute('data-motor-brand');
                const motorType = button.getAttribute('data-motor-type');
                const motorPlate = button.getAttribute('data-motor-plate');
                let motorPhoto = button.getAttribute('data-motor-photo'); // gunakan let bukan const
                const motorHarian = button.getAttribute('data-motor-harian');
                const motorMingguan = button.getAttribute('data-motor-mingguan');
                const motorBulanan = button.getAttribute('data-motor-bulanan');

                console.log('Original Motor Photo URL:', motorPhoto);

                // PERBAIKAN: Fix URL path yang salah
                if (motorPhoto.includes('/penyewa/storage/')) {
                    motorPhoto = motorPhoto.replace('/penyewa/storage/', '/storage/');
                    console.log('Fixed Motor Photo URL:', motorPhoto);
                }

                // PERBAIKAN: Jika URL relative, tambahkan domain
                if (motorPhoto.startsWith('/')) {
                    motorPhoto = window.location.origin + motorPhoto;
                    console.log('Absolute Motor Photo URL:', motorPhoto);
                }

                // Isi data modal
                document.getElementById('modal-motor-id').value = motorId;

                // PERBAIKAN: Set gambar dengan error handling
                const photoElement = document.getElementById('modal-motor-photo');

                // PERBAIKAN: Gunakan approach yang lebih reliable
                // Coba load gambar dulu, jika gagal gunakan default
                const testImage = new Image();
                testImage.onload = function() {
                    // Jika gambar berhasil dimuat, set ke modal
                    photoElement.src = motorPhoto;
                };
                testImage.onerror = function() {
                    // Jika gambar gagal dimuat, gunakan default
                    console.log('Gambar gagal dimuat, menggunakan default');
                    photoElement.src = '/images/default-motor.jpg';
                };
                testImage.src = motorPhoto; // Test load gambar

                photoElement.alt = `${motorBrand} ${motorType}cc`;

                document.getElementById('modal-motor-brand').textContent = `${motorBrand} ${motorType}cc`;
                document.getElementById('modal-motor-plate').textContent = `Plat : ${motorPlate}`;

                // PERBAIKAN: Format harga dengan handling NaN
                const harian = parseInt(motorHarian) || 0;
                const mingguan = parseInt(motorMingguan) || 0;
                const bulanan = parseInt(motorBulanan) || 0;

                document.getElementById('modal-harian-rate').textContent = harian.toLocaleString('id-ID');
                document.getElementById('modal-mingguan-rate').textContent = mingguan.toLocaleString('id-ID');
                document.getElementById('modal-bulanan-rate').textContent = bulanan.toLocaleString('id-ID');

                // PERBAIKAN: Update form action - pastikan route benar
                const form = document.getElementById('booking-form');
                form.action = "/penyewa/pemesanan/" + motorId;

                // Set tanggal default
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);

                document.getElementById('tanggal_mulai').value = formatDate(today);
                document.getElementById('tanggal_selesai').value = formatDate(tomorrow);
                document.getElementById('duration_type').value = 'daily';

                setTimeout(() => {
                    updateDurationOptions(); // Update opsi durasi berdasarkan tanggal default
                    calculateTotalPrice(); // Hitung harga awal
                }, 100);

                // Tampilkan modal
                document.getElementById('booking-modal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                // Hitung harga awal
                setTimeout(() => {
                    calculateTotalPrice();
                }, 100);

            } catch (error) {
                console.error('Error opening booking modal:', error);
                alert('Terjadi kesalahan saat membuka form pemesanan.');
            }
        }

        // PERBAIKAN: Tambahkan juga event listener untuk error handling pada gambar modal
        document.addEventListener('DOMContentLoaded', function() {
            const photoElement = document.getElementById('modal-motor-photo');
            if (photoElement) {
                photoElement.addEventListener('error', function() {
                    console.log('Gambar modal gagal dimuat, menggunakan default');
                    this.src = '/images/default-motor.jpg';
                });
            }
        });

        //Tambahkan event listener untuk error handling gambar saat halaman load
        document.addEventListener('DOMContentLoaded', function() {
            const photoElement = document.getElementById('modal-motor-photo');
            if (photoElement) {
                photoElement.onerror = function() {
                    console.log('Gambar gagal dimuat, menggunakan default');
                    this.src = '/images/default-motor.jpg';
                    this.alt = 'Default Motor Image';
                };
            }
        });

        function closeBookingModal() {
            const modal = document.getElementById('booking-modal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function resetFilter() {
            window.location.href = "{{ route('penyewa.cari-motor') }}";
        }
    </script>
</body>

</html>