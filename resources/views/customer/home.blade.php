@extends('layouts.customer')

@section('content')
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
                            <a href="/customer/register" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>購入手続きへ</a>
                    </div>


                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>商品No</th>
                                <th>商品コード</th>
                                <th>商品名</th>
                                <th>規格</th>
                                <th>価格</th>
                                <th>買い物option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_goods as $goods)
                                <tr>
                                    <td>{{$goods->id}}</td>
                                    <td>{{$goods->goods_code}}</td>
                                    <td>{{$goods->goods_name}}</td>
                                    <td>{{$goods->standard}}</td>
                                    <td>{{$goods->price}}円</td>
                                    <td>
                                        <!-- <a href="" class="btn btn-primary btn-sm">詳細</a> -->
                                        <a href="/student/edit/{{$goods->id}}" class="btn btn-primary btn-sm">カートに入れる</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- page control -->
                    {{-- {!! $students->links() !!} --}}
                    {!! $all_goods->appends(['keyword'=>$keyword])->render() !!}
                </div>
                <div class="card-footer">Dashboard-footer</div>
            </div>
        </div>
    </div>
</div>
@endsection
