@extends('layouts.app')

@section('title', 'Lead Management')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg shadow-lg mb-6 p-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white">Lead Management</h1>
            <p class="text-indigo-100 mt-2">Potential customers who haven't made a purchase yet</p>
        </div>
        <a href="{{ route('crm.dashboard') }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to CRM
        </a>
    </div>
</div>

<!-- Lead Statistics -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Leads</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $leads->total() }}</p>
            </div>
            <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-3">
                <i class="fas fa-user-plus text-blue-600 dark:text-blue-400 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Hot Leads</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $leads->where('created_at', '>=', now()->subDays(7))->count() }}</p>
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">This week</p>
            </div>
            <div class="bg-red-100 dark:bg-red-900 rounded-full p-3">
                <i class="fas fa-fire text-red-600 dark:text-red-400 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Conversion Rate</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">25%</p>
                <p class="text-sm text-green-600 dark:text-green-400 mt-1">Average</p>
            </div>
            <div class="bg-green-100 dark:bg-green-900 rounded-full p-3">
                <i class="fas fa-percentage text-green-600 dark:text-green-400 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Leads Table -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Potential Customers</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Registered</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($leads as $lead)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($lead->name, 0, 1)) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $lead->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Lead #{{ $lead->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">{{ $lead->email }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $lead->phone ?? 'No phone' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $lead->created_at->format('M d, Y') }}
                        <div class="text-xs text-gray-400">{{ $lead->created_at->diffForHumans() }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($lead->created_at >= now()->subDays(7))
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Hot Lead
                            </span>
                        @elseif($lead->created_at >= now()->subDays(30))
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Warm Lead
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                Cold Lead
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('customers.show', $lead) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('sales.create', ['customer_id' => $lead->id]) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 transition-colors duration-200">
                                <i class="fas fa-plus mr-1"></i>Create Sale
                            </a>
                            <a href="mailto:{{ $lead->email }}" class="text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300 transition-colors duration-200">
                                <i class="fas fa-envelope mr-1"></i>Email
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-user-plus text-gray-400 text-4xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No leads found</h3>
                            <p class="text-gray-500 dark:text-gray-400">All customers have made purchases!</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($leads->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
        {{ $leads->links() }}
    </div>
    @endif
</div>
@endsection
