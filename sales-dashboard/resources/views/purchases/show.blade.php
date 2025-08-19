@extends('layouts.app')

@section('title', 'Purchase #' . $purchase->purchase_number . ' - Purchase Details')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg mb-6">
    <div class="px-6 py-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="fas fa-shopping-cart text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Purchase Details</h1>
                    <p class="text-blue-100">Purchase #{{ $purchase->purchase_number }}</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('purchases.edit', $purchase) }}" class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                    <i class="fas fa-edit mr-2"></i>Edit Purchase
                </a>
                <a href="{{ route('purchases.index') }}" class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Purchases
                </a>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Purchase Information Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-600 dark:text-blue-400"></i>
                        Purchase Information
                    </h5>
                    <div class="flex space-x-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium shadow-sm
                            {{ $purchase->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                               ($purchase->status === 'pending' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200' : 
                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                            <i class="fas fa-circle mr-1.5 text-xs"></i>
                            {{ ucfirst($purchase->status) }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium shadow-sm
                            {{ $purchase->payment_method === 'cash' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                               ($purchase->payment_method === 'credit_card' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 
                                'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200') }}">
                            <i class="fas fa-credit-card mr-1.5 text-xs"></i>
                            {{ ucfirst(str_replace('_', ' ', $purchase->payment_method)) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Purchase Details -->
                    <div class="space-y-6">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Purchase #{{ $purchase->purchase_number }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 flex items-center">
                                <i class="fas fa-calendar-alt mr-2 text-blue-600 dark:text-blue-400"></i>
                                {{ $purchase->created_at->format('F d, Y \a\t H:i') }}
                            </p>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-2 mr-4">
                                    <i class="fas fa-truck text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Supplier</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $purchase->supplier->name }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-2 mr-4">
                                    <i class="fas fa-boxes text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Items</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $purchase->items_count }} products</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-2 mr-4">
                                    <i class="fas fa-cubes text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Quantity</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $purchase->total_items }} units</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Summary -->
                    <div class="space-y-6">
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-6">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-calculator mr-2 text-green-600 dark:text-green-400"></i>
                                Payment Summary
                            </h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Subtotal:</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Tax:</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($purchase->tax_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Discount:</span>
                                    <span class="text-sm font-semibold text-red-600 dark:text-red-400">-Rp {{ number_format($purchase->discount_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg text-white">
                                    <span class="text-sm font-medium">Total:</span>
                                    <span class="text-lg font-bold">Rp {{ number_format($purchase->final_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Purchase Items Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-list mr-2 text-blue-600 dark:text-blue-400"></i>
                    Purchase Items
                </h5>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">SKU</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit Price</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($purchase->items as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td class="px-6 py-6 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($item->product->image)
                                        <img class="h-12 w-12 rounded-xl object-cover mr-4 shadow-sm" src="{{ asset('images/products/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                    @else
                                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center mr-4 shadow-sm">
                                            <i class="fas fa-box text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $item->product->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item->product->category->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 shadow-sm">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $item->product->sku }}
                                </span>
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                    {{ number_format($item->quantity) }}
                                </span>
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap text-right text-sm font-semibold text-gray-900 dark:text-white">
                                Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap text-right text-sm font-bold text-green-600 dark:text-green-400">
                                Rp {{ number_format($item->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-8">
        <!-- Supplier Information Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-truck mr-2"></i>
                    Supplier Information
                </h5>
            </div>
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-full w-20 h-20 mx-auto mb-4 flex items-center justify-center shadow-lg">
                        <i class="fas fa-truck text-3xl text-white"></i>
                    </div>
                    <h5 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $purchase->supplier->name }}</h5>
                    @if($purchase->supplier->contact_person)
                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $purchase->supplier->contact_person }}</p>
                    @endif
                </div>
                
                <div class="space-y-4">
                    @if($purchase->supplier->email)
                    <div class="flex items-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-2 mr-3">
                            <i class="fas fa-envelope text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <a href="mailto:{{ $purchase->supplier->email }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">{{ $purchase->supplier->email }}</a>
                    </div>
                    @endif
                    
                    @if($purchase->supplier->phone)
                    <div class="flex items-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-2 mr-3">
                            <i class="fas fa-phone text-green-600 dark:text-green-400"></i>
                        </div>
                        <a href="tel:{{ $purchase->supplier->phone }}" class="text-green-600 dark:text-green-400 hover:underline text-sm font-medium">{{ $purchase->supplier->phone }}</a>
                    </div>
                    @endif
                    
                    @if($purchase->supplier->address)
                    <div class="flex items-start p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                        <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2 mr-3 mt-1">
                            <i class="fas fa-map-marker-alt text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <p class="text-amber-700 dark:text-amber-300 text-sm">{{ $purchase->supplier->address }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Quick Actions Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-bolt mr-2 text-amber-600 dark:text-amber-400"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <a href="{{ route('purchases.edit', $purchase) }}" 
                       class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Purchase
                    </a>
                    
                    <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this purchase?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Purchase
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Purchase Statistics Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-chart-bar mr-2 text-blue-600 dark:text-blue-400"></i>
                    Purchase Statistics
                </h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-1">{{ $purchase->total_items }}</div>
                        <div class="text-xs font-medium text-blue-700 dark:text-blue-300 uppercase tracking-wider">Total Items</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-xl">
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-1">Rp {{ number_format($purchase->final_amount, 0, ',', '.') }}</div>
                        <div class="text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Total Amount</div>
                    </div>
                </div>
                
                <div class="space-y-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Created:</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $purchase->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Updated:</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $purchase->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Notes Card -->
        @if($purchase->notes)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-sticky-note mr-2 text-amber-600 dark:text-amber-400"></i>
                    Notes
                </h5>
            </div>
            <div class="p-6">
                <div class="bg-amber-50 dark:bg-amber-900/20 rounded-xl p-4">
                    <p class="text-amber-800 dark:text-amber-200 text-sm leading-relaxed">{{ $purchase->notes }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
