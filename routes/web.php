<?php

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

/*Route::get('/', function () {
    return redirect('shop');
})->name('index');*/

Route::get('/', function () {
    return view('welcome');
})->name('shop');

//Route::get('/home','ShopController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('search', 'ShopController@search')->name('search');

Route::resource('/shop', 'ShopController');
Route::resource('cart', 'CartController');
Route::delete('emptyCart', 'CartController@emptyCart');
Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');
Route::resource('wishlist', 'WishlistController');
Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');
Route::post('switchToCart/{id}', 'WishlistController@switchToCart');
Route::post('cart/qty', 'CartController@update')->name('qty');
Route::get('/about', 'PageController@about')->name('about');
Route::get('/contact', 'PageController@contact')->name('contact');

Route::resource('/questions','QuestionController');
Route::resource('/items','ItemController');
Route::resource('/categories','CategoryController');

Route::post('payment', 'CheckoutController@charge');

Route::get('checkout', 'CartController@checkout')->name('checkout');
Route::post('/storeorder', 'CartController@storeorder')->name('storeorder');

Auth::routes();