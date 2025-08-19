@extends('layouts.app')

@section('title', 'Budget Details')

@section('content')
<div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-lg shadow-lg mb-6 p-6">
    <h1 class="text-3xl font-bold text-white">{{ $budget->campaign_name }}</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Budget Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Campaign Name</label>
                    <p class="text-lg font-semibold">{{ $budget->campaign_name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-500">Advertiser</label>
                    <p class="text-lg font-semibold">{{ $budget->advertiser->name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-500">Budget Amount</label>
                    <p class="text-lg font-semibold text-teal-600">Rp {{ number_format($budget->budget_amount, 0, ',', '.') }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-500">Spent Amount</label>
                    <p class="text-lg font-semibold text-red-600">Rp {{ number_format($budget->spent_amount, 0, ',', '.') }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-500">Remaining</label>
                    <p class="text-lg font-semibold text-green-600">Rp {{ number_format($budget->remaining_amount, 0, ',', '.') }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-500">Status</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        @if($budget->status == 'active') bg-green-100 text-green-800
                        @elseif($budget->status == 'paused') bg-yellow-100 text-yellow-800
                        @elseif($budget->status == 'completed') bg-blue-100 text-blue-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($budget->status) }}
                    </span>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-500">Start Date</label>
                    <p class="text-lg font-semibold">{{ $budget->start_date->format('M d, Y') }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-500">End Date</label>
                    <p class="text-lg font-semibold">{{ $budget->end_date->format('M d, Y') }}</p>
                </div>
            </div>
            
            @if($budget->description)
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-500">Description</label>
                <p class="text-gray-700">{{ $budget->description }}</p>
            </div>
            @endif
        </div>
    </div>
    
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold mb-4">Progress</h3>
            
            <div class="mb-4">
                <div class="flex justify-between text-sm mb-2">
                    <span>Progress</span>
                    <span>{{ number_format($budget->progress_percentage, 1) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-teal-600 h-2 rounded-full" style="width: {{ $budget->progress_percentage }}%"></div>
                </div>
            </div>
            
            <div class="space-y-3">
                <a href="{{ route('budgets.edit', $budget) }}" class="w-full block text-center px-4 py-2 bg-blue-500 text-white rounded-lg">
                    Edit Budget
                </a>
                <a href="{{ route('budgets.index') }}" class="w-full block text-center px-4 py-2 bg-gray-500 text-white rounded-lg">
                    Back to Budgets
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
