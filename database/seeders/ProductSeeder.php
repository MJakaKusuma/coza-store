<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Sneaker Sport',
            'description' => 'Sepatu olahraga pria.',
            'price' => 350000,
            'image' => 'products/sneaker.jpg',
            'gender' => 'men',
            'category_id' => 2, // Shoes
        ]);
    }
}
