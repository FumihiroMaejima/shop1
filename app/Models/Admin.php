<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'updated_at'
    ];
}
