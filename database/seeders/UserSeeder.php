<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ganti truncate() dengan delete()
        DB::table('users')->delete();

        // Data Admin (1 user)
        DB::table('users')->insert([
            [
                'id' => 1, // Tambahkan ID manual untuk konsistensi
                'name' => 'Admin Rental',
                'email' => 'admin@rental.com',
                'phone' => '081234567890',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Data Pemilik (1 user)
        DB::table('users')->insert([
            [
                'id' => 2,
                'name' => 'Pemilik Motor',
                'email' => 'pemilik@rental.com',
                'phone' => '081234567891',
                'password' => Hash::make('password123'),
                'role' => 'pemilik',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Data Penyewa (1 user)
        DB::table('users')->insert([
            [
                'id' => 3,
                'name' => 'Penyewa Motor',
                'email' => 'penyewa@rental.com',
                'phone' => '081234567892',
                'password' => Hash::make('password123'),
                'role' => 'penyewa',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        $this->command->info('UserSeeder berhasil dijalankan!');
    }
}
