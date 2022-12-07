<?php

use App\Http\Controllers\Backend\Category\CategoryController;
use Illuminate\Support\Facades\Route;


Route::controller(CategoryController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('create','create')->name('create');
    Route::post('store','store')->name('store');
    Route::get('edit/{category}','edit')->name('edit');
    Route::put('update/{category}','update')->name('update');
    Route::get('archieve','archieve')->name('archieve');
    Route::delete('delete/{category}','destroy')->name('delete');
});