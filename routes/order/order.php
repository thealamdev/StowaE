<?php

use App\Http\Controllers\Backend\Order\OrderController;
use Illuminate\Support\Facades\Route;


Route::controller(OrderController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('create','create')->name('create');
    Route::get('show/{id}','show')->name('show');
    Route::put('update/{id}','update')->name('update');
    Route::get('archieve','archieve')->name('archieve');
    Route::get('restore/{id}','restore')->name('restore');
    Route::delete('delete/{id}','destroy')->name('delete');
    Route::delete('trash/{id}','trash')->name('trash');
});