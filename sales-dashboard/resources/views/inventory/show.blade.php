@extends('layouts.app')

@section('title', $inventory->name . ' - Inventory Details')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
        <i class="fas fa-box mr-2 text-blue-600 dark:text-blue-400"></i>Product Details
    </h1>
    <div class="flex space-x-2">
        <a href="{{ route('inventory.edit', $inventory) }}" class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-edit mr-2"></i>Edit Product
        </a>
        <a href="{{ route('inventory.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Inventory
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Product Information -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Product Information</h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $inventory->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $inventory->description ?: 'No description available' }}</p>
                        
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">SKU:</span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                    {{ $inventory->sku }}
                                </span>
                            </div>
                            
                            <div>
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Category:</span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $inventory->category->name }}
                                </span>
                            </div>
                            
                            <div>
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Status:</span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $inventory->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ $inventory->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Pricing</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Selling Price:</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($inventory->selling_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Cost Price:</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($inventory->cost_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between border-t border-gray-200 dark:border-gray-600 pt-2">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Profit Margin:</span>
                                    <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                        {{ $inventory->selling_price > 0 ? number_format((($inventory->selling_price - $inventory->cost_price) / $inventory->selling_price) * 100, 1) : 0 }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Status -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Stock Status</h5>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 dark:text-white mb-1">{{ number_format($inventory->stock_quantity) }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Current Stock</div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Reorder Level:</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($inventory->reorder_level) }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Stock Value:</span>
                            <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">Rp {{ number_format($inventory->stock_quantity * $inventory->selling_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        @if($inventory->stock_quantity == 0)
                            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3">
                                <div class="flex items-center">
                                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 mr-2"></i>
                                    <span class="text-sm font-medium text-red-800 dark:text-red-200">Out of Stock</span>
                                </div>
                            </div>
                        @elseif($inventory->stock_quantity <= $inventory->reorder_level)
                            <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-3">
                                <div class="flex items-center">
                                    <i class="fas fa-exclamation-triangle text-amber-600 dark:text-amber-400 mr-2"></i>
                                    <span class="text-sm font-medium text-amber-800 dark:text-amber-200">Low Stock</span>
                                </div>
                            </div>
                        @else
                            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-3">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-green-600 dark:text-green-400 mr-2"></i>
                                    <span class="text-sm font-medium text-green-800 dark:text-green-200">Stock Available</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Image -->
<div class="mt-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Product Image</h5>
        </div>
        <div class="p-6 text-center">
            @if($inventory->image)
                <img src="{{ asset('images/products/' . $inventory->image) }}" 
                     alt="{{ $inventory->name }}" 
                     class="max-w-md mx-auto rounded-lg shadow-sm">
            @else
                <div class="w-64 h-64 mx-auto bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-6xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <p class="text-gray-500 dark:text-gray-400 mt-4">No image available</p>
            @endif
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h5>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('inventory.adjust-stock', $inventory) }}" 
                   class="inline-flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-edit mr-2"></i>
                    Adjust Stock
                </a>
                
                <a href="{{ route('purchases.create') }}" 
                   class="inline-flex items-center justify-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Create Purchase Order
                </a>
                
                <form action="{{ route('inventory.destroy', $inventory) }}" method="POST" class="inline" 
                      onsubmit="return confirm('Are you sure you want to delete this product?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full inline-flex items-center justify-center px-4 py-3 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-trash mr-2"></i>
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Product Statistics -->
<div class="mt-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Product Statistics</h5>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">
                        {{ $inventory->saleItems()->count() }}
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Sales</div>
                </div>
                
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-1">
                        {{ $inventory->purchaseItems()->count() }}
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Purchases</div>
                </div>
                
                <div class="text-center">
                    <div class="text-2xl font-bold text-amber-600 dark:text-amber-400 mb-1">
                        {{ $inventory->created_at->diffForHumans() }}
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Added</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
