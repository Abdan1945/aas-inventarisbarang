<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {});


    Route::resource('barang', App\Http\Controllers\BarangController::class);
    Route::resource('kategoribarang', App\Http\Controllers\KategoriBarangController::class);
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class);
    Route::resource('nama', App\Http\Controllers\NamaController::class);
    Route::resource('transaksi_detail', App\Http\Controllers\TransaksiDetailController::class);


    // test template
    Route::get('template', function (){
        return view('layouts.dashboard');
    });
