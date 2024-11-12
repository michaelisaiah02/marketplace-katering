<?php

use App\Http\Controllers\Merchant\Auth\AuthenticatedSessionMerchantController;
use App\Http\Controllers\Merchant\Auth\RegisteredMerchantController;
use App\Http\Controllers\MerchantProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Auth\RegisteredCustomerController;
use App\Http\Controllers\Customer\Auth\AuthenticatedSessionCustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::resource('menus', \App\Http\Controllers\Merchant\MenuController::class);
});

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/register', [RegisteredCustomerController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredCustomerController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionCustomerController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionCustomerController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionCustomerController::class, 'destroy'])->name('logout');
});

require __DIR__ . '/auth.php';
