@extends('layouts.app')

@section('title', 'Advertisers Management')

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
                    <h1 class="text-3xl font-bold text-white mb-1">Advertisers</h1>
                    <p class="text-purple-100">Manage your advertising partners and campaigns</p>
                </div>
            </div>
            <a href="{{ route('advertisers.create') }}" class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                <i class="fas fa-plus mr-2"></i>Add Advertiser
            </a>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-3 mr-4">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Advertisers</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $advertisers->total() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center">
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-3 mr-4">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Advertisers</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $advertisers->where('is_active', true)->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center">
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-3 mr-4">
                <i class="fas fa-coins text-white text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Budget</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($advertisers->sum('total_budget'), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center">
            <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg p-3 mr-4">
                <i class="fas fa-chart-line text-white text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Spent</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($advertisers->sum('total_spent'), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-6">
    <form method="GET" action="{{ route('advertisers.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
            <input type="text" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:text-white" 
                   id="search" name="search" value="{{ request('search') }}" placeholder="Search advertisers...">
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
            <select class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:text-white" 
                    id="status" name="status">
                <option value="">All Status</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-medium rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-200">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </div>
    </form>
</div>

<!-- Advertisers Table -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
            <i class="fas fa-bullhorn mr-2 text-purple-600 dark:text-purple-400"></i>
            Advertisers List
        </h5>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Advertiser</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Commission</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Budget</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($advertisers as $advertiser)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $advertiser->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $advertiser->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">{{ $advertiser->company_name ?: 'N/A' }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $advertiser->phone ?: 'No phone' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            {{ $advertiser->commission_rate }}%
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">Rp {{ number_format($advertiser->total_budget, 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Spent: Rp {{ number_format($advertiser->total_spent, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($advertiser->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <i class="fas fa-check-circle mr-1"></i>Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                <i class="fas fa-times-circle mr-1"></i>Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('advertisers.show', $advertiser) }}" 
                               class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors duration-200">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('advertisers.edit', $advertiser) }}" 
                               class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-900 dark:hover:text-yellow-300 transition-colors duration-200">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('advertisers.destroy', $advertiser) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this advertiser?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors duration-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-full p-4 mb-4">
                                <i class="fas fa-bullhorn text-2xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No advertisers found</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-4">Get started by adding your first advertiser.</p>
                            <a href="{{ route('advertisers.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-medium rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-200">
                                <i class="fas fa-plus mr-2"></i>Add Advertiser
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($advertisers->hasPages())
    <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
        {{ $advertisers->links() }}
    </div>
    @endif
</div>
@endsection
