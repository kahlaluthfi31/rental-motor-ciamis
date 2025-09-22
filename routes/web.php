<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RenterController;


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
    Route::post('/bookings/{booking}/cancel', [RenterController::class, 'cancelBooking'])->name('penyewa.cancelBooking');
});

Route::get('/', function () {
    return view('welcome');
});
