@extends('layouts.app')

@section('title', 'Edit Sale')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-edit me-2"></i>Edit Sale
    </h1>
    <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Sales
    </a>
</div>

<form action="{{ route('sales.update', $sale) }}" method="POST" id="saleForm">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-8">
            <!-- Customer Information -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customer_id" class="form-label">Customer <span class="text-danger">*</span></label>
                            <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id', $sale->customer_id) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->customer_code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="invoice_number" class="form-label">Invoice Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" id="invoice_number" name="invoice_number" value="{{ old('invoice_number', $sale->invoice_number) }}" required>
                            @error('invoice_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Selection -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Product Selection</h5>
                </div>
                <div class="card-body">
                    <div id="productItems">
                        @foreach($sale->items as $index => $item)
                        <div class="product-item border rounded p-3 mb-3">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Product <span class="text-danger">*</span></label>
                                    <select class="form-select product-select" name="items[{{ $index }}][product_id]" required>
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }} (Stock: {{ $product->stock }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control quantity-input" name="items[{{ $index }}][quantity]" min="1" value="{{ $item->quantity }}" required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label">Unit Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control price-input" name="items[{{ $index }}][unit_price]" step="0.01" min="0" value="{{ $item->unit_price }}" required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label">Total</label>
                                    <input type="text" class="form-control total-input" readonly value="{{ number_format($item->total_price, 2) }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-sm w-100 remove-item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <button type="button" class="btn btn-outline-primary" id="addProduct">
                        <i class="fas fa-plus me-2"></i>Add Product
                    </button>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Payment Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                                <option value="">Select Payment Method</option>
                                <option value="cash" {{ old('payment_method', $sale->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="credit_card" {{ old('payment_method', $sale->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="bank_transfer" {{ old('payment_method', $sale->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $sale->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card sticky-top" style="top: 1rem;">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">Subtotal:</div>
                        <div class="col-6 text-end" id="subtotal">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">Tax:</div>
                        <div class="col-6 text-end" id="tax">Rp {{ number_format($sale->tax_amount, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">Discount:</div>
                        <div class="col-6 text-end" id="discount">Rp {{ number_format($sale->discount_amount, 0, ',', '.') }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Total:</strong></div>
                        <div class="col-6 text-end"><strong id="total">Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</strong></div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Sale
                        </button>
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
let itemIndex = {{ $sale->items->count() }};

// Add new product item
document.getElementById('addProduct').addEventListener('click', function() {
    const productItems = document.getElementById('productItems');
    const newItem = document.querySelector('.product-item').cloneNode(true);
    
    // Update indices
    newItem.querySelectorAll('[name]').forEach(input => {
        input.name = input.name.replace(/\[\d+\]/, `[${itemIndex}]`);
    });
    
    // Clear values
    newItem.querySelector('.product-select').value = '';
    newItem.querySelector('.quantity-input').value = '1';
    newItem.querySelector('.price-input').value = '';
    newItem.querySelector('.total-input').value = '';
    
    // Add event listeners
    addItemEventListeners(newItem);
    
    productItems.appendChild(newItem);
    itemIndex++;
});

// Remove product item
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-item') || e.target.closest('.remove-item')) {
        const item = e.target.closest('.product-item');
        if (document.querySelectorAll('.product-item').length > 1) {
            item.remove();
            calculateTotal();
        }
    }
});

// Add event listeners to all items
document.querySelectorAll('.product-item').forEach(addItemEventListeners);

function addItemEventListeners(item) {
    const productSelect = item.querySelector('.product-select');
    const quantityInput = item.querySelector('.quantity-input');
    const priceInput = item.querySelector('.price-input');
    const totalInput = item.querySelector('.total-input');
    
    // Product selection
    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const price = selectedOption.dataset.price;
            const stock = selectedOption.dataset.stock;
            priceInput.value = price;
            quantityInput.max = stock;
            calculateItemTotal(item);
        } else {
            priceInput.value = '';
            totalInput.value = '';
        }
        calculateTotal();
    });
    
    // Quantity change
    quantityInput.addEventListener('input', function() {
        calculateItemTotal(item);
        calculateTotal();
    });
    
    // Price change
    priceInput.addEventListener('input', function() {
        calculateItemTotal(item);
        calculateTotal();
    });
}

function calculateItemTotal(item) {
    const quantity = parseFloat(item.querySelector('.quantity-input').value) || 0;
    const price = parseFloat(item.querySelector('.price-input').value) || 0;
    const total = quantity * price;
    item.querySelector('.total-input').value = total.toFixed(2);
}

function calculateTotal() {
    let subtotal = 0;
    
    document.querySelectorAll('.product-item').forEach(item => {
        const quantity = parseFloat(item.querySelector('.quantity-input').value) || 0;
        const price = parseFloat(item.querySelector('.price-input').value) || 0;
        subtotal += quantity * price;
    });
    
    const tax = 0; // You can add tax calculation logic here
    const discount = 0; // You can add discount calculation logic here
    const total = subtotal + tax - discount;
    
    document.getElementById('subtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
    document.getElementById('tax').textContent = `Rp ${tax.toLocaleString('id-ID')}`;
    document.getElementById('discount').textContent = `Rp ${discount.toLocaleString('id-ID')}`;
    document.getElementById('total').textContent = `Rp ${total.toLocaleString('id-ID')}`;
}

// Form validation
document.getElementById('saleForm').addEventListener('submit', function(e) {
    const items = document.querySelectorAll('.product-item');
    let hasValidItems = false;
    
    items.forEach(item => {
        const productId = item.querySelector('.product-select').value;
        const quantity = item.querySelector('.quantity-input').value;
        const price = item.querySelector('.price-input').value;
        
        if (productId && quantity && price) {
            hasValidItems = true;
        }
    });
    
    if (!hasValidItems) {
        e.preventDefault();
        alert('Please add at least one product to the sale.');
    }
});

// Initialize totals on page load
calculateTotal();
</script>
@endpush
@endsection
