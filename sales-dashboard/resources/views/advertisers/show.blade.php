@extends('layouts.app')

@section('title', $advertiser->name . ' - Advertiser Details')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg shadow-lg mb-6">
    <div class="px-6 py-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="fas fa-bullhorn text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">{{ $advertiser->name }}</h1>
                    <p class="text-purple-100">Advertiser Details & Performance</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('advertisers.edit', $advertiser) }}" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('advertisers.index') }}" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Advertisers
                </a>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Advertiser Information -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-user mr-2 text-purple-600 dark:text-purple-400"></i>
                    Advertiser Information
                </h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</h6>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $advertiser->name }}</p>
                    </div>
                    <div>
                        <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</h6>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $advertiser->email }}</p>
                    </div>
                    <div>
                        <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Phone</h6>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $advertiser->phone ?: 'Not provided' }}</p>
                    </div>
                    <div>
                        <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Company</h6>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $advertiser->company_name ?: 'Not provided' }}</p>
                    </div>
                    <div>
                        <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Commission Rate</h6>
                        <p class="mt-1 text-lg font-semibold text-purple-600 dark:text-purple-400">{{ $advertiser->commission_rate }}%</p>
                    </div>
                    <div>
                        <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</h6>
                        @if($advertiser->is_active)
                            <span class="mt-1 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <i class="fas fa-check-circle mr-1"></i>Active
                            </span>
                        @else
                            <span class="mt-1 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                <i class="fas fa-times-circle mr-1"></i>Inactive
                            </span>
                        @endif
                    </div>
                </div>
                
                @if($advertiser->address)
                <div class="mt-6">
                    <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Address</h6>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $advertiser->address }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Budget Summary -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-coins mr-2 text-yellow-600 dark:text-yellow-400"></i>
                    Budget Summary
                </h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-4">
                            <i class="fas fa-coins text-2xl text-blue-600 dark:text-blue-400 mb-2"></i>
                            <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Budget</h6>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($advertiser->total_budget, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-4">
                            <i class="fas fa-chart-line text-2xl text-green-600 dark:text-green-400 mb-2"></i>
                            <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Spent</h6>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($advertiser->total_spent, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-4">
                            <i class="fas fa-wallet text-2xl text-purple-600 dark:text-purple-400 mb-2"></i>
                            <h6 class="text-sm font-medium text-gray-500 dark:text-gray-400">Remaining</h6>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($advertiser->remaining_budget, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Purchases -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-shopping-cart mr-2 text-green-600 dark:text-green-400"></i>
                    Recent Purchases
                </h5>
            </div>
            <div class="p-6">
                @if($advertiser->purchases->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Purchase #</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($advertiser->purchases->take(5) as $purchase)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $purchase->purchase_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $purchase->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        Rp {{ number_format($purchase->final_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ ucfirst($purchase->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-full p-4 w-fit mx-auto mb-4">
                            <i class="fas fa-shopping-cart text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No purchases found</h3>
                        <p class="text-gray-500 dark:text-gray-400">This advertiser hasn't made any purchases yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-8">
        <!-- Quick Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-bolt mr-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('advertisers.edit', $advertiser) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 dark:bg-blue-900 dark:hover:bg-blue-800 dark:text-blue-200 text-sm font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit Advertiser
                    </a>
                    <a href="{{ route('budgets.index') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-100 hover:bg-green-200 text-green-800 dark:bg-green-900 dark:hover:bg-green-800 dark:text-green-200 text-sm font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-coins mr-2"></i>Manage Budgets
                    </a>
                    <a href="{{ route('purchases.index') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-purple-100 hover:bg-purple-200 text-purple-800 dark:bg-purple-900 dark:hover:bg-purple-800 dark:text-purple-200 text-sm font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-shopping-cart mr-2"></i>View All Purchases
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Statistics -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Statistics
                </h5>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Total Purchases</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $advertiser->purchases->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Active Budgets</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $advertiser->budgets->where('status', 'active')->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Total Commission</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($advertiser->purchases->sum('final_amount') * ($advertiser->commission_rate / 100), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Information -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-address-book mr-2"></i>
                    Contact Info
                </h5>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $advertiser->email }}</span>
                    </div>
                    @if($advertiser->phone)
                    <div class="flex items-center">
                        <i class="fas fa-phone text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $advertiser->phone }}</span>
                    </div>
                    @endif
                    @if($advertiser->company_name)
                    <div class="flex items-center">
                        <i class="fas fa-building text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $advertiser->company_name }}</span>
                    </div>
                    @endif
                    @if($advertiser->address)
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-gray-400 mr-3 mt-1"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $advertiser->address }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
