@extends('layouts.app')

@section('title', 'Create New Purchase')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-orange-600 to-orange-700 rounded-lg shadow-lg mb-6">
    <div class="px-6 py-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="fas fa-shopping-cart text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Create New Purchase</h1>
                    <p class="text-orange-100">Add a new purchase order</p>
                </div>
            </div>
            <a href="{{ route('purchases.index') }}" class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                <i class="fas fa-arrow-left mr-2"></i>Back to Purchases
            </a>
        </div>
    </div>
</div>

<form action="{{ route('purchases.store') }}" method="POST" id="purchaseForm">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Supplier Information Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-building mr-2 text-orange-600 dark:text-orange-400"></i>
                        Supplier Information
                    </h5>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Supplier <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white @error('supplier_id') border-red-500 @enderror" 
                                    id="supplier_id" name="supplier_id" required>
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }} @if($supplier->contact_person)({{ $supplier->contact_person }})@endif
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="purchase_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Purchase Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white @error('purchase_number') border-red-500 @enderror" 
                                   id="purchase_number" name="purchase_number" 
                                   value="{{ old('purchase_number', 'PO-' . date('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT)) }}" 
                                   required>
                            @error('purchase_number')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Selection Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-box mr-2 text-blue-600 dark:text-blue-400"></i>
                        Product Selection
                    </h5>
                </div>
                <div class="p-8">
                    <div id="productItems">
                        <div class="product-item border border-gray-200 dark:border-gray-600 rounded-xl p-6 mb-4 bg-gray-50 dark:bg-gray-700">
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Product <span class="text-red-500">*</span>
                                    </label>
                                    <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white product-select" 
                                            name="items[0][product_id]" required>
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->cost_price }}" data-stock="{{ $product->stock }}">
                                                {{ $product->name }} (Current Stock: {{ $product->stock }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Quantity <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" 
                                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white quantity-input" 
                                           name="items[0][quantity]" min="1" value="1" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Unit Price <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" 
                                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white price-input" 
                                           name="items[0][unit_price]" step="0.01" min="0" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Total</label>
                                    <input type="text" 
                                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-white total-input" 
                                           readonly>
                                </div>
                                <div class="flex items-end">
                                    <button type="button" 
                                            class="w-full px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200 remove-item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" 
                            class="inline-flex items-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200" 
                            id="addProduct">
                        <i class="fas fa-plus mr-2"></i>Add Product
                    </button>
                </div>
            </div>

            <!-- Payment Information Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-credit-card mr-2 text-purple-600 dark:text-purple-400"></i>
                        Payment Information
                    </h5>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Payment Method <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white @error('payment_method') border-red-500 @enderror" 
                                    id="payment_method" name="payment_method" required>
                                <option value="">Select Payment Method</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="credit" {{ old('payment_method') == 'credit' ? 'selected' : '' }}>Credit</option>
                            </select>
                            @error('payment_method')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white @error('status') border-red-500 @enderror" 
                                    id="status" name="status" required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes</label>
                        <textarea class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white @error('notes') border-red-500 @enderror" 
                                  id="notes" name="notes" rows="3" placeholder="Add any additional notes...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Order Summary Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                    <h5 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-calculator mr-2"></i>
                        Order Summary
                    </h5>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white" id="subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Tax (11%):</span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white" id="tax">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Discount:</span>
                            <span class="text-lg font-semibold text-green-600 dark:text-green-400" id="discount">Rp 0</span>
                        </div>
                        <hr class="border-gray-200 dark:border-gray-600">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-gray-900 dark:text-white">Total:</span>
                            <span class="text-2xl font-bold text-purple-600 dark:text-purple-400" id="total">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-save mr-2 text-green-600 dark:text-green-400"></i>
                        Actions
                    </h5>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-2"></i>
                            Create Purchase
                        </button>
                        
                        <a href="{{ route('purchases.index') }}" 
                           class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let itemIndex = 0;
    
    // Add product item
    document.getElementById('addProduct').addEventListener('click', function() {
        itemIndex++;
        const productItems = document.getElementById('productItems');
        const newItem = document.querySelector('.product-item').cloneNode(true);
        
        // Update form names
        newItem.querySelectorAll('select, input').forEach(input => {
            input.name = input.name.replace('[0]', `[${itemIndex}]`);
            input.value = '';
        });
        
        // Clear total
        newItem.querySelector('.total-input').value = '';
        
        productItems.appendChild(newItem);
        attachEventListeners(newItem);
    });
    
    // Remove product item
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            const productItems = document.getElementById('productItems');
            if (productItems.children.length > 1) {
                e.target.closest('.product-item').remove();
                calculateTotal();
            }
        }
    });
    
    // Calculate totals
    function calculateItemTotal(item) {
        const quantity = parseFloat(item.querySelector('.quantity-input').value) || 0;
        const price = parseFloat(item.querySelector('.price-input').value) || 0;
        const total = quantity * price;
        item.querySelector('.total-input').value = `Rp ${total.toLocaleString('id-ID')}`;
        return total;
    }
    
    function calculateTotal() {
        let subtotal = 0;
        document.querySelectorAll('.product-item').forEach(item => {
            subtotal += calculateItemTotal(item);
        });
        
        const tax = subtotal * 0.11;
        const discount = 0; // You can add discount logic here
        
        document.getElementById('subtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
        document.getElementById('tax').textContent = `Rp ${tax.toLocaleString('id-ID')}`;
        document.getElementById('discount').textContent = `Rp ${discount.toLocaleString('id-ID')}`;
        document.getElementById('total').textContent = `Rp ${(subtotal + tax - discount).toLocaleString('id-ID')}`;
    }
    
    // Attach event listeners to product items
    function attachEventListeners(item) {
        const productSelect = item.querySelector('.product-select');
        const quantityInput = item.querySelector('.quantity-input');
        const priceInput = item.querySelector('.price-input');
        
        productSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.dataset.price;
            if (price) {
                priceInput.value = price;
                calculateItemTotal(item);
                calculateTotal();
            }
        });
        
        quantityInput.addEventListener('input', function() {
            calculateItemTotal(item);
            calculateTotal();
        });
        
        priceInput.addEventListener('input', function() {
            calculateItemTotal(item);
            calculateTotal();
        });
    }
    
    // Attach event listeners to initial items
    document.querySelectorAll('.product-item').forEach(attachEventListeners);
    
    // Initial calculation
    calculateTotal();
});
</script>
@endsection
