@extends('layouts.app')

@section('title', 'Inventory Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-boxes me-2"></i>Inventory Report
    </h1>
    <div class="btn-group" role="group">
        <button onclick="window.print()" class="btn btn-outline-primary">
            <i class="fas fa-print me-2"></i>Print Report
        </button>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">Filters</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('reports.inventory') }}" class="row g-3">
            <div class="col-md-4">
                <label for="stock_status" class="form-label">Stock Status</label>
                <select class="form-select" id="stock_status" name="stock_status">
                    <option value="">All Products</option>
                    <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Low Stock</option>
                    <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>Out of Stock</option>
                    <option value="available" {{ request('stock_status') == 'available' ? 'selected' : '' }}>Available</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">All Categories</option>
                    @foreach(App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>Filter
                    </button>
                </div>
            </div>
        </form>
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

<div class="row">
    <!-- Stock by Category -->
    <div class="col-md-6">
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

    <!-- Stock Alerts -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Stock Alerts</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-danger">Out of Stock</h6>
                            <h4 class="text-danger">{{ number_format($outOfStockProducts) }}</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-warning">Low Stock</h6>
                        <h4 class="text-warning">{{ number_format($lowStockProducts) }}</h4>
                    </div>
                </div>
                
                @if($lowStockProducts > 0 || $outOfStockProducts > 0)
                <div class="alert alert-warning mt-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Action Required:</strong> 
                    @if($outOfStockProducts > 0)
                        {{ $outOfStockProducts }} product(s) out of stock,
                    @endif
                    @if($lowStockProducts > 0)
                        {{ $lowStockProducts }} product(s) running low on stock.
                    @endif
                    Consider placing purchase orders.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Inventory Details -->
<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">Inventory Details</h5>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-boxes fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No products found</h5>
                <p class="text-muted">Try adjusting your filters to see inventory data.</p>
            </div>
        @endif
    </div>
</div>
@endsection
