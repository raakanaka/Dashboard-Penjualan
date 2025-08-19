@extends('layouts.app')
@section('title', 'Add Budget')
@section('content')
<div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-lg shadow-lg mb-6 p-6">
    <h1 class="text-3xl font-bold text-white">Add New Budget</h1>
</div>
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
    <form action="{{ route('budgets.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium mb-2">Campaign Name</label>
                <input type="text" name="campaign_name" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Advertiser</label>
                <select name="advertiser_id" class="w-full px-4 py-2 border rounded-lg" required>
                    @foreach(\App\Models\Advertiser::where('is_active', true)->get() as $advertiser)
                        <option value="{{ $advertiser->id }}">{{ $advertiser->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Budget Amount</label>
                <input type="number" name="budget_amount" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border rounded-lg">
                    <option value="active">Active</option>
                    <option value="paused">Paused</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Start Date</label>
                <input type="date" name="start_date" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">End Date</label>
                <input type="date" name="end_date" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
        </div>
        <div class="mt-6">
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('budgets.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg">Create Budget</button>
        </div>
    </form>
</div>
@endsection
