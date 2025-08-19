<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CRMController;

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

// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
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

    // Inventory - Stock Alert route must come before resource route
    Route::get('/inventory/stock-alert', [InventoryController::class, 'stockAlert'])->name('inventory.stock-alert');
    Route::resource('inventory', InventoryController::class);
    Route::get('/inventory/{inventory}/adjust-stock', [InventoryController::class, 'adjustStock'])->name('inventory.adjust-stock');
    Route::post('/inventory/{inventory}/adjust-stock', [InventoryController::class, 'updateStock'])->name('inventory.update-stock');

    // Reports
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::get('/reports/purchases', [ReportController::class, 'purchases'])->name('reports.purchases');
    Route::get('/reports/inventory', [ReportController::class, 'inventory'])->name('reports.inventory');

    // Advertisers
    Route::resource('advertisers', AdvertiserController::class);

    // Budgets
    Route::resource('budgets', BudgetController::class);

    // Users (Admin only)
    Route::resource('users', UserController::class);
    
    // Advanced CRM Routes
    Route::prefix('crm')->name('crm.')->group(function () {
        Route::get('/dashboard', [CRMController::class, 'dashboard'])->name('dashboard');
        Route::get('/leads', [CRMController::class, 'leads'])->name('leads');
        Route::get('/segments', [CRMController::class, 'segments'])->name('segments');
        Route::get('/interactions/{customer}', [CRMController::class, 'interactions'])->name('interactions');
    });
});
