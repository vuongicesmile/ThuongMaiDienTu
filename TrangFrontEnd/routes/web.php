<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

//change laguage
Route::get('lang/{locale}',function ($locale) {
    if (! in_array($locale,['en','vn','cn'])) {
        abort(404);
    }
    session()->put('locale',$locale);
    return redirect()->back();
});

// phan login social
Route::get('/redirect-google',[\App\Http\Controllers\Auth\SocialController::class,'redirectGoogle'])->name('redirectGoogle');
Route::get('/google_callback',[\App\Http\Controllers\Auth\SocialController::class,'processGoogleLogin'])->name('processGoogleLogin');

Route::get('/','HomeController@index')->name('home');
Route::get('/add-to-carts/{id}','HomeController@addToCart')->name('addToCart');
Route::get('/show-cart','HomeController@showCart')->name('showCart');
Route::get('/update-cart','HomeController@updateCart')->name('updateCart');
Route::get('/deleted-cart','HomeController@deletedCart')->name('deletedCart');
Route::get('/category/{slug}/{id}',[
   'as' => 'category.product',
   'uses'=>'CategoryController@index'
]);
//Chi tiet san pham
Route::prefix('chitietsanpham')->group(function () {
    Route::get('/{product_id}', [
        'as' => 'details.product',
        'uses' => 'HomeController@details_product'
    ]);
    Route::post('/search', [
        'as' => 'search.index',
        'uses' => 'HomeController@search_index'
    ]);
    /*Autocompletesearch*/
    Route::post('/autocomplete-ajax', [
        'as' => 'autocomplete.ajax',
        'uses' => 'HomeController@autocomplete_ajax'
    ]);

});

//mail
Route::prefix('mail')->group(function () {
    Route::get('/sendMail', [
        'as' => 'Mail.send',
        'uses' => 'HomeController@sendMail'
    ]);

});
//cart
Route::prefix('cart')->group(function () {
    Route::post('/save-cart', [
        'as' => 'save.cart',
        'uses' => 'CartController@save_cart'
    ]);
    Route::post('/check-coupon', [
        'as' => 'check.coupon',
        'uses' => 'CartController@check_coupon'
    ]);

});

//checkout
Route::prefix('checkout')->group(function () {
    Route::get('/login-checkout', [
        'as' => 'login.checkout',
        'uses' => 'CheckOutController@login_checkout'
    ]);
    Route::post('/add-customer', [
        'as' => 'add.customer',
        'uses' => 'CheckOutController@add_customer'
    ]);
    Route::get('/checkout', [
        'as' => 'add.checkout',
        'uses' => 'CheckOutController@checkout'
    ]);
    Route::post('/save-checkout-customer', [
        'as' => 'save.checkoutcustomer',
        'uses' => 'CheckOutController@save_checkout_customer'
    ]);
    Route::get('/logout-checkout', [
        'as' => 'logout.checkout',
        'uses' => 'CheckOutController@logout_checkout'
    ]);
    Route::post('/login-customer', [
        'as' => 'login.customer',
        'uses' => 'CheckOutController@login_customer'
    ]);
    Route::post('/payment', [
        'as' => 'add.payment',
        'uses' => 'CheckOutController@payment'
    ]);
    Route::post('/order-place', [
        'as' => 'order.place',
        'uses' => 'CheckOutController@order_place'
    ]);


});





