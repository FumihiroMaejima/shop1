<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{
    public function index(Request $request)
    {
        // キーワード受け取り
        $keyword = $request->input('keyword');
        // クエリ作成
        $query = \App\Models\Goods::query();

        // キーワードがあるのなら
        if(!empty($keyword))
        {
            $query->where('goods_code', 'like', '%' .$keyword. '%');
            $query->orWhere('goods_name', 'like', '%' .$keyword. '%');
        }

        //ページネーション
        $all_goods = $query->orderBy('id', 'asc')->paginate(10);
        return view('root')->with('all_goods', $all_goods)->with('keyword', $keyword);
    }
}
