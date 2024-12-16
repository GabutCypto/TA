<?php

use App\Http\Controllers\BayarSumbanganController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ListSantriBayarController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SumbanganController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\TransaksiSaldoController;
use Illuminate\Support\Facades\Route;



Route::get('/home', [FrontController::class, 'index'])->name('front.index');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('front.product.details');

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

    Route::resource('bayar_sumbangan', BayarSumbanganController::class)->middleware('role:owner|buyer');
    Route::resource('topup', TopupController::class)->middleware('role:owner|buyer');
    Route::resource('transaksisaldo', TransaksiSaldoController::class)->middleware('role:owner|buyer');
    Route::get('/admin/bayar', [ListSantriBayarController::class, 'index'])->name('admin.bayar.list');
    Route::middleware('auth')->get('/dashboard', [SaldoController::class, 'index'])->name('dashboard');
    Route::resource('carts', CartController::class)->middleware('role:buyer');
    Route::post('/cart/add/{productId}', [CartController::class, 'store'])->middleware('role:buyer')->name('carts.store');
    Route::resource('product_transactions', ProductTransactionController::class)->middleware('role:owner|buyer');


    Route::prefix('admin')->name('admin.')->group(function(){
        Route::resource('sumbangan', SumbanganController::class)->middleware('role:owner');
        Route::resource('santri', SantriController::class)->middleware('role:owner');
        Route::resource('products', ProductController::class)->middleware('role:owner');
        Route::resource('categories', CategoryController::class)->middleware('role:owner');
    });
});

require __DIR__.'/auth.php';