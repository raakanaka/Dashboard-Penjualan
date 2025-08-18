@extends('layouts.app')

@section('title', 'Sale Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-shopping-cart me-2"></i>Sale Details
    </h1>
    <div class="btn-group" role="group">
        <a href="{{ route('sales.invoice', $sale) }}" class="btn btn-primary">
            <i class="fas fa-file-invoice me-2"></i>Invoice
        </a>
        <a href="{{ route('sales.edit', $sale) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Sales
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Sale Information -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Sale Information</h5>
                    <span class="badge bg-{{ $sale->status == 'completed' ? 'success' : ($sale->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($sale->status) }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 40%;">Invoice Number:</td>
                                <td><span class="badge bg-primary">{{ $sale->invoice_number }}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Customer:</td>
                                <td>
                                    <strong>{{ $sale->customer->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $sale->customer->customer_code }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Sale Date:</td>
                                <td>{{ $sale->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Payment Method:</td>
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
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 40%;">Subtotal:</td>
                                <td class="text-primary fw-bold">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tax:</td>
                                <td>Rp {{ number_format($sale->tax_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Discount:</td>
                                <td class="text-success">-Rp {{ number_format($sale->discount_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Final Amount:</td>
                                <td class="text-primary fw-bold fs-5">Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($sale->notes)
                <div class="mt-3">
                    <h6>Notes:</h6>
                    <p class="mb-0">{{ $sale->notes }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Sale Items -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Sale Items</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $item->product->category->name }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $item->product->sku }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-end">
                                    Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                                </td>
                                <td class="text-end fw-bold">
                                    Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Subtotal:</td>
                                <td class="text-end fw-bold">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                            </tr>
                            @if($sale->tax_amount > 0)
                            <tr>
                                <td colspan="4" class="text-end">Tax:</td>
                                <td class="text-end">Rp {{ number_format($sale->tax_amount, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                            @if($sale->discount_amount > 0)
                            <tr>
                                <td colspan="4" class="text-end text-success">Discount:</td>
                                <td class="text-end text-success">-Rp {{ number_format($sale->discount_amount, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="4" class="text-end fw-bold fs-5">Total:</td>
                                <td class="text-end fw-bold fs-5 text-primary">Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Customer Information -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                        <i class="fas fa-user fa-2x text-white"></i>
                    </div>
                    <h6>{{ $sale->customer->name }}</h6>
                    <p class="text-muted mb-2">{{ $sale->customer->customer_code }}</p>
                </div>
                
                <div class="row">
                    @if($sale->customer->email)
                    <div class="col-12 mb-2">
                        <small class="text-muted">Email:</small>
                        <div><a href="mailto:{{ $sale->customer->email }}">{{ $sale->customer->email }}</a></div>
                    </div>
                    @endif
                    
                    @if($sale->customer->phone)
                    <div class="col-12 mb-2">
                        <small class="text-muted">Phone:</small>
                        <div><a href="tel:{{ $sale->customer->phone }}">{{ $sale->customer->phone }}</a></div>
                    </div>
                    @endif
                    
                    @if($sale->customer->address)
                    <div class="col-12 mb-2">
                        <small class="text-muted">Address:</small>
                        <div>{{ $sale->customer->address }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('sales.invoice', $sale) }}" class="btn btn-primary">
                        <i class="fas fa-file-invoice me-2"></i>View Invoice
                    </a>
                    <a href="{{ route('sales.edit', $sale) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Sale
                    </a>
                    <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this sale?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Sale
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Sale Statistics -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Sale Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-muted">Items Sold</h6>
                            <h4 class="text-primary">{{ $sale->items->sum('quantity') }}</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Products</h6>
                        <h4 class="text-success">{{ $sale->items->count() }}</h4>
                    </div>
                </div>
                
                <hr>
                
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-muted">Avg. Item Price</h6>
                            <h4 class="text-info">Rp {{ $sale->items->count() > 0 ? number_format($sale->items->avg('unit_price'), 0, ',', '.') : '0' }}</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Profit Margin</h6>
                        <h4 class="text-warning">{{ $sale->items->count() > 0 ? number_format(($sale->final_amount - $sale->items->sum(function($item) { return $item->quantity * $item->product->cost_price; })) / $sale->final_amount * 100, 1) : '0' }}%</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
