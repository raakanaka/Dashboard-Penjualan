<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Models\Product;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        if ($suppliers->count() == 0 || $products->count() == 0) {
            return;
        }

        $paymentMethods = ['cash', 'credit_card', 'bank_transfer'];
        $statuses = ['completed', 'pending'];

        for ($i = 1; $i <= 8; $i++) {
            $supplier = $suppliers->random();
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
            $status = $statuses[array_rand($statuses)];

            $purchase = Purchase::create([
                'purchase_number' => 'PO-' . date('Ymd') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'supplier_id' => $supplier->id,
                'total_amount' => 0,
                'tax_amount' => 0,
                'discount_amount' => 0,
                'final_amount' => 0,
                'payment_method' => $paymentMethod,
                'status' => $status,
                'notes' => 'Sample purchase for testing purposes.',
                'created_at' => now()->subDays(rand(0, 30)),
            ]);

            // Add 1-4 items to each purchase
            $numItems = rand(1, 4);
            $totalAmount = 0;

            for ($j = 0; $j < $numItems; $j++) {
                $product = $products->random();
                $quantity = rand(10, 50);
                $unitPrice = $product->cost_price;
                $totalPrice = $quantity * $unitPrice;
                $totalAmount += $totalPrice;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'discount' => 0,
                ]);

                // Update product stock
                $product->increment('stock', $quantity);
            }

            // Update purchase totals
            $purchase->update([
                'total_amount' => $totalAmount,
                'final_amount' => $totalAmount,
            ]);
        }
    }
}
