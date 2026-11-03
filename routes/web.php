<?php

use App\Http\Controllers\MonthlyEntitlementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loggedin'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'active', 'role:admin,staff'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');

    Route::get('/distribution', [DistributionController::class, 'index'])->name('distribution.index');
    Route::get('/distribution/create', [DistributionController::class, 'create'])->name('distribution.create');
    Route::post('/distribution', [DistributionController::class, 'store'])->name('distribution.store');
});

Route::middleware(['auth', 'active', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::patch('/products/{id}/deactivate', [ProductController::class, 'deactivate'])->name('products.deactivate');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/card-categories', [CategoryController::class, 'cardCategory'])->name('card-categories.index');
    Route::post('/card-categories', [CategoryController::class, 'storeCardCategory'])->name('card-categories.store');

    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/create', [StockController::class, 'create'])->name('stock.create');
    Route::post('/stock', [StockController::class, 'store'])->name('stock.store');

    Route::get('/entitlements', [MonthlyEntitlementController::class, 'index'])->name('entitlements.index');
    Route::get('/entitlements/create', [MonthlyEntitlementController::class, 'create'])->name('entitlements.create');
    Route::post('/entitlements', [MonthlyEntitlementController::class, 'store'])->name('entitlements.store');
    Route::get('/entitlements/{monthlyEntitlement}/edit', [MonthlyEntitlementController::class, 'edit'])->name('entitlements.edit');
    Route::put('/entitlements/{monthlyEntitlement}', [MonthlyEntitlementController::class, 'update'])->name('entitlements.update');
    Route::delete('/entitlements/{monthlyEntitlement}', [MonthlyEntitlementController::class, 'destroy'])->name('entitlements.destroy');
});

Route::middleware(['auth', 'active', 'role:admin,staff'])->prefix('customers')->name('customers.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
    Route::put('/{customer}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
});