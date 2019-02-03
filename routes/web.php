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


Route::get('/', 'RootController@index');

// adminユーザーのルーティング
Route::group(['prefix' => 'admin'], function(){
    Route::get('login', 'Admin\Auth\LoginController@showAdminLoginForm')->name('admin_login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin_login_post');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin_logout');

    // Registration Routes...
    Route::get('register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin_register');
    Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin_register_post');

    // Password Reset Routes...
    Route::get('password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin_password_request');
    Route::post('password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin_password_email');
    Route::get('password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin_password_reset');
    Route::post('password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('admin_password_reset_post');

    Route::get('home', 'Admin\HomeController@index')->name('admin_home');


    // 商品登録画面
    Route::get('goods/regist', 'Admin\HomeController@registIndex')->name('admin_regist_index');
    Route::patch('goods/confirm', 'Admin\HomeController@registConfirm')->name('admin_regist_confirm');
    Route::post('goods/input', 'Admin\HomeController@registFinish')->name('admin_regist_input');
    Route::post('goods/upload', 'Admin\HomeController@uploadGoodsImage')->name('admin_upload_image');
    // 商品編集画面
    Route::get('goods/edit/{id}/', 'Admin\HomeController@editIndex')->name('admin_edit_index');
    Route::patch('goods/edit/{id}/confirm', 'Admin\HomeController@editConfirm')->name('admin_edit_confirm');
});

// customer ユーザーのルーティング
Route::group(['prefix' => 'customer'], function(){
    Route::get('login', 'Customer\Auth\LoginController@showAdminLoginForm')->name('customer_login');
    Route::post('login', 'Customer\Auth\LoginController@login')->name('customer_login_post');
    Route::post('logout', 'Customer\Auth\LoginController@logout')->name('customer_logout');

    // Registration Routes...
    Route::get('register', 'Customer\Auth\RegisterController@showRegistrationForm')->name('customer_register');
    Route::post('register', 'Customer\Auth\RegisterController@register')->name('customer_register_post');

    // Password Reset Routes...
    Route::get('password/reset', 'Customer\Auth\ForgotPasswordController@showLinkRequestForm')->name('customer_password_request');
    Route::post('password/email', 'Customer\Auth\ForgotPasswordController@sendResetLinkEmail')->name('customer_password_email');
    Route::get('password/reset/{token}', 'Customer\Auth\ResetPasswordController@showResetForm')->name('customer_password_reset');
    Route::post('password/reset', 'Customer\Auth\ResetPasswordController@reset')->name('customer_password_reset_post');

    Route::get('home', 'Customer\HomeController@index')->name('customer_home');
});

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

// 送信メール本文のプレビュー(画面のみのテスト)
Route::get('sample/mailable/preview', function () {
    return new App\Mail\SampleNotification($name='テスト', $text='テストです。');
});

// メール機能テスト
Route::get('sample/mailable/send', 'MailController@SampleNotification');
