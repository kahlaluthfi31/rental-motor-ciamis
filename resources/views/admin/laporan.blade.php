<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - RMC</title>
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
                <div class="max-w-7xl mx-auto my-5 p-6 bg-white rounded-lg shadow-md">
                    <!-- Ganti bagian h1 menjadi seperti ini: -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-lg font-bold text-purple-800">Laporan & Pendapatan</h1>

                        <a href="{{ route('admin.laporan.download', 'word') }}"
                            class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-purple-800 px-4 py-2 rounded-lg flex items-center text-sm font-medium shadow-lg transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Unduh Laporan
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-200 text-gray-800 p-6 rounded-lg shadow-sm flex items-center justify-between">
                            <div>
                                <div class="text-md font-medium">Total Pendapatan Kotor</div>
                                <div class="text-xl font-bold mt-1">Rp {{ number_format($totalGrossRevenue, 0, ',', '.') }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 opacity-40 text-gray-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote-off">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9.88 9.878a3 3 0 1 0 4.242 4.243m.58 -3.425a3.012 3.012 0 0 0 -1.412 -1.405" />
                                <path d="M10 6h9a2 2 0 0 1 2 2v8c0 .294 -.064 .574 -.178 .825m-2.822 1.175h-13a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h1" />
                                <path d="M18 12l.01 0" />
                                <path d="M6 12l.01 0" />
                                <path d="M3 3l18 18" />
                            </svg>
                        </div>

                        <div class="bg-indigo-100 text-indigo-800 p-6 rounded-lg shadow-sm flex items-center justify-between">
                            <div>
                                <div class="text-md font-medium">Pendapatan RMC (30%)</div>
                                <div class="text-xl font-bold mt-1">Rp {{ number_format($rmcRevenue, 0, ',', '.') }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 opacity-40 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-coin">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                <path d="M12 7v10" />
                            </svg>
                        </div>

                        <div class="bg-teal-100 text-teal-800 p-6 rounded-lg shadow-sm flex items-center justify-between">
                            <div>
                                <div class="text-md font-medium">Bagi Hasil Pemilik (70%)</div>
                                <div class="text-xl font-bold mt-1">Rp {{ number_format($ownerShare, 0, ',', '.') }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 opacity-40 text-teal-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cash">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 15h-3a1 1 0 0 1 -1 -1v-8a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v3" />
                                <path d="M7 9m0 1a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1z" />
                                <path d="M12 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            </svg>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm overflow-x-auto">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Rincian Laporan Pendapatan</h3>
                        @if ($completedBookings->isEmpty())
                        <div class="text-center py-10">
                            <h3 class="mt-2 text-md font-medium text-gray-600">Belum ada pemesanan yang selesai.</h3>
                            <p class="mt-1 text-sm text-gray-500">Laporan akan muncul setelah ada pemesanan yang selesai.</p>
                        </div>
                        @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Motor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penyewa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Sewa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pendapatan Kotor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pendapatan RMC
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Bagi Hasil Pemilik
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($completedBookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ asset($booking->motor->photo_url) }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-800">
                                                    {{ $booking->motor->brand }} {{ $booking->motor->type_cc }}cc
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $booking->renter->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($booking->status == 'disetujui') bg-green-100 text-green-800
                        @elseif($booking->status == 'selesai') bg-blue-100 text-blue-800
                        @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($booking->status == 'dibatalkan') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        <!-- PERBAIKAN: Gunakan data dari revenue_sharings, bukan hitung ulang -->
                                        Rp {{ number_format($booking->revenueSharing->pemilik_share + $booking->revenueSharing->admin_share, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                                        <!-- Pendapatan RMC dari revenue_sharings -->
                                        Rp {{ number_format($booking->revenueSharing->admin_share, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                        <!-- Bagi hasil pemilik dari revenue_sharings -->
                                        Rp {{ number_format($booking->revenueSharing->pemilik_share, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!-- Footer dengan Total -->
                            <tfoot class="bg-gray-50 font-semibold">
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-right text-sm text-gray-700">Total :</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        Rp {{ number_format($totalGrossRevenue, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                        Rp {{ number_format($rmcRevenue, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                                        Rp {{ number_format($ownerShare, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        @endif
                    </div>
                    <div class="overflow-x-auto mt-10">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Rating Tertinggi Motor</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Peringkat
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Merek & Tipe
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nomor Polisi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Jumlah Sewa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Pendapatan Dihasilkan
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($popularMotors as $index => $motor)
                                <tr class="transition-colors duration-150 hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($index == 0)
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">#1</span>
                                            @elseif($index == 1)
                                            <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">#2</span>
                                            @elseif($index == 2)
                                            <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">#3</span>
                                            @else
                                            <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">#{{ $index + 1 }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($motor->photo_url)
                                            <img class="h-10 w-10 rounded-full mr-4 object-cover" src="{{ asset($motor->photo_url) }}" alt="{{ $motor->brand }}">
                                            @else
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-4">
                                                <span class="text-xs text-gray-500">No Image</span>
                                            </div>
                                            @endif
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $motor->brand }}</div>
                                                <div class="text-xs text-gray-500">{{ $motor->type_cc }}cc</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $motor->plate_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($motor->status == 'tersedia') bg-green-100 text-green-800
                                                @elseif($motor->status == 'disewa') bg-red-100 text-red-800
                                                @elseif($motor->status == 'maintenance') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($motor->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-800">{{ $motor->rentals_count }}</div>
                                        <div class="text-xs text-gray-500">kali disewa</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                                        <!-- Asumsikan ada field total_revenue di model Motor -->
                                        Rp {{ number_format($motor->total_revenue ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-base text-gray-500">
                                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <h3 class="mt-2 text-md font-medium text-gray-600">Belum ada data penyewaan.</h3>
                                        <p class="mt-1 text-sm text-gray-500">Data akan muncul setelah ada motor yang disewa.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        // script untuk dropdown unduh
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdownMenu = document.getElementById('dropdown-menu');

            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // Menutup dropdown saat klik di luar area menu
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>