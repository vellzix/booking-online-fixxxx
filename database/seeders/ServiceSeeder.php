<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            // Tiket Pesawat
            [
                'category_id' => 1,
                'name' => 'Jakarta - Bali',
                'description' => 'Penerbangan langsung Jakarta ke Bali',
                'price' => 1200000,
                'capacity' => 200,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Jakarta - Yogyakarta',
                'description' => 'Penerbangan langsung Jakarta ke Yogyakarta',
                'price' => 800000,
                'capacity' => 180,
                'is_available' => true,
            ],
            
            // Hotel
            [
                'category_id' => 2,
                'name' => 'Grand Hotel Bali',
                'description' => 'Hotel bintang 5 di Kuta, Bali',
                'price' => 1500000,
                'capacity' => 50,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Yogyakarta Royal Hotel',
                'description' => 'Hotel mewah di pusat kota Yogyakarta',
                'price' => 1000000,
                'capacity' => 40,
                'is_available' => true,
            ],

            // Travel
            [
                'category_id' => 3,
                'name' => 'Paket Tour Bali 3D2N',
                'description' => 'Paket wisata Bali selama 3 hari 2 malam',
                'price' => 2500000,
                'capacity' => 20,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Paket Tour Yogya 2D1N',
                'description' => 'Paket wisata Yogyakarta selama 2 hari 1 malam',
                'price' => 1500000,
                'capacity' => 15,
                'is_available' => true,
            ],

            // Villa
            [
                'category_id' => 4,
                'name' => 'Villa Luxury Bali',
                'description' => 'Villa mewah dengan kolam renang pribadi di Ubud',
                'price' => 3000000,
                'capacity' => 8,
                'is_available' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Villa Kaliurang',
                'description' => 'Villa nyaman di kaki Gunung Merapi',
                'price' => 2000000,
                'capacity' => 6,
                'is_available' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
