@extends('layouts.app')

@section('title', 'Advanced CRM Dashboard')

@section('content')
<div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg shadow-lg mb-6 p-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white">Advanced CRM Dashboard</h1>
            <p class="text-purple-100 mt-2">Comprehensive customer relationship management</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('crm.leads') }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-users mr-2"></i>Leads
            </a>
            <a href="{{ route('crm.segments') }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-chart-pie mr-2"></i>Segments
            </a>
        </div>
    </div>
</div>

<!-- Key Metrics -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Customers -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Customers</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalCustomers) }}</p>
                <p class="text-sm text-green-600 dark:text-green-400 mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>{{ $newCustomersThisMonth }} this month
                </p>
            </div>
            <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-3">
                <i class="fas fa-users text-blue-600 dark:text-blue-400 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Active Customers -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Customers</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($activeCustomers) }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ round(($activeCustomers / max($totalCustomers, 1)) * 100, 1) }}% of total
                </p>
            </div>
            <div class="bg-green-100 dark:bg-green-900 rounded-full p-3">
                <i class="fas fa-user-check text-green-600 dark:text-green-400 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Revenue</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalSales) }}</p>
                <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">
                    Rp {{ number_format($salesThisMonth) }} this month
                </p>
            </div>
            <div class="bg-purple-100 dark:bg-purple-900 rounded-full p-3">
                <i class="fas fa-chart-line text-purple-600 dark:text-purple-400 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Average Order Value -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Avg Order Value</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($averageOrderValue) }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Per transaction</p>
            </div>
            <div class="bg-yellow-100 dark:bg-yellow-900 rounded-full p-3">
                <i class="fas fa-coins text-yellow-600 dark:text-yellow-400 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Sales Pipeline -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Sales Pipeline</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $salesPipeline['prospects'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Prospects</div>
                </div>
                <div class="text-center p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $salesPipeline['qualified_leads'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Qualified</div>
                </div>
                <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                    <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $salesPipeline['negotiations'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Negotiations</div>
                </div>
                <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $salesPipeline['closed_won'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Closed Won</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Segments -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Customer Segments</h3>
        
        <div class="space-y-4">
            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gold-100 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-crown text-yellow-600 dark:text-yellow-400 mr-3"></i>
                    <span class="font-medium text-gray-900 dark:text-white">VIP Customers</span>
                </div>
                <span class="text-lg font-bold text-yellow-600 dark:text-yellow-400">{{ $customerSegments['vip']->count() }}</span>
            </div>
            
            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-blue-100 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-user-tie text-blue-600 dark:text-blue-400 mr-3"></i>
                    <span class="font-medium text-gray-900 dark:text-white">Regular</span>
                </div>
                <span class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $customerSegments['regular']->count() }}</span>
            </div>
            
            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-green-100 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-user-plus text-green-600 dark:text-green-400 mr-3"></i>
                    <span class="font-medium text-gray-900 dark:text-white">New</span>
                </div>
                <span class="text-lg font-bold text-green-600 dark:text-green-400">{{ $customerSegments['new']->count() }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Top Customers & Recent Activities -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Top Customers -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Top Customers by Revenue</h3>
        
        <div class="space-y-4">
            @foreach($topCustomers->take(5) as $index => $customer)
            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                        {{ $index + 1 }}
                    </div>
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $customer->name }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ $customer->email }}</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-purple-600 dark:text-purple-400">
                        Rp {{ number_format($customer->total_revenue ?? 0) }}
                    </div>
                    <a href="{{ route('crm.interactions', $customer) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Recent Activities</h3>
        
        <div class="space-y-4">
            @foreach($recentActivities->take(5) as $activity)
            <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-shopping-cart text-white text-sm"></i>
                </div>
                <div class="flex-1">
                    <div class="font-medium text-gray-900 dark:text-white">{{ $activity['description'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Rp {{ number_format($activity['amount']) }} • {{ $activity['date']->diffForHumans() }}
                    </div>
                </div>
                <a href="{{ route('customers.show', $activity['customer']) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                    View
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
