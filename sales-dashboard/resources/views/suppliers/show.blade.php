@extends('layouts.app')

@section('title', 'Supplier Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-truck me-2"></i>Supplier Details
    </h1>
    <div class="btn-group" role="group">
        <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Suppliers
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Supplier Information</h5>
                    <span class="badge bg-{{ $supplier->is_active ? 'success' : 'secondary' }}">
                        {{ $supplier->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 40%;">Supplier Name:</td>
                                <td>{{ $supplier->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Contact Person:</td>
                                <td>
                                    @if($supplier->contact_person)
                                        <span class="badge bg-info">{{ $supplier->contact_person }}</span>
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Email Address:</td>
                                <td>
                                    @if($supplier->email)
                                        <a href="mailto:{{ $supplier->email }}">{{ $supplier->email }}</a>
                                    @else
                                        <span class="text-muted">Not provided</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Phone Number:</td>
                                <td>
                                    @if($supplier->phone)
                                        <a href="tel:{{ $supplier->phone }}">{{ $supplier->phone }}</a>
                                    @else
                                        <span class="text-muted">Not provided</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 40%;">Address:</td>
                                <td>
                                    @if($supplier->address)
                                        {{ $supplier->address }}
                                    @else
                                        <span class="text-muted">No address provided</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status:</td>
                                <td>
                                    <span class="badge bg-{{ $supplier->is_active ? 'success' : 'secondary' }}">
                                        {{ $supplier->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Created:</td>
                                <td>{{ $supplier->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Last Updated:</td>
                                <td>{{ $supplier->updated_at->format('M d, Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Contact Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($supplier->email)
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <a href="mailto:{{ $supplier->email }}" class="text-decoration-none">{{ $supplier->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($supplier->phone)
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Phone</h6>
                                    <a href="tel:{{ $supplier->phone }}" class="text-decoration-none">{{ $supplier->phone }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                @if($supplier->address)
                <div class="mt-3">
                    <div class="border rounded p-3">
                        <div class="d-flex align-items-start">
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Address</h6>
                                <p class="mb-0">{{ $supplier->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Supplier Profile</h5>
            </div>
            <div class="card-body text-center">
                <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 120px; height: 120px;">
                    <i class="fas fa-truck fa-3x text-white"></i>
                </div>
                <h5>{{ $supplier->name }}</h5>
                @if($supplier->contact_person)
                    <p class="text-muted mb-2">{{ $supplier->contact_person }}</p>
                @endif
                <span class="badge bg-{{ $supplier->is_active ? 'success' : 'secondary' }} mb-3">
                    {{ $supplier->is_active ? 'Active Supplier' : 'Inactive Supplier' }}
                </span>
                
                <div class="row text-center mt-4">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-muted">Partner Since</h6>
                            <small>{{ $supplier->created_at->format('M Y') }}</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Last Updated</h6>
                        <small>{{ $supplier->updated_at->format('M Y') }}</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Supplier
                    </a>
                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this supplier?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Supplier
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Supplier Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-muted">Total Orders</h6>
                            <h4 class="text-primary">0</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Total Spent</h6>
                        <h4 class="text-success">Rp 0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
