<?php

use App\Http\Controllers\BayarSumbanganController;
use App\Http\Controllers\ListSantriBayarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SumbanganController;
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

    Route::resource('bayar_sumbangan', BayarSumbanganController::class)->middleware('role:owner|buyer');
    Route::get('/admin/bayar', [ListSantriBayarController::class, 'index'])->name('admin.bayar.list');

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::resource('sumbangan', SumbanganController::class)->middleware('role:owner');
        Route::resource('santri', SantriController::class)->middleware('role:owner');
    });
});

require __DIR__.'/auth.php';