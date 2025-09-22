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
    @include('partials.sidebar')
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
                                <div class="text-xl font-bold">{{ $totalMotors }}</div>
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
                                <div class="text-xl font-bold">{{ $pendingBookingsCount }}</div>
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
                                <div class="text-xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
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
                                <div class="text-xl font-bold">{{ $pendingVerificationsCount }}</div>
                                <div class="text-sm text-gray-600 font-medium tracking-wide mt-1">Verifikasi Motor</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Motor Menunggu Verifikasi</h3>
                    <div class="overflow-x-auto">
                        @if($pendingVerifications->isEmpty())
                        <div class="text-center py-10 text-gray-500 text-base">
                            <p>Tidak ada motor yang menunggu verifikasi saat ini.</p>
                        </div>
                        @else
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
                                @foreach ($pendingVerifications as $motor)
                                <tr class="transition-colors duration-150 hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <img class="w-full h-full rounded-full object-cover" src="{{ asset($motor->photo_url) }}" alt="Motor Image">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ $motor->brand }} {{ $motor->type_cc }}cc</div>
                                                <div class="text-xs text-gray-500">{{ $motor->plate_number }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $motor->owner->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $motor->owner->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $motor->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.verifikasi-motor') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-full shadow-sm hover:bg-indigo-700 transition-colors duration-200">
                                            Verifikasi
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>