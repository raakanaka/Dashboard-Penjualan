<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Asus ROG',
                'description' => 'Laptop gaming dengan performa tinggi',
                'sku' => 'LAP001',
                'price' => 15000000,
                'cost_price' => 12000000,
                'stock' => 10,
                'min_stock' => 2,
                'category_name' => 'Elektronik',
            ],
            [
                'name' => 'Smartphone Samsung Galaxy',
                'description' => 'Smartphone Android terbaru',
                'sku' => 'PHN001',
                'price' => 5000000,
                'cost_price' => 4000000,
                'stock' => 25,
                'min_stock' => 5,
                'category_name' => 'Elektronik',
            ],
            [
                'name' => 'Kemeja Pria Premium',
                'description' => 'Kemeja pria dengan bahan berkualitas',
                'sku' => 'CLT001',
                'price' => 250000,
                'cost_price' => 150000,
                'stock' => 50,
                'min_stock' => 10,
                'category_name' => 'Pakaian',
            ],
            [
                'name' => 'Dress Wanita Elegan',
                'description' => 'Dress wanita dengan desain modern',
                'sku' => 'CLT002',
                'price' => 350000,
                'cost_price' => 200000,
                'stock' => 30,
                'min_stock' => 8,
                'category_name' => 'Pakaian',
            ],
            [
                'name' => 'Snack Keripik Kentang',
                'description' => 'Keripik kentang dengan berbagai rasa',
                'sku' => 'FOD001',
                'price' => 15000,
                'cost_price' => 8000,
                'stock' => 100,
                'min_stock' => 20,
                'category_name' => 'Makanan & Minuman',
            ],
            [
                'name' => 'Minuman Soda',
                'description' => 'Minuman soda segar',
                'sku' => 'FOD002',
                'price' => 8000,
                'cost_price' => 4000,
                'stock' => 200,
                'min_stock' => 50,
                'category_name' => 'Makanan & Minuman',
            ],
            [
                'name' => 'Shampoo Anti Ketombe',
                'description' => 'Shampoo untuk mengatasi ketombe',
                'sku' => 'HLT001',
                'price' => 45000,
                'cost_price' => 25000,
                'stock' => 75,
                'min_stock' => 15,
                'category_name' => 'Kesehatan & Kecantikan',
            ],
            [
                'name' => 'Blender Philips',
                'description' => 'Blender untuk kebutuhan dapur',
                'sku' => 'HOM001',
                'price' => 350000,
                'cost_price' => 200000,
                'stock' => 15,
                'min_stock' => 3,
                'category_name' => 'Rumah Tangga',
            ],
            [
                'name' => 'Sepatu Nike Running',
                'description' => 'Sepatu lari dengan teknologi terbaru',
                'sku' => 'SPT001',
                'price' => 1200000,
                'cost_price' => 800000,
                'stock' => 20,
                'min_stock' => 5,
                'category_name' => 'Olahraga',
            ],
            [
                'name' => 'Bola Sepak Adidas',
                'description' => 'Bola sepak berkualitas tinggi',
                'sku' => 'SPT002',
                'price' => 250000,
                'cost_price' => 150000,
                'stock' => 40,
                'min_stock' => 8,
                'category_name' => 'Olahraga',
            ],
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category_name'])->first();
            if ($category) {
                Product::create([
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'sku' => $product['sku'],
                    'price' => $product['price'],
                    'cost_price' => $product['cost_price'],
                    'stock' => $product['stock'],
                    'min_stock' => $product['min_stock'],
                    'category_id' => $category->id,
                    'is_active' => true,
                ]);
            }
        }
    }
}
