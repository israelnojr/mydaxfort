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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/category', 'CategoryController@index')->name('category.index');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::post('/updatecart', 'CartController@UpdateCart')->name('cart.updatecart');
Route::get('/reset', 'CartController@reset')->name('cart.reset');
Route::delete('/remove/{product}', 'CartController@destroy')->name('cart.remove');
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::get('/shop/{product}', 'ProductController@show')->name('product.show');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/review','ProductReviewController@store')->name('review.store');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('{path}','HomeController@index')->where('path', '[A-Za-z]+'); 


