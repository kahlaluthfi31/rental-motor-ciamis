<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data rental rate yang sudah ada
        DB::table('rental_rates')->delete();

        // Harga rental untuk setiap motor
        $rentalRates = [
            // Motor 100cc - Harga lebih murah
            [
                'motor_id' => 1,
                'harian' => 150000,
                'mingguan' => 900000,
                'bulanan' => 3000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'motor_id' => 2,
                'harian' => 150000,
                'mingguan' => 900000,
                'bulanan' => 3000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'motor_id' => 3,
                'harian' => 150000,
                'mingguan' => 900000,
                'bulanan' => 3000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Motor 125cc - Harga menengah
            [
                'motor_id' => 4,
                'harian' => 200000,
                'mingguan' => 1200000,
                'bulanan' => 4000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'motor_id' => 5,
                'harian' => 200000,
                'mingguan' => 1200000,
                'bulanan' => 4000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'motor_id' => 6,
                'harian' => 200000,
                'mingguan' => 1200000,
                'bulanan' => 4000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Motor 150cc - Harga tertinggi
            [
                'motor_id' => 7,
                'harian' => 275000,
                'mingguan' => 1650000,
                'bulanan' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'motor_id' => 8,
                'harian' => 275000,
                'mingguan' => 1650000,
                'bulanan' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'motor_id' => 9,
                'harian' => 275000,
                'mingguan' => 1650000,
                'bulanan' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'motor_id' => 10,
                'harian' => 275000,
                'mingguan' => 1650000,
                'bulanan' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data ke database
        DB::table('rental_rates')->insert($rentalRates);

        // Tampilkan informasi
        $this->command->info('Rental Rate seeder berhasil dijalankan!');
        $this->command->info('Total rental rate yang dibuat: ' . count($rentalRates));
    }
}
