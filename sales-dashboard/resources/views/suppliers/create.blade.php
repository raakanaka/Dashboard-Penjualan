@extends('layouts.app')

@section('title', 'Add New Supplier')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-green-600 to-green-700 rounded-lg shadow-lg mb-6">
    <div class="px-6 py-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="fas fa-building text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Add New Supplier</h1>
                    <p class="text-green-100">Create a new supplier account</p>
                </div>
            </div>
            <a href="{{ route('suppliers.index') }}" class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                <i class="fas fa-arrow-left mr-2"></i>Back to Suppliers
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-building mr-2 text-green-600 dark:text-green-400"></i>
                    Supplier Information
                </h5>
            </div>
            <div class="p-8">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Supplier Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white @error('name') border-red-500 @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="contact_person" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Contact Person
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white @error('contact_person') border-red-500 @enderror" 
                                   id="contact_person" name="contact_person" value="{{ old('contact_person') }}">
                            @error('contact_person')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email Address
                            </label>
                            <input type="email" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror" 
                                   id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Phone Number
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white @error('phone') border-red-500 @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Address
                        </label>
                        <textarea class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white @error('address') border-red-500 @enderror" 
                                  id="address" name="address" rows="3" placeholder="Enter supplier address...">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-8">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" 
                                   id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Active Supplier
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('suppliers.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-sm font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-2"></i>Save Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-8">
        <!-- Help Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-question-circle mr-2"></i>
                    Help & Information
                </h5>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-building text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white mb-1">Supplier Name</h6>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Company or business name</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white mb-1">Contact Person</h6>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Primary contact for the supplier</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-envelope text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white mb-1">Email Address</h6>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Used for purchase orders and communications</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-cyan-100 dark:bg-cyan-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-phone text-cyan-600 dark:text-cyan-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white mb-1">Phone Number</h6>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Primary contact number</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-map-marker-alt text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white mb-1">Address</h6>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Business address for deliveries</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Tips Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-lightbulb mr-2"></i>
                    Quick Tips
                </h5>
            </div>
            <div class="p-6">
                <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-lightbulb text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <div>
                            <h6 class="font-medium text-amber-800 dark:text-amber-200 mb-2">Pro Tip</h6>
                            <p class="text-sm text-amber-700 dark:text-amber-300">
                                Keep supplier contact information up to date to ensure smooth purchase transactions and timely deliveries.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
