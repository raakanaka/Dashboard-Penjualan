@extends('layouts.app')

@section('title', 'Products')

@section('content')
<!-- Header Section -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1" style="color: var(--text-primary); font-weight: 600;">
            Products Management
        </h1>
        <p class="text-muted mb-0">Manage your product catalog and inventory</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Product
        </a>
    </div>
</div>

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('products.index') }}" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" name="search" 
                           placeholder="Search products..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="category_id">
                    <option value="">All Categories</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="stock_status">
                    <option value="">All Stock Status</option>
                    <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                    <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Products Grid -->
@if($products->count() > 0)
    <div class="row">
        @foreach($products as $product)
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card h-100 product-card">
                <div class="position-relative">
                    @if($product->image)
                        <img src="{{ asset('images/products/' . $product->image) }}" 
                             class="card-img-top" alt="{{ $product->name }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light" 
                             style="height: 200px;">
                            <i class="fas fa-box fa-2x text-muted"></i>
                        </div>
                    @endif
                    
                    <!-- Stock Status Badge -->
                    <div class="position-absolute top-0 end-0 m-2">
                        @if($product->stock == 0)
                            <span class="badge bg-danger">Out of Stock</span>
                        @elseif($product->stock <= $product->min_stock)
                            <span class="badge bg-warning">Low Stock</span>
                        @else
                            <span class="badge bg-success">In Stock</span>
                        @endif
                    </div>
                    
                    <!-- Category Badge -->
                    <div class="position-absolute top-0 start-0 m-2">
                        <span class="badge bg-info">{{ $product->category->name }}</span>
                    </div>
                </div>
                
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-semibold mb-2" style="color: var(--text-primary);">
                        {{ $product->name }}
                    </h6>
                    
                    <p class="text-muted small mb-3">{{ Str::limit($product->description, 80) }}</p>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small">SKU:</span>
                            <span class="fw-semibold text-secondary">{{ $product->sku }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small">Price:</span>
                            <span class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Stock:</span>
                            <span class="fw-semibold {{ $product->stock <= $product->min_stock ? 'text-danger' : 'text-success' }}">
                                {{ number_format($product->stock) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-auto">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('products.show', $product) }}" 
                               class="btn btn-outline-info btn-sm" title="View">
                                <i class="fas fa-eye fa-sm"></i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" 
                               class="btn btn-outline-warning btn-sm" title="Edit">
                                <i class="fas fa-edit fa-sm"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                        onclick="return confirm('Are you sure you want to delete this product?')" title="Delete">
                                    <i class="fas fa-trash fa-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Responsive Pagination -->
    @if($products->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Products pagination">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    @endif
@else
    <!-- Empty State -->
    <div class="card">
        <div class="card-body text-center py-5">
            <div class="mb-4">
                <i class="fas fa-box fa-3x text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">No Products Found</h4>
            <p class="text-muted mb-4">
                @if(request('search') || request('category_id') || request('stock_status'))
                    Try adjusting your search criteria or filters.
                @else
                    Get started by adding your first product to the catalog.
                @endif
            </p>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Your First Product
            </a>
        </div>
    </div>
@endif

<style>
.product-card {
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.product-card .card-img-top {
    border-radius: 0.75rem 0.75rem 0 0;
}

.product-card .card-body {
    border-radius: 0 0 0.75rem 0.75rem;
}

.btn-group .btn {
    border-radius: 0.5rem;
    margin: 0 2px;
    padding: 0.375rem 0.75rem;
}

.btn-group .btn:first-child {
    margin-left: 0;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

/* Responsive Pagination Styles */
.pagination {
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.25rem;
}

.pagination .page-link {
    border-radius: 0.5rem;
    border: 1px solid var(--border-color);
    color: var(--text-secondary);
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.pagination .page-link:hover {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: var(--text-muted);
    background-color: transparent;
    border-color: var(--border-color);
}

/* Mobile responsive pagination */
@media (max-width: 768px) {
    .pagination {
        font-size: 0.8rem;
    }
    
    .pagination .page-link {
        padding: 0.375rem 0.5rem;
        min-width: 2.5rem;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
}
</style>
@endsection
