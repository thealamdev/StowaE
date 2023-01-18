<?php

use App\Http\Controllers\Frontend\Cart\CartController;
use Illuminate\Support\Facades\Route;


Route::controller(CartController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::post('store','store')->name('store');
    Route::get('show/{slug}','show')->name('show');

});