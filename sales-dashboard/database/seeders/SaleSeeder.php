<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Customer;
use App\Models\Product;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $products = Product::all();

        if ($customers->count() == 0 || $products->count() == 0) {
            return;
        }

        $paymentMethods = ['cash', 'credit_card', 'bank_transfer'];
        $statuses = ['completed', 'pending'];

        for ($i = 1; $i <= 10; $i++) {
            $customer = $customers->random();
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
            $status = $statuses[array_rand($statuses)];

            $sale = Sale::create([
                'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'customer_id' => $customer->id,
                'total_amount' => 0,
                'tax_amount' => 0,
                'discount_amount' => 0,
                'final_amount' => 0,
                'payment_method' => $paymentMethod,
                'status' => $status,
                'notes' => 'Sample sale for testing purposes.',
                'created_at' => now()->subDays(rand(0, 30)),
            ]);

            // Add 1-3 items to each sale
            $numItems = rand(1, 3);
            $totalAmount = 0;

            for ($j = 0; $j < $numItems; $j++) {
                $product = $products->random();
                $quantity = rand(1, 5);
                $unitPrice = $product->price;
                $totalPrice = $quantity * $unitPrice;
                $totalAmount += $totalPrice;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'discount' => 0,
                ]);

                // Update product stock
                $product->decrement('stock', $quantity);
            }

            // Update sale totals
            $sale->update([
                'total_amount' => $totalAmount,
                'final_amount' => $totalAmount,
            ]);
        }
    }
}
