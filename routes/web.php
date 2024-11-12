<?php

use App\Http\Controllers\Merchant\Auth\AuthenticatedSessionMerchantController;
use App\Http\Controllers\Merchant\Auth\RegisteredMerchantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});

require __DIR__ . '/auth.php';
