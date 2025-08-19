<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display sales report
     */
    public function sales(Request $request)
    {
        $query = Sale::with(['customer', 'items.product']);

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by customer
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        $sales = $query->orderBy('created_at', 'desc')->paginate(15);
        $customers = Customer::where('is_active', true)->get();

        // Calculate summary
        $totalSales = $query->count();
        $totalAmount = $query->sum('final_amount');
        $totalDiscount = $query->sum('discount_amount');
        $avgAmount = $totalSales > 0 ? $totalAmount / $totalSales : 0;

        // Sales by status
        $salesByStatus = Sale::select('status', DB::raw('count(*) as count'), DB::raw('sum(final_amount) as total'))
            ->groupBy('status')
            ->get();

        // Top customers
        $topCustomers = Sale::with('customer')
            ->select('customer_id', DB::raw('count(*) as total_orders'), DB::raw('sum(final_amount) as total_amount'))
            ->groupBy('customer_id')
            ->orderBy('total_amount', 'desc')
            ->limit(10)
            ->get();

        return view('reports.sales', compact(
            'sales',
            'customers',
            'totalSales',
            'totalAmount',
            'totalDiscount',
            'avgAmount',
            'salesByStatus',
            'topCustomers'
        ));
    }

    /**
     * Display purchases report
     */
    public function purchases(Request $request)
    {
        $query = Purchase::with(['supplier', 'items.product']);

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by supplier
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $purchases = $query->orderBy('created_at', 'desc')->paginate(15);
        $suppliers = Supplier::where('is_active', true)->get();

        // Calculate summary
        $totalPurchases = $query->count();
        $totalAmount = $query->sum('final_amount');
        $avgAmount = $totalPurchases > 0 ? $totalAmount / $totalPurchases : 0;

        // Purchases by status
        $purchasesByStatus = Purchase::select('status', DB::raw('count(*) as count'), DB::raw('sum(final_amount) as total'))
            ->groupBy('status')
            ->get();

        // Top suppliers
        $topSuppliers = Purchase::with('supplier')
            ->select('supplier_id', DB::raw('count(*) as total_orders'), DB::raw('sum(final_amount) as total_amount'))
            ->groupBy('supplier_id')
            ->orderBy('total_amount', 'desc')
            ->limit(10)
            ->get();

        return view('reports.purchases', compact(
            'purchases',
            'suppliers',
            'totalPurchases',
            'totalAmount',
            'avgAmount',
            'purchasesByStatus',
            'topSuppliers'
        ));
    }

    /**
     * Display inventory report
     */
    public function inventory(Request $request)
    {
        $query = Product::with(['category']);

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by stock status
        if ($request->filled('stock_status')) {
            switch ($request->stock_status) {
                case 'low':
                    $query->whereRaw('stock <= min_stock');
                    break;
                case 'out':
                    $query->where('stock', 0);
                    break;
                case 'available':
                    $query->where('stock', '>', 0);
                    break;
            }
        }

        $products = $query->orderBy('stock', 'asc')->paginate(15);

        // Calculate summary
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $totalValue = Product::sum(DB::raw('stock * price'));
        $lowStockProducts = Product::whereRaw('stock <= min_stock')->count();
        $outOfStockProducts = Product::where('stock', 0)->count();

        // Stock by category
        $stockByCategory = Product::with('category')
            ->select('category_id', DB::raw('count(*) as total_products'), DB::raw('sum(stock) as total_stock'))
            ->groupBy('category_id')
            ->get();

        return view('reports.inventory', compact(
            'products',
            'totalProducts',
            'totalStock',
            'totalValue',
            'lowStockProducts',
            'outOfStockProducts',
            'stockByCategory'
        ));
    }
}
