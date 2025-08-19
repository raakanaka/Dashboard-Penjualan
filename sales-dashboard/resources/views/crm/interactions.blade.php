@extends('layouts.app')

@section('title', 'Customer Interactions - ' . $customer->name)

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-700 rounded-lg shadow-lg mb-6 p-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white">{{ $customer->name }}</h1>
            <p class="text-green-100 mt-2">Customer interaction history and analytics</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('crm.dashboard') }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to CRM
            </a>
            <a href="{{ route('sales.create', ['customer_id' => $customer->id]) }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>New Sale
            </a>
        </div>
    </div>
</div>

<!-- Customer Statistics -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Orders</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_orders'] }}</p>
            </div>
            <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-3">
                <i class="fas fa-shopping-cart text-blue-600 dark:text-blue-400 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Spent</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($stats['total_spent']) }}</p>
            </div>
            <div class="bg-green-100 dark:bg-green-900 rounded-full p-3">
                <i class="fas fa-dollar-sign text-green-600 dark:text-green-400 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Average Order</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($stats['average_order']) }}</p>
            </div>
            <div class="bg-purple-100 dark:bg-purple-900 rounded-full p-3">
                <i class="fas fa-chart-bar text-purple-600 dark:text-purple-400 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Last Order</p>
                <p class="text-lg font-bold text-gray-900 dark:text-white">
                    @if($stats['last_order'])
                        {{ $stats['last_order']->created_at->diffForHumans() }}
                    @else
                        Never
                    @endif
                </p>
            </div>
            <div class="bg-orange-100 dark:bg-orange-900 rounded-full p-3">
                <i class="fas fa-clock text-orange-600 dark:text-orange-400 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Interaction History -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Interaction History</h3>
            </div>
            
            <div class="p-6">
                @forelse($interactions as $interaction)
                <div class="flex items-start space-x-4 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-shopping-cart text-white text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Sale #{{ $interaction->id }}
                            </h4>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $interaction->created_at->format('M d, Y H:i') }}
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-2xl font-bold text-green-600 dark:text-green-400">
                                Rp {{ number_format($interaction->total_amount) }}
                            </span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($interaction->status == 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @elseif($interaction->status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                                {{ ucfirst($interaction->status) }}
                            </span>
                        </div>
                        
                        @if($interaction->products->count() > 0)
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                            <h5 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Products purchased:</h5>
                            <div class="space-y-1">
                                @foreach($interaction->products as $product)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">{{ $product->name }}</span>
                                    <span class="text-gray-900 dark:text-white">{{ $product->pivot->quantity }}x</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-history text-gray-400 text-4xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No interactions yet</h3>
                    <p class="text-gray-500 dark:text-gray-400">This customer hasn't made any purchases.</p>
                </div>
                @endforelse
            </div>
            
            @if($interactions->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $interactions->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Customer Profile & Favorite Products -->
    <div class="space-y-6">
        <!-- Customer Profile -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Customer Profile</h3>
            
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-400">Email</label>
                    <p class="text-gray-900 dark:text-white">{{ $customer->email }}</p>
                </div>
                
                @if($customer->phone)
                <div>
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-400">Phone</label>
                    <p class="text-gray-900 dark:text-white">{{ $customer->phone }}</p>
                </div>
                @endif
                
                @if($customer->address)
                <div>
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-400">Address</label>
                    <p class="text-gray-900 dark:text-white">{{ $customer->address }}</p>
                </div>
                @endif
                
                <div>
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-400">Customer Since</label>
                    <p class="text-gray-900 dark:text-white">{{ $customer->created_at->format('M d, Y') }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-400">Status</label>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                        @if($customer->is_active) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                        @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                        {{ $customer->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Favorite Products -->
        @if($stats['favorite_products']->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Favorite Products</h3>
            
            <div class="space-y-3">
                @foreach($stats['favorite_products'] as $product)
                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $product->total_quantity }} units</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
