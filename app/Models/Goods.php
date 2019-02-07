<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    public $timestamps = true;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    // $fillableはホワイトリスト
    // id, created_at 以外のカラムを更新可能とする
    protected $fillable = [
        'goods_code',
        'goods_name',
        'standard',
        'price',
        'maker',
        'release_date',
        'handling_date',
        'updated_at'
    ];
}
