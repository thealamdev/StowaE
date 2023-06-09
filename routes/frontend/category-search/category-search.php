<?php

use Illuminate\Support\Facades\Route;;
use App\Http\Controllers\Frontend\CategorySearchController;

Route::controller(CategorySearchController::class)->group(function(){
    Route::get('category-view/{slug}','categoryView')->name('categoryView');
    
});