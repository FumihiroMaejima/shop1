<?php

namespace App\Listeners;

use App\Events\Logined;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\UserProviderInterface;
use App\Models\Admin;

class LastLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logined  $event
     * @return void
     */
    public function handle(Logined $event)
    {
        $request_url = $_SERVER['REQUEST_URI'];
        if($request_url == "/admin/login")
        {
            $email = $_POST['email'];
            // クエリ
            $admin = \App\Models\Admin::where('email',$email)->first();
            $admin->last_login_at = Carbon::now();
            // 保存
            $admin->save();
        }
        else if($request_url == "/customer/login")
        {
            $email = $_POST['email'];
            // クエリ
            $admin = \App\Models\Customer::where('email',$email)->first();
            $admin->last_login_at = Carbon::now();
            // 保存
            $admin->save();
        }
        else
        {
            // userテーブルを使った最終ログイン時刻の書き込み
            $user = Auth::user();
            $user->last_login_at = Carbon::now();
            $user->save();
        }
    }
}
