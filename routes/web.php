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

//Route::get('student/list', 'StudentController@index');

Route::group(['prefix' => 'student'], function(){
    Route::get('list', 'StudentController@index');      //一覧
    Route::get('new', 'StudentController@insert');      //入力
    Route::patch('new', 'StudentController@confirm');   //確認
    Route::post('new', 'StudentController@finish');     //完了

    Route::get('edit/{id}/', 'StudentController@edit');             //編集
    Route::patch('edit/{id}/', 'StudentController@edit_confirm');   //編集確認
    Route::post('edit/{id}/', 'StudentController@edit_finish');     //編集終了
});



