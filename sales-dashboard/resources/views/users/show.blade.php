@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg mb-6 p-6">
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
        <a href="{{ route('users.edit', $user) }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
            <i class="fas fa-edit mr-2"></i>Edit User
        </a>
        <a href="{{ route('users.index') }}" class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Users
        </a>
    </div>
</div>
@endsection
