<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $categories = Category::all(); // Mengambil semua kategori yang telah dibuat

        // Buat 50 produk random
        foreach (range(1, 50) as $index) {
            Product::create([
                'name' => $faker->words(2, true), // Nama produk dengan 2 kata
                'description' => $faker->sentence(), // Deskripsi produk
                'price' => $faker->numberBetween(100000, 5000000), // Harga antara 100 ribu hingga 5 juta
                'stock' => $faker->numberBetween(5, 100), // Stok antara 5 hingga 100
                'category_id' => $categories->random()->id, // Memilih kategori secara acak
            ]);
        }
    }
}
