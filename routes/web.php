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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// [users/index]一覧のルート
Route::get('/users', 'UserController@index');
// [users/show]詳細のルート
Route::get('users/{id}', 'UserController@show');
// [users/edit]ルート
Route::get('users/{id}/edit', 'UserController@edit');
// [users/patch]のルート
Route::patch('users/{id}', 'UserController@update');

// [/tasks]のルート
Route::get('/tasks', 'TaskController@index');
// [/tasks/{id}]詳細showのルート
Route::get('/tasks/{id}', 'TaskController@show')->where('id', '[0-9]+');
// [/tasks/{id}]更新updateのルート
Route::put('/tasks/{id}', 'TaskController@update')->where('id', '[0-9]+');
// [/tasks/new]新規作成のルート
Route::get('/tasks/new', 'TaskController@new');
// [/tasks]新規登録のルート
Route::post('/tasks', 'TaskController@create');
// [/tasks/delete]削除のルート
Route::delete('/tasks/{id}', 'TaskController@delete')->where('id', '[0-9]+');