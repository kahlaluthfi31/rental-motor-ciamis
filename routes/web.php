<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RenterController;
use App\Models\Motor;


// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Role Selection
Route::get('/select-role', [AuthController::class, 'showRoleSelection'])->name('select.role')->middleware('auth');
Route::post('/update-role', [AuthController::class, 'updateRole'])->name('update.role')->middleware('auth');

// Become Owner
Route::post('/become-owner', [AuthController::class, 'becomeOwner'])->name('become.owner')->middleware('auth');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('admin.dashboard-admin');
    Route::get('/verifikasi-motor', [AdminController::class, 'verifikasiMotor'])->name('admin.verifikasi-motor');
    Route::get('/manajemen-harga', [AdminController::class, 'manajemenHarga'])->name('admin.manajemen-harga');
    Route::get('/manajemen-pemesanan', [AdminController::class, 'manajemenPemesanan'])->name('admin.manajemen-pemesanan');
    Route::get('/laporan', [AdminController::class, 'laporanKeuangan'])->name('admin.laporan');
    // Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');

    // untuk route unduh laporan
    Route::get('/laporan/download/{format}', [AdminController::class, 'downloadLaporan'])
        ->name('admin.laporan.download');

    // Routes untuk Verifikasi Motor
    // Route::post('/verifikasi/approve/{motor}', [AdminController::class, 'approveMotor'])->name('admin.verifikasi.approve');
    // Route::delete('/verifikasi/reject/{motor}', [AdminController::class, 'rejectMotor'])->name('admin.verifikasi.reject');

    // Routes untuk Manajemen Pemesanan
    Route::post('/pemesanan/approve/{booking}', [AdminController::class, 'approvebooking'])->name('admin.pemesanan.approve');
    Route::delete('/pemesanan/reject/{booking}', [AdminController::class, 'rejectPemesanan'])->name('admin.pemesanan.reject');
    Route::put('/manajemen-harga/{rentalRate}', [AdminController::class, 'updateRentalRate'])->name('admin.manajemen-harga.update');


    Route::put('/verifikasi-motor/{motor}/approve', [AdminController::class, 'approveMotor'])->name('admin.verifikasi.approve');
    Route::delete('/verifikasi-motor/{motor}/reject', [AdminController::class, 'rejectMotor'])->name('admin.verifikasi.reject');

    // Rute untuk Manajemen Harga
    Route::put('/manajemen-harga/{motor}', [AdminController::class, 'updateRentalRate'])->name('admin.manajemen-harga.update');
    Route::put('/manajemen-harga/{motor}/set-available', [AdminController::class, 'setMotorAvailable'])->name('admin.motor.set-available');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/chart-data', [AdminController::class, 'getChartData'])->name('admin.chart.data');
    Route::get('/available-years', [AdminController::class, 'getAvailableYears'])->name('admin.available.years');
    Route::post('/pemesanan/{booking}/complete', [AdminController::class, 'completeBooking'])->name('admin.pemesanan.complete');
});

// Owner Routes
Route::prefix('pemilik')->middleware(['auth', 'role:pemilik,admin'])->group(function () {
    Route::get('/dashboard-pemilik', [OwnerController::class, 'dashboard'])->name('pemilik.dashboard-pemilik');
    Route::get('/titip-motor', [OwnerController::class, 'titipMotor'])->name('pemilik.titip-motor');
    Route::get('/laporan', [OwnerController::class, 'laporan'])->name('pemilik.laporan');

    Route::post('/titip-motor', [OwnerController::class, 'storeMotor'])->name('pemilik.titip-motor.store');
    Route::delete('/titip-motor/{motor}', [OwnerController::class, 'destroy'])->name('pemilik.titip-motor.destroy');
    Route::put('/titip-motor/{motor}', [OwnerController::class, 'update'])->name('pemilik.titip-motor.update');
});

// Renter Routes
Route::prefix('penyewa')->middleware(['auth', 'role:penyewa,admin'])->group(function () {
    Route::get('/dashboard-penyewa', [RenterController::class, 'dashboard'])->name('penyewa.dashboard-penyewa');
    Route::get('/cari-motor', [RenterController::class, 'cariMotor'])->name('penyewa.cari-motor');
    Route::get('/riwayat-sewa', [RenterController::class, 'riwayatSewa'])->name('penyewa.riwayat-sewa');
    // Route::get('/pemesanan', [RenterController::class, 'showPendingBookings'])->name('penyewa.pemesanan');

    // Di web.php
    Route::get('/pemesanan', [RenterController::class, 'showAllBookings'])->name('penyewa.pemesanan');
    Route::get('/pemesanan/{motorId}', [RenterController::class, 'showBookingForm'])->name('penyewa.show-pemesanan');
    Route::post('/pemesanan/{motorId}', [RenterController::class, 'processBooking'])->name('penyewa.processBooking');
    Route::delete('/bookings/{booking}/cancel', [RenterController::class, 'cancelBooking'])->name('penyewa.cancelBooking');
});

Route::get('/', function (Request $request) {
    $brand = trim((string) $request->query('brand', ''));
    $typeCc = trim((string) $request->query('type_cc', ''));

    $isSearching = $brand !== '' || $typeCc !== '';

    if (!Schema::hasTable('motors') || !Schema::hasTable('bookings')) {
        $motors = collect();
        $showcaseMotors = collect();
        return view('welcome', compact('motors', 'showcaseMotors', 'isSearching', 'brand', 'typeCc'));
    }

    $showcaseMotors = Motor::where('status', 'tersedia')
        ->has('rentalRates')
        ->orderBy('brand')
        ->get(['id', 'brand', 'type_cc', 'photo_url']);

    $motorsQuery = Motor::with('rentalRates')
        ->withCount([
            'bookings as completed_bookings_count' => function ($query) {
                $query->where('status', 'selesai');
            }
        ])
        ->where('status', 'tersedia');

    if ($brand !== '') {
        $motorsQuery->where('brand', 'like', '%' . $brand . '%');
    }

    if ($typeCc !== '') {
        $motorsQuery->where('type_cc', $typeCc);
    }

    $motors = $motorsQuery
        ->orderByDesc('completed_bookings_count')
        ->limit(4)
        ->get();

    return view('welcome', compact('motors', 'showcaseMotors', 'isSearching', 'brand', 'typeCc'));
});
