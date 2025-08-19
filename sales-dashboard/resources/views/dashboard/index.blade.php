@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        Welcome back, Admin! 👋
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        Here's what's happening with your business today.
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="text-right">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Today's Date</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ now()->format('l, F j, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Key Metrics -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Sales -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Sales</p>
                    <p class="text-3xl font-bold text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <p class="text-blue-100 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +{{ number_format($thisMonthSales > 0 ? (($thisMonthSales / $totalRevenue) * 100) : 0, 1) }}% this month
                    </p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Revenue</p>
                    <p class="text-3xl font-bold text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <p class="text-green-100 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +15.3% this month
                    </p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-sm font-medium mb-1">Products</p>
                    <p class="text-3xl font-bold text-white">{{ number_format($totalProducts) }}</p>
                    <p class="text-indigo-100 text-sm mt-1">
                        <i class="fas fa-box mr-1"></i>
                        {{ number_format($lowStockProducts) }} low stock
                    </p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-boxes text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Customers -->
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium mb-1">Customers</p>
                    <p class="text-3xl font-bold text-white">{{ number_format($totalCustomers) }}</p>
                    <p class="text-orange-100 text-sm mt-1">
                        <i class="fas fa-users mr-1"></i>
                        +{{ number_format($totalCustomers * 0.08) }} new this month
                    </p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Analytics -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Sales Trend Chart -->
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <i class="fas fa-chart-line text-blue-500 mr-2"></i>
                    Sales Trend
                </h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm bg-blue-500 text-white rounded-lg">7 Days</button>
                    <button class="px-3 py-1 text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg">30 Days</button>
                    <button class="px-3 py-1 text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg">90 Days</button>
                </div>
            </div>
            <div class="h-64">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                <i class="fas fa-chart-pie text-blue-500 mr-2"></i>
                Quick Stats
            </h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div>
                        <p class="font-semibold text-blue-600 dark:text-blue-400">Average Order Value</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Last 30 days</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($avgOrderValue, 0, ',', '.') }}</p>
                        <p class="text-sm text-green-600 dark:text-green-400">
                            <i class="fas fa-arrow-up mr-1"></i>+8.2%
                        </p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div>
                        <p class="font-semibold text-purple-600 dark:text-purple-400">Conversion Rate</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">This month</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $conversionRate }}%</p>
                        <p class="text-sm text-green-600 dark:text-green-400">
                            <i class="fas fa-arrow-up mr-1"></i>+2.1%
                        </p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div>
                        <p class="font-semibold text-orange-600 dark:text-orange-400">Total Orders</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">This month</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($totalSales) }}</p>
                        <p class="text-sm text-green-600 dark:text-green-400">
                            <i class="fas fa-arrow-up mr-1"></i>+12.5%
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Top Products -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                <i class="fas fa-star text-yellow-500 mr-2"></i>
                Top Products
            </h3>
            <div class="space-y-4">
                @forelse($topProducts as $product)
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $product->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->sku }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 dark:text-white">{{ number_format($product->total_sold) }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">units sold</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-box text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">No products data available</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Sales -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                <i class="fas fa-clock text-green-500 mr-2"></i>
                Recent Sales
            </h3>
            <div class="space-y-4">
                @forelse($recentSales as $sale)
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $sale->customer->name ?? 'Unknown Customer' }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $sale->created_at->format('M j, Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            {{ ucfirst($sale->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-shopping-cart text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">No recent sales</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
            <i class="fas fa-bolt text-yellow-500 mr-2"></i>
            Quick Actions
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('products.create') }}" class="flex flex-col items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                <i class="fas fa-plus text-blue-600 dark:text-blue-400 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-blue-700 dark:text-blue-300">Add Product</span>
            </a>
            <a href="{{ route('sales.create') }}" class="flex flex-col items-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/40 transition-colors">
                <i class="fas fa-shopping-cart text-green-600 dark:text-green-400 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-green-700 dark:text-green-300">New Sale</span>
            </a>
            <a href="{{ route('customers.create') }}" class="flex flex-col items-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/40 transition-colors">
                <i class="fas fa-user-plus text-purple-600 dark:text-purple-400 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-purple-700 dark:text-purple-300">Add Customer</span>
            </a>
            <a href="{{ route('reports.sales') }}" class="flex flex-col items-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg hover:bg-orange-100 dark:hover:bg-orange-900/40 transition-colors">
                <i class="fas fa-chart-bar text-orange-600 dark:text-orange-400 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-orange-700 dark:text-orange-300">View Reports</span>
            </a>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($salesTrendLabels),
            datasets: [{
                label: 'Sales Amount',
                data: @json($salesTrendData),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(156, 163, 175, 0.1)'
                    },
                    ticks: {
                        color: '#6b7280',
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
});
</script>
@endsection
