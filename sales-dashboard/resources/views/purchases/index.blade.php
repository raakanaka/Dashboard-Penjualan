@extends('layouts.app')

@section('title', 'Purchases')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-shopping-bag me-2"></i>Purchases
    </h1>
    <a href="{{ route('purchases.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>New Purchase
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
                <h5 class="card-title mb-0">Purchases List</h5>
            </div>
            <div class="col-md-6">
                <form action="{{ route('purchases.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search purchases..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
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
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Actions</th>
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
                                <strong class="text-primary">Rp {{ number_format($purchase->final_amount, 0, ',', '.') }}</strong>
                                @if($purchase->discount_amount > 0)
                                    <br>
                                    <small class="text-success">-Rp {{ number_format($purchase->discount_amount, 0, ',', '.') }}</small>
                                @endif
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
                            <td>
                                @switch($purchase->status)
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
                                        <span class="badge bg-secondary">{{ ucfirst($purchase->status) }}</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('purchases.show', $purchase) }}" class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this purchase?')">
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
                {{ $purchases->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No purchases found</h5>
                <p class="text-muted">Start by creating your first purchase.</p>
                <a href="{{ route('purchases.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>New Purchase
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
                        <h6 class="card-title">Total Purchases</h6>
                        <h4 class="mb-0">{{ $purchases->total() }}</h4>
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
                        <h6 class="card-title">Today's Purchases</h6>
                        <h4 class="mb-0">{{ $purchases->where('created_at', '>=', now()->startOfDay())->count() }}</h4>
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
                        <h6 class="card-title">Total Spent</h6>
                        <h4 class="mb-0">Rp {{ number_format($purchases->sum('final_amount'), 0, ',', '.') }}</h4>
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
                        <h6 class="card-title">Avg. Purchase Value</h6>
                        <h4 class="mb-0">Rp {{ $purchases->count() > 0 ? number_format($purchases->avg('final_amount'), 0, ',', '.') : '0' }}</h4>
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
