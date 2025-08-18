@extends('layouts.app')

@section('title', 'Purchases Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-shopping-bag me-2"></i>Purchases Report
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
        <form method="GET" action="{{ route('reports.purchases') }}" class="row g-3">
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
                <label for="supplier_id" class="form-label">Supplier</label>
                <select class="form-select" id="supplier_id" name="supplier_id">
                    <option value="">All Suppliers</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
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
                        <h6 class="card-title">Total Purchases</h6>
                        <h4 class="mb-0">{{ number_format($totalPurchases) }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-shopping-bag fa-2x"></i>
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
                        <h6 class="card-title">Total Spent</h6>
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
                        <h6 class="card-title">Average Purchase</h6>
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
                        <h6 class="card-title">Completion Rate</h6>
                        <h4 class="mb-0">{{ $totalPurchases > 0 ? number_format(($purchases->where('status', 'completed')->count() / $totalPurchases) * 100, 1) : 0 }}%</h4>
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
    <!-- Purchases by Status -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Purchases by Status</h5>
            </div>
            <div class="card-body">
                @foreach($purchasesByStatus as $status)
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

    <!-- Top Suppliers -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Top Suppliers</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Supplier</th>
                                <th>Orders</th>
                                <th>Total Amount</th>
                                <th>Average</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topSuppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->supplier->name }}</td>
                                <td>{{ $supplier->total_orders }}</td>
                                <td>Rp {{ number_format($supplier->total_amount, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($supplier->total_amount / $supplier->total_orders, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Purchases Details -->
<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">Purchases Details</h5>
    </div>
    <div class="card-body">
        @if($purchases->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Purchase #</th>
                            <th>Supplier</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                        <tr>
                            <td>
                                <strong>{{ $purchase->purchase_number }}</strong>
                                <br>
                                <small class="text-muted">ID: {{ $purchase->id }}</small>
                            </td>
                            <td>
                                <strong>{{ $purchase->supplier->name }}</strong>
                                @if($purchase->supplier->contact_person)
                                    <br>
                                    <small class="text-muted">{{ $purchase->supplier->contact_person }}</small>
                                @endif
                            </td>
                            <td>
                                <div>{{ $purchase->created_at->format('M d, Y') }}</div>
                                <small class="text-muted">{{ $purchase->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $purchase->items->count() }} items</span>
                                <br>
                                <small class="text-muted">{{ $purchase->items->sum('quantity') }} units</small>
                            </td>
                            <td>
                                <strong class="text-primary">Rp {{ number_format($purchase->final_amount, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-{{ $purchase->status == 'completed' ? 'success' : ($purchase->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($purchase->status) }}
                                </span>
                            </td>
                            <td>
                                @switch($purchase->payment_method)
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
                                        <span class="badge bg-secondary">{{ ucfirst($purchase->payment_method) }}</span>
                                @endswitch
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $purchases->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No purchases found</h5>
                <p class="text-muted">Try adjusting your filters to see purchase data.</p>
            </div>
        @endif
    </div>
</div>
@endsection
