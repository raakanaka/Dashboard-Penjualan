@extends('layouts.app')

@section('title', 'Stock Alerts - Inventory Management')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-red-600 to-red-700 rounded-lg shadow-lg mb-6">
    <div class="px-6 py-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Stock Alerts</h1>
                    <p class="text-red-100">Monitor low stock and out of stock products</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('inventory.index') }}" class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Inventory
                </a>
                <a href="{{ route('purchases.create') }}" class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                    <i class="fas fa-shopping-cart mr-2"></i>Create Purchase Order
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h6 class="text-white/80 text-sm font-medium uppercase tracking-wider">Out of Stock</h6>
                    <h4 class="text-3xl font-bold text-white mt-2">{{ number_format($outOfStockProducts->count()) }}</h4>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <i class="fas fa-times-circle text-2xl text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h6 class="text-white/80 text-sm font-medium uppercase tracking-wider">Low Stock</h6>
                    <h4 class="text-3xl font-bold text-white mt-2">{{ number_format($lowStockProducts->count()) }}</h4>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Out of Stock Products -->
@if($outOfStockProducts->count() > 0)
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
    <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
        <h5 class="text-xl font-bold text-white flex items-center">
            <i class="fas fa-times-circle mr-2"></i>
            Out of Stock Products ({{ $outOfStockProducts->count() }})
        </h5>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">SKU</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Current Stock</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Min Stock</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($outOfStockProducts as $product)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <td class="px-6 py-6 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($product->image)
                                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-xl object-cover mr-4 shadow-sm">
                            @else
                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center mr-4 shadow-sm">
                                    <i class="fas fa-box text-gray-400 dark:text-gray-500"></i>
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $product->description ?: 'No description' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 shadow-sm">
                            <i class="fas fa-tag mr-1"></i>
                            {{ $product->sku }}
                        </span>
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 shadow-sm">
                            {{ $product->category->name }}
                        </span>
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 shadow-sm">
                            <i class="fas fa-times-circle mr-1"></i>
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                        {{ $product->min_stock }}
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('inventory.edit', $product) }}" 
                               class="inline-flex items-center px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition-colors duration-200" 
                               title="Update Stock">
                                <i class="fas fa-edit mr-1"></i>
                                Update
                            </a>
                            <a href="{{ route('purchases.create') }}" 
                               class="inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-lg transition-colors duration-200" 
                               title="Create Purchase Order">
                                <i class="fas fa-shopping-cart mr-1"></i>
                                Purchase
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Low Stock Products -->
@if($lowStockProducts->count() > 0)
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
    <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
        <h5 class="text-xl font-bold text-white flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Low Stock Products ({{ $lowStockProducts->count() }})
        </h5>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">SKU</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Current Stock</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Min Stock</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($lowStockProducts as $product)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <td class="px-6 py-6 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($product->image)
                                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-xl object-cover mr-4 shadow-sm">
                            @else
                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center mr-4 shadow-sm">
                                    <i class="fas fa-box text-gray-400 dark:text-gray-500"></i>
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $product->description ?: 'No description' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 shadow-sm">
                            <i class="fas fa-tag mr-1"></i>
                            {{ $product->sku }}
                        </span>
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 shadow-sm">
                            {{ $product->category->name }}
                        </span>
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200 shadow-sm">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                        {{ $product->min_stock }}
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-6 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('inventory.edit', $product) }}" 
                               class="inline-flex items-center px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition-colors duration-200" 
                               title="Update Stock">
                                <i class="fas fa-edit mr-1"></i>
                                Update
                            </a>
                            <a href="{{ route('purchases.create') }}" 
                               class="inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-lg transition-colors duration-200" 
                               title="Create Purchase Order">
                                <i class="fas fa-shopping-cart mr-1"></i>
                                Purchase
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- No Alerts Message -->
@if($outOfStockProducts->count() == 0 && $lowStockProducts->count() == 0)
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="p-12 text-center">
        <div class="bg-green-100 dark:bg-green-900/20 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center">
            <i class="fas fa-check-circle text-3xl text-green-600 dark:text-green-400"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">All Good!</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-8">No stock alerts at the moment. All products have sufficient stock levels.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('inventory.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-warehouse mr-2"></i>
                View Inventory
            </a>
            <a href="{{ route('purchases.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-shopping-cart mr-2"></i>
                Create Purchase Order
            </a>
        </div>
    </div>
</div>
@endif

<!-- Quick Actions -->
@if($outOfStockProducts->count() > 0 || $lowStockProducts->count() > 0)
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
            <i class="fas fa-bolt mr-2 text-blue-600 dark:text-blue-400"></i>
            Quick Actions
        </h5>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('inventory.index') }}" 
               class="inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-warehouse mr-2"></i>
                View Full Inventory
            </a>
            
            <a href="{{ route('purchases.create') }}" 
               class="inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-shopping-cart mr-2"></i>
                Create Purchase Order
            </a>
            
            <a href="{{ route('reports.inventory') }}" 
               class="inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-chart-bar mr-2"></i>
                View Reports
            </a>
        </div>
    </div>
</div>
@endif
@endsection
