<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\OriginalPasswordReset;
use Illuminate\Support\Facades\Password;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *パスワードリセットに使われるブローカの取得
    *
    * @return PasswordBroker
    */
    protected function broker()
    {
        return Password::broker('admin');
    }

    /**
     * パスワードリセット通知の送信
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new OriginalPasswordReset($token));
    }
}
