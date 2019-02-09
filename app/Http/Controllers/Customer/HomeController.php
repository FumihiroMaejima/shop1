<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
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

        // ログインしているユーザーを取得
        $customer = Auth::user();

        return view('customer.home')->with('customer', $customer)->with('all_goods', $all_goods)->with('keyword', $keyword);
    }

    // 商品情報をカートに登録
    public function cartInput(Request $request)
    {
        // カートに入れる商品のID
        $goods_id = $request->input('goods_id');
        // 1回のボタン押下によるカートに入れる個数
        $input_num = 1;
        // セッションの'cart'キーに、商品のIDと個数を格納する
        // 複数回同じボタンを押したらその分数が増える
        session()->increment('cart.' . $goods_id, 1);

        // customerホームにリダイレクト
        // flashmessage(モーダル表示用のセッション変数)
        return redirect()->to('customer/home')->with('flashmessage', '選択した商品をカートに入れました。');
    }

    // 商品情報をカートに登録
    public function cartDelete(Request $request)
    {
        // カートから商品のID
        $goods_id = $request->input('goods_id');

        // 'cart'keyが存在し、nullではない
        $exist_goods = $request->session()->has('cart');
        if($exist_goods){
            // カート内の商品IDと個数を取得
            $select_goods_data = session()->get('cart');
            // 選択した商品がカート内にあるかの確認
            $exist_this_goods = array_key_exists($goods_id, $select_goods_data);
            if ($exist_this_goods) {

                $current_num = $select_goods_data[$goods_id];
                if($current_num != 0){
                    session()->decrement('cart.' . $goods_id, 1);

                // customerホームにリダイレクト
                    return redirect()->to('customer/home')->with('flashmessage', '選択した商品をカートから1つ外しました。');
                }
                else{
                    return redirect()->to('customer/home')->with('flashmessage', '選択した商品はカート内に存在しません。');
                }
            } else {
                return redirect()->to('customer/home')->with('flashmessage', '選択した商品はカート内に存在しません。');
            }
        }
        else{
            return redirect()->to('customer/home')->with('flashmessage', 'カート内に商品が存在しません。');
        }
    }

    // 決済前のカート内情報の登録
    public function paymentConfirm(Request $request)
    {
        // 'cart'keyが存在し、nullではない
        $exist_goods = $request->session()->has('cart');
        if($exist_goods){
            // ログイン中のユーザーIDの取得
            $customer_id = $request->input('customer_id');

            // customerオブジェクトを作成
            $customer = \App\Models\Customer::findOrFail($customer_id);

            // カート内の商品IDと個数を取得
            $select_goods_data = session()->get('cart');

            // 画面に表示する商品データ格納用の変数
            $confirm_goods_data = array();

            // 商品詳細データとカート内の個数との紐付け
            foreach ($select_goods_data as $goods_id => $num) {
                // 0個以外の商品のデータを紐付ける
                if ($num != 0) {
                    $goods = \App\Models\Goods::findOrFail($goods_id);
                    // 各商品の詳細データを格納
                    $confirm_goods_data[$goods_id] = $goods;
                    // 各商品のカート内個数を格納
                    $confirm_goods_data[$goods_id]['input_num'] = $num;
                }
            }
            // データをviewに渡す
            return view('customer.cart.confirm')->with('customer', $customer)->with('confirm_goods_data', $confirm_goods_data);
        }
        else{
            return redirect()->to('customer/home')->with('flashmessage', 'カート内に商品が存在しません。');
        }
    }

    // 単発決済処理
    public function paymentExec(Request $request)
    {
        //dd($request);
        try{
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'jpy',
            ));

            // カート情報の削除
            $request->session()->forget('cart');

            // ホーム画面にリダイレクト
            return redirect()->to('customer/home')->with('flashmessage', '決済が完了しました。');
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
