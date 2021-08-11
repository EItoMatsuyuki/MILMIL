<?php

use App\Book;
use Illuminate\Http\Request;

/**
* 本のダッシュボード表示(books.blade.php)
*/
Route::get('/','BooksController@index');

//更新画面
// Route::group(['middleware' => 'auth'], function () {
Route::post('/booksedit/{books}','BooksController@edit');
// });

//更新処理
Route::post('/books/update','BooksController@update');

/**
* 新「本」を追加 
*/
Route::post('/books', 'BooksController@store');


//質問詳細
Route::post('/question/{books}','BooksController@question','BooksController@comm');

/**
* 本を削除 
*/
Route::delete('/book/{book}','BooksController@destroy');


//ログイン
Auth::routes();

Route::get('/home', 'BooksController@index')->name('home');



