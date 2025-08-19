@extends('layouts.app')

@section('title', $product->name . ' - Product Details')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
        <i class="fas fa-box mr-2 text-blue-600 dark:text-blue-400"></i>Product Details
    </h1>
    <div class="flex space-x-2">
        <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-edit mr-2"></i>Edit Product
        </a>
        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Products
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Product Information -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Product Information</h5>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $product->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $product->description ?: 'No description available' }}</p>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-32">SKU:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $product->sku }}
                                </span>
                            </div>
                            
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-32">Category:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                            
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-32">Status:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $product->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
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
                                    <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Cost Price:</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($product->cost_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between border-t border-gray-200 dark:border-gray-600 pt-2">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Profit Margin:</span>
                                    <span class="text-sm font-semibold {{ $product->selling_price > $product->cost_price ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        {{ $product->selling_price > $product->cost_price ? '+' : '' }}Rp {{ number_format($product->selling_price - $product->cost_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stock Status -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Stock Status</h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">{{ number_format($product->stock_quantity) }}</div>
                        <div class="text-sm text-blue-700 dark:text-blue-300">Current Stock</div>
                    </div>
                    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-amber-600 dark:text-amber-400 mb-1">{{ number_format($product->reorder_level) }}</div>
                        <div class="text-sm text-amber-700 dark:text-amber-300">Reorder Level</div>
                    </div>
                    <div class="bg-{{ $product->stock_quantity <= $product->reorder_level ? 'red' : 'green' }}-50 dark:bg-{{ $product->stock_quantity <= $product->reorder_level ? 'red' : 'green' }}-900/20 border border-{{ $product->stock_quantity <= $product->reorder_level ? 'red' : 'green' }}-200 dark:border-{{ $product->stock_quantity <= $product->reorder_level ? 'red' : 'green' }}-800 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-{{ $product->stock_quantity <= $product->reorder_level ? 'red' : 'green' }}-600 dark:text-{{ $product->stock_quantity <= $product->reorder_level ? 'red' : 'green' }}-400 mb-1">
                            {{ number_format($product->stock_quantity - $product->reorder_level) }}
                        </div>
                        <div class="text-sm text-{{ $product->stock_quantity <= $product->reorder_level ? 'red' : 'green' }}-700 dark:text-{{ $product->stock_quantity <= $product->reorder_level ? 'red' : 'green' }}-300">Available Above Min</div>
                    </div>
                </div>
                
                @if($product->stock_quantity <= $product->reorder_level)
                    <div class="mt-4 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-amber-600 dark:text-amber-400 mt-0.5 mr-3"></i>
                            <div>
                                <p class="text-amber-800 dark:text-amber-200 font-medium">Low Stock Alert</p>
                                <p class="text-amber-700 dark:text-amber-300 text-sm mt-1">This product is running low on stock. Consider placing a purchase order.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Product Image & Actions -->
    <div class="lg:col-span-1">
        <!-- Product Image -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Product Image</h5>
            </div>
            <div class="p-6 text-center">
                @if($product->image)
                    <img src="{{ asset('images/products/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="max-w-full h-auto rounded-lg shadow-sm mx-auto" 
                         style="max-height: 300px;">
                @else
                    <div class="w-full h-64 bg-gray-100 dark:bg-gray-700 rounded-lg flex flex-col items-center justify-center">
                        <i class="fas fa-image text-4xl text-gray-400 dark:text-gray-500 mb-3"></i>
                        <p class="text-gray-500 dark:text-gray-400">No image available</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h5>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('products.edit', $product) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-3 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Product
                    </a>
                    
                    <form action="{{ route('products.destroy', $product) }}" method="POST" 
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
        
        <!-- Product Statistics -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Product Statistics</h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Created</h6>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $product->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Last Updated</h6>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $product->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Sales</h6>
                            <div class="text-lg font-semibold text-blue-600 dark:text-blue-400 mt-1">
                                {{ $product->saleItems()->count() }}
                            </div>
                        </div>
                        <div class="text-center">
                            <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Stock Value</h6>
                            <div class="text-lg font-semibold text-green-600 dark:text-green-400 mt-1">
                                Rp {{ number_format($product->stock_quantity * $product->selling_price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
