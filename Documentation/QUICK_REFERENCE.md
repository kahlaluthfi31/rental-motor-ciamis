# 🚀 QUICK START - Lihat Harga Motor

## ⚡ 3 Langkah Cepat

### Langkah 1: Login
```
URL: http://127.0.0.1:8000/login

Email: penyewa@rental.com
Password: password123
```

### Langkah 2: Buka Cari Motor
```
URL: http://127.0.0.1:8000/penyewa/cari-motor
```

### Langkah 3: Klik "Sewa Sekarang"
```
Cari motor apapun, lalu klik tombol "Sewa Sekarang"
Modal akan muncul dengan harga:
  - Harian
  - Mingguan
  - Bulanan
```

---

## 📋 Harga Sesuai Tipe CC

### 100cc
```
Rp 150.000 / hari
Rp 900.000 / minggu
Rp 3.000.000 / bulan
```

### 125cc
```
Rp 200.000 / hari
Rp 1.200.000 / minggu
Rp 4.000.000 / bulan
```

### 150cc
```
Rp 275.000 / hari
Rp 1.650.000 / minggu
Rp 5.000.000 / bulan
```

---

## ✅ Daftar Motor yang Ada

### 100cc (3 unit)
- [ ] Honda CB100 - D 1234 AB
- [ ] Yamaha YZF-R15 - D 5678 CD
- [ ] Suzuki GN100 - D 9012 EF

### 125cc (3 unit)
- [ ] Honda CB125R - D 3456 GH
- [ ] Yamaha Vixion - D 7890 IJ (⚠️ Sedang disewa)
- [ ] Kawasaki Ninja 125 - D 2345 KL

### 150cc (4 unit)
- [ ] Honda CB150R - D 6789 MN
- [ ] Yamaha NMax 155 - D 4567 OP
- [ ] Suzuki GSX-R150 - D 8901 QR (⏳ Pending verification)
- [ ] Kawasaki Ninja 150 - D 5432 ST

---

## 💻 Verifikasi via Terminal

```bash
# Cek jumlah motor
php artisan tinker
>>> Motor::count()
# Output: 10

# Cek jumlah harga
>>> DB::table('rental_rates')->count()
# Output: 10

# Lihat harga motor ID 1
>>> Motor::find(1)->rentalRates
# Output: RentalRate object dengan harian, mingguan, bulanan
```

---

## 🎯 Selesai!

Harga sudah ada dan siap digunakan. Silakan test di aplikasi! 🚀
