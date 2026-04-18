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
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Language;


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

        // // Data untuk cards
        // $totalMotors = DB::table('motors')->count();
        // $totalBookings = DB::table('bookings')->count();
        // $activeBookings = DB::table('bookings')->where('status', 'disetujui')->count();
        // $revenue = DB::table('payments')->where('status', 'lunas')->sum('jumlah');

        // // Data untuk chart berdasarkan tanggal_mulai (tanggal sewa dimulai)
        // $dailyRentals = $this->getBookingData('daily');
        // $weeklyRentals = $this->getBookingData('weekly');
        // $monthlyRentals = $this->getBookingData('monthly');

        return view('admin.dashboard-admin', compact(
            'totalMotors',
            'pendingBookingsCount',
            'totalRevenue',
            'totalOwnerRevenue',
            'pendingVerificationsCount',
            'pendingVerifications',
        ));
    }

    public function getChartData(Request $request)
    {
        $period = $request->get('period', 'daily');
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));

        Log::info('Chart Data Request:', [
            'period' => $period,
            'year' => $year,
            'month' => $month
        ]);

        $query = DB::table('bookings')
            ->whereIn('status', ['disetujui', 'selesai']);

        switch ($period) {
            case 'daily':
                // Data harian untuk bulan dan tahun yang dipilih
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $labels = [];
                $data = [];

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $date = Carbon::create($year, $month, $day);
                    $labels[] = $date->format('d M');

                    $count = $query->clone()
                        ->whereDate('tanggal_mulai', $date->format('Y-m-d'))
                        ->count();

                    $data[] = $count;
                }
                break;

            case 'weekly':
                // Data mingguan untuk tahun yang dipilih
                $labels = [];
                $data = [];

                // Cari jumlah minggu dalam tahun
                $weeksInYear = Carbon::create($year, 12, 28)->weekOfYear; // Minggu terakhir di tahun tersebut

                for ($week = 1; $week <= $weeksInYear; $week++) {
                    $startOfWeek = Carbon::now()->setISODate($year, $week)->startOfWeek();
                    $endOfWeek = Carbon::now()->setISODate($year, $week)->endOfWeek();

                    $labels[] = 'Minggu ' . $week . ' (' . $startOfWeek->format('d M') . ')';

                    $count = $query->clone()
                        ->whereBetween('tanggal_mulai', [
                            $startOfWeek->format('Y-m-d'),
                            $endOfWeek->format('Y-m-d')
                        ])
                        ->count();

                    $data[] = $count;
                }
                break;

            case 'monthly':
                // Data bulanan untuk tahun yang dipilih
                $labels = [];
                $data = [];
                $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

                for ($m = 1; $m <= 12; $m++) {
                    $startOfMonth = Carbon::create($year, $m, 1)->startOfMonth();
                    $endOfMonth = Carbon::create($year, $m, 1)->endOfMonth();

                    $labels[] = $monthNames[$m - 1] . ' ' . $year;

                    $count = $query->clone()
                        ->whereBetween('tanggal_mulai', [
                            $startOfMonth->format('Y-m-d'),
                            $endOfMonth->format('Y-m-d')
                        ])
                        ->count();

                    $data[] = $count;
                }
                break;
        }

        Log::info('Chart Data Response:', [
            'labels' => $labels,
            'data' => $data,
            'total_data' => count($data)
        ]);

        return response()->json([
            'success' => true,
            'labels' => $labels,
            'data' => $data,
            'period' => $period,
            'year' => $year,
            'month' => $month
        ]);
    }

    // API untuk mendapatkan tahun-tahun yang tersedia
    public function getAvailableYears()
    {
        try {
            $years = DB::table('bookings')
                ->select(DB::raw('YEAR(tanggal_mulai) as year'))
                ->whereIn('status', ['disetujui', 'selesai'])
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year')
                ->toArray();

            // Jika tidak ada data, return tahun sekarang saja
            if (empty($years)) {
                return response()->json([date('Y')]);
            }

            // Hanya tampilkan tahun yang <= tahun sekarang
            $currentYear = date('Y');
            $availableYears = array_filter($years, function ($year) use ($currentYear) {
                return $year <= $currentYear;
            });

            // Jika setelah filter kosong, tambahkan tahun sekarang
            if (empty($availableYears)) {
                $availableYears = [$currentYear];
            }

            // Urutkan descending
            rsort($availableYears);

            return response()->json($availableYears);
        } catch (\Exception $e) {
            // Fallback ke tahun sekarang jika error
            return response()->json([date('Y')]);
        }
    }

    public function manajemenPemesanan()
    {
        // Pemesanan menunggu persetujuan
        $pendingBookings = Booking::with(['renter', 'motor'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // SEMUA pemesanan untuk riwayat (dengan pagination)
        $allBookingsAdmin = Booking::with(['renter', 'motor'])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 10 items per page

        return view('admin.manajemen-pemesanan', compact('pendingBookings', 'allBookingsAdmin'));
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

    public function completeBooking(Booking $booking)
    {
        try {
            DB::transaction(function () use ($booking) {
                $booking->update(['status' => 'selesai']);

                // Kembalikan motor ke status tersedia
                $motor = Motor::find($booking->motor_id);
                if ($motor) {
                    $motor->update(['status' => 'tersedia']);
                }
            });

            return redirect()->back()->with('success', 'Pemesanan berhasil ditandai sebagai selesai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

        $popularMotors = DB::table('motors')
            ->select(
                'motors.id',
                'motors.brand',
                'motors.type_cc',
                'motors.plate_number',
                'motors.photo_url',
                'motors.status',
                DB::raw('COUNT(bookings.id) as rentals_count'),
                DB::raw('COALESCE(SUM(revenue_sharings.pemilik_share + revenue_sharings.admin_share), 0) as total_revenue')
            )
            ->leftJoin('bookings', function ($join) {
                $join->on('motors.id', '=', 'bookings.motor_id')
                    ->where('bookings.status', 'selesai');
            })
            ->leftJoin('revenue_sharings', 'bookings.id', '=', 'revenue_sharings.booking_id')
            ->groupBy(
                'motors.id',
                'motors.brand',
                'motors.type_cc',
                'motors.plate_number',
                'motors.photo_url',
                'motors.status'
            )
            ->orderByDesc('rentals_count')
            ->orderByDesc('total_revenue')
            ->limit(5) // TAMPILKAN 5 BESAR SAJA
            ->get();

        return view('admin.laporan', compact(
            'totalGrossRevenue',
            'rmcRevenue',
            'ownerShare',
            'completedBookings',
            'popularMotors'
        ));
    }

    // Tambahkan method ini di AdminController yang sudah ada
    public function downloadLaporan(Request $request, $format)
    {
        try {
            // Ambil data langsung dari method getLaporanData
            $data = $this->getLaporanData();

            // Debug: Cek apakah data ada
            logger('Data Laporan:', $data);

            if ($format === 'pdf') {
                return $this->downloadPDF($data);
            } elseif ($format === 'word') {
                return $this->downloadWord($data);
            }

            return redirect()->back()->with('error', 'Format tidak didukung');
        } catch (\Exception $e) {
            logger('Error download laporan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi error: ' . $e->getMessage());
        }
    }

    private function getLaporanData()
    {
        // Total Pendapatan Kotor (pemilik_share + admin_share)
        $totalGrossRevenue = DB::table('revenue_sharings')
            ->selectRaw('SUM(pemilik_share + admin_share) as total')
            ->value('total') ?? 0;

        // Pendapatan RMC (admin share)
        $rmcRevenue = DB::table('revenue_sharings')->sum('admin_share');

        // Bagian pemilik
        $ownerShare = DB::table('revenue_sharings')->sum('pemilik_share');

        // Data booking lengkap - PASTIKAN RELASI ADA
        $completedBookings = Booking::with(['motor', 'renter', 'revenueSharing'])
            ->whereHas('revenueSharing')
            ->orderBy('created_at', 'desc')
            ->get();

        $popularMotors = DB::table('motors')
            ->select(
                'motors.id',
                'motors.brand',
                'motors.type_cc',
                'motors.plate_number',
                'motors.photo_url',
                'motors.status',
                DB::raw('COUNT(bookings.id) as rentals_count'),
                DB::raw('COALESCE(SUM(revenue_sharings.pemilik_share + revenue_sharings.admin_share), 0) as total_revenue')
            )
            ->leftJoin('bookings', function ($join) {
                $join->on('motors.id', '=', 'bookings.motor_id')
                    ->where('bookings.status', 'selesai');
            })
            ->leftJoin('revenue_sharings', 'bookings.id', '=', 'revenue_sharings.booking_id')
            ->groupBy('motors.id', 'motors.brand', 'motors.type_cc', 'motors.plate_number', 'motors.photo_url', 'motors.status')
            ->orderByDesc('rentals_count')
            ->orderByDesc('total_revenue')
            ->limit(5)
            ->get();

        // Data tambahan
        $totalBookings = Booking::count();
        $completedBookingsCount = Booking::where('status', 'selesai')->count();
        $activeMotors = DB::table('motors')->where('status', 'tersedia')->count();

        return [
            'totalGrossRevenue' => $totalGrossRevenue,
            'rmcRevenue' => $rmcRevenue,
            'ownerShare' => $ownerShare,
            'completedBookings' => $completedBookings,
            'popularMotors' => $popularMotors,
            'totalBookings' => $totalBookings,
            'completedBookingsCount' => $completedBookingsCount,
            'activeMotors' => $activeMotors,
            'tanggal_laporan' => now()->format('d F Y'),
            'periode_laporan' => 'Semua Periode'
        ];
    }

    private function downloadPDF($data)
    {
        // Tambahkan data tambahan yang diperlukan untuk view
        $data['periode_laporan'] = 'Semua Periode'; // atau sesuaikan dengan filter

        $pdf = Pdf::loadView('admin.laporan', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('defaultFont', 'Poppins');

        $filename = 'Laporan_Keuangan_RMC_' . now()->format('Y_m_d') . '.pdf';
        return $pdf->download($filename);
    }

    private function downloadWord($data)
    {
        $phpWord = new PhpWord();

        // Set font default ke Poppins
        $phpWord->setDefaultFontName('Poppins');
        $phpWord->getSettings()->setThemeFontLang(new Language(Language::EN_US));

        $section = $phpWord->addSection();

        // Header Laporan
        $header = $section->addHeader();
        $header->addText('LAPORAN KEUANGAN - RENTAL MOTOR RMC', ['bold' => true, 'size' => 14], ['alignment' => 'center']);
        $header->addText('Periode : ' . $data['periode_laporan'], ['size' => 10], ['alignment' => 'center']);

        // Judul Utama
        $section->addTextBreak(1);
        $section->addTitle('LAPORAN KEUANGAN DETAIL - RENTAL MOTOR RMC', 1);
        $section->addText('Tanggal Laporan: ' . $data['tanggal_laporan'], ['size' => 10]);
        $section->addTextBreak(1);

        // Ringkasan Pendapatan
        $section->addTitle('Ringkasan Pendapatan', 2);

        // Tabel Ringkasan
        $tableStyle = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 50,
            'alignment' => 'center'
        ];

        $firstRowStyle = ['bgColor' => 'E0E0E0'];
        $phpWord->addTableStyle('summaryTable', $tableStyle, $firstRowStyle);

        $table = $section->addTable('summaryTable');
        $table->addRow();
        $table->addCell(4000)->addText('Jenis Pendapatan', ['bold' => true]);
        $table->addCell(4000)->addText('Jumlah', ['bold' => true]);

        $table->addRow();
        $table->addCell(4000)->addText('Total Pendapatan Kotor');
        $table->addCell(4000)->addText('Rp ' . number_format($data['totalGrossRevenue'], 0, ',', '.'));

        $table->addRow();
        $table->addCell(4000)->addText('Pendapatan RMC (30%)');
        $table->addCell(4000)->addText('Rp ' . number_format($data['rmcRevenue'], 0, ',', '.'));

        $table->addRow();
        $table->addCell(4000)->addText('Bagi Hasil Pemilik (70%)');
        $table->addCell(4000)->addText('Rp ' . number_format($data['ownerShare'], 0, ',', '.'));

        $section->addTextBreak(2);

        // Statistik Tambahan
        $section->addTitle('Statistik Umum', 2);

        $statsTable = $section->addTable('summaryTable');
        $statsTable->addRow();
        $statsTable->addCell(4000)->addText('Total Pemesanan', ['bold' => true]);
        $statsTable->addCell(4000)->addText($data['totalBookings']);

        $statsTable->addRow();
        $statsTable->addCell(4000)->addText('Pemesanan Selesai', ['bold' => true]);
        $statsTable->addCell(4000)->addText($data['completedBookingsCount']);

        $statsTable->addRow();
        $statsTable->addCell(4000)->addText('Motor Tersedia', ['bold' => true]);
        $statsTable->addCell(4000)->addText($data['activeMotors']);

        $section->addTextBreak(2);

        // Rincian Pendapatan per Booking
        $section->addTitle('Rincian Pendapatan per Booking', 2);

        if ($data['completedBookings']->isEmpty()) {
            $section->addText('Belum ada pemesanan yang selesai.');
        } else {
            $detailTableStyle = [
                'borderSize' => 6,
                'borderColor' => '000000',
                'cellMargin' => 50
            ];

            $phpWord->addTableStyle('detailTable', $detailTableStyle, $firstRowStyle);
            $detailTable = $section->addTable('detailTable');

            // Header Tabel
            $detailTable->addRow();
            $detailTable->addCell(2000)->addText('Motor', ['bold' => true]);
            $detailTable->addCell(2000)->addText('Penyewa', ['bold' => true]);
            $detailTable->addCell(2000)->addText('Tanggal Sewa', ['bold' => true]);
            $detailTable->addCell(1500)->addText('Pendapatan Kotor', ['bold' => true]);
            $detailTable->addCell(1500)->addText('Pendapatan RMC', ['bold' => true]);
            $detailTable->addCell(1500)->addText('Bagi Hasil Pemilik', ['bold' => true]);

            // Data Booking
            foreach ($data['completedBookings'] as $booking) {
                $detailTable->addRow();
                $detailTable->addCell(2000)->addText($booking->motor->brand . ' ' . $booking->motor->type_cc . 'cc');
                $detailTable->addCell(2000)->addText($booking->renter->name);
                $detailTable->addCell(2000)->addText(
                    \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d/m/Y') . ' - ' .
                        \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d/m/Y')
                );
                $detailTable->addCell(1500)->addText('Rp ' . number_format($booking->revenueSharing->pemilik_share + $booking->revenueSharing->admin_share, 0, ',', '.'));
                $detailTable->addCell(1500)->addText('Rp ' . number_format($booking->revenueSharing->admin_share, 0, ',', '.'));
                $detailTable->addCell(1500)->addText('Rp ' . number_format($booking->revenueSharing->pemilik_share, 0, ',', '.'));
            }

            // Footer Total
            $detailTable->addRow();
            $detailTable->addCell(6000)->addText('TOTAL', ['bold' => true], ['alignment' => 'right']);
            $detailTable->addCell(1500)->addText('Rp ' . number_format($data['totalGrossRevenue'], 0, ',', '.'), ['bold' => true]);
            $detailTable->addCell(1500)->addText('Rp ' . number_format($data['rmcRevenue'], 0, ',', '.'), ['bold' => true]);
            $detailTable->addCell(1500)->addText('Rp ' . number_format($data['ownerShare'], 0, ',', '.'), ['bold' => true]);
        }

        $section->addTextBreak(2);

        // Motor Populer
        $section->addTitle('5 Motor Terpopuler', 2);

        if ($data['popularMotors']->isEmpty()) {
            $section->addText('Belum ada data motor populer.');
        } else {
            $motorTable = $section->addTable('detailTable');

            $motorTable->addRow();
            $motorTable->addCell(1500)->addText('Peringkat', ['bold' => true]);
            $motorTable->addCell(2500)->addText('Motor', ['bold' => true]);
            $motorTable->addCell(2000)->addText('Nomor Polisi', ['bold' => true]);
            $motorTable->addCell(1500)->addText('Status', ['bold' => true]);
            $motorTable->addCell(1500)->addText('Jumlah Sewa', ['bold' => true]);
            $motorTable->addCell(1500)->addText('Total Pendapatan', ['bold' => true]);

            foreach ($data['popularMotors'] as $index => $motor) {
                $motorTable->addRow();
                $motorTable->addCell(1500)->addText('#' . ($index + 1));
                $motorTable->addCell(2500)->addText($motor->brand . ' ' . $motor->type_cc . 'cc');
                $motorTable->addCell(2000)->addText($motor->plate_number);
                $motorTable->addCell(1500)->addText(ucfirst($motor->status));
                $motorTable->addCell(1500)->addText($motor->rentals_count . ' kali');
                $motorTable->addCell(1500)->addText('Rp ' . number_format($motor->total_revenue ?? 0, 0, ',', '.'));
            }
        }

        $section->addTextBreak(2);

        // Footer
        $section->addText('Laporan ini dibuat secara otomatis oleh sistem Rental Motor RMC.');
        $section->addText('© ' . date('Y') . ' RMC - All rights reserved.', ['size' => 9, 'italic' => true]);

        $filename = 'Laporan_Keuangan_RMC_' . now()->format('Y_m_d') . '.docx';
        $filePath = storage_path('app/' . $filename);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filePath);

        return response()->download($filePath, $filename)->deleteFileAfterSend(true);
    }
}
