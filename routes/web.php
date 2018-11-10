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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

// Auth
//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

// ロールによる制限の参考
/*
// 全ユーザ
Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
  // ユーザ一覧
  Route::get('/account', 'AccountController@index')->name('account.index');
});

// 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
  // ユーザ登録
  Route::get('/account/regist', 'AccountController@regist')->name('account.regist');
  Route::post('/account/regist', 'AccountController@createData')->name('account.regist');

  // ユーザ編集
  Route::get('/account/edit/{user_id}', 'AccountController@edit')->name('account.edit');
  Route::post('/account/edit/{user_id}', 'AccountController@updateData')->name('account.edit');

  // ユーザ削除
  Route::post('/account/delete/{user_id}', 'AccountController@deleteData');
});

// システム管理者のみ
Route::group(['middleware' => ['auth', 'can:system-only']], function () {

});
*/

// DocumentRoot
Route::get('/', 'RootController@index');

//Route::get('student/list', 'StudentController@index');

Route::group(['prefix' => 'student'], function(){
    Route::get('list', 'StudentController@index');      //一覧
    Route::get('new', 'StudentController@insert');      //入力
    Route::patch('new', 'StudentController@confirm');   //確認
    Route::post('new', 'StudentController@finish');     //完了

    Route::get('edit/{id}/', 'StudentController@edit');             //編集
    Route::patch('edit/{id}/', 'StudentController@edit_confirm');   //編集確認
    Route::post('edit/{id}/', 'StudentController@edit_finish');     //編集終了

    Route::post('delete/{id}/', 'StudentController@delete');     //削除処理
});

// 送信メール本文のプレビュー
Route::get('sample/mailable/preview', function () {
    return new App\Mail\SampleNotification($name='テスト', $text='テストです。');
});

Route::get('sample/mailable/send', 'MailController@SampleNotification');
