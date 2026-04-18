<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pemesanan - RMC</title>
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
                <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">

                    @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif

                    <div class="p-6 rounded-lg overflow-x-auto">
                        <h3 class="text-lg font-bold text-purple-800">Pemesanan Menunggu Persetujuan</h3>
                        @if ($pendingBookings->isEmpty())
                        <div class="text-center py-5">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada pemesanan yang menunggu persetujuan.</h3>
                            <p class="mt-1 text-sm text-gray-500">Pemesanan yang dibuat oleh penyewa akan muncul di sini.</p>
                        </div>
                        @else
                        <table class="min-w-full divide-y mt-6 divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Motor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penyewa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Periode Sewa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Biaya
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
                                @foreach ($pendingBookings as $booking)
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
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $booking->renter->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->renter->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Rp {{ number_format($booking->total_biaya, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu Persetujuan
                                        </span>
                                    </td>
                                    <!-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('admin.pemesanan.approve', $booking) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.pemesanan.reject', $booking) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Anda yakin akan menolak motor ini ?');" class="text-red-600 hover:text-red-900 transition duration-200 ease-in-out transform hover:scale-105">Tolak</button>
                                        </form>
                                    </td> -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button type="button"
                                            class="approve-btn text-green-600 hover:text-green-900 mr-2"
                                            data-booking-id="{{ $booking->id }}"
                                            data-total-biaya="{{ $booking->total_biaya }}">
                                            Setujui
                                        </button>
                                        <form action="{{ route('admin.pemesanan.reject', $booking) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Anda yakin akan menolak pesanan ini ?');" class="text-red-600 hover:text-red-900 transition duration-200 ease-in-out transform hover:scale-105">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>

                <div class="mt-8 p-8 bg-white rounded-lg shadow-md">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-purple-800 ml-4">Riwayat Pemesanan Semua Penyewa</h3>

                        <!-- Filter Status -->
                        <div class="flex space-x-2">
                            <span class="text-sm text-gray-600">Filter Status:</span>
                            <button class="status-filter-admin px-3 py-1 text-xs rounded bg-purple-100 text-purple-800" data-status="all">Semua</button>
                            <button class="status-filter-admin px-3 py-1 text-xs rounded bg-gray-200 text-gray-700" data-status="pending">Menunggu</button>
                            <button class="status-filter-admin px-3 py-1 text-xs rounded bg-green-100 text-green-800" data-status="disetujui">Disetujui</button>
                            <button class="status-filter-admin px-3 py-1 text-xs rounded bg-blue-100 text-blue-800" data-status="selesai">Selesai</button>
                            <button class="status-filter-admin px-3 py-1 text-xs rounded bg-red-100 text-red-800" data-status="dibatalkan">Dibatalkan</button>
                        </div>
                    </div>

                    @if ($allBookingsAdmin->isEmpty())
                    <div class="text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 mx-auto text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada riwayat pemesanan.</h3>
                        <p class="mt-1 text-sm text-gray-500">Penyewa belum melakukan pemesanan motor.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Motor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penyewa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Periode Sewa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Biaya
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Pesan
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="admin-bookings-table">
                                @foreach ($allBookingsAdmin as $booking)
                                <tr class="admin-booking-row" data-status="{{ $booking->status }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($booking->motor && $booking->motor->photo_url)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($booking->motor->photo_url) }}" alt="{{ $booking->motor->brand }}">
                                                @else
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-xs text-gray-500">No Image</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->motor->brand ?? 'N/A' }} {{ $booking->motor->type_cc ?? '' }}cc
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $booking->motor->plate_number ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $booking->renter->name ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->renter->email ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                                        <div class="text-xs text-gray-400 capitalize">
                                            ({{ $booking->duration_type }})
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                        Rp {{ number_format($booking->total_biaya, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($booking->status == 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu Pembayaran
                                        </span>
                                        @elseif($booking->status == 'disetujui')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Disetujui
                                        </span>
                                        @elseif($booking->status == 'selesai')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Selesai
                                        </span>
                                        @elseif($booking->status == 'dibatalkan')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Dibatalkan
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $booking->status }}
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($booking->status == 'pending')
                                        <div class="flex space-x-2">
                                            <form action="{{ route('admin.pemesanan.approve', $booking) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900 text-xs">Setujui</button>
                                            </form>
                                            <span class="text-gray-300">|</span>
                                            <form action="{{ route('admin.pemesanan.reject', $booking) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Tolak pemesanan ini?')" class="text-red-600 hover:text-red-900 text-xs">Tolak</button>
                                            </form>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    @if($allBookingsAdmin->hasPages())
                    <div class="mt-4">
                        {{ $allBookingsAdmin->links() }}
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </main>
    </div>
    <!-- Modal Pembayaran -->
    <div id="payment-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="payment-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="payment-form" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="payment-modal-title">
                            Konfirmasi Pembayaran
                        </h3>
                        <div class="mt-4">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                                <p id="payment-amount" class="text-xl font-bold text-purple-600 mt-1">Rp 0</p>
                                <input type="hidden" id="payment-total" name="jumlah">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="metode" value="cash" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" checked>
                                        <span class="ml-2 text-sm text-gray-700">Cash (Bayar di Tempat)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="metode" value="transfer" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <span class="ml-2 text-sm text-gray-700">Transfer Bank</span>
                                    </label>
                                </div>
                            </div>

                            <div id="transfer-info" class="bg-blue-50 p-4 rounded-md mt-3 hidden">
                                <p class="text-sm text-blue-700">
                                    Silakan transfer ke:<br>
                                    <strong>BANK BCA - 1234567890</strong><br>
                                    a.n. Rental Motor Center
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Konfirmasi Pembayaran
                        </button>
                        <button type="button" onclick="closePaymentModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Filter untuk admin bookings
        document.addEventListener('DOMContentLoaded', function() {
            // Filter status untuk admin
            document.querySelectorAll('.status-filter-admin').forEach(button => {
                button.addEventListener('click', function() {
                    const status = this.getAttribute('data-status');

                    // Update active button
                    document.querySelectorAll('.status-filter-admin').forEach(btn => {
                        btn.classList.remove('bg-purple-100', 'text-purple-800');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    this.classList.add('bg-purple-100', 'text-purple-800');
                    this.classList.remove('bg-gray-200', 'text-gray-700');

                    // Filter rows
                    const rows = document.querySelectorAll('.admin-booking-row');
                    rows.forEach(row => {
                        if (status === 'all' || row.getAttribute('data-status') === status) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        });

        // Function untuk show detail booking (bisa dikembangkan)
        function showBookingDetail(bookingId) {
            // Implementasi modal detail booking
            alert('Detail booking ID: ' + bookingId);
            // Bisa diimplementasikan dengan modal atau redirect ke halaman detail
            // window.location.href = '/admin/bookings/' + bookingId;
        }
    </script>
    <script>
        // Event listener untuk tombol approve
        document.querySelectorAll('.approve-btn').forEach(button => {
            button.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-booking-id');
                const totalBiaya = parseFloat(this.getAttribute('data-total-biaya'));
                openPaymentModal(bookingId, totalBiaya);
            });
        });
    </script>
    <script>
        let currentBookingId = null;
        let currentTotalBiaya = 0;

        // Fungsi untuk membuka modal pembayaran
        function openPaymentModal(bookingId, totalBiaya) {
            currentBookingId = bookingId;
            currentTotalBiaya = totalBiaya;

            // Set data di modal
            document.getElementById('payment-amount').textContent = 'Rp ' + totalBiaya.toLocaleString('id-ID');
            document.getElementById('payment-total').value = totalBiaya;

            // Set form action
            const form = document.getElementById('payment-form');
            form.action = `/admin/pemesanan/approve/${bookingId}`;

            // Tampilkan modal
            document.getElementById('payment-modal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal
        function closePaymentModal() {
            document.getElementById('payment-modal').classList.add('hidden');
        }

        // Toggle info transfer
        document.querySelectorAll('input[name="metode"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const transferInfo = document.getElementById('transfer-info');
                transferInfo.classList.toggle('hidden', this.value !== 'transfer');
            });
        });

        // Event listener untuk form setujui
        document.querySelectorAll('form[action*="approve"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const bookingId = this.action.split('/').pop();
                const totalBiaya = parseFloat(this.querySelector('input[name="total_biaya"]')?.value || 0);
                openPaymentModal(bookingId, totalBiaya);
            });
        });
    </script>
</body>

</html>