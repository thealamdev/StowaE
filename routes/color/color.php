<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Color\ColorController;

Route::controller(ColorController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('create','create')->name('create');
    Route::post('store','store')->name('store');
    Route::get('edit{id}','edit')->name('edit');
    Route::put('update/{id}','update')->name('update');
    Route::delete('delete/{id}','destroy')->name('delete');
    Route::delete('archieve/{id}','trash')->name('archieve');
    Route::get('archieve','trash')->name('archieve');
});