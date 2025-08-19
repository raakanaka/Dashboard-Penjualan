@extends('layouts.app')

@section('title', 'Sales Report')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-chart-line mr-2"></i>Sales Report
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Analyze your sales performance and trends</p>
    </div>
    <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-2">
        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-print mr-2"></i>Print Report
        </button>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
    </div>
</div>

<!-- Filters -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Filters</h3>
        <form method="GET" action="{{ route('reports.sales') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                <input type="date" 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                       id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                <input type="date" 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                       id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                        id="status" name="status">
                    <option value="">All Status</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Customer</label>
                <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                        id="customer_id" name="customer_id">
                    <option value="">All Customers</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-sm p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-blue-100 text-sm font-medium">Total Sales</p>
                <p class="text-2xl font-bold">{{ number_format($totalSales) }}</p>
            </div>
            <div class="text-blue-100">
                <i class="fas fa-shopping-cart text-3xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-sm p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-green-100 text-sm font-medium">Total Revenue</p>
                <p class="text-2xl font-bold">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
            </div>
            <div class="text-green-100">
                <i class="fas fa-money-bill-wave text-3xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-sm p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-indigo-100 text-sm font-medium">Average Sale</p>
                <p class="text-2xl font-bold">Rp {{ $totalSales > 0 ? number_format($totalAmount / $totalSales, 0, ',', '.') : '0' }}</p>
            </div>
            <div class="text-indigo-100">
                <i class="fas fa-chart-line text-3xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-sm p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-purple-100 text-sm font-medium">Total Discount</p>
                <p class="text-2xl font-bold">Rp {{ number_format($totalDiscount, 0, ',', '.') }}</p>
            </div>
            <div class="text-purple-100">
                <i class="fas fa-tags text-3xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Sales Chart -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Sales Trend</h3>
        <div class="h-64">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
</div>

<!-- Sales Table -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Sales Details</h3>
    </div>
    @if($sales->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Discount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($sales as $sale)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $sale->invoice_number }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $sale->customer->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $sale->created_at->format('M d, Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-blue-600 dark:text-blue-400">Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($sale->discount_amount, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @switch($sale->status)
                                @case('completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Completed</span>
                                    @break
                                @case('pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">Pending</span>
                                    @break
                                @case('cancelled')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Cancelled</span>
                                    @break
                                @default
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">{{ ucfirst($sale->status) }}</span>
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($sales->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $sales->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                <i class="fas fa-chart-line text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No sales data found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
                Try adjusting your filter criteria or create some sales first.
            </p>
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    // Sample data - replace with actual data from controller
    const salesData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Sales Amount',
            data: [12000, 19000, 15000, 25000, 22000, 30000],
            borderColor: 'rgb(59, 130, 246)',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.4
        }]
    };
    
    new Chart(ctx, {
        type: 'line',
        data: salesData,
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
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection
