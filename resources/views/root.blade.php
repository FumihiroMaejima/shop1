@extends('layout.layout')
@section('title', 'Shopping Site')


@section('script')

@endsection
@section('content')
<div class="row" style="margin-bottom:30px;">
    <div class="col-sm-6">
        <form method="get" action="" class="form-inline">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" value="{{$keyword}}" placeholder="検索キーワード">
            </div>
            <input type="submit" value="検索" class="btn btn-info">
        </form>
    </div>
    <div class="col-sm-3">
        <a href="/customer/login" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;会員様はこちら</a>
    </div>
    <div class="col-sm-3">
        <a href="/customer/register" class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;新規会員登録はこちら</a>
    </div>
</div>

<table class="table table-striped table-hover">
  <thead>
  <tr>
    <th>商品No</th>
    <th>商品コード</th>
    <th>商品名</th>
    <th>規格</th>
    <th>価格</th>
    <th>opration</th>
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
                <a href="/student/edit/{{$goods->id}}" class="btn btn-primary btn-sm">編集</a>
            </td>
            <td>
                <form action="/student/delete/{{$goods->id}}" method="POST">
                    {{ csrf_field() }}
                    <input type=submit value="削除" class="btn btn-danger btn-sm btn-dell">
                </form>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>

<!-- page control -->
{{-- {!! $students->links() !!} --}}
{!! $all_goods->appends(['keyword'=>$keyword])->render() !!}
@endsection
