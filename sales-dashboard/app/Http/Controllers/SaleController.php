<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleItem;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['customer'])->orderBy('created_at', 'desc')->paginate(10);
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();
        return view('sales.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_number' => 'required|string|unique:sales,invoice_number',
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

        // Create sale
        $sale = Sale::create([
            'invoice_number' => $request->invoice_number,
            'customer_id' => $request->customer_id,
            'total_amount' => $totalAmount,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'notes' => $request->notes,
        ]);

        // Create sale items and update product stock
        foreach ($request->items as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
                'discount' => 0,
            ]);

            // Update product stock
            $product = Product::find($item['product_id']);
            $product->decrement('stock', $item['quantity']);
        }

        return redirect()->route('sales.show', $sale)
            ->with('success', 'Sale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load(['customer', 'items.product']);
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $customers = Customer::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();
        $sale->load(['items.product']);
        return view('sales.edit', compact('sale', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_number' => 'required|string|unique:sales,invoice_number,' . $sale->id,
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,credit_card,bank_transfer',
            'notes' => 'nullable|string',
        ]);

        // Restore old stock
        foreach ($sale->items as $item) {
            $product = Product::find($item->product_id);
            $product->increment('stock', $item->quantity);
        }

        // Calculate new totals
        $totalAmount = 0;
        $taxAmount = 0;
        $discountAmount = 0;

        foreach ($request->items as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
        }

        $finalAmount = $totalAmount + $taxAmount - $discountAmount;

        // Update sale
        $sale->update([
            'invoice_number' => $request->invoice_number,
            'customer_id' => $request->customer_id,
            'total_amount' => $totalAmount,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        // Delete old items
        $sale->items()->delete();

        // Create new sale items and update product stock
        foreach ($request->items as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
                'discount' => 0,
            ]);

            // Update product stock
            $product = Product::find($item['product_id']);
            $product->decrement('stock', $item['quantity']);
        }

        return redirect()->route('sales.show', $sale)
            ->with('success', 'Sale updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        // Restore product stock
        foreach ($sale->items as $item) {
            $product = Product::find($item->product_id);
            $product->increment('stock', $item->quantity);
        }

        $sale->delete();

        return redirect()->route('sales.index')
            ->with('success', 'Sale deleted successfully.');
    }

    /**
     * Generate invoice for the sale.
     */
    public function invoice(Sale $sale)
    {
        $sale->load(['customer', 'items.product']);
        return view('sales.invoice', compact('sale'));
    }
}
