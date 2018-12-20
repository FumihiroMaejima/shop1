<?php

namespace App\Http\Controllers\Customer\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Events\Logined;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $maxAttempts = 3;     // ログイン試行回数(回数)
    protected $decayMinutes = 10;   // ログインロックタイム(分)

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/customer/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('customer');
    }

    public function showAdminLoginForm()
    {
        return view('customer.login');
    }

    /**
     * ログイン後の処理
     * @param Request $request
     * @param $user
     */
    protected function authenticated(Request $request, $user)
    {
        // ログインイベントを発火させ、最終ログイン日時を記録する
        event(new Logined());
    }
}
