<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Guest\ProductController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ShoppingCartController;
use App\Http\Middleware\AdminAuthorised;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.home');
})->name('homePage');

Route::controller(ProductController::class)->group(function () {
    Route::group(['prefix' => 'products'], function() {
        Route::group(['prefix' => 'carts'], function() {
            Route::get('/', 'shoppingCart')->name('shoppingCart');
            Route::get('/add/{id}', 'addProductTocart')->name('addProductTocart');
            Route::get('/delete', 'clearAllCart')->name('clearAllCart');
            Route::patch('/update/send/gema', 'updateProductCart')->name('updateProductCart');
        });
        Route::get('/', 'productList')->name('products');
        Route::get('/{id}/{slug}', 'productDetails')->name('productDetails');
        Route::get('/filter', 'productFilter')->name('productFilter');

    });
});

Route::middleware('auth')->group(function () {

    Route::middleware('userAuth')->group(function () {
        Route::group(['prefix' => 'user'], function() {
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

            Route::controller(ProfileController::class)->group(function () {
                Route::get('/profile', 'edit')->name('profile.edit');
                Route::patch('/profile', 'update')->name('profile.update');
                Route::delete('/profile', 'destroy')->name('profile.destroy');
            });

            Route::controller(OrderController::class)->group(function () {
                Route::group(['prefix' => 'order'], function() {
                    Route::get('/', 'getOrder')->name('getOrder');
                    Route::get('/details/{id}/{orderNum}', 'orderDetails')->name('orderDetails');
                });

                Route::group(['prefix' => 'wishlist'], function() {
                    Route::get('/', 'getWishList')->name('getWishList');
                    Route::get('/add-remove/{id}', 'addProToWishList')->name('addProToWishList');
                });

                Route::group(['prefix' => 'checkout'], function() {
                    Route::get('/', 'checkoutView')->name('checkoutView');
                    Route::post('/submit', 'submitCheckout')->name('submitCheckout');
                });

            });
        });
    });


    Route::middleware('adminAuth')->group(function () {
        Route::group(['prefix' => 'administrator'], function() {
            Route::controller(AdminDashboardController::class)->group(function () {
                Route::get('/dashboard', 'adminDashboard')->name('adminDashboard');
            });
            Route::controller(AdminProductController::class)->group(function () {
                Route::group(['prefix' => 'product'], function() {
                    Route::group(['prefix' => 'category'], function() {
                        Route::get('/', 'admincatList')->name('admincategory');
                        Route::post('/', 'adminPostcat')->name('admincategory.post');
                        Route::delete('/', 'adminDeletecat')->name('admincategory.destroy');
                    });

                    Route::get('/', 'adminproList')->name('adminproduct');
                    Route::get('/add', 'adminAddPro')->name('adminproduct.add');
                    Route::post('/', 'adminPostPro')->name('adminproduct.post');
                    Route::get('/single/{id}', 'adminSinglePro')->name('adminproduct.single');
                    Route::patch('/', 'adminUpdatePro')->name('adminproduct.update');
                    Route::delete('/', 'adminDeletePro')->name('adminproduct.destroy');
                    Route::post('/upload/images', 'adminUploadProImg')->name('adminUploadProImg');
                    Route::delete('/upload/images/delete', 'adminDeleteProductImage')->name('adminDeleteProductImage');
                });
            });

             Route::controller(AdminOrderController::class)->group(function () {
                Route::group(['prefix' => 'orders'], function() {
                    Route::get('/', 'adminOrder')->name('adminOrder');
                    Route::get('/{id}/{orderNum}', 'adminOrderDetails')->name('adminOrderDetails');
                    Route::patch('/paid', 'markAsPaid')->name('markAsPaid');
                    Route::patch('/status/update', 'updateOrderStatus')->name('updateOrderStatus');
                });
            });
        });
    });

});

require __DIR__.'/auth.php';
