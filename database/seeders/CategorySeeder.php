<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tiket Pesawat',
                'slug' => 'tiket-pesawat',
                'description' => 'Berbagai tiket pesawat domestik dan internasional',
                'icon' => 'fa-plane',
            ],
            [
                'name' => 'Hotel',
                'slug' => 'hotel',
                'description' => 'Akomodasi hotel berbintang',
                'icon' => 'fa-hotel',
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Paket perjalanan wisata',
                'icon' => 'fa-bus',
            ],
            [
                'name' => 'Villa',
                'slug' => 'villa',
                'description' => 'Villa dan penginapan eksklusif',
                'icon' => 'fa-home',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
