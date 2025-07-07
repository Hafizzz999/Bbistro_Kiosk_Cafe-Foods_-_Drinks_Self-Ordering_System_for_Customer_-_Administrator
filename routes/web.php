<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentMethodController;

use App\Http\Controllers\CustomerDiningController;
use App\Http\Controllers\CustomerTableController;
use App\Http\Controllers\CustomerMenuController;
use App\Http\Controllers\CustomerCartController;
use App\Http\Controllers\CustomerCheckoutController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Dining method selection
Route::get('/dining', [CustomerDiningController::class, 'show'])->name('customer.dining');
Route::post('/dining', [CustomerDiningController::class, 'store']);

// Table selection (only for Eat In)
Route::get('/tables', [CustomerTableController::class, 'show'])->name('customer.table');
Route::post('/tables', [CustomerTableController::class, 'store']);

// Menu browsing
Route::get('/menu', [CustomerMenuController::class, 'show'])->name('customer.menu');

// Cart management
Route::get('/cart', [CustomerCartController::class, 'show'])->name('customer.cart');
Route::post('/cart/add/{product}', [CustomerCartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update/{product}', [CustomerCartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CustomerCartController::class, 'removeFromCart'])->name('cart.remove');

// Checkout process
Route::get('/checkout', [CustomerCheckoutController::class, 'show'])->name('customer.checkout');
Route::post('/checkout', [CustomerCheckoutController::class, 'placeOrder']);

// Order success
Route::get('/success/{order}', [CustomerCheckoutController::class, 'success'])->name('customer.success');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('table', TableController::class);
Route::resource('payment', PaymentMethodController::class);
Route::resource('order', OrderController::class)->only(['index', 'show', 'destroy']);
Route::patch('/order/{order}/complete', [OrderController::class, 'complete'])
     ->name('order.complete');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
