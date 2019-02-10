@extends('layouts.customer')

@section('content')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
@if(Session::has('flashmessage'))
    <script>
        $(window).load(function(){
            $('#modal_box').modal('show');
        });
    </script>
    <!-- モーダルウィンドウの中身 -->
    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Goods Registed</h4>
                </div>
                <div class="modal-body">
                    {{ session('flashmessage') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <div class="col-sm-6">
                        <form method="get" action="" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="keyword" class="form-control" value="{{$keyword}}" placeholder="検索キーワード">
                            </div>
                            <input type="submit" value="検索" class="btn btn-info" style="margin: 2px;">
                        </form>
                    </div>
                    <div class="" style="margin-bottom:5px;float:right;">
                        <form action="{{ route('customer_payment_confirm') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="customer_id" value="{{$customer->id}}">
                            <input type="submit" class="btn btn-success" name="" value="購入手続きへ">
                        </form>
                    </div>


                    <table class="table table-striped table-hover">
                        <thead>
                            <tr style="text-align:right;">
                                <th>商品No</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>商品イメージ</th>
                                <th>買い物option</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:right;">
                            @foreach($all_goods as $goods)
                                <tr>
                                    <td>{{$goods->id}}</td>
                                    <td>{{$goods->goods_name}}</td>
                                    <td>{{$goods->price}}円</td>
                                    <td>
                                        @if($goods->image_name)
                                            <img src="{{ asset('storage/goods/' . $goods->id . '/' . $goods->image_name) }}" width="40" height="40" alt="no_goods_image" />
                                        @else
                                            <p>--------</p>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- <a href="" class="btn btn-primary btn-sm">詳細</a> -->
                                        <form action="{{ route('customer_cart_input', $goods->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="goods_id" value="{{$goods->id}}">
                                            <input type="submit" class="btn btn-primary btn-sm" name="" value="カートに入れる">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('customer_cart_delete', $goods->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="goods_id" value="{{$goods->id}}">
                                            <input type="submit" class="btn btn-danger btn-sm btn-dell" name="" value="カートから外す">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- page control -->
                    {!! $all_goods->appends(['keyword'=>$keyword])->render() !!}
                </div>
                <div class="card-footer">Dashboard-footer</div>
            </div>
        </div>
    </div>
</div>
@endsection
