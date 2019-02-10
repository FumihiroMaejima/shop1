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

// トップページ
Route::group(['middleware' => 'auth.very_basic'], function () {
    Route::get('/', 'RootController@index');
});

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

    // 管理画面ホーム
    Route::get('home', 'Admin\HomeController@index')->name('admin_home');


    // 商品登録画面
    Route::get('goods/regist', 'Admin\HomeController@registIndex')->name('admin_regist_index');
    Route::patch('goods/confirm', 'Admin\HomeController@registConfirm')->name('admin_regist_confirm');
    Route::post('goods/input', 'Admin\HomeController@registFinish')->name('admin_regist_input');
    Route::post('goods/upload', 'Admin\HomeController@uploadGoodsImage')->name('admin_upload_image');
    // 商品編集画面
    Route::get('goods/edit/{id}', 'Admin\HomeController@editIndex')->name('admin_edit_index');
    Route::patch('goods/edit/{id}/confirm', 'Admin\HomeController@editConfirm')->name('admin_edit_confirm');
    Route::post('goods/edit/{id}/input', 'Admin\HomeController@editFinish')->name('admin_edit_input');
    // 商品削除
    Route::post('goods/delete/{id}', 'Admin\HomeController@delete')->name('admin_goods_delete');

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

    // ユーザー画面ホーム
    Route::get('home', 'Customer\HomeController@index')->name('customer_home');

    // カートへの格納処理
    Route::post('cart/input/{id}', 'Customer\HomeController@cartInput')->name('customer_cart_input');
    Route::post('cart/delete/{id}', 'Customer\HomeController@cartDelete')->name('customer_cart_delete');
    // 決済確認画面
    Route::post('cart/payment/confirm', 'Customer\HomeController@paymentConfirm')->name('customer_payment_confirm');
    Route::post('cart/payment/exec', 'Customer\HomeController@paymentExec')->name('customer_payment_exec');
});

/*
// 送信メール本文のプレビュー(画面のみのテスト)
Route::get('sample/mailable/preview', function () {
    return new App\Mail\SampleNotification($name='テスト', $text='テストです。');
});

// メール機能テスト
Route::get('sample/mailable/send', 'MailController@SampleNotification');
*/
