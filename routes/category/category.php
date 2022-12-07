<?php

use App\Http\Controllers\Backend\Category\CategoryController;
use Illuminate\Support\Facades\Route;


Route::controller(CategoryController::class)->group(function(){
    Route::get('/','index')->name('index');
});