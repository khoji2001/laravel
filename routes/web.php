<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('product.index');


Auth::routes();

Route::post('/cart', [CartController::class, 'store'])->name('cart');
Route::get('/checkout', [CartController::class, 'index'])->name('checkout');
Route::get('/checkout/get/items', [CartController::class, 'get_item_for_cart']);


