@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="bg-gradient-to-r from-sky-400 to-blue-500 rounded-lg shadow-lg mb-6 p-6">
    <h1 class="text-3xl font-bold text-white">{{ $user->name }}</h1>
</div>

<div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
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
        <a href="{{ route('users.edit', $user) }}" class="px-6 py-3 bg-gradient-to-r from-sky-400 to-blue-500 hover:from-sky-500 hover:to-blue-600 text-white rounded-lg transition-all duration-200 font-medium shadow-md hover:shadow-lg">
            <i class="fas fa-edit mr-2"></i>Edit User
        </a>
        <a href="{{ route('users.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200 font-medium">
            <i class="fas fa-arrow-left mr-2"></i>Back to Users
        </a>
    </div>
</div>
@endsection
