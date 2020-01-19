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

Route::get('/', function () {
    return view('welcome');
});
Route::get('books/offset/{offset}/limit/{limit}/column/{column}/asc/{asc}', 'GetBooksController');
Route::get('list-books', 'ListBooksController');
Route::post('addCart', 'AddToTheCartController');
Route::post('removeFromCart', 'RemoveFromCartController');
Route::post('emptyCart', 'EmptyCartController');
Route::get('cart-content', 'GetCartContentController');
Route::get('cart-catalog-price', 'GetCartCatalogPriceController');
Route::get('cart-special-price', 'GetCartSpecialPriceController');
