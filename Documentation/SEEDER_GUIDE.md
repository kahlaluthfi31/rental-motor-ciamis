# 🛠️ Panduan Modifikasi Seeder Motor Rental

## 📝 Daftar Seeder

Aplikasi Anda memiliki 3 seeder:
1. **UserSeeder** - Data pengguna (Admin, Pemilik, Penyewa)
2. **MotorSeeder** - Data motor yang tersedia
3. **RentalRateSeeder** - Harga rental untuk setiap motor

---

## 🔧 Cara Menambah Motor Baru

### Langkah 1: Buka `MotorSeeder.php`
File: `database/seeders/MotorSeeder.php`

### Langkah 2: Tambahkan data motor di dalam array `$motors`

Contoh menambah motor baru:
```php
$motors = [
    // Motor yang sudah ada...
    
    // Motor baru
    [
        'owner_id' => 2,
        'brand' => 'Harley-Davidson Street 750',
        'type_cc' => '150',
        'plate_number' => 'D 9999 ZZ',
        'status' => 'tersedia',
        'photo_url' => 'storage/motor_photos/harley_street750.jpg',
        'dokumen_kepemilikan' => 'storage/motor_documents/stnk_d9999zz.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ],
];
```

### Langkah 3: Jalankan seeder
```bash
php artisan db:seed --class=MotorSeeder
```

---

## 💰 Cara Mengubah Harga Rental

### Langkah 1: Buka `RentalRateSeeder.php`
File: `database/seeders/RentalRateSeeder.php`

### Langkah 2: Ubah nilai harga di array `$rentalRates`

Struktur data rental rate:
```php
[
    'motor_id' => 1,           // ID motor yang sesuai
    'harian' => 150000,        // Harga per hari (dalam Rupiah)
    'mingguan' => 900000,      // Harga per minggu (dalam Rupiah)
    'bulanan' => 3000000,      // Harga per bulan (dalam Rupiah)
    'created_at' => now(),
    'updated_at' => now(),
],
```

### Contoh mengubah harga motor ID 1:
```php
// Sebelum
[
    'motor_id' => 1,
    'harian' => 150000,
    'mingguan' => 900000,
    'bulanan' => 3000000,
    ...
],

// Sesudah (harga naik)
[
    'motor_id' => 1,
    'harian' => 200000,        // Naik dari 150k
    'mingguan' => 1200000,     // Naik dari 900k
    'bulanan' => 4000000,      // Naik dari 3jt
    ...
],
```

### Langkah 3: Jalankan seeder
```bash
php artisan db:seed --class=RentalRateSeeder
```

---

## 👥 Cara Menambah User Baru

### Langkah 1: Buka `UserSeeder.php`
File: `database/seeders/UserSeeder.php`

### Langkah 2: Tambahkan user baru
```php
DB::table('users')->insert([
    [
        'id' => 4,  // ID baru yang unik
        'name' => 'Pemilik Motor Kedua',
        'email' => 'pemilik2@rental.com',
        'phone' => '081234567892',
        'password' => Hash::make('password123'),
        'role' => 'pemilik',
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);
```

### Langkah 3: Jalankan seeder
```bash
php artisan db:seed --class=UserSeeder
```

---

## ⚠️ Catatan Penting

### Status Motor yang Valid
```php
'status' => 'tersedia'              // Motor siap disewa
'status' => 'disewa'                // Motor sedang disewa
'status' => 'pending_verification'  // Menunggu verifikasi admin
'status' => 'dibatalkan'            // Motor dibatalkan/tidak aktif
```

### Tipe CC yang Valid
```php
'type_cc' => '100'   // Motor 100cc
'type_cc' => '125'   // Motor 125cc
'type_cc' => '150'   // Motor 150cc
```

### Role User yang Valid
```php
'role' => 'admin'    // Administrator
'role' => 'pemilik'  // Pemilik Motor
'role' => 'penyewa'  // Penyewa Motor
```

### Struktur Plat Nomor
```php
'plate_number' => 'D 1234 AB'  // Format: Kode_Provinsi NOMOR HURUF
// D = Jawa Barat (Bandung)
// Gunakan format dengan spasi seperti di atas
```

---

## 🔄 Perintah Seeder Umum

### Reset semua data dan seeding ulang
```bash
php artisan migrate:refresh --seed
```

### Hanya seeding (tanpa migration)
```bash
php artisan db:seed
```

### Seeding seeder tertentu
```bash
php artisan db:seed --class=MotorSeeder
php artisan db:seed --class=RentalRateSeeder
php artisan db:seed --class=UserSeeder
```

### Melihat output seeder
```bash
php artisan db:seed --verbose
```

---

## 🐛 Troubleshooting

### Error: "Column not found"
**Solusi:** Pastikan nama kolom sesuai dengan struktur tabel di migration
- Motors: `owner_id`, `brand`, `type_cc`, `plate_number`, `status`, `photo_url`, `dokumen_kepemilikan`
- Rental Rates: `motor_id`, `harian`, `mingguan`, `bulanan`
- Users: `id`, `name`, `email`, `phone`, `password`, `role`

### Error: "Foreign key constraint fails"
**Solusi:** Pastikan `owner_id` atau `motor_id` yang direferensikan sudah ada
- Ketika menambah motor, pastikan `owner_id` = 2 (Pemilik) atau ID user yang ada
- Ketika menambah rental rate, pastikan `motor_id` sesuai dengan motor yang ada

### Data tidak berubah setelah seeding
**Solusi:** Gunakan `migrate:refresh --seed` untuk reset dan seeding ulang
```bash
php artisan migrate:refresh --seed
```

---

## 📊 Contoh Data yang Sudah Ada

### Motor Tersedia
- Honda CB100 (100cc) - ID Motor 1
- Yamaha YZF-R15 (100cc) - ID Motor 2
- Suzuki GN100 (100cc) - ID Motor 3
- Honda CB125R (125cc) - ID Motor 4
- Honda CB150R (150cc) - ID Motor 7

### Motor Sedang Disewa
- Yamaha Vixion (125cc) - ID Motor 5

### Motor Pending Verification
- Suzuki GSX-R150 (150cc) - ID Motor 9

---

## 💡 Tips Praktis

### Membuat banyak motor sekaligus dengan array
```php
$motors = [];

for ($i = 1; $i <= 20; $i++) {
    $motors[] = [
        'owner_id' => 2,
        'brand' => 'Motor Dummy ' . $i,
        'type_cc' => ['100', '125', '150'][rand(0, 2)],
        'plate_number' => 'D ' . str_pad($i, 4, '0', STR_PAD_LEFT) . ' XX',
        'status' => 'tersedia',
        'photo_url' => 'storage/motor_photos/dummy_' . $i . '.jpg',
        'dokumen_kepemilikan' => 'storage/motor_documents/dummy_' . $i . '.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ];
}

DB::table('motors')->insert($motors);
```

### Menggunakan Factory untuk data yang lebih realistis
```php
// Buat factory untuk Motor
php artisan make:factory MotorFactory

// Gunakan di seeder
Motor::factory(50)->create(['owner_id' => 2]);
```

---

## 📚 File Referensi

- `database/seeders/MotorSeeder.php` - Seeder untuk motor
- `database/seeders/RentalRateSeeder.php` - Seeder untuk harga rental
- `database/seeders/UserSeeder.php` - Seeder untuk pengguna
- `database/seeders/DatabaseSeeder.php` - Seeder utama yang memanggil semua seeder
- `database/migrations/2025_09_22_004905_create_motors_table.php` - Struktur tabel motors
- `database/migrations/2025_09_22_005120_create_rental_rates_table.php` - Struktur tabel rental_rates

---

## 🎯 Workflow Rekomendasi

1. **Development**: Gunakan `php artisan migrate:refresh --seed` setiap kali ingin reset
2. **Testing**: Tambahkan data test melalui seeder, bukan melalui UI
3. **Production**: Gunakan seeder hanya sekali di awal, kemudian gunakan migration untuk perubahan struktur

---

Semoga panduan ini membantu! Jika ada pertanyaan, silakan hubungi tim development. 🚀
