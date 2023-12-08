<?php

use App\Http\Controllers\AppInfoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user', [UserController::class, 'index']);

Route::prefix('app-info')->group(function() {
    Route::get('/', [AppInfoController::class, 'index']);
    Route::post('/', [AppInfoController::class, 'store']);
    Route::put('/{id}', [AppInfoController::class, 'update']);
});

Route::prefix('permission')->group(function() {
    Route::get('/', [PermissionController::class, 'index']);
    Route::post('/', [PermissionController::class, 'store']);
    Route::get('/search', [PermissionController::class, 'search']);
    Route::get('/{id}', [PermissionController::class, 'show']);
    Route::put('/{id}', [PermissionController::class, 'update']);
    Route::delete('/{id}', [PermissionController::class, 'delete']);
});

Route::prefix('category')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/search', [CategoryController::class, 'search']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'delete']);
});

Route::prefix('user')->group(function() {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/search', [UserController::class, 'search']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});

Route::prefix('product')->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/search', [ProductController::class, 'search']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

Route::prefix('cart')->group(function() {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/', [CartController::class, 'store']);
    Route::get('/search', [CartController::class, 'search']);
    Route::get('/{id}', [CartController::class, 'show']);
    Route::put('/{id}', [CartController::class, 'update']);
    Route::delete('/{id}', [CartController::class, 'delete']);
});

Route::prefix('cart-item')->group(function() {
    Route::get('/', [CartItemController::class, 'index']);
    Route::post('/', [CartItemController::class, 'store']);
    Route::get('/search', [CartItemController::class, 'search']);
    Route::get('/{id}', [CartItemController::class, 'show']);
    Route::put('/{id}', [CartItemController::class, 'update']);
    Route::delete('/{id}', [CartItemController::class, 'delete']);
});

Route::prefix('order')->group(function() {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/search', [OrderController::class, 'search']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::put('/delivery_update/{id}', [OrderController::class, 'delivery_update']);
    Route::delete('/{id}', [OrderController::class, 'delete']);
});

Route::prefix('order-item')->group(function() {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/search', [OrderController::class, 'search']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'delete']);
});
