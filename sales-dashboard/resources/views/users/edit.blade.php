@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="bg-gradient-to-r from-sky-400 to-blue-500 rounded-lg shadow-lg mb-6 p-6">
    <h1 class="text-3xl font-bold text-white">Edit User</h1>
</div>

<div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium mb-2">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-gray-50 hover:bg-white transition-colors duration-200" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-gray-50 hover:bg-white transition-colors duration-200" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Password (leave blank to keep current)</label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-gray-50 hover:bg-white transition-colors duration-200">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Role</label>
                <select name="role_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-gray-50 hover:bg-white transition-colors duration-200" required>
                    @foreach(\App\Models\Role::all() as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->display_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('users.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200 font-medium">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sky-400 to-blue-500 hover:from-sky-500 hover:to-blue-600 text-white rounded-lg transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i>Update User
            </button>
        </div>
    </form>
</div>
@endsection
