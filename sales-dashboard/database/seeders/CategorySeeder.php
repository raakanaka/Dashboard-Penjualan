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
                'name' => 'Elektronik',
                'description' => 'Produk-produk elektronik dan gadget',
                'is_active' => true,
            ],
            [
                'name' => 'Pakaian',
                'description' => 'Pakaian dan aksesoris fashion',
                'is_active' => true,
            ],
            [
                'name' => 'Makanan & Minuman',
                'description' => 'Produk makanan dan minuman',
                'is_active' => true,
            ],
            [
                'name' => 'Kesehatan & Kecantikan',
                'description' => 'Produk kesehatan dan kecantikan',
                'is_active' => true,
            ],
            [
                'name' => 'Rumah Tangga',
                'description' => 'Peralatan dan perlengkapan rumah tangga',
                'is_active' => true,
            ],
            [
                'name' => 'Olahraga',
                'description' => 'Peralatan dan pakaian olahraga',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
