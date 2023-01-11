<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Shop\ShopController;

Route::controller(ShopController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('show/{slug}','show')->name('show');
});