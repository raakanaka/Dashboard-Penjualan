<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Products
Route::resource('products', ProductController::class);

// Sales
Route::resource('sales', SaleController::class);
Route::get('/sales/{sale}/invoice', [SaleController::class, 'invoice'])->name('sales.invoice');

// Purchases
Route::resource('purchases', PurchaseController::class);

// Customers
Route::resource('customers', CustomerController::class);

// Suppliers
Route::resource('suppliers', SupplierController::class);

// Inventory
Route::resource('inventory', InventoryController::class);
Route::get('/inventory/stock-alert', [InventoryController::class, 'stockAlert'])->name('inventory.stock-alert');

// Reports
Route::get('/reports/sales', function () {
    return view('reports.sales');
})->name('reports.sales');

Route::get('/reports/purchases', function () {
    return view('reports.purchases');
})->name('reports.purchases');

Route::get('/reports/inventory', function () {
    return view('reports.inventory');
})->name('reports.inventory');
