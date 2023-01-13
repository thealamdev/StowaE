<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Shop\ShopController;

Route::controller(ShopController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('show/{slug}','show')->name('show');


    // ajax routes:
    Route::post('size-select','sizeSelect')->name('sizeSelect');
    Route::post('additional-price','additionalPrice')->name('additionalPrice');
});