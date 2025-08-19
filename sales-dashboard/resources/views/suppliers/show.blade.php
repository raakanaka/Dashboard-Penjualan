@extends('layouts.app')

@section('title', $supplier->name . ' - Supplier Details')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
        <i class="fas fa-truck mr-2 text-blue-600 dark:text-blue-400"></i>Supplier Details
    </h1>
    <div class="flex space-x-2">
        <a href="{{ route('suppliers.edit', $supplier) }}" class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-edit mr-2"></i>Edit Supplier
        </a>
        <a href="{{ route('suppliers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Suppliers
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Supplier Information -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Supplier Information</h5>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $supplier->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                        {{ $supplier->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $supplier->name }}</h3>
                            @if($supplier->contact_person)
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Contact: {{ $supplier->contact_person }}</p>
                            @endif
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-32">Email:</span>
                                <span class="text-sm text-gray-900 dark:text-white">
                                    @if($supplier->email)
                                        <a href="mailto:{{ $supplier->email }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $supplier->email }}</a>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">Not provided</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-32">Phone:</span>
                                <span class="text-sm text-gray-900 dark:text-white">
                                    @if($supplier->phone)
                                        <a href="tel:{{ $supplier->phone }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $supplier->phone }}</a>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">Not provided</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-32">Status:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $supplier->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                                    {{ $supplier->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Address</h4>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                @if($supplier->address)
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $supplier->address }}</p>
                                @else
                                    <p class="text-sm text-gray-400 dark:text-gray-500">No address provided</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Created:</span>
                                <span class="text-sm text-gray-900 dark:text-white">{{ $supplier->created_at->format('M d, Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Last Updated:</span>
                                <span class="text-sm text-gray-900 dark:text-white">{{ $supplier->updated_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Contact Information</h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($supplier->email)
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="bg-blue-600 rounded-full p-3 mr-4">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h6 class="font-medium text-blue-900 dark:text-blue-100 mb-1">Email</h6>
                                <a href="mailto:{{ $supplier->email }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">{{ $supplier->email }}</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($supplier->phone)
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="bg-green-600 rounded-full p-3 mr-4">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h6 class="font-medium text-green-900 dark:text-green-100 mb-1">Phone</h6>
                                <a href="tel:{{ $supplier->phone }}" class="text-green-600 dark:text-green-400 hover:underline text-sm">{{ $supplier->phone }}</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                @if($supplier->address)
                <div class="mt-4">
                    <div class="bg-cyan-50 dark:bg-cyan-900/20 border border-cyan-200 dark:border-cyan-800 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="bg-cyan-600 rounded-full p-3 mr-4">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h6 class="font-medium text-cyan-900 dark:text-cyan-100 mb-1">Address</h6>
                                <p class="text-cyan-800 dark:text-cyan-200 text-sm">{{ $supplier->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Supplier Profile & Actions -->
    <div class="lg:col-span-1">
        <!-- Supplier Profile -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Supplier Profile</h5>
            </div>
            <div class="p-6 text-center">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-truck text-3xl text-white"></i>
                </div>
                <h5 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $supplier->name }}</h5>
                @if($supplier->contact_person)
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ $supplier->contact_person }}</p>
                @endif
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                    {{ $supplier->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                    {{ $supplier->is_active ? 'Active Supplier' : 'Inactive Supplier' }}
                </span>
                
                <div class="grid grid-cols-2 gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Partner Since</h6>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $supplier->created_at->format('M Y') }}</p>
                    </div>
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Last Updated</h6>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $supplier->updated_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h5>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('suppliers.edit', $supplier) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-3 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Supplier
                    </a>
                    
                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this supplier?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-3 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Supplier
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Supplier Statistics -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">Supplier Statistics</h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Orders</h6>
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">
                            {{ $supplier->purchases()->count() }}
                        </div>
                    </div>
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Spent</h6>
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400 mt-1">
                            Rp {{ number_format($supplier->purchases()->sum('final_amount'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                
                @if($supplier->purchases()->count() > 0)
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Average Order</h6>
                        <div class="text-lg font-semibold text-amber-600 dark:text-amber-400 mt-1">
                            Rp {{ number_format($supplier->purchases()->avg('final_amount'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
