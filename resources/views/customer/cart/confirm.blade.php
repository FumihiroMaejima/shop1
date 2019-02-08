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
                <div class="card-header">Customer Confirm Cart Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Confirm Cart Data!

                    <form action="" method="POST">
                        <input type="hidden" name="customer_id" value="{{$customer->id}}">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr style="text-align:right;">
                                    <th>商品No</th>
                                    <th>商品名</th>
                                    <th>価格</th>
                                    <th>商品イメージ</th>
                                    <th>購入数</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:right;">
                                @foreach($confirm_goods_data as $goods)
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
                                        <td>{{$goods->input_num}}個</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-offset-3 text-center">
                            <a class="btn btn-primary" href="/customer/home">戻る</a>
                            <input type="submit" class="btn btn-success" value="決済する">
                        </div>
                    </form>
                </div>
                <div class="card-footer">Dashboard-footer</div>
            </div>
        </div>
    </div>
</div>
@endsection
