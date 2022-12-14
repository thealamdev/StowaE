<?php

use App\Http\Controllers\Backend\Product\ProductController;
use Illuminate\Support\Facades\Route;


Route::controller(ProductController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('create','create')->name('create');
    Route::post('store','store')->name('store');
    Route::get('edit/{id}','edit')->name('edit');
    Route::put('update/{id}','update')->name('update');
    Route::get('archieve','archieve')->name('archieve');
    Route::get('restore/{id}','restore')->name('restore');
    Route::delete('delete/{id}','destroy')->name('delete');
    Route::delete('trash/{id}','trash')->name('trash');
});