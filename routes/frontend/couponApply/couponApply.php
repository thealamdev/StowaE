<?php

use App\Http\Controllers\Backend\Coupon\CouponController;
use App\Http\Controllers\frontend\CouponApply\CouponApplyController;
use Illuminate\Support\Facades\Route;


Route::controller(CouponApplyController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::post('store','store')->name('store');
    Route::get('show/{slug}','show')->name('show');
    Route::delete('delete/{id}','destroy')->name('delete');

    //api routes:
    Route::post('update','update')->name('update');
});