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
        // Gunakan eager loading dengan count yang benar
        $query = Motor::with('rentalRates')
            ->withCount(['bookings' => function ($query) {
                $query->where('status', 'selesai'); // Status yang sesuai dengan enum di database
            }])
            ->where('status', 'tersedia');

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

        // DEBUG: Tampilkan motor dan jumlah bookingnya
        foreach ($motors as $motor) {
            Log::info('Motor: ' . $motor->id . ' - ' . $motor->brand . ' - Status: ' . $motor->status . ' - Bookings Count: ' . $motor->bookings_count);

            // Debug tambahan untuk melihat booking yang ada
            $actualBookings = $motor->bookings()->where('status', 'selesai')->count();
            Log::info('Actual completed bookings for motor ' . $motor->id . ': ' . $actualBookings);
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

    public function cancelBooking($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login.');
        }

        try {
            $booking = Booking::where('id', $id)
                ->where('renter_id', $user->id)
                ->firstOrFail();

            // Validasi status
            if (!in_array($booking->status, ['pending'])) {
                return redirect()->back()->with('error', 'Pemesanan ini tidak dapat dibatalkan.');
            }

            DB::transaction(function () use ($booking) {
                $booking->update(['status' => 'dibatalkan']);

                $motor = Motor::find($booking->motor_id);
                if ($motor) {
                    $motor->update(['status' => 'tersedia']);
                }
            });

            return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Pemesanan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
