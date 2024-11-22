<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\MerchantSearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard (berbeda untuk merchant dan customer)
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'merchant') {
        return redirect()->route('merchant.dashboard');
    } elseif ($user->role === 'customer') {
        return redirect()->route('customer.dashboard');
    }
    abort(403);
})->name('dashboard');

// Rute khusus merchant
Route::middleware(['auth', RoleMiddleware::class . ':merchant'])->prefix('merchant')->name('merchant.')->group(function () {
    Route::get('/dashboard', [MerchantController::class, 'index'])->name('dashboard');
    Route::resource('menus', MenuController::class);
    Route::get('/orders', [OrderController::class, 'merchantOrders'])->name('orders.index');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'showInvoice'])->name('orders.invoice');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// Rute khusus customer
Route::middleware(['auth', RoleMiddleware::class . ':customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
    Route::get('merchants/search', [MerchantSearchController::class, 'index'])->name('merchants.search');
    Route::get('merchants/{merchant}', [MerchantSearchController::class, 'show'])->name('merchants.show');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{menu}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::middleware(['auth', RoleMiddleware::class . ':customer'])->prefix('orders')->name('customer.orders.')->group(function () {
    Route::get('/{menu}/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/{id}', [OrderController::class, 'show'])->name('show');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}/invoice', [OrderController::class, 'showInvoice'])->name('orders.invoice');
    Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__ . '/auth.php';
