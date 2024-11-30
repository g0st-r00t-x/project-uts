<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Elektronik',
            'Gadget',
            'Furniture',
            'Pakaian',
            'Makanan'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'description' => 'Deskripsi untuk ' . $categoryName,
            ]);
        }
    }
}
