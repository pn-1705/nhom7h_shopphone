<?php

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
//Route Login
Route::get('/login', [\App\Http\Controllers\Login\LoginController::class,'index'])->name('login');
Route::get('/register', [\App\Http\Controllers\Login\LoginController::class,'show'])->name('register');
Route::post('/store', [\App\Http\Controllers\Login\LoginController::class,'store']);
Route::post('/create', [\App\Http\Controllers\Login\LoginController::class,'create']);


Route::get('/', [\App\Http\Controllers\Home\HomeController::class,'index'])->name("viewHome");
Route::get('/productdetails', [\App\Http\Controllers\Product\ProductController::class,'show'])->name('viewProductDetails');

//Route Admin
Route::middleware(['auth','isAdmin:2'])->group(function() {
    Route::prefix('admin')->group(function () {
        Route::get('/',[\App\Http\Controllers\Admin\AdminController::class,'index'])->name('admin');
        Route::prefix('product')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('listproduct');
            Route::get('add', [\App\Http\Controllers\Admin\ProductController::class, 'create']);
            Route::post('add', [\App\Http\Controllers\Admin\ProductController::class, 'store']);
            Route::get('destroy', [\App\Http\Controllers\Admin\ProductController::class, 'destroy']);
            Route::get('edt', [\App\Http\Controllers\Admin\ProductController::class, 'show']);
            Route::post('edt', [\App\Http\Controllers\Admin\ProductController::class, 'edit']);
            Route::get('filter', [\App\Http\Controllers\Admin\ProductController::class, 'filter']);
        });


    });
});
//Route Logout
Route::middleware(['auth','isAdmin:1,2,3'])->group(function() {
    Route::get('logout', [\App\Http\Controllers\Login\LoginController::class, 'logout']);
});


Route::get('/cart', function () {
    return view('User.cart');
});
