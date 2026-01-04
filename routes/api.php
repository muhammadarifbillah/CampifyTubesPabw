<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [\App\Http\Controllers\Api\AuthApiController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Api\AuthApiController::class, 'logout'])->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| ADMIN API
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/buyers', [\App\Http\Controllers\Api\Admin\AdminBuyerController::class, 'index']);
        Route::post('/buyers', [\App\Http\Controllers\Api\Admin\AdminBuyerController::class, 'store']);
        Route::delete('/buyers/{buyer}', [\App\Http\Controllers\Api\Admin\AdminBuyerController::class, 'destroy']);
    });

/*
| SELLER API
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:seller'])
    ->prefix('seller')
    ->group(function () {
        Route::get('/profile', [\App\Http\Controllers\Api\Seller\AdminSellerController::class, 'show']);
        Route::put('/profile', [\App\Http\Controllers\Api\Seller\AdminSellerController::class, 'update']);
    });
