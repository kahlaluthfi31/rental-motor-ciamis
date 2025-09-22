<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Harga - RMC</title>
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
</head>

<body class="bg-gray-50 flex h-screen overflow-hidden">
    @include('partials.sidebar')
    <div class="flex-1 flex flex-col overflow-y-auto">
        <main class="flex-1 p-6 lg:p-10">
            <div class="max-w-7xl mx-auto space-y-8">
                <!-- Header Section with Purple Title -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                    <h1 class="text-lg font-bold text-purple-800">List Data Motor</h1>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-xl shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif
                @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-xl shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Card Motor Tersedia -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg font-semibold text-gray-900">Motor Tersedia</h3>
                                <p class="text-2xl font-bold text-green-600">{{ $availableCount }}</p>
                                <p class="text-sm text-gray-500">Motor siap disewa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Motor Disewa -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                        <path d="M12 8v4" />
                                        <path d="M12 16h.01" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg font-semibold text-gray-900">Motor Disewa</h3>
                                <p class="text-2xl font-bold text-blue-600">{{ $rentedCount }}</p>
                                <p class="text-sm text-gray-500">Sedang disewa customer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    @if ($motors->isEmpty())
                    <div class="text-center py-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto h-16 w-16 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada motor yang tersedia untuk manajemen harga.</h3>
                        <p class="mt-1 text-sm text-gray-500">Silakan verifikasi motor terlebih dahulu di halaman verifikasi motor.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Motor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Harga Harian
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Harga Mingguan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Harga Bulanan
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
                                @foreach ($motors as $motor)
                                <tr class="transition-colors duration-150 hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($motor->photo_url) }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $motor->brand }} {{ $motor->type_cc }}cc
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $motor->plate_number }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($motor->rentalRates->harian, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($motor->rentalRates->mingguan, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($motor->rentalRates->bulanan, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($motor->status == 'tersedia')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Tersedia
                                        </span>
                                        @elseif($motor->status == 'disewa')
                                        <div class="flex flex-col items-start space-y-1">
                                            <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Disewa
                                            </span>
                                            @php
                                            // Cari booking aktif untuk motor ini
                                            $activeBooking = \App\Models\Booking::where('motor_id', $motor->id)
                                            ->where('status', 'disewa')
                                            ->first();
                                            @endphp
                                            @if($activeBooking)
                                            <span class="text-xs text-gray-500">
                                                Selesai: {{ \Carbon\Carbon::parse($activeBooking->end_date)->format('d M Y') }}
                                            </span>
                                            @endif
                                        </div>
                                        @elseif($motor->status == 'pending_verification')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending Verification
                                        </span>
                                        @elseif($motor->status == 'dibatalkan')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Dibatalkan
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $motor->status }}
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($motor->status == 'disewa')
                                        <form action="{{ route('admin.motor.set-available', $motor->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-white bg-purple-600 hover:bg-purple-700 px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200" onclick="return confirm('Apakah Anda yakin ingin mengubah status motor menjadi Tersedia?')">
                                                Set Tersedia
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>

</html>