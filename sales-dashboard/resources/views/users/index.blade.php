@extends('layouts.app')

@section('title', 'Users Management')

@section('content')
<div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg mb-6 p-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white">Users Management</h1>
        <a href="{{ route('users.create') }}" class="px-6 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>Add User
        </a>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $user->role->display_name ?? 'No Role' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('users.show', $user) }}" class="text-blue-400 hover:text-blue-300 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('users.edit', $user) }}" class="text-green-400 hover:text-green-300 dark:text-green-400 dark:hover:text-green-300 transition-colors duration-200">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this user?')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No users found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
