<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\RoleAssign\RoleAssignController;

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
Route::get('/', [frontendController::class, 'index'])->name('frontend.home');



Route::middleware('auth')->group(function () {
    // SSLCOMMERZ Start
    // Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('example1');
    // Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
    Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
    // Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    //SSLCOMMERZ END
});



Auth::routes();
// ============== Backend Routes =================
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    //Dashboard index route:
    Route::get('/', [BackendController::class, 'index'])->name('dashboard');

    Route::controller(RolePermissionController::class)->prefix('role')->name('role.')->group(function () {
        Route::get('/', 'index')->middleware('role_or_permission:super-admin|show|edit|delete')->name('index');
        Route::get('create', 'create')->middleware('role_or_permission:super-admin|edit|delete')->name('create');
        Route::post('store', 'store')->middleware('role_or_permission:super-admin|edit|delete')->name('store');
        Route::get('edit/{id}', 'edit')->middleware('role_or_permission:super-admin|edit|delete')->name('edit');
        Route::put('update/{id}', 'update')->middleware('role_or_permission:super-admin|edit|delete')->name('update');
        Route::delete('delete/{id}', 'destroy')->middleware('role_or_permission:super-admin')->name('delete');
    });


    Route::controller(RoleAssignController::class)->prefix('roleAssign')->name('roleAssign.')->group(function () {
        Route::middleware(['auth', 'role_or_permission:super-admin'])->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
            Route::get('delete/{id}', 'destroy')->name('delete');
        });
    });

    Route::controller(PermissionController::class)->middleware('role_or_permission:super-admin|admin')->prefix('permission')->name('permission.')->group(function () {
        Route::post('/', 'store')->name('store');
    });

    Route::middleware(['auth'])->group(function () {
        Route::prefix('categories')->name('category.')->group(function () {
            require __DIR__ . '/category/category.php';
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::prefix('color')->name('color.')->group(function () {
            require __DIR__ . "/color/color.php";
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::prefix('size')->name('size.')->group(function () {
            require __DIR__ . "/size/size.php";
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::prefix('product')->name('product.')->group(function () {
            require __DIR__ . "/product/product.php";
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::prefix('inventory')->name('inventory.')->group(function () {
            require __DIR__ . "/inventory/inventory.php";
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::prefix('coupon')->name('coupon.')->group(function () {
            require __DIR__ . "/coupon/coupon.php";
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::prefix('shipping')->name('shipping.')->group(function () {
            require __DIR__ . "/shipping/shipping.php";
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::prefix('order')->name('order.')->group(function () {
            require __DIR__ . "/order/order.php";
        });
    });
});

// ============== Frontend Routes ================
Route::name('frontend.')->group(function () {
    Route::prefix('shop')->name('shop.')->group(function () {
        require __DIR__ . "/frontend/shop/shop.php";
    });
});

Route::name('frontend.')->group(function () {
    Route::prefix('cart')->name('cart.')->group(function () {
        require __DIR__ . "/frontend/cart/cart.php";
    });
});

Route::name('frontend.')->group(function () {
    Route::prefix('couponApply')->name('couponApply.')->group(function () {
        require __DIR__ . "/frontend/couponApply/couponApply.php";
    });
});
