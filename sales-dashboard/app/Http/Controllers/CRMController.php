<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CRMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,crm');
    }

    public function dashboard()
    {
        // Customer Analytics
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::where('is_active', true)->count();
        $newCustomersThisMonth = Customer::whereRaw('strftime("%m", created_at) = ?', [Carbon::now()->format('m')])->count();
        
        // Sales Analytics
        $totalSales = Sale::sum('total_amount');
        $salesThisMonth = Sale::whereRaw('strftime("%m", created_at) = ?', [Carbon::now()->format('m')])->sum('total_amount');
        $averageOrderValue = Sale::avg('total_amount');
        
        // Top Customers by Revenue
        $topCustomers = Customer::select('customers.*', DB::raw('SUM(sales.total_amount) as total_revenue'))
            ->leftJoin('sales', 'customers.id', '=', 'sales.customer_id')
            ->groupBy('customers.id')
            ->orderByDesc('total_revenue')
            ->limit(10)
            ->get();

        // Customer Segmentation
        $customerSegments = $this->getCustomerSegments();
        
        // Sales Pipeline
        $salesPipeline = $this->getSalesPipeline();
        
        // Recent Activities
        $recentActivities = $this->getRecentActivities();
        
        // Monthly Sales Trend
        $monthlySales = Sale::select(
                DB::raw('strftime("%m", created_at) as month'),
                DB::raw('strftime("%Y", created_at) as year'),
                DB::raw('SUM(total_amount) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->whereRaw('strftime("%Y", created_at) = ?', [Carbon::now()->year])
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        return view('crm.dashboard', compact(
            'totalCustomers', 'activeCustomers', 'newCustomersThisMonth',
            'totalSales', 'salesThisMonth', 'averageOrderValue',
            'topCustomers', 'customerSegments', 'salesPipeline',
            'recentActivities', 'monthlySales'
        ));
    }

    public function leads()
    {
        // Potential customers (customers with no sales yet)
        $leads = Customer::select('customers.*', DB::raw('COUNT(sales.id) as sales_count'))
            ->leftJoin('sales', 'customers.id', '=', 'sales.customer_id')
            ->groupBy('customers.id')
            ->having('sales_count', '=', 0)
            ->orderBy('customers.created_at', 'desc')
            ->paginate(15);

        return view('crm.leads', compact('leads'));
    }

    public function interactions(Customer $customer)
    {
        // Get customer interactions (sales history)
        $interactions = Sale::where('customer_id', $customer->id)
            ->with(['products'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Customer statistics
        $stats = [
            'total_orders' => Sale::where('customer_id', $customer->id)->count(),
            'total_spent' => Sale::where('customer_id', $customer->id)->sum('total_amount'),
            'average_order' => Sale::where('customer_id', $customer->id)->avg('total_amount'),
            'last_order' => Sale::where('customer_id', $customer->id)->latest()->first(),
            'favorite_products' => $this->getCustomerFavoriteProducts($customer->id)
        ];

        return view('crm.interactions', compact('customer', 'interactions', 'stats'));
    }

    public function segments()
    {
        $segments = $this->getCustomerSegments();
        
        return view('crm.segments', compact('segments'));
    }

    private function getCustomerSegments()
    {
        // VIP Customers (>= $10,000 total spent)
        $vipCustomers = Customer::select('customers.*', DB::raw('SUM(sales.total_amount) as total_spent'))
            ->leftJoin('sales', 'customers.id', '=', 'sales.customer_id')
            ->groupBy('customers.id')
            ->having('total_spent', '>=', 10000)
            ->get();

        // Regular Customers ($1,000 - $9,999)
        $regularCustomers = Customer::select('customers.*', DB::raw('SUM(sales.total_amount) as total_spent'))
            ->leftJoin('sales', 'customers.id', '=', 'sales.customer_id')
            ->groupBy('customers.id')
            ->having('total_spent', '>=', 1000)
            ->having('total_spent', '<', 10000)
            ->get();

        // New Customers (< $1,000 or no purchases)
        $newCustomers = Customer::select('customers.*', DB::raw('COALESCE(SUM(sales.total_amount), 0) as total_spent'))
            ->leftJoin('sales', 'customers.id', '=', 'sales.customer_id')
            ->groupBy('customers.id')
            ->having('total_spent', '<', 1000)
            ->get();

        return [
            'vip' => $vipCustomers,
            'regular' => $regularCustomers,
            'new' => $newCustomers
        ];
    }

    private function getSalesPipeline()
    {
        // Mock pipeline data - in real app this would come from leads/opportunities table
        return [
            'prospects' => Customer::whereDoesntHave('sales')->count(),
            'qualified_leads' => Customer::whereHas('sales', function($query) {
                $query->where('created_at', '>=', Carbon::now()->subDays(30));
            })->count(),
            'negotiations' => Sale::where('status', 'pending')->count(),
            'closed_won' => Sale::where('status', 'completed')->whereRaw('strftime("%m", created_at) = ?', [Carbon::now()->format('m')])->count(),
        ];
    }

    private function getRecentActivities()
    {
        // Recent sales as activities
        return Sale::with(['customer'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($sale) {
                return [
                    'type' => 'sale',
                    'description' => "New sale to {$sale->customer->name}",
                    'amount' => $sale->total_amount,
                    'date' => $sale->created_at,
                    'customer' => $sale->customer
                ];
            });
    }

    private function getCustomerFavoriteProducts($customerId)
    {
        return DB::table('sale_product')
            ->select('products.name', DB::raw('SUM(sale_product.quantity) as total_quantity'))
            ->join('sales', 'sale_product.sale_id', '=', 'sales.id')
            ->join('products', 'sale_product.product_id', '=', 'products.id')
            ->where('sales.customer_id', $customerId)
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();
    }
}