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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class OwnerController extends Controller
{
    public function dashboard()
    {
        $owner = Auth::user();

        // Mendapatkan semua motor yang dimiliki oleh user yang sedang login
        $motors = $owner->motors;

        // Menghitung statistik untuk dashboard
        $totalMotors = $motors->count();
        $availableMotors = $motors->where('status', 'tersedia')->count();
        $rentedMotors = $motors->where('status', 'disewa')->count();

        // PERBAIKAN: Hitung bagi hasil pemilik dari revenue_sharings BUKAN dari bookings
        $totalOwnerShare = DB::table('revenue_sharings')
            ->join('bookings', 'revenue_sharings.booking_id', '=', 'bookings.id')
            ->join('motors', 'bookings.motor_id', '=', 'motors.id')
            ->where('motors.owner_id', $owner->id)
            ->sum('revenue_sharings.pemilik_share');

        return view('pemilik.dashboard-pemilik', compact(
            'totalMotors',
            'availableMotors',
            'rentedMotors',
            'totalOwnerShare',
            'motors'
        ));
    }

    public function titipMotor()
    {
        $owner = Auth::user();
        // Mengambil semua motor milik pemilik yang sedang login
        $motors = $owner->motors;

        return view('pemilik.titip-motor', compact('motors'));
    }

    public function storeMotor(Request $request)
    {
        try {
            Log::info('StoreMotor called', ['request' => $request->all()]);

            // Validasi data yang masuk
            $validated = $request->validate([
                'brand' => 'required|string|max:255',
                'type_cc' => 'required|string|max:255',
                'plate_number' => 'required|string|max:20|unique:motors,plate_number',
                'photo_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'dokumen_kepemilikan' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            // Unggah foto
            if ($request->hasFile('photo_url')) {
                $path = $request->file('photo_url')->store('motor_photos', 'public');
                Log::info('Photo uploaded', ['path' => $path]);
            }

            // Buat entri motor baru
            $motor = new Motor();
            $motor->owner_id = Auth::id();
            $motor->brand = $request->brand;
            $motor->type_cc = $request->type_cc;
            $motor->plate_number = $request->plate_number;
            $motor->status = 'pending_verification';
            $motor->photo_url = 'storage/' . $path;

            Log::info('Motor data prepared', ['motor' => $motor->toArray()]);

            // Upload dokumen kepemilikan jika ada
            if ($request->hasFile('dokumen_kepemilikan')) {
                $docPath = $request->file('dokumen_kepemilikan')->store('motor_documents', 'public');
                $motor->dokumen_kepemilikan = 'storage/' . $docPath;
                Log::info('Document uploaded', ['docPath' => $docPath]);
            }

            $motor->save();
            Log::info('Motor saved successfully', ['motor_id' => $motor->id]);

            return redirect()->route('pemilik.titip-motor')->with('success', 'Motor Anda berhasil didaftarkan! Motor akan diverifikasi dalam 24 jam.');
        } catch (\Exception $e) {
            Log::error('Error in storeMotor', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function laporan()
    {
        $owner = Auth::user();

        // PERBAIKAN: Ambil data dari revenue_sharings yang terkait dengan motor pemilik
        $revenueData = DB::table('revenue_sharings')
            ->join('bookings', 'revenue_sharings.booking_id', '=', 'bookings.id')
            ->join('motors', 'bookings.motor_id', '=', 'motors.id')
            ->where('motors.owner_id', $owner->id)
            ->select(
                'revenue_sharings.*',
                'bookings.*',
                'motors.brand',
                'motors.type_cc',
                'motors.plate_number',
                'motors.photo_url'
            )
            ->get();

        // Hitung total dari data aktual
        $totalGrossRevenue = $revenueData->sum(function ($item) {
            return $item->pemilik_share + $item->admin_share;
        });

        $rmcRevenue = $revenueData->sum('admin_share');
        $ownerShare = $revenueData->sum('pemilik_share');

        return view('pemilik.laporan', compact(
            'revenueData',
            'totalGrossRevenue',
            'rmcRevenue',
            'ownerShare'
        ));
    }

    public function update(Request $request, Motor $motor)
    {
        // Pastikan motor milik user yang login
        if ($motor->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'type_cc' => 'required|in:100,125,150',
            'plate_number' => 'required|string|max:255|unique:motors,plate_number,' . $motor->id,
            'photo_url' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'dokumen_kepemilikan' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // TAMBAHAN: Validasi dokumen
        ]);

        // Upload foto jika ada
        if ($request->hasFile('photo_url')) {
            $path = $request->file('photo_url')->store('motor-photos', 'public');
            $validated['photo_url'] = 'storage/' . $path;
        }

        // Upload dokumen kepemilikan jika ada
        if ($request->hasFile('dokumen_kepemilikan')) {
            $path = $request->file('dokumen_kepemilikan')->store('motor-documents', 'public');
            $validated['dokumen_kepemilikan'] = 'storage/' . $path;
        }

        $motor->update($validated);

        return redirect()->route('pemilik.titip-motor')
            ->with('success', 'Data motor berhasil diperbarui.');
    }

    public function destroy(Motor $motor)
    {
        // Pastikan motor milik user yang login
        if ($motor->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Cek status motor
        if ($motor->status === 'disewa' || $motor->status === 'pending_verification') {
            return redirect()->route('pemilik.titip-motor')
                ->with('error', 'Motor tidak dapat dihapus karena sedang disewa atau dalam proses verifikasi.');
        }

        $motor->delete();

        return redirect()->route('pemilik.titip-motor')
            ->with('success', 'Motor berhasil dihapus.');
    }
}
