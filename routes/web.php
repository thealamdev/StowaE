<?php

use App\Http\Controllers\Backend\BackendController;
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

    //role and permission route:
     Route::group(['middleware' =>['role:super-admin']],function(){
         Route::get('role/index',[RolePermissionController::class, "index"])->name('role.index');
         Route::post('role/store',[RolePermissionController::class, "store"])->name('role.store');
         Route::get('role/edit/{id}',[RolePermissionController::class, "edit"])->name('role.edit');
         Route::put('role/update/{id}',[RolePermissionController::class, "update"])->name('role.update');
         Route::delete('role/delete/{id}',[RolePermissionController::class,"destroy"])->name('role.delete');
     });

});
 
 
