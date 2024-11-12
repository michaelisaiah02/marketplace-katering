<?php

use App\Http\Controllers\Merchant\Auth\AuthenticatedSessionMerchantController;
use App\Http\Controllers\Merchant\Auth\RegisteredMerchantController;
use App\Http\Controllers\Merchant\ProfileController as MerchantProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Auth\RegisteredCustomerController;
use App\Http\Controllers\Customer\Auth\AuthenticatedSessionCustomerController;
use App\Http\Controllers\Customer\MerchantSearchController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Merchant\OrderController as MerchantOrderController;
use App\Http\Controllers\Merchant\MenuController;
use App\Http\Controllers\MerchantController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('merchant.orders');
})->name('merchant.dashboard');
Route::get('customer/dashboard', function () {
    return redirect()->route('customer.orders');
})->name('customer.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('merchant')->name('merchant.')->group(function () {
    Route::get('/register', [RegisteredMerchantController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredMerchantController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionMerchantController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionMerchantController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionMerchantController::class, 'destroy'])->name('logout');
});
Route::middleware(['auth:merchant'])->prefix('merchant')->name('merchant.')->group(function () {
    Route::get('/profile', [MerchantProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [MerchantProfileController::class, 'update'])->name('profile.update');
    Route::resource('menus', MenuController::class);
    Route::get('/orders', [MerchantOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/invoice', [MerchantOrderController::class, 'showInvoice'])->name('orders.invoice');
    Route::post('/orders/{order}/update-status', [MerchantOrderController::class, 'updateStatus'])->name('order.updateStatus');
});

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/register', [RegisteredCustomerController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredCustomerController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionCustomerController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionCustomerController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionCustomerController::class, 'destroy'])->name('logout');
});

// Customer Order Routes
Route::middleware(['auth:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('orders', [CustomerOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{menu}/create', [CustomerOrderController::class, 'create'])->name('orders.create');
    Route::post('orders/{menu}', [CustomerOrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{order}/update-status', [CustomerOrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('merchants/search', [MerchantSearchController::class, 'index'])->name('merchants.search');
    Route::get('merchants/{merchant}', [MerchantController::class, 'show'])->name('merchant.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});


require __DIR__ . '/auth.php';
