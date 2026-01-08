<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BuyerApiController;
use App\Http\Controllers\Api\SellerApiController;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| ADMIN API
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/buyers', [BuyerApiController::class, 'index']);
        Route::get('/buyers/{buyer}', [BuyerApiController::class, 'show']);
        Route::post('/buyers', [BuyerApiController::class, 'store']);
        Route::put('/buyers/{buyer}', [BuyerApiController::class, 'update']);
        Route::delete('/buyers/{buyer}', [BuyerApiController::class, 'destroy']);


        Route::get('/sellers', [SellerApiController::class, 'index']);
        Route::post('/sellers', [SellerApiController::class, 'store']);
        Route::put('/sellers/{seller}', [SellerApiController::class, 'update']);
        Route::delete('/sellers/{seller}', [SellerApiController::class, 'destroy']);
    });

/*
| SELLER API
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:seller'])
    ->prefix('seller')
    ->group(function () {
        Route::get('/profile', [SellerApiController::class, 'showProfile']);
        Route::put('/profile', [SellerApiController::class, 'updateProfile']);
    });
