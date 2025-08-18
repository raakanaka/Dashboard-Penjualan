<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseItem;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::with(['supplier'])->orderBy('created_at', 'desc')->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();
        return view('purchases.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_number' => 'required|string|unique:purchases,purchase_number',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,credit_card,bank_transfer',
            'notes' => 'nullable|string',
        ]);

        // Calculate totals
        $totalAmount = 0;
        $taxAmount = 0;
        $discountAmount = 0;

        foreach ($request->items as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
        }

        $finalAmount = $totalAmount + $taxAmount - $discountAmount;

        // Create purchase
        $purchase = Purchase::create([
            'purchase_number' => $request->purchase_number,
            'supplier_id' => $request->supplier_id,
            'total_amount' => $totalAmount,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'notes' => $request->notes,
        ]);

        // Create purchase items and update product stock
        foreach ($request->items as $item) {
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
                'discount' => 0,
            ]);

            // Update product stock
            $product = Product::find($item['product_id']);
            $product->increment('stock', $item['quantity']);
        }

        return redirect()->route('purchases.show', $purchase)
            ->with('success', 'Purchase created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'items.product']);
        return view('purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();
        $purchase->load(['items.product']);
        return view('purchases.edit', compact('purchase', 'suppliers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_number' => 'required|string|unique:purchases,purchase_number,' . $purchase->id,
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,credit_card,bank_transfer',
            'notes' => 'nullable|string',
        ]);

        // Restore old stock
        foreach ($purchase->items as $item) {
            $product = Product::find($item->product_id);
            $product->decrement('stock', $item->quantity);
        }

        // Calculate new totals
        $totalAmount = 0;
        $taxAmount = 0;
        $discountAmount = 0;

        foreach ($request->items as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
        }

        $finalAmount = $totalAmount + $taxAmount - $discountAmount;

        // Update purchase
        $purchase->update([
            'purchase_number' => $request->purchase_number,
            'supplier_id' => $request->supplier_id,
            'total_amount' => $totalAmount,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        // Delete old items
        $purchase->items()->delete();

        // Create new purchase items and update product stock
        foreach ($request->items as $item) {
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
                'discount' => 0,
            ]);

            // Update product stock
            $product = Product::find($item['product_id']);
            $product->increment('stock', $item['quantity']);
        }

        return redirect()->route('purchases.show', $purchase)
            ->with('success', 'Purchase updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        // Restore product stock
        foreach ($purchase->items as $item) {
            $product = Product::find($item->product_id);
            $product->decrement('stock', $item->quantity);
        }

        $purchase->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase deleted successfully.');
    }
}
