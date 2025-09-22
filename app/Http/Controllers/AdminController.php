<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Motor;
use App\Models\Booking;
use App\Models\RevenueSharing;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\RentalRate;
use Carbon\Carbon; // Untuk mempermudah perhitungan tanggal
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function dashboard()
    {
        // PERBAIKAN: Mendapatkan total motor di sistem HANYA yang statusnya 'tersedia' atau 'disewa'
        $totalMotors = Motor::whereIn('status', ['tersedia', 'disewa'])->count();

        // Mendapatkan jumlah pemesanan baru (pending)
        $pendingBookingsCount = Booking::where('status', 'pending')->count();

        // PERBAIKAN: Total pendapatan admin HARUS dari revenue_sharings.admin_share
        $totalRevenue = DB::table('revenue_sharings')->sum('admin_share');

        // PERBAIKAN: Total bagi hasil pemilik dari revenue_sharings.pemilik_share
        $totalOwnerRevenue = DB::table('revenue_sharings')->sum('pemilik_share');

        // Mendapatkan jumlah motor yang butuh verifikasi (pending)
        $pendingVerificationsCount = Motor::where('status', 'pending_verification')->count();

        // Mengambil daftar motor yang butuh verifikasi
        $pendingVerifications = Motor::with('owner')
            ->where('status', 'pending_verification')
            ->get();

        return view('admin.dashboard-admin', compact(
            'totalMotors',
            'pendingBookingsCount',
            'totalRevenue',
            'totalOwnerRevenue', // Tambahkan ini
            'pendingVerificationsCount',
            'pendingVerifications'
        ));
    }

    public function verifikasiMotor()
    {
        $pendingMotors = Motor::with('owner')->where('status', 'pending_verification')->get();
        return view('admin.verifikasi-motor', compact('pendingMotors'));
    }

    public function manajemenHarga()
    {
        $motors = Motor::where('status', 'tersedia')
            ->orWhere('status', 'disewa')
            ->with('rentalRates') // Pastikan eager load rental rates
            ->get();

        // Hitung jumlah motor tersedia dan disewa
        $availableCount = Motor::where('status', 'tersedia')->count();
        $rentedCount = Motor::where('status', 'disewa')->count();

        return view('admin.manajemen-harga', compact('motors', 'availableCount', 'rentedCount'));
    }

    public function updateHarga(Request $request, Motor $motor)
    {
        $request->validate([
            'price_day' => 'required|numeric|min:0',
            'price_week' => 'required|numeric|min:0',
            'price_month' => 'required|numeric|min:0',
        ]);

        $motor->update([
            'price_day' => $request->price_day,
            'price_week' => $request->price_week,
            'price_month' => $request->price_month,
        ]);

        return redirect()->back()->with('success', 'Harga motor berhasil diperbarui.');
    }

    public function manajemenPemesanan()
    {
        $pendingBookings = Booking::with(['renter', 'motor'])->where('status', 'pending')->get();
        return view('admin.manajemen-pemesanan', compact('pendingBookings'));
    }

    public function approveBooking(Request $request, Booking $booking)
    {
        try {
            DB::beginTransaction();

            // Validasi
            $validated = $request->validate([
                'metode' => 'required|in:cash,transfer',
                'jumlah' => 'required|numeric|min:0'
            ]);

            // 1. Update status booking
            $booking->status = 'disetujui';
            $booking->save();

            // 2. Simpan data pembayaran
            $payment = new Payment();
            $payment->booking_id = $booking->id;
            $payment->jumlah = $validated['jumlah'];
            $payment->metode = $validated['metode'];
            $payment->status = 'lunas';
            $payment->save();

            // 3. Hitung revenue sharing (70% pemilik, 30% admin)
            $pemilikShare = $validated['jumlah'] * 0.7;
            $adminShare = $validated['jumlah'] * 0.3;

            // 4. Simpan revenue sharing
            $revenueSharing = new RevenueSharing();
            $revenueSharing->booking_id = $booking->id;
            $revenueSharing->pemilik_share = $pemilikShare;
            $revenueSharing->admin_share = $adminShare;
            $revenueSharing->save();

            // ✅ PERBAIKAN: Update status motor menjadi 'disewa'
            $motor = Motor::find($booking->motor_id);
            if ($motor) {
                $motor->status = 'disewa';
                $motor->save();
                Log::info("Motor status updated to: disewa - Motor ID: {$motor->id}");
            } else {
                Log::error("Motor not found for booking: {$booking->id}");
            }

            DB::commit();

            return redirect()->route('admin.manajemen-pemesanan')
                ->with('success', 'Pemesanan disetujui dan pembayaran berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Approve booking error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectPemesanan(Booking $booking)
    {
        // Ganti status booking menjadi 'dibatalkan'
        $booking->update(['status' => 'dibatalkan']);

        // Ganti status motor menjadi 'tersedia'
        $booking->motor->update(['status' => 'tersedia']);

        return redirect()->route('admin.manajemen-pemesanan')->with('success', 'Pemesanan berhasil ditolak.');
    }

    // public function laporanKeuangan()
    // {
    //     // Mendapatkan semua pemesanan yang statusnya 'selesai'
    //     $completedBookings = Booking::with(['renter', 'motor'])
    //         ->where('status', 'selesai')
    //         ->get();

    //     // Menghitung total pendapatan kotor dari semua pemesanan yang selesai
    //     $totalGrossRevenue = $completedBookings->sum('total_biaya');

    //     // Menghitung pendapatan bersih RMC (20% dari total)
    //     $rmcRevenue = $totalGrossRevenue * 0.20;

    //     // Menghitung bagi hasil untuk pemilik (80% dari total)
    //     $ownerShare = $totalGrossRevenue * 0.80;

    //     return view('admin.laporan', compact(
    //         'completedBookings',
    //         'totalGrossRevenue',
    //         'rmcRevenue',
    //         'ownerShare'
    //     ));
    // }

    public function showVerifikasi()
    {
        $pendingMotors = Motor::where('status', 'pending_verification')->get();
        return view('admin.verifikasi-motor', compact('pendingMotors'));
    }

    // Method untuk menyetujui motor dan menetapkan harga
    public function approveMotor(Request $request, Motor $motor)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'price_day'   => 'required|integer|min:0',
            'price_week'  => 'required|integer|min:0',
            'price_month' => 'required|integer|min:0',
        ]);

        // 2. Perbarui status motor di tabel `motors`
        $motor->status = 'tersedia';
        $motor->save();

        // 3. Simpan harga sewa ke tabel `rental_rates`
        // Pastikan model Motor memiliki relasi `hasOne` ke RentalRate
        $motor->rentalRates()->create([
            'harian'  => $request->price_day,
            'mingguan'  => $request->price_week,
            'bulanan' => $request->price_month,
        ]);

        return redirect()->route('admin.verifikasi-motor')->with('success', 'Motor berhasil disetujui dan harga sewa telah ditetapkan!');
    }

    // Method untuk mengubah status motor menjadi tersedia dan menyelesaikan booking
    public function setMotorAvailable(Motor $motor)
    {
        // Pastikan motor statusnya 'disewa'
        if ($motor->status !== 'disewa') {
            return redirect()->back()->with('error', 'Hanya motor yang sedang disewa yang bisa diubah statusnya.');
        }

        // Cari booking aktif untuk motor ini
        $activeBooking = Booking::where('motor_id', $motor->id)
            ->where('status', 'disetujui') // Cari yang statusnya disetujui (sedang disewa)
            ->first();

        if (!$activeBooking) {
            return redirect()->back()->with('error', 'Tidak ditemukan data penyewaan aktif untuk motor ini.');
        }

        // Mulai transaction untuk memastikan konsistensi data
        DB::beginTransaction();

        try {
            // 1. Ubah status motor menjadi 'tersedia'
            $motor->status = 'tersedia';
            $motor->save();

            // 2. Ubah status booking menjadi 'selesai'
            $activeBooking->status = 'selesai';
            $activeBooking->save();

            // Commit transaction
            DB::commit();

            return redirect()->route('admin.manajemen-harga')->with('success', 'Status motor berhasil diubah menjadi Tersedia dan penyewaan telah diselesaikan!');
        } catch (\Exception $e) {
            // Rollback transaction jika ada error
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Method untuk menolak motor
    public function rejectMotor(Motor $motor)
    {
        // Hapus file foto
        if ($motor->photo_url) {
            Storage::disk('public')->delete(str_replace('storage/', '', $motor->photo_url));
        }

        // Hapus data motor
        $motor->delete();

        return redirect()->route('admin.verifikasi-motor')->with('success', 'Motor berhasil ditolak dan dihapus.');
    }

    // Method untuk menampilkan semua motor yang sudah tersedia (untuk manajemen harga)
    public function showManajemenHarga()
    {
        $motors = Motor::where('status', 'tersedia')->get();
        return view('admin.manajemen-harga', compact('motors'));
    }

    // Method untuk mengupdate harga motor yang sudah ada
    public function updateRentalRate(Request $request, Motor $motor)
    {
        $request->validate([
            'price_day' => 'required|numeric|min:0',
            'price_week' => 'required|numeric|min:0',
            'price_month' => 'required|numeric|min:0',
        ]);

        $motor->price_day = $request->price_day;
        $motor->price_week = $request->price_week;
        $motor->price_month = $request->price_month;
        $motor->save();

        return redirect()->route('admin.manajemen-harga')->with('success', 'Harga sewa berhasil diperbarui.');
    }

    public function laporanKeuangan()
    {
        // Total Pendapatan Kotor (pemilik_share + admin_share)
        $totalGrossRevenue = DB::table('revenue_sharings')
            ->selectRaw('SUM(pemilik_share + admin_share) as total')
            ->value('total') ?? 0;

        // Pendapatan RMC (admin share)
        $rmcRevenue = DB::table('revenue_sharings')
            ->sum('admin_share');

        // Bagian pemilik
        $ownerShare = DB::table('revenue_sharings')
            ->sum('pemilik_share');

        // PERBAIKAN: Ambil SEMUA booking yang sudah ada bagi hasilnya, TANPA filter status
        $completedBookings = Booking::with(['motor', 'renter', 'revenueSharing'])
            ->whereHas('revenueSharing') // Hanya booking yang sudah ada revenue sharing
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.laporan', compact(
            'totalGrossRevenue',
            'rmcRevenue',
            'ownerShare',
            'completedBookings'
        ));
    }
}
