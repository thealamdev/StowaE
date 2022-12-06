<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\frontend\frontendController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
// Frontend show route:
Route::get('/',[frontendController::class, 'index'])->name('frontend.home');

Auth::routes();


Route::prefix('dashboard')->name('dashboard.')->group(function(){
    //Dashboard index route:
    Route::get('/', [BackendController::class, 'index'])->name('dashboard');

    Route::controller(RolePermissionController::class)->prefix('role')->name('role.')->group(function(){
        Route::get('/','index')->middleware('role_or_permission:super-admin|show|edit|delete')->name('index');
        Route::get('create','create')->middleware('role_or_permission:super-admin|edit|delete')->name('create');
        Route::post('store','store')->middleware('role_or_permission:super-admin|edit|delete')->name('store');
        Route::get('edit/{id}','edit')->middleware('role_or_permission:super-admin|edit|delete')->name('edit');
        Route::put('update/{id}','update')->middleware('role_or_permission:super-admin|edit|delete')->name('update');
        Route::delete('delete/{id}','destroy')->middleware('role_or_permission:super-admin')->name('delete');
    });

     Route::controller(PermissionController::class)->middleware('role_or_permission:super-admin|admin')->prefix('permission')->name('permission.')->group(function(){
        Route::post('/', 'store')->name('store');

     });

});
 
 
