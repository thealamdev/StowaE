<?php

use App\Http\Controllers\Backend\Inventory\InventoryController;
use Illuminate\Support\Facades\Route;


Route::controller(InventoryController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('create/{id}','create')->name('create');
    Route::post('store','store')->name('store');
});