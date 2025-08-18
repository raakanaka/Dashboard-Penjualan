@extends('layouts.app')

@section('title', 'Inventory Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-boxes me-2"></i>Inventory Management
    </h1>
    <div class="btn-group" role="group">
        <a href="{{ route('inventory.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Product
        </a>
        <a href="{{ route('inventory.stock-alert') }}" class="btn btn-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>Stock Alerts
            @if($lowStockProducts > 0 || $outOfStockProducts > 0)
                <span class="badge bg-danger ms-1">{{ $lowStockProducts + $outOfStockProducts }}</span>
            @endif
        </a>
    </div>
</div>

<!-- Summary Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Products</h6>
                        <h4 class="mb-0">{{ number_format($totalProducts) }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-boxes fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Stock</h6>
                        <h4 class="mb-0">{{ number_format($totalStock) }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-warehouse fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Value</h6>
                        <h4 class="mb-0">Rp {{ number_format($totalValue, 0, ',', '.') }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Low Stock Items</h6>
                        <h4 class="mb-0">{{ number_format($lowStockProducts) }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stock Alerts -->
@if($lowStockProducts > 0 || $outOfStockProducts > 0)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-triangle me-2"></i>
    <strong>Stock Alert:</strong> 
    @if($outOfStockProducts > 0)
        {{ $outOfStockProducts }} product(s) out of stock,
    @endif
    @if($lowStockProducts > 0)
        {{ $lowStockProducts }} product(s) running low on stock.
    @endif
    <a href="{{ route('inventory.stock-alert') }}" class="alert-link">View Details</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    <!-- Stock by Category -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Stock by Category</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Products</th>
                                <th>Total Stock</th>
                                <th>Avg Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stockByCategory as $category)
                            <tr>
                                <td>{{ $category->category->name }}</td>
                                <td>{{ $category->total_products }}</td>
                                <td>{{ number_format($category->total_stock) }}</td>
                                <td>{{ $category->total_products > 0 ? number_format($category->total_stock / $category->total_products, 0) : 0 }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-grid gap-2">
                            <a href="{{ route('inventory.create') }}" class="btn btn-outline-primary">
                                <i class="fas fa-plus me-2"></i>Add New Product
                            </a>
                            <a href="{{ route('inventory.stock-alert') }}" class="btn btn-outline-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>View Stock Alerts
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-grid gap-2">
                            <a href="{{ route('reports.inventory') }}" class="btn btn-outline-info">
                                <i class="fas fa-chart-bar me-2"></i>Inventory Report
                            </a>
                            <a href="{{ route('purchases.create') }}" class="btn btn-outline-success">
                                <i class="fas fa-shopping-cart me-2"></i>Create Purchase Order
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inventory List -->
<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">Inventory List</h5>
    </div>
    <div class="card-body">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Current Stock</th>
                            <th>Min Stock</th>
                            <th>Stock Value</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($product->image)
                                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                            <i class="fas fa-box text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $product->description ?: 'No description' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $product->sku }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $product->category->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $product->stock <= $product->min_stock ? 'danger' : 'success' }}">
                                    {{ number_format($product->stock) }}
                                </span>
                            </td>
                            <td>
                                {{ number_format($product->min_stock) }}
                            </td>
                            <td>
                                <strong>Rp {{ number_format($product->stock * $product->price, 0, ',', '.') }}</strong>
                                <br>
                                <small class="text-muted">@ Rp {{ number_format($product->price, 0, ',', '.') }}/unit</small>
                            </td>
                            <td>
                                @if($product->stock == 0)
                                    <span class="badge bg-danger">Out of Stock</span>
                                @elseif($product->stock <= $product->min_stock)
                                    <span class="badge bg-warning">Low Stock</span>
                                @else
                                    <span class="badge bg-success">Available</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('inventory.show', $product) }}" class="btn btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('inventory.edit', $product) }}" class="btn btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('inventory.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-boxes fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No products in inventory</h5>
                <p class="text-muted">Start by adding your first product to the inventory.</p>
                <a href="{{ route('inventory.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add First Product
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
