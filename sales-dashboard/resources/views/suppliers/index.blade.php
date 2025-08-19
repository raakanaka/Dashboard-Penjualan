@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-truck mr-2"></i>Suppliers
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Manage your supplier database</p>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('suppliers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>Add Supplier
        </a>
    </div>
</div>

<!-- Search -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
    <div class="p-6">
        <form action="{{ route('suppliers.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                       placeholder="Search suppliers by name, email, phone..." 
                       value="{{ request('search') }}">
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </form>
    </div>
</div>

<!-- Suppliers Table -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
    @if($suppliers->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Contact Person</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Contact Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($suppliers as $supplier)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $supplier->name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">ID: {{ $supplier->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($supplier->contact_person)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $supplier->contact_person }}
                                </span>
                            @else
                                <span class="text-sm text-gray-400 dark:text-gray-500">Not specified</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($supplier->email)
                                <div class="text-sm text-gray-900 dark:text-white">
                                    <i class="fas fa-envelope mr-2 text-gray-400"></i>{{ $supplier->email }}
                                </div>
                            @endif
                            @if($supplier->phone)
                                <div class="text-sm text-gray-900 dark:text-white">
                                    <i class="fas fa-phone mr-2 text-gray-400"></i>{{ $supplier->phone }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($supplier->address)
                                <div class="text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate">
                                    {{ Str::limit($supplier->address, 50) }}
                                </div>
                            @else
                                <span class="text-sm text-gray-400 dark:text-gray-500">No address</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($supplier->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('suppliers.show', $supplier) }}" 
                                   class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" 
                                   title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('suppliers.edit', $supplier) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this supplier?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" 
                                            title="Delete">
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
        @if($suppliers->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $suppliers->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                <i class="fas fa-truck text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No suppliers found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
                @if(request('search'))
                    Try adjusting your search criteria.
                @else
                    Get started by adding your first supplier.
                @endif
            </p>
            <a href="{{ route('suppliers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Add Supplier
            </a>
        </div>
    @endif
</div>
@endsection
