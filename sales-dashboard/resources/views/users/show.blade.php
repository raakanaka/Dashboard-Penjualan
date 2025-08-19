@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg shadow-lg mb-6 p-6">
    <h1 class="text-3xl font-bold text-white">{{ $user->name }}</h1>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Name</label>
            <p class="text-lg font-semibold">{{ $user->name }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Email</label>
            <p class="text-lg font-semibold">{{ $user->email }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Role</label>
            <p class="text-lg font-semibold">{{ $user->role->display_name ?? 'No Role' }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Created At</label>
            <p class="text-lg font-semibold">{{ $user->created_at->format('M d, Y H:i') }}</p>
        </div>
    </div>
    
    <div class="mt-6 flex space-x-4">
        <a href="{{ route('users.edit', $user) }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg">Edit User</a>
        <a href="{{ route('users.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg">Back to Users</a>
    </div>
</div>
@endsection
