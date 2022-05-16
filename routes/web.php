<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('App\Http\Livewire\Data')->as('data.')->group(function(){
    Route::get('/', Home::class);
    Route::get('/data/menu', Menu::class)->name('menu');
    Route::get('/data/transaksi', Transaksi::class)->name('transaksi');
    Route::get('/data/meja', Meja::class)->name('meja');
});
