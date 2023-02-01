<?php

use App\Http\Controllers\Backend\Coupon\CouponController;

use Illuminate\Support\Facades\Route;


Route::controller(CouponController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('create','create')->name('create');
    Route::post('store','store')->name('store');
    Route::get('edit{id}','edit')->name('edit');
    Route::put('update/{id}','update')->name('update');
    Route::delete('delete/{id}','destroy')->name('delete');
    Route::get('archieve','archieve')->name('archieve');
    Route::delete('trash/{id}','trash')->name('trash');
    Route::get('restore/{id}','restore')->name('restore');
});