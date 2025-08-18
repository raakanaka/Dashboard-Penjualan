@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2" style="color: var(--text-primary); font-weight: 600;">
                            Welcome back! 👋
                        </h2>
                        <p class="text-muted mb-0" style="font-size: 1.1rem;">
                            Here's what's happening with your business today.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="d-flex align-items-center justify-content-md-end gap-3">
                            <div class="text-end">
                                <div class="text-muted small">Today's Date</div>
                                <div class="fw-semibold">{{ now()->format('l, F j, Y') }}</div>
                            </div>
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Key Metrics -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-white-50 mb-1" style="font-size: 0.875rem; font-weight: 500;">Total Sales</div>
                    <div class="h3 mb-0 text-white fw-bold">{{ number_format($totalSales) }}</div>
                    <div class="text-white-50 small mt-1">
                        <i class="fas fa-arrow-up me-1"></i>
                        +{{ number_format($totalSales * 0.12) }} this month
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-white-50 mb-1" style="font-size: 0.875rem; font-weight: 500;">Revenue</div>
                    <div class="h3 mb-0 text-white fw-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    <div class="text-white-50 small mt-1">
                        <i class="fas fa-arrow-up me-1"></i>
                        +15.3% this month
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-white-50 mb-1" style="font-size: 0.875rem; font-weight: 500;">Products</div>
                    <div class="h3 mb-0 text-white fw-bold">{{ number_format($totalProducts) }}</div>
                    <div class="text-white-50 small mt-1">
                        <i class="fas fa-box me-1"></i>
                        {{ number_format($lowStockProducts) }} low stock
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-white-50 mb-1" style="font-size: 0.875rem; font-weight: 500;">Customers</div>
                    <div class="h3 mb-0 text-white fw-bold">{{ number_format($totalCustomers) }}</div>
                    <div class="text-white-50 small mt-1">
                        <i class="fas fa-users me-1"></i>
                        +{{ number_format($totalCustomers * 0.08) }} new this month
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Analytics -->
<div class="row mb-4">
    <!-- Sales Trend Chart -->
    <div class="col-xl-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line me-2 text-primary"></i>
                    Sales Trend
                </h5>
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-primary active">7 Days</button>
                    <button type="button" class="btn btn-outline-primary">30 Days</button>
                    <button type="button" class="btn btn-outline-primary">90 Days</button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="col-xl-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-pie me-2 text-primary"></i>
                    Quick Stats
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: var(--light-bg);">
                        <div>
                            <div class="fw-semibold text-primary">Average Order Value</div>
                            <div class="text-muted small">Last 30 days</div>
                        </div>
                        <div class="text-end">
                            <div class="h5 mb-0 fw-bold">Rp {{ number_format($avgOrderValue, 0, ',', '.') }}</div>
                            <div class="text-success small">
                                <i class="fas fa-arrow-up me-1"></i>+8.2%
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: var(--light-bg);">
                        <div>
                            <div class="fw-semibold text-success">Conversion Rate</div>
                            <div class="text-muted small">Sales to visits</div>
                        </div>
                        <div class="text-end">
                            <div class="h5 mb-0 fw-bold">{{ number_format($conversionRate, 1) }}%</div>
                            <div class="text-success small">
                                <i class="fas fa-arrow-up me-1"></i>+2.1%
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: var(--light-bg);">
                        <div>
                            <div class="fw-semibold text-warning">Stock Alerts</div>
                            <div class="text-muted small">Low stock items</div>
                        </div>
                        <div class="text-end">
                            <div class="h5 mb-0 fw-bold">{{ $lowStockProducts }}</div>
                            <div class="text-warning small">
                                <i class="fas fa-exclamation-triangle me-1"></i>Needs attention
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity and Top Products -->
<div class="row">
    <!-- Recent Sales -->
    <div class="col-xl-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock me-2 text-primary"></i>
                    Recent Sales
                </h5>
                <a href="{{ route('sales.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @if($recentSales->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="border-0 ps-3">Invoice</th>
                                    <th class="border-0">Customer</th>
                                    <th class="border-0">Amount</th>
                                    <th class="border-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                <tr>
                                    <td class="ps-3">
                                        <div class="fw-semibold">{{ $sale->invoice_number }}</div>
                                        <small class="text-muted">{{ $sale->created_at->format('M d, H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $sale->customer->name }}</div>
                                        <small class="text-muted">{{ $sale->customer->customer_code }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-primary">Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $sale->status == 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($sale->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-shopping-cart fa-2x text-muted mb-3"></i>
                        <p class="text-muted mb-0">No recent sales found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Top Products -->
    <div class="col-xl-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-star me-2 text-primary"></i>
                    Top Products
                </h5>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @if($topProducts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="border-0 ps-3">Product</th>
                                    <th class="border-0">Sold</th>
                                    <th class="border-0">Revenue</th>
                                    <th class="border-0">Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topProducts as $product)
                                <tr>
                                    <td class="ps-3">
                                        <div class="fw-semibold">{{ $product->name }}</div>
                                        <small class="text-muted">{{ $product->sku }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ number_format($product->total_sold) }}</div>
                                        <small class="text-muted">units</small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-success">Rp {{ number_format($product->total_sold * $product->price, 0, ',', '.') }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $product->stock <= $product->min_stock ? 'danger' : 'success' }}">
                                            {{ number_format($product->stock) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-box fa-2x text-muted mb-3"></i>
                        <p class="text-muted mb-0">No product data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt me-2 text-primary"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('sales.create') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3">
                            <i class="fas fa-plus-circle fa-2x mb-2"></i>
                            <span class="fw-semibold">New Sale</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('purchases.create') }}" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3">
                            <i class="fas fa-shopping-bag fa-2x mb-2"></i>
                            <span class="fw-semibold">New Purchase</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('products.create') }}" class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3">
                            <i class="fas fa-box fa-2x mb-2"></i>
                            <span class="fw-semibold">Add Product</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('inventory.stock-alert') }}" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                            <span class="fw-semibold">Stock Alerts</span>
                            @if($lowStockProducts > 0)
                                <span class="badge bg-danger position-absolute top-0 end-0 mt-2 me-2">{{ $lowStockProducts }}</span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Sales Chart
const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($salesTrendLabels) !!},
        datasets: [{
            label: 'Sales',
            data: {!! json_encode($salesTrendData) !!},
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99, 102, 241, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#6366f1',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#64748b'
                }
            },
            y: {
                grid: {
                    color: '#e2e8f0'
                },
                ticks: {
                    color: '#64748b',
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString();
                    }
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        }
    }
});
</script>
@endsection
