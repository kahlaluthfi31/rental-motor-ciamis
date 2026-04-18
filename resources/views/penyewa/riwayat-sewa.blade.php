<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa - RMC</title>
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
                <div class="max-w-8xl mb-6 px-6 py-5 bg-white rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-purple-800">Riwayat Sewa</h2>
                </div>

                @if ($history->isEmpty())
                <div class="text-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mx-auto text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-history">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 8l0 4l2 2" />
                        <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
                    </svg>
                    <p class="mt-4 text-gray-600 text-lg font-medium">Tidak ada riwayat sewa.</p>
                    <p class="mt-1 text-sm text-gray-500">Anda dapat melihat riwayat setelah menyelesaikan atau membatalkan pesanan.</p>
                </div>
                @else
                <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
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
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($history as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{ asset($booking->motor->photo_url) }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $booking->motor->brand }} {{ $booking->motor->type_cc }}cc
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $booking->motor->plate_number }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500 capitalize">
                                        ({{ $booking->duration_type }})
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp {{ number_format($booking->total_biaya, 0, ',', '.') }}
                                    <br>
                                    <span class="text-xs">
                                        @if($booking->payment)
                                        ({{ ucfirst($booking->payment->metode) }})
                                        @else
                                        <!-- Tampilkan status berdasarkan kondisi -->
                                        @if($booking->status === 'dibatalkan')
                                        <span class="text-red-500">(Dibatalkan)</span>
                                        @elseif($booking->status === 'pending')
                                        <span class="text-yellow-500">(Menunggu Pembayaran)</span>
                                        @else
                                        <span class="text-gray-500">(Tidak ada info pembayaran)</span>
                                        @endif
                                        @endif
                                    </span>
                                </td>
                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($booking->status === 'disetujui')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Disetujui
                                    </span>
                                    @elseif ($booking->status === 'selesai')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>
                                    @elseif ($booking->status === 'dibatalkan')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Dibatalkan
                                    </span>
                                    @elseif ($booking->status === 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Konfirmasi
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $booking->status }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>

</html>