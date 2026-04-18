<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data motor yang sudah ada
        DB::table('motors')->delete();

        // Data Motor untuk Pemilik ID 2
        $motors = [
            // Kelompok 1: Motor 100cc
            [
                'owner_id' => 2,
                'brand' => 'Honda CB100',
                'type_cc' => '100',
                'plate_number' => 'D 1234 AB',
                'status' => 'tersedia',
                'photo_url' => 'https://www.hondamandalajayaabadi.com/uploads/1/1/8/8/118818151/genio-front-01.webp',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => 2,
                'brand' => 'Yamaha YZF-R15',
                'type_cc' => '100',
                'plate_number' => 'D 5678 CD',
                'status' => 'tersedia',
                'photo_url' => 'https://www.wahanahonda.com/assets/upload/produk/gambar/PRODUK_GAMBAR_48_2025-10-29.webp',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => 2,
                'brand' => 'Suzuki GN100',
                'type_cc' => '100',
                'plate_number' => 'D 9012 EF',
                'status' => 'tersedia',
                'photo_url' => 'https://akcdn.detik.net.id/visual/2023/01/17/yamaha-grand-filano_169.png?w=1200',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kelompok 2: Motor 125cc
            [
                'owner_id' => 2,
                'brand' => 'Honda CB125R',
                'type_cc' => '125',
                'plate_number' => 'D 3456 GH',
                'status' => 'tersedia',
                'photo_url' => 'https://i0.wp.com/www.fortuna-motor.co.id/wp-content/uploads/2024/02/2024103012395610897K52086.png?fit=560%2C492&ssl=1',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => 2,
                'brand' => 'Yamaha Vixion',
                'type_cc' => '125',
                'plate_number' => 'D 7890 IJ',
                'status' => 'disewa',
                'photo_url' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/medium//105/MTA-90636709/yamaha_yamaha_full01.jpg',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => 2,
                'brand' => 'Kawasaki Ninja 125',
                'type_cc' => '125',
                'plate_number' => 'D 2345 KL',
                'status' => 'tersedia',
                'photo_url' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/MTA-138568684/yamaha_yamaha_grand_filano_hybrid_connected_-_neo_version_sepeda_motor_-otr_jabodetabekser-_full02_rwho7cii.jpg',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kelompok 3: Motor 150cc
            [
                'owner_id' => 2,
                'brand' => 'Honda CB150R',
                'type_cc' => '150',
                'plate_number' => 'D 6789 MN',
                'status' => 'tersedia',
                'photo_url' => 'https://id.ronghaomotor.com/uploads/202133587/racing-motor-200cc-small-displacement46518876378.jpg',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => 2,
                'brand' => 'Yamaha NMax 155',
                'type_cc' => '150',
                'plate_number' => 'D 4567 OP',
                'status' => 'tersedia',
                'photo_url' => 'https://elangsung.com/wp-content/uploads/2023/11/Daftar-Merek-Motor-di-Indonesia-kamu-punya-yang-mana-yamaha-aerox.webp',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => 2,
                'brand' => 'Suzuki GSX-R150',
                'type_cc' => '150',
                'plate_number' => 'D 8901 QR',
                'status' => 'pending_verification',
                'photo_url' => 'https://s3.ap-southeast-1.amazonaws.com/img.jba.co.id//wysiwyg/ckeditor/20250226093459cover8DwRtu53.webp',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => 2,
                'brand' => 'Kawasaki Ninja 150',
                'type_cc' => '150',
                'plate_number' => 'D 5432 ST',
                'status' => 'tersedia',
                'photo_url' => 'https://motorace.ph/wp-content/uploads/2025/02/5.png',
                'dokumen_kepemilikan' => 'https://asset.kompas.com/crops/OkStXTmEoXsaWBoxDK6NvakV_wc=/0x73:1280x926/1200x800/data/photo/2021/09/01/612e627c91f83.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data ke database
        DB::table('motors')->insert($motors);

        // Tampilkan informasi
        $this->command->info('Motor seeder berhasil dijalankan!');
        $this->command->info('Total motor yang dibuat: ' . count($motors));
        $this->command->info('Pemilik: Pemilik Motor (ID: 2)');
    }
}
