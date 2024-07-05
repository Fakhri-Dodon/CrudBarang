<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BeliController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return redirect()->route('barang.index');
});

Route::resource('barang', BarangController::class);

Route::resource('beli', BeliController::class);
Route::get('beli/getBarang', [BeliController::class, 'getBarang'])->name('beli.getBarang');

Route::resource('user', UsersController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
