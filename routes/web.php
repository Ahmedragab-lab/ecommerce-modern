<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\Dashboard;

Route::get('/',[Frontend\HomeController::class,'index']);
Auth::routes();
Route::get('/home',[Frontend\HomeController::class,'index'])->name('home');


Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    Route::group(['middleware'=>['Roles','role:admin|supervisor']],function(){
        Route::get('/dashboard',[Dashboard\DashboardController::class,'index'])->name('dashboard');

        Route::resource('/users',Dashboard\CustomerController::class);
        Route::delete('/users/bulk_delete/{ids}', [Dashboard\CustomerController::class,'bulkDelete'])->name('users.bulk_delete');

        Route::resource('/product_categories',Dashboard\ProductCategoriesController::class);
        Route::delete('/product_categories/bulk_delete/{ids}', [Dashboard\ProductCategoriesController::class,'bulkDelete'])->name('product_categories.bulk_delete');

        Route::resource('/tags',Dashboard\TagController::class);
        Route::delete('/tags/bulk_delete/{ids}', [Dashboard\TagController::class,'bulkDelete'])->name('tags.bulk_delete');

        Route::resource('/products',Dashboard\ProductController::class);
        Route::delete('/products/bulk_delete/{ids}', [Dashboard\ProductController::class,'bulkDelete'])->name('products.bulk_delete');
        Route::post('/products/remove_image', [Dashboard\ProductController::class,'remove_image'])->name('products.remove_image');

        Route::resource('/coupons',Dashboard\CouponController::class);
        Route::delete('/coupons/bulk_delete/{ids}', [Dashboard\CouponController::class,'bulkDelete'])->name('coupons.bulk_delete');

        Route::resource('/reviews',Dashboard\ReviewController::class);
        Route::delete('/reviews/bulk_delete/{ids}', [Dashboard\ReviewController::class,'bulkDelete'])->name('reviews.bulk_delete');
    });
});












// Route::get('/', function () {
    //     return view('frontend.index');
    // });

    // Route::get('/dash', function () {
        //     return view('dashboard.home');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
