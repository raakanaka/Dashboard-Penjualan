@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </h1>
    <div class="text-muted">
        <i class="fas fa-calendar me-1"></i>
        {{ now()->format('d F Y') }}
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Total Sales</h6>
                        <h3 class="mb-0 text-white">Rp {{ number_format($totalSalesAmount, 0, ',', '.') }}</h3>
                        <small class="text-white-50">All time</small>
                    </div>
                    <div class="text-end">
                        <i class="fas fa-chart-line fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-secondary h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Today's Sales</h6>
                        <h3 class="mb-0 text-white">Rp {{ number_format($todaySales, 0, ',', '.') }}</h3>
                        <small class="text-white-50">Today</small>
                    </div>
                    <div class="text-end">
                        <i class="fas fa-shopping-cart fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-success h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Total Products</h6>
                        <h3 class="mb-0 text-white">{{ $totalProducts }}</h3>
                        <small class="text-white-50">In stock</small>
                    </div>
                    <div class="text-end">
                        <i class="fas fa-box fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card-warning h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Total Customers</h6>
                        <h3 class="mb-0 text-white">{{ $totalCustomers }}</h3>
                        <small class="text-white-50">Registered</small>
                    </div>
                    <div class="text-end">
                        <i class="fas fa-users fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Tables Row -->
<div class="row">
    <!-- Sales Chart -->
    <div class="col-xl-8 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line me-2"></i>Sales Trend (Last 7 Days)
                </h5>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="col-xl-4 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Quick Stats
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border-end">
                            <h4 class="text-primary mb-1">{{ $totalSales }}</h4>
                            <small class="text-muted">Total Sales</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <h4 class="text-success mb-1">{{ $totalPurchases }}</h4>
                        <small class="text-muted">Total Purchases</small>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border-end">
                            <h4 class="text-info mb-1">{{ $totalSuppliers }}</h4>
                            <small class="text-muted">Suppliers</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <h4 class="text-warning mb-1">{{ $lowStockProducts->count() }}</h4>
                        <small class="text-muted">Low Stock Items</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Top Products -->
        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-star me-2"></i>Top Products
                </h5>
            </div>
            <div class="card-body">
                @if($topProducts->count() > 0)
                    @foreach($topProducts as $product)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h6 class="mb-0">{{ $product->name }}</h6>
                            <small class="text-muted">{{ $product->total_sold }} sold</small>
                        </div>
                        <span class="badge bg-primary">{{ $product->total_sold }}</span>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center mb-0">No sales data available</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Row -->
<div class="row">
    <!-- Recent Sales -->
    <div class="col-xl-6 mb-4">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-shopping-cart me-2"></i>Recent Sales
                </h5>
                <a href="{{ route('sales.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recentSales->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                <tr>
                                    <td>
                                        <strong>{{ $sale->invoice_number }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $sale->created_at->format('d M Y') }}</small>
                                    </td>
                                    <td>{{ $sale->customer->name }}</td>
                                    <td>Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</td>
                                    <td>
                                        @if($sale->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($sale->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No recent sales</p>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Recent Purchases -->
    <div class="col-xl-6 mb-4">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-shopping-bag me-2"></i>Recent Purchases
                </h5>
                <a href="{{ route('purchases.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recentPurchases->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Purchase #</th>
                                    <th>Supplier</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPurchases as $purchase)
                                <tr>
                                    <td>
                                        <strong>{{ $purchase->purchase_number }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $purchase->created_at->format('d M Y') }}</small>
                                    </td>
                                    <td>{{ $purchase->supplier->name }}</td>
                                    <td>Rp {{ number_format($purchase->final_amount, 0, ',', '.') }}</td>
                                    <td>
                                        @if($purchase->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($purchase->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No recent purchases</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Low Stock Alert -->
@if($lowStockProducts->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="card border-warning">
            <div class="card-header bg-warning text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Low Stock Alert
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Current Stock</th>
                                <th>Min Stock</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockProducts as $product)
                            <tr>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $product->category->name }}</small>
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ $product->stock }}</span>
                                </td>
                                <td>{{ $product->min_stock }}</td>
                                <td>
                                    @if($product->stock == 0)
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @else
                                        <span class="badge bg-warning">Low Stock</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
// Sales Chart
const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json(collect($salesChartData)->pluck('date')),
        datasets: [{
            label: 'Sales Amount (Rp)',
            data: @json(collect($salesChartData)->pluck('amount')),
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
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
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
@endpush
