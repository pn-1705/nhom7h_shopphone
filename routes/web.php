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


Route::get('/', [\App\Http\Controllers\Home\HomeController::class,'index'])->name("viewHome");
//Route Login
Route::get('/login', [\App\Http\Controllers\Login\LoginController::class,'index'])->name('login');
Route::post('/store', [\App\Http\Controllers\Login\LoginController::class,'store']);
Route::post('/create', [\App\Http\Controllers\Login\LoginController::class,'create']);
Route::get('/google', [\App\Http\Controllers\Api\GoogleController::class, 'getGoogleSignInUrl']);
Route::get('/google/callback', [\App\Http\Controllers\Api\GoogleController::class, 'loginCallback']);
Route::get('/facebook', [\App\Http\Controllers\Api\FacebookController::class, 'getFBSignInUrl']);
Route::get('/facebook/callback', [\App\Http\Controllers\Api\FacebookController::class, 'loginFBCallback']);
Route::get('/activate/{customer}/{token}', [\App\Http\Controllers\Login\LoginController::class,'activate'])->name('activate');
Route::get('/forget/{customer}/{token}', [\App\Http\Controllers\Login\LoginController::class,'forget'])->name('forget');



Route::get('/productdetails', [\App\Http\Controllers\Product\ProductController::class,'show'])->name('viewProductDetails');
Route::get('/productdetails', [\App\Http\Controllers\Product\ProductController::class,'show'])->name('product.view');

//Route Admin
Route::middleware(['auth','isAdmin:2'])->group(function() {
    Route::prefix('admin')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class,'dashboard'])->name('admin.dashboard');
        Route::prefix('productOld')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\ProductControllerOld::class, 'index'])->name('listproduct');
            Route::get('add', [\App\Http\Controllers\Admin\ProductControllerOld::class, 'create']);
            Route::post('add', [\App\Http\Controllers\Admin\ProductControllerOld::class, 'store']);
            Route::get('destroy', [\App\Http\Controllers\Admin\ProductControllerOld::class, 'destroy']);
            Route::get('edt', [\App\Http\Controllers\Admin\ProductControllerOld::class, 'show']);
            Route::post('edt', [\App\Http\Controllers\Admin\ProductControllerOld::class, 'edit']);
            Route::get('filter', [\App\Http\Controllers\Admin\ProductControllerOld::class, 'filter']);
        });

        Route::prefix('product')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\ProductController::class,'index'])->name('admin.product.index');
            Route::get('/add',[\App\Http\Controllers\Admin\ProductController::class,'addProduct'])->name('admin.product.add');
            Route::post('/add',[\App\Http\Controllers\Admin\ProductController::class,'addProductPost'])->name('admin.product.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\ProductController::class,'edit'])->name('admin.product.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\ProductController::class,'update'])->name('admin.product.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\ProductController::class,'destroy'])->name('admin.product.getDestroy');
            Route::get('/active/{id}',[\App\Http\Controllers\Admin\ProductController::class,'active'])->name('admin.product.active');
        });

        Route::prefix('category')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\CateController::class,'index'])->name('admin.category.index');
            Route::get('/add',[\App\Http\Controllers\Admin\CateController::class,'addCate'])->name('admin.category.add');
            Route::post('/add',[\App\Http\Controllers\Admin\CateController::class,'addCatePost'])->name('admin.category.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\CateController::class,'edit'])->name('admin.category.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\CateController::class,'update'])->name('admin.category.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\CateController::class,'destroy'])->name('admin.category.getDestroy');
        });

        Route::prefix('brand')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\BrandController::class,'index'])->name('admin.brand.index');
            Route::get('/add',[\App\Http\Controllers\Admin\BrandController::class,'addBrand'])->name('admin.brand.add');
            Route::post('/add',[\App\Http\Controllers\Admin\BrandController::class,'addBrandPost'])->name('admin.brand.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\BrandController::class,'edit'])->name('admin.brand.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\BrandController::class,'update'])->name('admin.brand.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\BrandController::class,'destroy'])->name('admin.brand.getDestroy');
        });

        Route::prefix('discount')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\DiscountController::class,'index'])->name('admin.discount.index');
            Route::get('/add',[\App\Http\Controllers\Admin\DiscountController::class,'addDiscount'])->name('admin.discount.add');
            Route::post('/add',[\App\Http\Controllers\Admin\DiscountController::class,'addDiscountPost'])->name('admin.discount.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\DiscountController::class,'edit'])->name('admin.discount.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\DiscountController::class,'update'])->name('admin.discount.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\DiscountController::class,'destroy'])->name('admin.discount.getDestroy');
        });

        Route::prefix('order')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\OrderController::class,'index'])->name('admin.order.index');
            Route::get('/add',[\App\Http\Controllers\Admin\OrderController::class,'addDiscount'])->name('admin.order.add');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\OrderController::class,'edit'])->name('admin.order.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\OrderController::class,'update'])->name('admin.order.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\OrderController::class,'destroy'])->name('admin.order.getDestroy');
            Route::get('/detail/{id}', [\App\Http\Controllers\Admin\OrderController::class,'detail'])->name('admin.order.detail');

            Route::get('/action/{id}',[\App\Http\Controllers\Admin\OrderController::class,'action'])->name('admin.order.action');
            Route::get('/cancel/{id}', [\App\Http\Controllers\Admin\OrderController::class,'cancel'])->name('admin.order.cancel');
            Route::get('/returns/{id}', [\App\Http\Controllers\Admin\OrderController::class,'returns'])->name('admin.order.returns');
            Route::get('/del_product/{MaSP}/{MaHD}',[\App\Http\Controllers\Admin\OrderController::class,'destroy'])->name('admin.order.getDestroy');
            Route::get('/detail/{MaSP}/{MaHD}/{sl}', [\App\Http\Controllers\Admin\OrderController::class,'change_sl'])->name('admin.order.change_sl');
        });

        Route::prefix('user')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\UserController::class,'index'])->name('admin.user.index');
            Route::get('/add',[\App\Http\Controllers\Admin\UserController::class,'addUser'])->name('admin.user.add');
            Route::post('/add',[\App\Http\Controllers\Admin\UserController::class,'addUserPost'])->name('admin.user.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\UserController::class,'edit'])->name('admin.user.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\UserController::class,'update'])->name('admin.user.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\UserController::class,'destroy'])->name('admin.user.getDestroy');
        });
    });
});
//Route Logout
Route::middleware(['auth','isAdmin:1,2,3'])->group(function() {
    Route::get('logout', [\App\Http\Controllers\Login\LoginController::class, 'logout']);
    Route::get('cart', [\App\Http\Controllers\Product\CartController::class, 'index'])->name('cart');
    Route::POST('updatecart', [\App\Http\Controllers\Product\CartController::class, 'update']);
    Route::get('addtocart', [\App\Http\Controllers\Product\CartController::class, 'store']);
    Route::get('updatecart',[\App\Http\Controllers\Product\CartController::class, 'updatecart'])->name("user.updatecart");

    Route::get('/profile', [\App\Http\Controllers\User\UserController::class, 'user_inf'])->name('user.inf');
    Route::post('/saveprofile', [\App\Http\Controllers\User\UserController::class, 'user_inf_edid'])->name('user.saveinf');

    Route::get('/doi_mk', [\App\Http\Controllers\User\UserController::class, 'doi_mk_view'])->name('user.doi_mk_view');
    Route::post('/doi_mk', [\App\Http\Controllers\User\UserController::class, 'doi_mk'])->name('user.doi_mk');

    Route::post('/thanhtoan', [\App\Http\Controllers\User\HomeController::class, 'thanh_toan'])->name('user.thanh_toan');
    Route::get('/thanhtoan', [\App\Http\Controllers\User\HomeController::class, 'thanh_toan_view'])->name('user.thanh_toan');
    Route::get('/addcoupon', [\App\Http\Controllers\User\HomeController::class, 'addcoupon'])->name('user.addcoupon');

    Route::get('/get_data_location',[\App\Http\Controllers\User\HomeController::class, 'get_data_location'])->name('user.get_data_location');

    Route::get('/quanlydonhang',[\App\Http\Controllers\User\UserController::class, 'don_mua'])->name('user.don_mua');
    Route::get('/in_don_hang/{id_hd}',[\App\Http\Controllers\User\UserController::class, 'in_don_hang'])->name('user.in_don_hang');




    Route::post('/user/inf/edid', '\App\Http\Controllers\User\UserController@user_inf_edid')->name('user_inf_edid');

    Route::get('favourite', [\App\Http\Controllers\Product\FavouriteController::class, 'index'])->name('favourite');
    Route::get('addtofavourite', [\App\Http\Controllers\Product\FavouriteController::class, 'store']);


});


