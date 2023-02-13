<?php

use App\Http\Controllers\Frontend\Cart\CartController;
use Illuminate\Support\Facades\Route;


Route::controller(CartController::class)->group(function(){
    Route::get('/','index')->middleware('auth')->name('index');
    Route::post('store','store')->name('store');
    Route::get('show/{slug}','show')->name('show');
    Route::delete('delete/{id}','destroy')->name('delete');
    Route::get('checkout','checkout')->name('checkout');

    //api routes:
    Route::post('update','update')->name('update');
});