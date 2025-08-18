@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-box me-2"></i>Product Details
    </h1>
    <div class="btn-group" role="group">
        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Products
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Product Information</h5>
                    <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 40%;">Product Name:</td>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">SKU:</td>
                                <td><span class="badge bg-primary">{{ $product->sku }}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Category:</td>
                                <td>{{ $product->category->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Description:</td>
                                <td>{{ $product->description ?: 'No description available' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 40%;">Selling Price:</td>
                                <td class="text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Cost Price:</td>
                                <td>Rp {{ number_format($product->cost_price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Profit Margin:</td>
                                <td class="text-{{ $product->price > $product->cost_price ? 'success' : 'danger' }}">
                                    {{ $product->price > $product->cost_price ? '+' : '' }}Rp {{ number_format($product->price - $product->cost_price, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Current Stock:</td>
                                <td>
                                    <span class="badge bg-{{ $product->stock <= $product->min_stock ? 'danger' : 'success' }}">
                                        {{ $product->stock }} units
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Minimum Stock:</td>
                                <td>{{ $product->min_stock }} units</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Stock Status</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="border rounded p-3">
                            <h4 class="text-primary mb-1">{{ $product->stock }}</h4>
                            <small class="text-muted">Current Stock</small>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="border rounded p-3">
                            <h4 class="text-warning mb-1">{{ $product->min_stock }}</h4>
                            <small class="text-muted">Minimum Stock</small>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="border rounded p-3">
                            <h4 class="text-{{ $product->stock <= $product->min_stock ? 'danger' : 'success' }} mb-1">
                                {{ $product->stock - $product->min_stock }}
                            </h4>
                            <small class="text-muted">Available Above Min</small>
                        </div>
                    </div>
                </div>
                
                @if($product->stock <= $product->min_stock)
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Low Stock Alert:</strong> This product is running low on stock. Consider placing a purchase order.
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Product Image</h5>
            </div>
            <div class="card-body text-center">
                @if($product->image)
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="Product image" class="img-fluid rounded" style="max-height: 300px;">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                        <div>
                            <i class="fas fa-image fa-4x text-muted mb-3"></i>
                            <p class="text-muted">No image available</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Product
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Product Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-muted">Created</h6>
                            <small>{{ $product->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Last Updated</h6>
                        <small>{{ $product->updated_at->format('M d, Y') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
