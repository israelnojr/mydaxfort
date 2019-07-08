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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::get('/{product}/slug', 'ProductController@show')->name('product.show');



Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('{path}','HomeController@index')->where('path', '[A-Za-z]+'); 


