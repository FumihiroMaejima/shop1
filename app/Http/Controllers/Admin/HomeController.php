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
    public function registIndex(Request $request)
    {
        $goods_name = $request->input('goods_name');
        $price      = $request->input('price');
        $goods_text = $request->input('goods_text');
        $data = "";
        if((isset($goods_name))&&(isset($price))&&(isset($goods_text))){
            $data['goods_name'] = $goods_name;
            $data['price']      = $price;
            $data['goods_text'] = $goods_text;
        }
        //dd($request);

        return view('admin.goods.regist.index');
    }

    // 商品登録確認画面
    public function registConfirm(\App\Http\Requests\CheckGoodsRequest $request)
    {

        // リクエストデータを取得(配列)
        $data = $request->all();
        //dd($data);
        return view('admin.goods.regist.confirm')->with('data', $data);
    }

    // 新商品情報の登録
    public function registFinish(Request $request)
    {
        // goodsオブジェクトを作成
        $new_goods = new \App\Models\Goods;

        // ランダムな商品コードの作成(random_bytes()関数を使う)
        $random_goods_code  = str_random(6);
        // 画像名と説明文の取得
        $tmp_image_name = $request->image_name;
        $tmp_goods_text = $request->goods_text;

        // 値の登録
        $new_goods->goods_code = $random_goods_code;
        $new_goods->goods_name = $request->goods_name;
        $new_goods->standard = "1";
        $new_goods->price = $request->price;
        $new_goods->maker = "test maker";
        if(isset($tmp_image_name)){
            $new_goods->image_name = $tmp_image_name;
        }
        if(isset($tmp_goods_text)){
            $new_goods->goods_text = $tmp_goods_text;
        }

        // 保存(DBに登録)
        $new_goods->save();

        // 管理画面ホームにリダイレクト
        // flashmessage(モーダル表示用のセッション変数)
        return redirect()->to('admin/home')->with('flashmessage', '新商品の登録が完了しました。');

    }

    // 商品登録確認画面
    public function uploadGoodsImage(Request $request)
    {
        dd(var_dump($_FILES));
        /*
        echo var_dump($_FILES);

        dd($request);
        */
        $file = $request->input('goods_image');
        // 登録対処の商品ID
        $select_id = $request->input('select_id');
        $upload_data = $request->input('goods_image');

        // アップロードしたファイルのバリデーション設定
        $this->validate($request, [
            'goods_image' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
                // 最小縦横120px 最大縦横400px
                'dimensions:min_width=100,min_height=100,max_width=600,max_height=600',
            ]
        ]);
dd($request);
        if ($request->input('goods_image')->isValid([])) {
            $filename = $request->file->store('public/storage');

            $goods = \App\Models\Goods::findOrFail($id);
            $goods->image_name = $upload_data;
            // 更新(差分があればDBに登録)
            $goods->save();
        }


        //$file = $request->file('goods_image');
        /*
        if($request->hasFile('goods_image')){
             dd($upload_data);
        }
        */


        //dd($data);
        redirect()->to('admin/home')->with('flashmessage', 'イメージ画像の登録が完了しました。');
    }

    // 商品情報編集画面
    public function editIndex(Request $request, $id)
    {
        // goodsオブジェクトを作成
        $goods = \App\Models\Goods::findOrFail($id);
        return view('admin.goods.edit.index')->with('goods', $goods);
    }

    // 商品情報編集確認画面
    public function editConfirm(\App\Http\Requests\CheckGoodsRequest $request, $id)
    {
        // goodsオブジェクトを作成
        $goods = \App\Models\Goods::findOrFail($id);
        return view('admin.goods.edit.index')->with('goods', $goods);
    }
}
