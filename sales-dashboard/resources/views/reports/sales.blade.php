@extends('layouts.app')

@section('title', 'Sales Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-chart-line me-2"></i>Sales Report
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
        <form method="GET" action="{{ route('reports.sales') }}" class="row g-3">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">All Status</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="customer_id" class="form-label">Customer</label>
                <select class="form-select" id="customer_id" name="customer_id">
                    <option value="">All Customers</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
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
                        <h6 class="card-title">Total Sales</h6>
                        <h4 class="mb-0">{{ number_format($totalSales) }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-shopping-cart fa-2x"></i>
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
                        <h6 class="card-title">Total Revenue</h6>
                        <h4 class="mb-0">Rp {{ number_format($totalAmount, 0, ',', '.') }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
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
                        <h6 class="card-title">Average Sale</h6>
                        <h4 class="mb-0">Rp {{ number_format($avgAmount, 0, ',', '.') }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-chart-bar fa-2x"></i>
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
                        <h6 class="card-title">Conversion Rate</h6>
                        <h4 class="mb-0">{{ $totalSales > 0 ? number_format(($sales->where('status', 'completed')->count() / $totalSales) * 100, 1) : 0 }}%</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-percentage fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Sales by Status -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Sales by Status</h5>
            </div>
            <div class="card-body">
                @foreach($salesByStatus as $status)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-{{ $status->status == 'completed' ? 'success' : ($status->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($status->status) }}
                    </span>
                    <div class="text-end">
                        <div class="fw-bold">{{ $status->count }}</div>
                        <small class="text-muted">Rp {{ number_format($status->total, 0, ',', '.') }}</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top Customers -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Top Customers</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Orders</th>
                                <th>Total Amount</th>
                                <th>Average</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topCustomers as $customer)
                            <tr>
                                <td>{{ $customer->customer->name }}</td>
                                <td>{{ $customer->total_orders }}</td>
                                <td>Rp {{ number_format($customer->total_amount, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($customer->total_amount / $customer->total_orders, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sales Details -->
<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">Sales Details</h5>
    </div>
    <div class="card-body">
        @if($sales->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <td>
                                <strong>{{ $sale->invoice_number }}</strong>
                                <br>
                                <small class="text-muted">ID: {{ $sale->id }}</small>
                            </td>
                            <td>
                                <strong>{{ $sale->customer->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $sale->customer->customer_code }}</small>
                            </td>
                            <td>
                                <div>{{ $sale->created_at->format('M d, Y') }}</div>
                                <small class="text-muted">{{ $sale->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $sale->items->count() }} items</span>
                                <br>
                                <small class="text-muted">{{ $sale->items->sum('quantity') }} units</small>
                            </td>
                            <td>
                                <strong class="text-primary">Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-{{ $sale->status == 'completed' ? 'success' : ($sale->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($sale->status) }}
                                </span>
                            </td>
                            <td>
                                @switch($sale->payment_method)
                                    @case('cash')
                                        <span class="badge bg-success">Cash</span>
                                        @break
                                    @case('credit_card')
                                        <span class="badge bg-info">Credit Card</span>
                                        @break
                                    @case('bank_transfer')
                                        <span class="badge bg-warning">Bank Transfer</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ ucfirst($sale->payment_method) }}</span>
                                @endswitch
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $sales->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No sales found</h5>
                <p class="text-muted">Try adjusting your filters to see sales data.</p>
            </div>
        @endif
    </div>
</div>
@endsection
