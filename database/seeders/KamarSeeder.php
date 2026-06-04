<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run()
    {
        // Data VIP
        for ($i = 1; $i <= 10; $i++) {
            Kamar::create([
                'no_kamar' => 'V' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tipe_kamar' => 'VIP',
                'fasilitas' => 'AC, Kamar mandi dalam, Tempat tidur, meja belajar, wifi',
                'harga_kamar' => 1500000,
                'status_kamar' => 'Tersedia' // Tambahkan ini
            ]);
        }

        // Data DELUXE
        for ($i = 1; $i <= 10; $i++) {
            Kamar::create([
                'no_kamar' => 'D' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tipe_kamar' => 'Deluxe',
                'fasilitas' => 'Kipas Angin, Kamar mandi dalam, Tempat tidur, Meja Belajar',
                'harga_kamar' => 1200000,
                'status_kamar' => 'Tersedia' 
            ]);
        }

        // Data STANDARD
        for ($i = 1; $i <= 10; $i++) {
            Kamar::create([
                'no_kamar' => 'SN' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tipe_kamar' => 'Standard',
                'fasilitas' => 'Kipas Angin, Kamar mandi dalam, Tempat tidur',
                'harga_kamar' => 800000,
                'status_kamar' => 'Tersedia' 
            ]);
        }
    }
}