<?php

use App\Book;
use Illuminate\Http\Request;

Auth::routes();

Route::get('/home', 'BooksController@index')->name('home');
/**
 * 本の一覧表示
 */
Route::get('/', 'BooksController@index');

/**
 * 本を登録
 */
Route::post('/books', 'BooksController@store');

/**更新処理
 *
*/
Route::post('/books/update', 'BooksController@update');

/**
 * 更新画面
 */

Route::post('/edit/{book}', 'BooksController@edit');

/**
 * 本を削除
 */
Route::delete('/book/{book}', 'BooksController@delete');
