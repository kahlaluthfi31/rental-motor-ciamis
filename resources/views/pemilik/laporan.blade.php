<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Owner - RMC</title>
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
        <main class="flex-1 bg-gray-50 p-6 sm:p-10">
            <div class="flex items-center justify-between mb-4 bg-white p-5 rounded-xl shadow-md overflow-x-auto">
                <h1 class="text-lg font-bold text-purple-800">Laporan Pendapatan</h1>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-x-auto">
                @if($revenueData->isEmpty())
                <div class="text-center py-12 px-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>
                    <p class="mt-4 text-xl font-medium text-gray-500">Belum ada transaksi sewa yang selesai.</p>
                    <p class="mt-2 text-sm text-gray-400">Silakan kembali lagi setelah ada penyewaan yang selesai.</p>
                </div>
                @else
                <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Motor
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal Sewa
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Biaya Total
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Pendapatan Anda
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($revenueData as $data)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-12 h-12 p-1">
                                            <img class="w-full h-full rounded-full object-cover shadow-sm"
                                                src="{{ asset($data->photo_url) }}"
                                                alt="{{ $data->brand }} {{ $data->type_cc }}">
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $data->brand }} {{ $data->type_cc }}cc</div>
                                            <div class="text-xs text-gray-500">{{ $data->plate_number }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($data->tanggal_selesai)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    <!-- Total biaya = pemilik_share + admin_share -->
                                    Rp {{ number_format($data->pemilik_share + $data->admin_share, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">
                                    <!-- Pendapatan pemilik dari revenue_sharings -->
                                    Rp {{ number_format($data->pemilik_share, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 font-semibold">
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-right text-sm text-gray-700">Total :</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($totalGrossRevenue, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                    Rp {{ number_format($ownerShare, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif
            </div>
        </main>
    </div>
</body>

</html>