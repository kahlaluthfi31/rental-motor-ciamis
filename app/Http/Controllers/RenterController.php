<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Motor;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\RentalRate; // Pastikan model RentalRate sudah ada
use Carbon\Carbon; // Untuk mempermudah perhitungan tanggal
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RenterController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mengambil data statistik untuk dashboard
        // Motor tersedia: hitung motor yang berstatus 'tersedia' dan memiliki harga
        $motorTersedia = Motor::where('status', 'tersedia')
            ->has('rentalRates') // Filter motor yang sudah memiliki relasi harga
            ->count();

        $penyewaanAktif = Booking::where('renter_id', $user->id)
            ->whereIn('status', ['disetujui'])
            ->count();

        // Total Penyewaan: hitung semua pemesanan yang pernah dibuat oleh user ini
        $totalPenyewaan = Booking::where('renter_id', $user->id)->count();

        // Mengambil daftar motor yang tersedia untuk disewakan
        // Filter motor dengan status 'tersedia' dan memiliki relasi harga.
        // Gunakan 'with('rentalRates')' untuk eager loading data harga.
        $motors = Motor::where('status', 'tersedia')
            ->has('rentalRates')
            ->with('rentalRates')
            ->get();

        // PERBAIKAN: Mengambil motor yang paling sering disewa HANYA yang statusnya 'tersedia' atau 'disewa'
        $popularMotors = Motor::whereIn('status', ['tersedia', 'disewa'])
            ->withCount('rentals')
            ->orderByDesc('rentals_count')
            ->limit(5) // Batasi hasilnya, misalnya 5 motor teratas
            ->get();

        return view('penyewa.dashboard-penyewa', compact('motorTersedia', 'penyewaanAktif', 'totalPenyewaan', 'popularMotors'));
    }

    public function cariMotor(Request $request)
    {
        Log::info('=== CARI MOTOR DEBUG ===');

        // GUNAKAN 'tersedia' BUKAN 'available'
        $query = Motor::with('rentalRates')
            ->where('status', 'tersedia'); // INI YANG PERLU DIPERBAIKI!

        Log::info('Base query with tersedia: ' . $query->count());

        // Filter berdasarkan merek
        if ($request->has('brand') && !empty($request->brand)) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // Filter berdasarkan type_cc
        if ($request->has('type_cc') && !empty($request->type_cc)) {
            $query->where('type_cc', $request->type_cc);
        }

        // Filter berdasarkan harga
        if ($request->has('price_range') && !empty($request->price_range)) {
            $range = $request->price_range;

            $query->whereHas('rentalRates', function ($q) use ($range) {
                if ($range === '<100000') {
                    $q->where('harian', '<', 100000);
                } elseif ($range === '100000-150000') {
                    $q->whereBetween('harian', [100000, 150000]);
                } elseif ($range === '>150000') {
                    $q->where('harian', '>', 150000);
                }
            });
        }

        $motors = $query->get();

        Log::info('Final motors count: ' . $motors->count());

        // DEBUG: Tampilkan motor yang ditemukan
        foreach ($motors as $motor) {
            Log::info('Motor: ' . $motor->id . ' - ' . $motor->brand . ' - Status: ' . $motor->status);
        }

        return view('penyewa.cari-motor', compact('motors'));
    }

    public function showBookingForm($motorId)
    {
        $motor = Motor::findOrFail($motorId);
        return view('penyewa.booking-form', compact('motor'));
    }

    public function processBooking(Request $request, $motorId)
    {
        try {
            DB::beginTransaction();

            // Gunakan DB facade langsung
            $bookingId = DB::table('bookings')->insertGetId([
                'renter_id' => Auth::id(),
                'motor_id' => $motorId,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'duration_type' => $request->duration_type,
                'total_biaya' => $request->total_biaya,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('Booking created with ID: ' . $bookingId);

            // Update motor status
            DB::table('motors')->where('id', $motorId)->update([
                'status' => 'disewa',
                'updated_at' => now()
            ]);

            DB::commit();

            return redirect()->route('penyewa.pemesanan')
                ->with('success', 'Pemesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Direct DB Error: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function cancelBooking(Booking $booking)
    {
        $user = Auth::user();

        // Pastikan user sudah login terlebih dahulu
        if (!$user) {
            return redirect()->back()->with('error', 'Anda harus login untuk melakukan aksi ini.');
        }

        // Pastikan hanya pemilik pemesanan yang bisa membatalkannya
        if ($booking->renter_id !== $user->id) { // Menggunakan $user->id yang sudah didefinisikan
            return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk membatalkan pemesanan ini.');
        }

        // Transaksi database untuk memastikan konsistensi
        DB::transaction(function () use ($booking) {
            $booking->status = 'cancelled';
            $booking->save();

            // Ubah status motor kembali menjadi 'tersedia'
            $motor = Motor::find($booking->motor_id);
            $motor->status = 'tersedia';
            $motor->save();
        });

        return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    // Di RenterController
    public function showAllBookings()
    {
        $allBookings = Booking::with(['motor', 'renter', 'payment'])
            ->where('renter_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penyewa.pemesanan', compact('allBookings'));
    }

    // UserController.php (atau Controller untuk penyewa)
    public function riwayatSewa()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login.');
        }

        // Ambil semua riwayat dengan status disetujui, selesai, dan dibatalkan
        $history = Booking::with('motor')
            ->where('renter_id', $user->id)
            ->whereIn('status', ['selesai', 'dibatalkan']) // <- TAMBAHKAN 'selesai'
            ->orderBy('created_at', 'desc') // Urutkan dari yang terbaru
            ->get();

        return view('penyewa.riwayat-sewa', compact('history'));
    }

    public function pemesanan()
    {
        return view('penyewa.pemesanan');
    }

    public function statusPenyewaan()
    {
        return view('penyewa.status-penyewaan');
    }
}
