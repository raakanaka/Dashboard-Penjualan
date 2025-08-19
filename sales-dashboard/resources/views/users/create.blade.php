@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg shadow-lg mb-6 p-6">
    <h1 class="text-3xl font-bold text-white">Add New User</h1>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium mb-2">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Role</label>
                <select name="role_id" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="">Select Role</option>
                    @foreach(\App\Models\Role::all() as $role)
                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('users.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg">Create User</button>
        </div>
    </form>
</div>
@endsection
