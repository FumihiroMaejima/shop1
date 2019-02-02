<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\OriginalPasswordReset;
use Illuminate\Support\Facades\Password;

class Customer extends Authenticatable
{
    use Notifiable;

    //テーブル名
    protected $table = 'customer';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'postcode',
        'address',
        'user_agent',
        'credit_card_type',
        'credit_card_number',
        'credit_card_expiration_date',
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
        return Password::broker('customer');
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
