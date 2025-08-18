@extends('layouts.app')

@section('title', 'Stock Alerts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-exclamation-triangle me-2"></i>Stock Alerts
    </h1>
    <div class="btn-group" role="group">
        <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Inventory
        </a>
        <a href="{{ route('purchases.create') }}" class="btn btn-primary">
            <i class="fas fa-shopping-cart me-2"></i>Create Purchase Order
        </a>
    </div>
</div>

<!-- Summary Cards -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Out of Stock</h6>
                        <h4 class="mb-0">{{ number_format($outOfStockProducts->count()) }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Low Stock</h6>
                        <h4 class="mb-0">{{ number_format($lowStockProducts->count()) }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Out of Stock Products -->
@if($outOfStockProducts->count() > 0)
<div class="card mb-4">
    <div class="card-header bg-danger text-white">
        <h5 class="card-title mb-0">
            <i class="fas fa-times-circle me-2"></i>Out of Stock Products ({{ $outOfStockProducts->count() }})
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Current Stock</th>
                        <th>Min Stock</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($outOfStockProducts as $product)
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
                            <span class="badge bg-danger">{{ number_format($product->stock) }}</span>
                        </td>
                        <td>
                            {{ number_format($product->min_stock) }}
                        </td>
                        <td>
                            <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('inventory.edit', $product) }}" class="btn btn-outline-warning" title="Update Stock">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('purchases.create') }}" class="btn btn-outline-success" title="Create Purchase Order">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<!-- Low Stock Products -->
@if($lowStockProducts->count() > 0)
<div class="card mb-4">
    <div class="card-header bg-warning text-white">
        <h5 class="card-title mb-0">
            <i class="fas fa-exclamation-triangle me-2"></i>Low Stock Products ({{ $lowStockProducts->count() }})
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Current Stock</th>
                        <th>Min Stock</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowStockProducts as $product)
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
                            <span class="badge bg-warning">{{ number_format($product->stock) }}</span>
                        </td>
                        <td>
                            {{ number_format($product->min_stock) }}
                        </td>
                        <td>
                            <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('inventory.edit', $product) }}" class="btn btn-outline-warning" title="Update Stock">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('purchases.create') }}" class="btn btn-outline-success" title="Create Purchase Order">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<!-- No Alerts -->
@if($outOfStockProducts->count() == 0 && $lowStockProducts->count() == 0)
<div class="card">
    <div class="card-body text-center py-5">
        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
        <h5 class="text-success">No Stock Alerts</h5>
        <p class="text-muted">All products have sufficient stock levels.</p>
        <a href="{{ route('inventory.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left me-2"></i>Back to Inventory
        </a>
    </div>
</div>
@endif

<!-- Action Buttons -->
@if($outOfStockProducts->count() > 0 || $lowStockProducts->count() > 0)
<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">Quick Actions</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="d-grid">
                    <a href="{{ route('purchases.create') }}" class="btn btn-success">
                        <i class="fas fa-shopping-cart me-2"></i>Create Purchase Order
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-grid">
                    <a href="{{ route('inventory.index') }}" class="btn btn-primary">
                        <i class="fas fa-boxes me-2"></i>Manage Inventory
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-grid">
                    <a href="{{ route('reports.inventory') }}" class="btn btn-info">
                        <i class="fas fa-chart-bar me-2"></i>View Reports
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
