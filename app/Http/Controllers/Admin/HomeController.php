<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
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
        //return view('root')->with('all_goods', $all_goods)->with('keyword', $keyword);

        return view('admin.home')->with('all_goods', $all_goods)->with('keyword', $keyword);
    }

    // 商品登録画面
    public function registIndex()
    {
        return view('admin.goods.regist.index');
    }

    // 商品登録確認画面
    public function registConfirm($id)
    {
        // goodsオブジェクトを作成
        $goods = \App\Models\Goods::findOrFail($id);
        return view('admin.goods.regist.index')->with('goods', $goods);
    }

    // 商品情報編集画面
    public function editIndex(Request $request, $id)
    {
        // goodsオブジェクトを作成
        $goods = \App\Models\Goods::findOrFail($id);
        return view('admin.goods.edit.index')->with('goods', $goods);
    }

    // 商品情報編集確認画面
    public function editConfirm(Request $request, $id)
    {
        // goodsオブジェクトを作成
        $goods = \App\Models\Goods::findOrFail($id);
        return view('admin.goods.edit.index')->with('goods', $goods);
    }
}
