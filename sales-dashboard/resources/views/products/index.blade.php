@extends('layouts.app')

@section('title', 'Products')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Products</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Manage your product inventory</p>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>
            Add Product
        </a>
    </div>
</div>

<!-- Search and Filters -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
    <div class="p-6">
        <form method="GET" action="{{ route('products.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                       placeholder="Search products...">
            </div>
            
            <!-- Category Filter -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                <select name="category" id="category" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Stock Status Filter -->
            <div>
                <label for="stock_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stock Status</label>
                <select name="stock_status" id="stock_status" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All</option>
                    <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                    <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>
            
            <!-- Filter Button -->
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-filter mr-2"></i>
                    Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Products Grid -->
@if($products->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @foreach($products as $product)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
            <!-- Product Image -->
            <div class="relative h-48 bg-gray-100 dark:bg-gray-700 rounded-t-xl overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-box text-gray-400 text-4xl"></i>
                    </div>
                @endif
                
                <!-- Stock Status Badge -->
                <div class="absolute top-3 right-3">
                    @if($product->stock == 0)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                            Out of Stock
                        </span>
                    @elseif($product->stock <= $product->min_stock)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                            Low Stock
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            In Stock
                        </span>
                    @endif
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="p-4">
                <div class="mb-3">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2">
                        {{ $product->name }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $product->sku }}</p>
                    @if($product->category)
                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            {{ $product->category->name }}
                        </span>
                    @endif
                </div>
                
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Stock: {{ number_format($product->stock) }}
                        </p>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex space-x-2">
                    <a href="{{ route('products.show', $product) }}" 
                       class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                        <i class="fas fa-eye mr-1"></i>
                        View
                    </a>
                    <a href="{{ route('products.edit', $product) }}" 
                       class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-blue-300 text-sm font-medium rounded-lg text-blue-700 bg-blue-50 hover:bg-blue-100 dark:border-blue-600 dark:text-blue-300 dark:bg-blue-900/20 dark:hover:bg-blue-900/40 transition-colors duration-200">
                        <i class="fas fa-edit mr-1"></i>
                        Edit
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" 
                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-3 py-2 border border-red-300 text-sm font-medium rounded-lg text-red-700 bg-red-50 hover:bg-red-100 dark:border-red-600 dark:text-red-300 dark:bg-red-900/20 dark:hover:bg-red-900/40 transition-colors duration-200">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($products->hasPages())
        <div class="flex justify-center">
            {{ $products->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    @endif
@else
    <!-- Empty State -->
    <div class="text-center py-12">
        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
            <i class="fas fa-box text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No products found</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-6">
            @if(request('search') || request('category') || request('stock_status'))
                Try adjusting your search criteria or filters.
            @else
                Get started by adding your first product.
            @endif
        </p>
        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>
            Add Product
        </a>
    </div>
@endif

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
