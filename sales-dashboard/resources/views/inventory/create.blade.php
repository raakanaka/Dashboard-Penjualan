@extends('layouts.app')

@section('title', 'Add New Product to Inventory')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg shadow-lg mb-6">
    <div class="px-6 py-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="fas fa-box text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Add New Product</h1>
                    <p class="text-indigo-100">Add a new product to your inventory</p>
                </div>
            </div>
            <a href="{{ route('inventory.index') }}" class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                <i class="fas fa-arrow-left mr-2"></i>Back to Inventory
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-box mr-2 text-indigo-600 dark:text-indigo-400"></i>
                    Product Information
                </h5>
            </div>
            <div class="p-8">
                <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('name') border-red-500 @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                SKU <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('sku') border-red-500 @enderror" 
                                   id="sku" name="sku" value="{{ old('sku') }}" required>
                            @error('sku')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('description') border-red-500 @enderror" 
                                  id="description" name="description" rows="3" placeholder="Enter product description...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('category_id') border-red-500 @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Product Image
                            </label>
                            <input type="file" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('image') border-red-500 @enderror" 
                                   id="image" name="image" accept="image/*">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Max size: 2MB. Supported formats: JPEG, PNG, JPG, GIF</p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Selling Price <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 dark:text-gray-400">Rp</span>
                                <input type="number" 
                                       class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('price') border-red-500 @enderror" 
                                       id="price" name="price" value="{{ old('price') }}" min="0" step="0.01" required>
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="cost_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Cost Price <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 dark:text-gray-400">Rp</span>
                                <input type="number" 
                                       class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('cost_price') border-red-500 @enderror" 
                                       id="cost_price" name="cost_price" value="{{ old('cost_price') }}" min="0" step="0.01" required>
                            </div>
                            @error('cost_price')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Initial Stock <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('stock') border-red-500 @enderror" 
                                   id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" required>
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="min_stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Minimum Stock Level <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('min_stock') border-red-500 @enderror" 
                                   id="min_stock" name="min_stock" value="{{ old('min_stock', 10) }}" min="0" required>
                            @error('min_stock')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" 
                                   id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Active Product
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('inventory.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white text-sm font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-2"></i>Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-8">
        <!-- Help Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-question-circle mr-2"></i>
                    Help & Information
                </h5>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-indigo-100 dark:bg-indigo-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-tag text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white mb-1">SKU</h6>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Stock Keeping Unit - unique identifier for the product</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-dollar-sign text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white mb-1">Pricing</h6>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Selling price is what customers pay, cost price is what you paid</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-warehouse text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white mb-1">Stock Management</h6>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Set minimum stock level to get alerts when running low</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-image text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white mb-1">Product Image</h6>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Upload a clear image to help identify the product</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Tips Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-lightbulb mr-2"></i>
                    Quick Tips
                </h5>
            </div>
            <div class="p-6">
                <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-lightbulb text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-amber-800 dark:text-amber-200 mb-2">Pro Tips</h6>
                            <ul class="text-sm text-amber-700 dark:text-amber-300 space-y-1">
                                <li>• Use descriptive SKUs (e.g., LAP-ASUS-ROG-001)</li>
                                <li>• Set realistic minimum stock levels</li>
                                <li>• Upload high-quality product images</li>
                                <li>• Keep cost and selling prices updated</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
