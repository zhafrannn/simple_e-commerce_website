<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Transcation;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('beer');

Route::get('/beer/{id}', [ProductController::class, 'show'])->name('product_name');

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart', [CartController::class, 'store']);
Route::put('/cart/{id}', [CartController::class, 'update']);
Route::get('/cart/{id}', [CartController::class, 'destroy']);

Route::get('/checkoutd/{id}', [CheckoutController::class, 'destroy']);
Route::get('/checkout/{id}', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'store']);

Route::get('/transaction', [TransactionController::class, 'index']);
Route::post('/transaction', [TransactionController::class, 'update']);
Route::get('/transaction/delete/{id}', [TransactionController::class, 'destroy']);

Route::post('/search', [ProductController::class, 'search']);
