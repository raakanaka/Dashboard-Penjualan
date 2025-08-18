@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="fas fa-truck me-2"></i>Suppliers
    </h1>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Supplier
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
                <h5 class="card-title mb-0">Supplier List</h5>
            </div>
            <div class="col-md-6">
                <form action="{{ route('suppliers.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search suppliers..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($suppliers->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Contact Person</th>
                            <th>Contact Info</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                        <tr>
                            <td>
                                <strong>{{ $supplier->name }}</strong>
                                <br>
                                <small class="text-muted">ID: {{ $supplier->id }}</small>
                            </td>
                            <td>
                                @if($supplier->contact_person)
                                    <span class="badge bg-info">{{ $supplier->contact_person }}</span>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </td>
                            <td>
                                @if($supplier->email)
                                    <div><i class="fas fa-envelope me-1"></i>{{ $supplier->email }}</div>
                                @endif
                                @if($supplier->phone)
                                    <div><i class="fas fa-phone me-1"></i>{{ $supplier->phone }}</div>
                                @endif
                            </td>
                            <td>
                                @if($supplier->address)
                                    <small class="text-muted">{{ Str::limit($supplier->address, 50) }}</small>
                                @else
                                    <span class="text-muted">No address</span>
                                @endif
                            </td>
                            <td>
                                @if($supplier->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this supplier?')">
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
                {{ $suppliers->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-truck fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No suppliers found</h5>
                <p class="text-muted">Start by adding your first supplier.</p>
                <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Supplier
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
