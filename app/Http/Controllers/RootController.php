<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{
    public function index()
    {
        // クエリ作成
        $query = \App\Models\Goods::query();

        //ページネーション
        $all_goods = $query->orderBy('id', 'esc')->paginate(10);
        return view('root')->with('all_goods', $all_goods);
    }
}
