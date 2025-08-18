<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $sale->invoice_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            .invoice-container {
                margin: 0 !important;
                padding: 0 !important;
            }
        }
        
        .invoice-header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-info {
            text-align: left;
        }
        
        .invoice-info {
            text-align: right;
        }
        
        .invoice-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .table th {
            background-color: #007bff;
            color: white;
            border: none;
        }
        
        .total-section {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 8px;
        }
        
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-fluid invoice-container">
        <!-- Print Button -->
        <div class="row mb-4 no-print">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('sales.show', $sale) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Sale
                    </a>
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print me-2"></i>Print Invoice
                    </button>
                </div>
            </div>
        </div>

        <!-- Invoice Header -->
        <div class="row invoice-header">
            <div class="col-6 company-info">
                <h2 class="text-primary mb-2">
                    <i class="fas fa-store me-2"></i>Your Company Name
                </h2>
                <p class="mb-1"><strong>Address:</strong> 123 Business Street, City, Country</p>
                <p class="mb-1"><strong>Phone:</strong> +62 123 456 789</p>
                <p class="mb-1"><strong>Email:</strong> info@yourcompany.com</p>
                <p class="mb-0"><strong>Website:</strong> www.yourcompany.com</p>
            </div>
            <div class="col-6 invoice-info">
                <h1 class="text-primary mb-3">INVOICE</h1>
                <p class="mb-1"><strong>Invoice #:</strong> {{ $sale->invoice_number }}</p>
                <p class="mb-1"><strong>Date:</strong> {{ $sale->created_at->format('M d, Y') }}</p>
                <p class="mb-1"><strong>Due Date:</strong> {{ $sale->created_at->format('M d, Y') }}</p>
                <p class="mb-0"><strong>Status:</strong> 
                    <span class="badge bg-{{ $sale->status == 'completed' ? 'success' : ($sale->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($sale->status) }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Customer and Invoice Details -->
        <div class="row">
            <div class="col-6">
                <div class="invoice-details">
                    <h5 class="mb-3"><i class="fas fa-user me-2"></i>Bill To:</h5>
                    <p class="mb-1"><strong>{{ $sale->customer->name }}</strong></p>
                    <p class="mb-1">Customer Code: {{ $sale->customer->customer_code }}</p>
                    @if($sale->customer->email)
                        <p class="mb-1">Email: {{ $sale->customer->email }}</p>
                    @endif
                    @if($sale->customer->phone)
                        <p class="mb-1">Phone: {{ $sale->customer->phone }}</p>
                    @endif
                    @if($sale->customer->address)
                        <p class="mb-0">Address: {{ $sale->customer->address }}</p>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class="invoice-details">
                    <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Invoice Details:</h5>
                    <p class="mb-1"><strong>Payment Method:</strong> 
                        @switch($sale->payment_method)
                            @case('cash')
                                Cash
                                @break
                            @case('credit_card')
                                Credit Card
                                @break
                            @case('bank_transfer')
                                Bank Transfer
                                @break
                            @default
                                {{ ucfirst($sale->payment_method) }}
                        @endswitch
                    </p>
                    <p class="mb-1"><strong>Sale Date:</strong> {{ $sale->created_at->format('M d, Y H:i') }}</p>
                    <p class="mb-0"><strong>Items:</strong> {{ $sale->items->count() }} products</p>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="40%">Product</th>
                                <th width="15%">SKU</th>
                                <th width="10%" class="text-center">Qty</th>
                                <th width="15%" class="text-end">Unit Price</th>
                                <th width="15%" class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $item->product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $item->product->category->name }}</small>
                                </td>
                                <td>{{ $item->product->sku }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                <td class="text-end fw-bold">Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Totals -->
        <div class="row">
            <div class="col-6 offset-6">
                <div class="total-section">
                    <div class="row mb-2">
                        <div class="col-6">Subtotal:</div>
                        <div class="col-6 text-end">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</div>
                    </div>
                    @if($sale->tax_amount > 0)
                    <div class="row mb-2">
                        <div class="col-6">Tax:</div>
                        <div class="col-6 text-end">Rp {{ number_format($sale->tax_amount, 0, ',', '.') }}</div>
                    </div>
                    @endif
                    @if($sale->discount_amount > 0)
                    <div class="row mb-2">
                        <div class="col-6">Discount:</div>
                        <div class="col-6 text-end text-success">-Rp {{ number_format($sale->discount_amount, 0, ',', '.') }}</div>
                    </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-6"><strong>Total:</strong></div>
                        <div class="col-6 text-end"><strong class="fs-5 text-primary">Rp {{ number_format($sale->final_amount, 0, ',', '.') }}</strong></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes -->
        @if($sale->notes)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6><i class="fas fa-sticky-note me-2"></i>Notes:</h6>
                        <p class="mb-0">{{ $sale->notes }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p class="mb-2">Thank you for your business!</p>
            <p class="mb-0">
                <small>
                    This is a computer generated invoice. No signature required.<br>
                    For any questions, please contact us at info@yourcompany.com
                </small>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
