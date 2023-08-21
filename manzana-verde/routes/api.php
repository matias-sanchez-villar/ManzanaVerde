<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
use Tymon\JWTAuth\Middleware\JWTVerify;

Route::name('auth.')->group(function () {
    Route::post('register', [UserController::class, 'register'])->name('register');
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('logout', [UserController::class, 'logout'])->middleware('jwt.auth')->name('logout');
});

Route::middleware('jwt.auth')->group(function () {
    Route::get('foods', [FoodController::class, 'index'])->name('foods.index');
    Route::get('foods/{id}', [FoodController::class, 'show'])->name('foods.show');

    Route::post('orders', [OrderController::class, 'create'])->name('orders.create');
    Route::get('orders', [OrderController::class, 'all'])->name('orders.all');
});