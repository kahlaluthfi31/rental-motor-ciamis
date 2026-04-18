# 📊 Penjelasan Harga Motor - Bagaimana Cara Kerjanya

## ✅ Status Harga Motor

Semua 10 motor sudah memiliki harga yang terdaftar di database. Harga disimpan di tabel `rental_rates` yang terpisah dari tabel `motors`.

---

## 📋 Daftar Lengkap Harga Motor

### Motor 100cc

| Motor | Plat | Harian | Mingguan | Bulanan |
|-------|------|--------|----------|---------|
| Honda CB100 | D 1234 AB | Rp 150.000 | Rp 900.000 | Rp 3.000.000 |
| Yamaha YZF-R15 | D 5678 CD | Rp 150.000 | Rp 900.000 | Rp 3.000.000 |
| Suzuki GN100 | D 9012 EF | Rp 150.000 | Rp 900.000 | Rp 3.000.000 |

### Motor 125cc

| Motor | Plat | Harian | Mingguan | Bulanan |
|-------|------|--------|----------|---------|
| Honda CB125R | D 3456 GH | Rp 200.000 | Rp 1.200.000 | Rp 4.000.000 |
| Yamaha Vixion | D 7890 IJ | Rp 200.000 | Rp 1.200.000 | Rp 4.000.000 |
| Kawasaki Ninja 125 | D 2345 KL | Rp 200.000 | Rp 1.200.000 | Rp 4.000.000 |

### Motor 150cc

| Motor | Plat | Harian | Mingguan | Bulanan |
|-------|------|--------|----------|---------|
| Honda CB150R | D 6789 MN | Rp 275.000 | Rp 1.650.000 | Rp 5.000.000 |
| Yamaha NMax 155 | D 4567 OP | Rp 275.000 | Rp 1.650.000 | Rp 5.000.000 |
| Suzuki GSX-R150 | D 8901 QR | Rp 275.000 | Rp 1.650.000 | Rp 5.000.000 |
| Kawasaki Ninja 150 | D 5432 ST | Rp 275.000 | Rp 1.650.000 | Rp 5.000.000 |

---

## 🏗️ Struktur Data

### Tabel `motors`
```
id | owner_id | brand | type_cc | plate_number | status | photo_url | ...
```

### Tabel `rental_rates` (Harga)
```
id | motor_id | harian | mingguan | bulanan | ...
```

**Relasi:**
- 1 Motor → 1 Rental Rate
- Motor ID 1 → Rental Rate ID 1
- Motor ID 2 → Rental Rate ID 2
- ... dst

---

## 🌐 Tempat Harga Ditampilkan

### 1. **Halaman Penyewa - Cari Motor**
📍 URL: `http://127.0.0.1:8000/penyewa/cari-motor`

**Tampilan:**
- Klik "Sewa Sekarang" → Modal popup menampilkan:
  - ✅ Harian: Rp XXX.XXX
  - ✅ Mingguan: Rp XXX.XXX
  - ✅ Bulanan: Rp XXX.XXX

**Code:**
```blade
<!-- File: resources/views/penyewa/cari-motor.blade.php -->
<button
    data-motor-harian="{{ $motor->rentalRates->harian ?? 0 }}"
    data-motor-mingguan="{{ $motor->rentalRates->mingguan ?? 0 }}"
    data-motor-bulanan="{{ $motor->rentalRates->bulanan ?? 0 }}"
    onclick="openBookingModal(this)">
    Sewa Sekarang
</button>
```

### 2. **Dashboard Pemilik - Manajemen Harga**
📍 URL: `http://127.0.0.1:8000/pemilik/manajemen-harga` (jika ada)

**Tampilan:**
- Tabel dengan kolom:
  - Motor Brand
  - Harian
  - Mingguan
  - Bulanan

### 3. **Dashboard Admin - Verifikasi Motor**
📍 URL: `http://127.0.0.1:8000/admin/verifikasi-motor`

**Tampilan:**
- Form untuk input harga saat approve motor:
  - Harga Harian (form input)
  - Harga Mingguan (form input)
  - Harga Bulanan (form input)

---

## 🔗 Cara Kerja Relasi

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

### Model RentalRate.php
```php
class RentalRate extends Model
{
    protected $fillable = [
        'motor_id',
        'harian',
        'mingguan',
        'bulanan',
    ];
}
```

### Penggunaan di Blade
```blade
<!-- Mengakses harga motor -->
{{ $motor->rentalRates->harian }}      <!-- Rp 150.000 -->
{{ $motor->rentalRates->mingguan }}    <!-- Rp 900.000 -->
{{ $motor->rentalRates->bulanan }}     <!-- Rp 3.000.000 -->

<!-- Format dengan rupiah -->
Rp {{ number_format($motor->rentalRates->harian, 0, ',', '.') }}
```

---

## 🔄 Alur Data Harga

### 1. **Saat Admin Approve Motor**
```
Admin input harga
↓
Form POST ke /admin/verifikasi-motor/{motor}/approve
↓
AdminController::approveMotor()
↓
$motor->rentalRates()->create([
    'harian' => $request->price_day,
    'mingguan' => $request->price_week,
    'bulanan' => $request->price_month,
])
↓
Data tersimpan di tabel rental_rates
```

### 2. **Saat Penyewa Melihat Harga**
```
Penyewa klik "Sewa Sekarang"
↓
openBookingModal(this) dipanggil
↓
Ambil data-motor-harian, mingguan, bulanan dari button
↓
Update modal dengan harga
↓
Tampilkan di UI
```

---

## 💾 Database Query

### Ambil semua motor dengan harganya
```php
$motors = Motor::with('rentalRates')->get();

// Atau dengan eager loading
$motors = Motor::has('rentalRates')->get();
```

### Ambil motor beserta harga berdasarkan tipe CC
```php
$motors = Motor::where('type_cc', '100')
    ->with('rentalRates')
    ->get();
```

### Ambil motor dengan harga tertentu
```php
$motors = Motor::whereHas('rentalRates', function ($q) {
    $q->where('harian', '>', 150000);
})->get();
```

---

## 🧪 Testing

### 1. Login sebagai Penyewa
```
Email: penyewa@rental.com
Password: password123
```

### 2. Pergi ke "Cari Motor"
```
URL: http://127.0.0.1:8000/penyewa/cari-motor
```

### 3. Klik "Sewa Sekarang" pada motor apapun
```
Lihat modal yang muncul
Harga harian, mingguan, bulanan akan ditampilkan
```

### 4. Ubah tanggal awal & akhir
```
Lihat "Total Harga" berubah berdasarkan durasi
Hitung otomatis: Harga × Jumlah Hari/Minggu/Bulan
```

---

## 🐛 Troubleshooting

### ❌ Harga tidak muncul di modal?

**Kemungkinan penyebab:**
1. Motor tidak memiliki rental rate
2. Relasi `rentalRates()` tidak bekerja

**Solusi:**
```php
// Cek apakah motor memiliki rental rate
$motor = Motor::find(1);
if ($motor->rentalRates) {
    echo "Harga: " . $motor->rentalRates->harian;
} else {
    echo "Motor tidak memiliki harga";
}
```

### ❌ Total harga tidak dihitung?

**Kemungkinan penyebab:**
1. JavaScript error saat parsing harga
2. Format harga tidak sesuai

**Solusi:**
```javascript
// Cek di browser console (F12)
console.log(harianRate, mingguanRate, bulananRate);
```

---

## ✅ Verifikasi Data

Jalankan query di database:

```sql
-- Lihat semua motor dengan harganya
SELECT m.id, m.brand, m.type_cc, m.plate_number, 
       r.harian, r.mingguan, r.bulanan
FROM motors m
LEFT JOIN rental_rates r ON m.id = r.motor_id
ORDER BY m.id;

-- Lihat hanya motor yang punya harga
SELECT m.id, m.brand, m.type_cc, m.plate_number, 
       r.harian, r.mingguan, r.bulanan
FROM motors m
INNER JOIN rental_rates r ON m.id = r.motor_id;

-- Hitung total motor dengan harga
SELECT COUNT(*) FROM motors 
WHERE id IN (SELECT DISTINCT motor_id FROM rental_rates);
```

---

## 📝 Catatan

- ✅ Semua 10 motor sudah memiliki rental rate
- ✅ Harga sesuai dengan tipe CC motor
- ✅ RentalRateSeeder berhasil dijalankan
- ✅ Relasi Motor ↔ RentalRate sudah terkonfigurasi
- ✅ Harga ditampilkan di berbagai halaman aplikasi

Semuanya sudah siap! Harga motor sudah tersimpan dan dapat ditampilkan. 🎉
