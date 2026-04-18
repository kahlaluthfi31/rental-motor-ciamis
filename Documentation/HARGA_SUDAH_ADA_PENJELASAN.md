# ✅ Penjelasan Lengkap: Kenapa Harga "Tidak Ada"

## 🎯 Jawaban Singkat

**HARGA SUDAH ADA!** Namun harga disimpan di **tabel `rental_rates`** yang terpisah, bukan di tabel `motors`.

---

## 📊 Struktur Database

### Tabel `motors` (Data Motor)
```
id | owner_id | brand | type_cc | plate_number | status | photo_url | ...
1  | 2        | Honda CB100 | 100 | D 1234 AB | tersedia | ...
2  | 2        | Yamaha YZF-R15 | 100 | D 5678 CD | tersedia | ...
...
```

### Tabel `rental_rates` (Data Harga) ← **INILAH HARGANYA!**
```
id | motor_id | harian | mingguan | bulanan
1  | 1        | 150000 | 900000   | 3000000
2  | 2        | 150000 | 900000   | 3000000
3  | 3        | 150000 | 900000   | 3000000
4  | 4        | 200000 | 1200000  | 4000000
5  | 5        | 200000 | 1200000  | 4000000
6  | 6        | 200000 | 1200000  | 4000000
7  | 7        | 275000 | 1650000  | 5000000
8  | 8        | 275000 | 1650000  | 5000000
9  | 9        | 275000 | 1650000  | 5000000
10 | 10       | 275000 | 1650000  | 5000000
```

---

## 🔗 Relasi Antar Tabel

```
motors.id ←→ rental_rates.motor_id

Motor 1 (Honda CB100) ←→ Rental Rate 1 (Rp 150k/hari)
Motor 2 (Yamaha YZF) ←→ Rental Rate 2 (Rp 150k/hari)
Motor 3 (Suzuki GN100) ←→ Rental Rate 3 (Rp 150k/hari)
... dst
```

---

## ✅ Verifikasi Data Sudah Ada

Jalankan perintah ini di terminal:

```bash
php artisan tinker
>>> DB::table('rental_rates')->count()
# Output: 10 (berarti ada 10 data harga)

>>> DB::table('rental_rates')->get()
# Output: Tampilkan semua 10 harga

>>> DB::table('rental_rates')->where('motor_id', 1)->first()
# Output: Harga motor ID 1
```

---

## 🌐 Dimana Harga Ditampilkan di Aplikasi

### 1️⃣ **Halaman Penyewa - Cari Motor**
📍 **URL:** `http://127.0.0.1:8000/penyewa/cari-motor`

**Cara Melihat:**
1. Login dengan akun penyewa:
   - Email: `penyewa@rental.com`
   - Password: `password123`

2. Pergi ke "Cari Motor"

3. Klik tombol **"Sewa Sekarang"** pada motor apapun

4. **Modal popup akan menampilkan:**
   ```
   Harian: Rp 150.000
   Mingguan: Rp 900.000
   Bulanan: Rp 3.000.000
   ```

**Video Tutorial:**
- Set tanggal awal & akhir
- Pilih durasi (Harian/Mingguan/Bulanan)
- Lihat "Total Harga" dihitung otomatis berdasarkan harga × durasi

### 2️⃣ **Halaman Admin - Manajemen Harga**
📍 **URL:** `http://127.0.0.1:8000/admin/manajemen-harga`

**Tampilan:** Tabel dengan kolom Harian, Mingguan, Bulanan untuk setiap motor

### 3️⃣ **Dashboard Admin - Verifikasi Motor**
📍 **URL:** `http://127.0.0.1:8000/admin/verifikasi-motor`

**Tampilan:** Form input untuk set harga saat approve motor baru

---

## 💻 Code Di Behind-The-Scenes

### Model Motor.php
```php
class Motor extends Model
{
    public function rentalRates()
    {
        return $this->hasOne(RentalRate::class, 'motor_id');
    }
}
```

### Blade Template (cari-motor.blade.php)
```blade
<!-- Ambil harga dari relasi rentalRates -->
<button
    data-motor-harian="{{ $motor->rentalRates->harian ?? 0 }}"
    data-motor-mingguan="{{ $motor->rentalRates->mingguan ?? 0 }}"
    data-motor-bulanan="{{ $motor->rentalRates->bulanan ?? 0 }}"
    onclick="openBookingModal(this)">
    Sewa Sekarang
</button>
```

### JavaScript (di modal)
```javascript
function openBookingModal(button) {
    const motorHarian = button.getAttribute('data-motor-harian');
    const motorMingguan = button.getAttribute('data-motor-mingguan');
    const motorBulanan = button.getAttribute('data-motor-bulanan');
    
    // Tampilkan harga di modal
    document.getElementById('modal-harian-rate').textContent = motorHarian;
    document.getElementById('modal-mingguan-rate').textContent = motorMingguan;
    document.getElementById('modal-bulanan-rate').textContent = motorBulanan;
}
```

---

## 📈 Alur Lengkap Data Harga

### Saat Seeding (Awal)
```
Database Seeder
    ↓
RentalRateSeeder::run()
    ↓
DB::table('rental_rates')->insert($rentalRates)
    ↓
Harga disimpan di tabel rental_rates
```

### Saat Penyewa Melihat Motor
```
Penyewa akses /penyewa/cari-motor
    ↓
RenterController::cariMotor()
    ↓
$motors = Motor::with('rentalRates')->get()
    ↓
Blade template render dengan harga
    ↓
Button "Sewa Sekarang" memiliki data-motor-harian, mingguan, bulanan
    ↓
JavaScript baca atribut dan tampilkan di modal
```

### Saat Penyewa Pesan Motor
```
Penyewa klik "Pesan Sekarang"
    ↓
Form submit dengan:
    - motor_id
    - tanggal_mulai
    - tanggal_selesai
    - duration_type (daily/weekly/monthly)
    - total_biaya (dihitung JS)
    ↓
RenterController::processBooking()
    ↓
Booking dibuat dengan total_biaya dari form
```

---

## 🧪 Testing Sendiri

### Test 1: Lihat Harga di Database
```bash
php artisan tinker
>>> Motor::find(1)->rentalRates
# Output: RentalRate object dengan harian, mingguan, bulanan
```

### Test 2: Lihat Harga di Aplikasi
```
1. Login penyewa
2. Ke cari-motor
3. Klik "Sewa Sekarang"
4. Lihat harga muncul di modal
```

### Test 3: Lihat Harga Formatted
```blade
<!-- Tampilkan dengan format Rupiah -->
Rp {{ number_format($motor->rentalRates->harian, 0, ',', '.') }}
<!-- Output: Rp 150.000 -->
```

---

## ✅ Checklist - Semuanya Sudah Ada

- ✅ Tabel `motors` → 10 motor
- ✅ Tabel `rental_rates` → 10 harga
- ✅ Relasi Motor ↔ RentalRate sudah terkonfigurasi
- ✅ Model Motor memiliki method `rentalRates()`
- ✅ Model RentalRate sudah ada
- ✅ Blade template menggunakan `$motor->rentalRates->harian` dll
- ✅ JavaScript baca harga dari button attributes
- ✅ Modal popup tampilkan harga dengan benar
- ✅ Total harga dihitung otomatis
- ✅ RentalRateSeeder berhasil insert semua data

---

## 🎉 Kesimpulan

**Harga SUDAH ADA dan SUDAH BERFUNGSI!**

Yang mungkin membuat Anda bingung:
- Harga tidak di tabel `motors`, tapi di tabel `rental_rates` terpisah
- Harga baru terlihat setelah klik "Sewa Sekarang" (di modal)
- Harga baru tampil lengkap setelah upgrade motor approve (jika pending verification)

**Silakan coba:**
1. Login penyewa
2. Ke "Cari Motor"
3. Klik "Sewa Sekarang" pada motor apapun
4. Lihat modal dengan harga harian, mingguan, bulanan

Semuanya sudah siap! 🚀
