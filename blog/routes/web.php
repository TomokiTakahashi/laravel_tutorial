<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//ブログ一覧画面を表示
Route::get('/', "App\Http\Controllers\BlogController@showList")->name("blogs");
// ->name("blogs");はこのルートに名前を付けている。

//ブログ登録画面を表示する
Route::get('/blog/create', "App\Http\Controllers\BlogController@showCreate")->name("create");

//ブログ登録
Route::post('/blog/store', "App\Http\Controllers\BlogController@exeStore")->name("store");

//ブログ詳細画面を表示する
Route::get('/blog/{id}', "App\Http\Controllers\BlogController@showDetail")->name("show");

//ブログ編集画面を表示
Route::get('/blog/edit/{id}', "App\Http\Controllers\BlogController@showEdit")->name("edit");


//ブログの編集機能
Route::post('/blog/update', "App\Http\Controllers\BlogController@exeUpdate")->name("update");

//ブログの削除機能
Route::post('/blog/delete/{id}', "App\Http\Controllers\BlogController@exeDelete")->name("delete");


