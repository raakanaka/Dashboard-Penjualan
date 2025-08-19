@extends('layouts.app')

@section('title', 'Inventory Management')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-boxes mr-2"></i>Inventory Management
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Monitor and manage your product inventory</p>
    </div>
    <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-2">
        <a href="{{ route('inventory.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>Add Product
        </a>
        <a href="{{ route('inventory.stock-alert') }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-exclamation-triangle mr-2"></i>Stock Alerts
            @if($lowStockProducts > 0 || $outOfStockProducts > 0)
                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                    {{ $lowStockProducts + $outOfStockProducts }}
                </span>
            @endif
        </a>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-sm p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-blue-100 text-sm font-medium">Total Products</p>
                <p class="text-2xl font-bold">{{ number_format($totalProducts) }}</p>
            </div>
            <div class="text-blue-100">
                <i class="fas fa-boxes text-3xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-sm p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-green-100 text-sm font-medium">Total Stock</p>
                <p class="text-2xl font-bold">{{ number_format($totalStock) }}</p>
            </div>
            <div class="text-green-100">
                <i class="fas fa-warehouse text-3xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-sm p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-indigo-100 text-sm font-medium">Total Value</p>
                <p class="text-2xl font-bold">Rp {{ number_format($totalValue, 0, ',', '.') }}</p>
            </div>
            <div class="text-indigo-100">
                <i class="fas fa-dollar-sign text-3xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-sm p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-yellow-100 text-sm font-medium">Low Stock Items</p>
                <p class="text-2xl font-bold">{{ number_format($lowStockProducts) }}</p>
            </div>
            <div class="text-yellow-100">
                <i class="fas fa-exclamation-triangle text-3xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Stock Alerts -->
@if($lowStockProducts > 0 || $outOfStockProducts > 0)
<div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4 mb-6">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400"></i>
        </div>
        <div class="ml-3 flex-1">
            <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Stock Alert</h3>
            <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                @if($outOfStockProducts > 0)
                    <p>{{ $outOfStockProducts }} product(s) out of stock,</p>
                @endif
                @if($lowStockProducts > 0)
                    <p>{{ $lowStockProducts }} product(s) running low on stock.</p>
                @endif
            </div>
            <div class="mt-4">
                <a href="{{ route('inventory.stock-alert') }}" class="text-sm font-medium text-yellow-800 dark:text-yellow-200 hover:text-yellow-900 dark:hover:text-yellow-100 underline">
                    View Details →
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Search and Filters -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
    <div class="p-6">
        <form action="{{ route('inventory.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" name="search" 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                       placeholder="Search products..." 
                       value="{{ request('search') }}">
            </div>
            <div>
                <select name="category" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="stock_status" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Stock Status</option>
                    <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                    <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Inventory Table -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
    @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($product->image)
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-lg object-cover" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                @else
                                    <div class="flex-shrink-0 h-10 w-10 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $product->sku }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                {{ $product->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ number_format($product->stock_quantity) }}</div>
                            @if($product->stock_quantity <= $product->reorder_level)
                                <div class="text-xs text-red-600 dark:text-red-400">Reorder Level: {{ $product->reorder_level }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Cost: Rp {{ number_format($product->cost_price, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->stock_quantity == 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                    Out of Stock
                                </span>
                            @elseif($product->stock_quantity <= $product->reorder_level)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                    Low Stock
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    In Stock
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('inventory.show', $product) }}" 
                                   class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" 
                                   title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('inventory.edit', $product) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('inventory.adjust-stock', $product) }}" 
                                   class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" 
                                   title="Adjust Stock">
                                    <i class="fas fa-plus-minus"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $products->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                <i class="fas fa-boxes text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No products found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
                @if(request('search') || request('category') || request('stock_status'))
                    Try adjusting your search criteria.
                @else
                    Get started by adding your first product to inventory.
                @endif
            </p>
            <a href="{{ route('inventory.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Add Product
            </a>
        </div>
    @endif
</div>
@endsection
