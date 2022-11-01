<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\frontend\frontendController;
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
//Dashboard show route:
Route::get('/dashboard', [BackendController::class, 'index'])->name('dashboard');
