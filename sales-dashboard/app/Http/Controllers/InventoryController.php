<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('stock_quantity', 'asc')
            ->paginate(15);

        // Calculate summary statistics
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock_quantity');
        $totalValue = Product::sum(DB::raw('stock_quantity * selling_price'));
        $lowStockProducts = Product::whereRaw('stock_quantity <= reorder_level')->count();
        $outOfStockProducts = Product::where('stock_quantity', 0)->count();

        // Get categories for filter
        $categories = Category::where('is_active', true)->get();

        return view('inventory.index', compact(
            'products',
            'totalProducts',
            'totalStock',
            'totalValue',
            'lowStockProducts',
            'outOfStockProducts',
            'categories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('inventory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku|max:50',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $data['image'] = $imageName;
        }

        Product::create($data);

        return redirect()->route('inventory.index')
            ->with('success', 'Product added to inventory successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('inventory.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('inventory.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:50|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
                unlink(public_path('images/products/' . $product->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
            unlink(public_path('images/products/' . $product->image));
        }

        $product->delete();

        return redirect()->route('inventory.index')
            ->with('success', 'Product removed from inventory successfully.');
    }

    /**
     * Display stock alerts.
     */
    public function stockAlert()
    {
        $lowStockProducts = Product::with('category')
            ->whereRaw('stock <= min_stock')
            ->orderBy('stock', 'asc')
            ->get();

        $outOfStockProducts = Product::with('category')
            ->where('stock', 0)
            ->orderBy('name', 'asc')
            ->get();

        return view('inventory.stock-alert', compact('lowStockProducts', 'outOfStockProducts'));
    }

    /**
     * Show the form for adjusting stock.
     */
    public function adjustStock(Product $product)
    {
        return view('inventory.adjust-stock', compact('product'));
    }

    /**
     * Update stock manually.
     */
    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'stock_quantity' => 'required|integer|min:0',
            'reason' => 'required|string|max:255',
        ]);

        $oldStock = $product->stock_quantity;
        $newStock = $request->stock_quantity;
        
        $product->update(['stock_quantity' => $newStock]);

        // Log the stock adjustment
        // You can add a stock adjustment log table here if needed

        $message = "Stock updated from {$oldStock} to {$newStock}. Reason: " . $request->reason;

        return redirect()->route('inventory.index')
            ->with('success', $message);
    }
}
