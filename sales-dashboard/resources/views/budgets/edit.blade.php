@extends('layouts.app')

@section('title', 'Edit Budget')

@section('content')
<div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-lg shadow-lg mb-6 p-6">
    <h1 class="text-3xl font-bold text-white">Edit Budget</h1>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
    <form action="{{ route('budgets.update', $budget) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Campaign Name</label>
                <input type="text" name="campaign_name" value="{{ $budget->campaign_name }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Advertiser</label>
                <select name="advertiser_id" class="w-full px-4 py-2 border rounded-lg" required>
                    @foreach(\App\Models\Advertiser::where('is_active', true)->get() as $advertiser)
                        <option value="{{ $advertiser->id }}" {{ $budget->advertiser_id == $advertiser->id ? 'selected' : '' }}>
                            {{ $advertiser->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Budget Amount</label>
                <input type="number" name="budget_amount" value="{{ $budget->budget_amount }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Spent Amount</label>
                <input type="number" name="spent_amount" value="{{ $budget->spent_amount }}" class="w-full px-4 py-2 border rounded-lg">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Status</label>
                <select name="status" class="w-full px-4 py-2 border rounded-lg">
                    <option value="active" {{ $budget->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="paused" {{ $budget->status == 'paused' ? 'selected' : '' }}>Paused</option>
                    <option value="completed" {{ $budget->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $budget->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Start Date</label>
                <input type="date" name="start_date" value="{{ $budget->start_date }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">End Date</label>
                <input type="date" name="end_date" value="{{ $budget->end_date }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
        </div>
        
        <div class="mt-6">
            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Description</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ $budget->description }}</textarea>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('budgets.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg">Update Budget</button>
        </div>
    </form>
</div>
@endsection
