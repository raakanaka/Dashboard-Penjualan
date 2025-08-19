@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg mb-6 p-6">
    <h1 class="text-3xl font-bold text-white">Edit User</h1>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium mb-2">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Password (leave blank to keep current)</label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Role</label>
                <select name="role_id" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required>
                    @foreach(\App\Models\Role::all() as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->display_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('users.index') }}" class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-save mr-2"></i>Update User
            </button>
        </div>
    </form>
</div>
@endsection
