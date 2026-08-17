<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Category Management
    |--------------------------------------------------------------------------
    */
    Route::resource('categories', CategoryController::class);

    /*
    |--------------------------------------------------------------------------
    | Menu Management
    |--------------------------------------------------------------------------
    */
    Route::resource('menus', MenuController::class);

    /*
    |--------------------------------------------------------------------------
    | Order Management
    |--------------------------------------------------------------------------
    */
    Route::resource('orders', OrderController::class);

    Route::patch(
        '/orders/{order}/status',
        [OrderController::class, 'updateStatus']
    )->name('orders.updateStatus');

    Route::patch(
    '/orders/{order}/complete',
    [OrderController::class, 'complete']
    )->name('orders.complete');

    Route::get(
    '/orders/{order}/print',
    [OrderController::class, 'print']
    )->name('orders.print');
    /*
    |--------------------------------------------------------------------------
    | Kitchen Display
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/kitchen',
        [OrderController::class, 'kitchen']
    )->name('orders.kitchen');

    /*
    |--------------------------------------------------------------------------
    | Sales Report
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/sales-report',
        [SalesReportController::class, 'index']
    )->name('sales.index');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';