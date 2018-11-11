<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'PhoneNumber',
        'postcode',
        'address',
        'userAgent',
        'creditCardType',
        'creditCardNumber',
        'creditCardExpirationDate',
        'updated_at'
    ];
}
