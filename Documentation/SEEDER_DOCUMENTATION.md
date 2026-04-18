# Dokumentasi Database Seeder - Motor Rental

## 📋 Daftar Seeder yang Dibuat

Saya telah membuat 3 seeder untuk aplikasi Rental Motor Anda:

### 1. **UserSeeder** (Sudah Ada)
**File:** `database/seeders/UserSeeder.php`

Membuat data user dengan 3 role berbeda:
- **Admin** (ID: 1)
  - Email: `admin@rental.com`
  - Password: `password123`
  
- **Pemilik Motor** (ID: 2)
  - Email: `pemilik@rental.com`
  - Password: `password123`
  
- **Penyewa Motor** (ID: 3)
  - Email: `penyewa@rental.com`
  - Password: `password123`

---

### 2. **MotorSeeder** ✨ (Baru Dibuat)
**File:** `database/seeders/MotorSeeder.php`

Membuat 10 motor dengan berbagai tipe dan status:

#### Motor 100cc (3 unit)
1. **Honda CB100** - Plat: D 1234 AB - Status: Tersedia
2. **Yamaha YZF-R15** - Plat: D 5678 CD - Status: Tersedia
3. **Suzuki GN100** - Plat: D 9012 EF - Status: Tersedia

#### Motor 125cc (3 unit)
4. **Honda CB125R** - Plat: D 3456 GH - Status: Tersedia
5. **Yamaha Vixion** - Plat: D 7890 IJ - Status: Disewa
6. **Kawasaki Ninja 125** - Plat: D 2345 KL - Status: Tersedia

#### Motor 150cc (4 unit)
7. **Honda CB150R** - Plat: D 6789 MN - Status: Tersedia
8. **Yamaha NMax 155** - Plat: D 4567 OP - Status: Tersedia
9. **Suzuki GSX-R150** - Plat: D 8901 QR - Status: Pending Verification
10. **Kawasaki Ninja 150** - Plat: D 5432 ST - Status: Tersedia

**Pemilik:** Pemilik Motor (ID: 2)

---

### 3. **RentalRateSeeder** ✨ (Baru Dibuat)
**File:** `database/seeders/RentalRateSeeder.php`

Membuat harga rental untuk setiap motor dengan harga yang disesuaikan berdasarkan tipe CC:

| Tipe CC | Harian | Mingguan | Bulanan |
|---------|--------|----------|---------|
| 100cc | Rp 150.000 | Rp 900.000 | Rp 3.000.000 |
| 125cc | Rp 200.000 | Rp 1.200.000 | Rp 4.000.000 |
| 150cc | Rp 275.000 | Rp 1.650.000 | Rp 5.000.000 |

---

## 🚀 Cara Menggunakan Seeder

### Menjalankan semua seeder sekaligus (dengan migration fresh)
```bash
php artisan migrate:refresh --seed
```

### Menjalankan hanya seeder tanpa migration
```bash
php artisan db:seed
```

### Menjalankan seeder tertentu saja
```bash
# Jalankan hanya MotorSeeder
php artisan db:seed --class=MotorSeeder

# Jalankan hanya RentalRateSeeder
php artisan db:seed --class=RentalRateSeeder
```

---

## 📊 Data yang Dibuat

Setelah menjalankan seeder, database akan berisi:

### Tabel `users`
- 1 Admin
- 1 Pemilik
- 1 Penyewa

### Tabel `motors`
- 10 Motor dengan berbagai tipe CC (100, 125, 150)
- Status bervariasi: tersedia, disewa, pending_verification
- Semua motor milik Pemilik Motor (ID: 2)

### Tabel `rental_rates`
- 10 harga rental sesuai dengan 10 motor
- Harga disesuaikan dengan tipe CC motor

---

## 🔐 Akun Test

Gunakan akun berikut untuk testing:

### Login sebagai Pemilik Motor
- **Email:** pemilik@rental.com
- **Password:** password123
- **URL:** http://127.0.0.1:8000/login

### Login sebagai Penyewa Motor
- **Email:** penyewa@rental.com
- **Password:** password123

### Login sebagai Admin
- **Email:** admin@rental.com
- **Password:** password123

---

## 📝 Struktur File Seeder

### MotorSeeder.php
```php
class MotorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('motors')->delete();
        
        $motors = [
            // Array dengan 10 motor
        ];
        
        DB::table('motors')->insert($motors);
    }
}
```

### RentalRateSeeder.php
```php
class RentalRateSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rental_rates')->delete();
        
        $rentalRates = [
            // Array dengan 10 harga rental
        ];
        
        DB::table('rental_rates')->insert($rentalRates);
    }
}
```

### DatabaseSeeder.php
```php
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MotorSeeder::class,
            RentalRateSeeder::class,
        ]);
    }
}
```

---

## 💡 Tips

1. **Jika ingin menambah lebih banyak motor:** Edit file `MotorSeeder.php` dan tambahkan data ke array `$motors`

2. **Jika ingin mengubah harga:** Edit file `RentalRateSeeder.php` dan sesuaikan nilai di array `$rentalRates`

3. **Jika ada data yang sudah ada:** Seeder akan otomatis menghapus data lama sebelum insert data baru (menggunakan `DB::table('motors')->delete()`)

4. **Untuk development:** Gunakan `php artisan migrate:refresh --seed` untuk reset database dengan data test yang fresh

---

## ✅ Status Seeding

Seeding berhasil dijalankan dengan output:
```
Database\Seeders\UserSeeder ............................ 638 ms DONE
Database\Seeders\MotorSeeder ........................... 5 ms DONE
Database\Seeders\RentalRateSeeder ...................... 9 ms DONE
```

Semua data telah berhasil dimasukkan ke database! 🎉
