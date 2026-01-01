<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KuceController;

// List page
Route::get('/', [KuceController::class, 'index'])->name('kuces.index');

// Single kuca page
Route::get('/kuce/{id}', [KuceController::class, 'show'])->name('kuces.show');

use App\Http\Controllers\CartController;

//Route::middleware( 'auth'/* ovo ide kad setupujem auth: auth*/)->group(function() {
    //Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    //Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
   // Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
//});
Route::post('/cart/add/{kuceId}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/kuces', [KuceController::class, 'index'])->name('kuces.index');
Route::get('/kuces/search', [KuceController::class, 'search'])->name('kuces.search');
Route::get('/kuces/filter', [KuceController::class, 'filter'])->name('kuces.filter');

