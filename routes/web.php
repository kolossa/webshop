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
