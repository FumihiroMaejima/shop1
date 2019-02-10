@extends('layouts.payment')

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

                    <form action="{{ route('customer_payment_exec') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="customer_id" value="{{$customer->id}}">
                        <input type="hidden" name="total_cost" value="{{$total_cost}}">
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
                                <tr style="text-align:right;"><td></td><td></td><td></td><td></td><td>合計価格:{{$total_cost}}</td></tr>
                            </tbody>
                        </table>
                        <div class="col-md-offset-3 text-center">
                            <a class="btn btn-primary" href="/customer/home">戻る</a>
                            <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="{{ env('STRIPE_PUBLIC_KEY') }}"
                                    data-amount="{{$total_cost}}"
                                    data-name="EC Shop"
                                    data-label="決済をする"
                                    data-description="Online shopping by Stripe"
                                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                    data-locale="auto"
                                    data-currency="JPY">
                            </script>
                        </div>
                    </form>
                </div>
                <div class="card-footer">Dashboard-footer</div>
            </div>
        </div>
    </div>
</div>
@endsection
