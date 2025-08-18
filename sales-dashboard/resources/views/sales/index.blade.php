@extends('layouts.app')

@section('title', 'Sales')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-shopping-cart me-2"></i>Sales
    </h1>
    <a href="{{ route('sales.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>New Sale
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-header bg-white">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="card-title mb-0">Sales List</h5>
            </div>
            <div class="col-md-6">
                <form action="{{ route('sales.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search sales..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
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
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Actions</th>
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
                                <strong class="text-primary">Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</strong>
                                @if($sale->discount_amount > 0)
                                    <br>
                                    <small class="text-success">-Rp {{ number_format($sale->discount_amount, 0, ',', '.') }}</small>
                                @endif
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
                            <td>
                                @switch($sale->status)
                                    @case('completed')
                                        <span class="badge bg-success">Completed</span>
                                        @break
                                    @case('pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ ucfirst($sale->status) }}</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('sales.invoice', $sale) }}" class="btn btn-sm btn-outline-primary" title="Invoice">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>
                                    <a href="{{ route('sales.edit', $sale) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this sale?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
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
                {{ $sales->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No sales found</h5>
                <p class="text-muted">Start by creating your first sale.</p>
                <a href="{{ route('sales.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>New Sale
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Summary Cards -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Sales</h6>
                        <h4 class="mb-0">{{ $sales->total() }}</h4>
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
                        <h6 class="card-title">Today's Sales</h6>
                        <h4 class="mb-0">{{ $sales->where('created_at', '>=', now()->startOfDay())->count() }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-day fa-2x"></i>
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
                        <h6 class="card-title">Total Revenue</h6>
                        <h4 class="mb-0">Rp {{ number_format($sales->sum('final_amount'), 0, ',', '.') }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
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
                        <h6 class="card-title">Avg. Sale Value</h6>
                        <h4 class="mb-0">Rp {{ $sales->count() > 0 ? number_format($sales->avg('final_amount'), 0, ',', '.') : '0' }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
