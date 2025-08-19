@extends('layouts.app')

@section('title', $customer->name . ' - Customer Details')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg shadow-lg mb-6">
    <div class="px-6 py-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="fas fa-user text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Customer Details</h1>
                    <p class="text-purple-100">{{ $customer->name }}</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                    <i class="fas fa-edit mr-2"></i>Edit Customer
                </a>
                <a href="{{ route('customers.index') }}" class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Customers
                </a>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Customer Information Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-info-circle mr-2 text-purple-600 dark:text-purple-400"></i>
                        Customer Information
                    </h5>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium shadow-sm
                        {{ $customer->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                        <i class="fas fa-circle mr-1.5 text-xs"></i>
                        {{ $customer->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Customer Details -->
                    <div class="space-y-6">
                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-xl p-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $customer->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 flex items-center">
                                <i class="fas fa-id-card mr-2 text-purple-600 dark:text-purple-400"></i>
                                {{ $customer->customer_code }}
                            </p>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-2 mr-4">
                                    <i class="fas fa-user text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Customer Name</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $customer->name }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-2 mr-4">
                                    <i class="fas fa-envelope text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                        @if($customer->email)
                                            <a href="mailto:{{ $customer->email }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $customer->email }}</a>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">Not provided</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-2 mr-4">
                                    <i class="fas fa-phone text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                        @if($customer->phone)
                                            <a href="tel:{{ $customer->phone }}" class="text-green-600 dark:text-green-400 hover:underline">{{ $customer->phone }}</a>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">Not provided</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Information -->
                    <div class="space-y-6">
                        <div class="bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-cyan-900/20 dark:to-blue-900/20 rounded-xl p-6">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-cyan-600 dark:text-cyan-400"></i>
                                Address Information
                            </h4>
                            <div class="space-y-3">
                                @if($customer->address)
                                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                                        <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">{{ $customer->address }}</p>
                                    </div>
                                @else
                                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                                        <p class="text-gray-400 dark:text-gray-500 text-sm">No address provided</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Created:</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $customer->created_at->format('M d, Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Last Updated:</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $customer->updated_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Information Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-address-book mr-2 text-purple-600 dark:text-purple-400"></i>
                    Contact Information
                </h5>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($customer->email)
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="bg-blue-600 rounded-full p-3 mr-4">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h6 class="font-medium text-blue-900 dark:text-blue-100 mb-1">Email</h6>
                                <a href="mailto:{{ $customer->email }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">{{ $customer->email }}</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($customer->phone)
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="bg-green-600 rounded-full p-3 mr-4">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h6 class="font-medium text-green-900 dark:text-green-100 mb-1">Phone</h6>
                                <a href="tel:{{ $customer->phone }}" class="text-green-600 dark:text-green-400 hover:underline text-sm">{{ $customer->phone }}</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                @if($customer->address)
                <div class="mt-4">
                    <div class="bg-cyan-50 dark:bg-cyan-900/20 border border-cyan-200 dark:border-cyan-800 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="bg-cyan-600 rounded-full p-3 mr-4">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h6 class="font-medium text-cyan-900 dark:text-cyan-100 mb-1">Address</h6>
                                <p class="text-cyan-800 dark:text-cyan-200 text-sm">{{ $customer->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-8">
        <!-- Customer Profile Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-user mr-2"></i>
                    Customer Profile
                </h5>
            </div>
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-full w-20 h-20 mx-auto mb-4 flex items-center justify-center shadow-lg">
                        <i class="fas fa-user text-3xl text-white"></i>
                    </div>
                    <h5 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $customer->name }}</h5>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ $customer->customer_code }}</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $customer->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                        {{ $customer->is_active ? 'Active Customer' : 'Inactive Customer' }}
                    </span>
                </div>
                
                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Member Since</h6>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $customer->created_at->format('M Y') }}</p>
                    </div>
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Last Updated</h6>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $customer->updated_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-bolt mr-2 text-amber-600 dark:text-amber-400"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <a href="{{ route('customers.edit', $customer) }}" 
                       class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Customer
                    </a>
                    
                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this customer?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Customer
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Customer Statistics Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-chart-bar mr-2 text-purple-600 dark:text-purple-400"></i>
                    Customer Statistics
                </h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-1">{{ $customer->sales()->count() }}</div>
                        <div class="text-xs font-medium text-blue-700 dark:text-blue-300 uppercase tracking-wider">Total Orders</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-xl">
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-1">Rp {{ number_format($customer->sales()->sum('final_amount'), 0, ',', '.') }}</div>
                        <div class="text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Total Spent</div>
                    </div>
                </div>
                
                @if($customer->sales()->count() > 0)
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <h6 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Average Order</h6>
                        <div class="text-lg font-semibold text-purple-600 dark:text-purple-400 mt-1">
                            Rp {{ number_format($customer->sales()->avg('final_amount'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
