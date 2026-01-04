<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminBuyerController;
use App\Http\Controllers\Admin\AdminSellerController;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('auth/login');
});

// Admin routes (protected)
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\RoleAdminMiddleware::class])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::resource('buyers', AdminBuyerController::class, ['as' => 'admin']);
    Route::resource('sellers', AdminSellerController::class, ['as' => 'admin']);
    Route::post('sellers/{seller}/activate', [AdminSellerController::class, 'activate'])->name('admin.sellers.activate');
});

// Seller routes (protected)
Route::prefix('seller')->middleware(['auth', \App\Http\Middleware\RoleSellerMiddleware::class])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'seller'])->name('seller.dashboard');
    Route::get('profile', [SellerProfileController::class, 'profile'])->name('seller.profile');
    Route::post('profile', [SellerProfileController::class, 'update'])->name('seller.profile.update');
});

// Authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
