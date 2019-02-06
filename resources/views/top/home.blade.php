@extends('layouts.top')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Goods Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    New Release Goods!

                    <div class="col-sm-6" style="margin-bottom:5px;">
                        <form method="get" action="" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="keyword" class="form-control" value="{{$keyword}}" placeholder="検索キーワード">
                            </div>
                            <input type="submit" value="検索" class="btn btn-info" style="margin: 2px;">
                        </form>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr style="text-align:center;">
                                <th>商品No</th>
                                <th>商品コード</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>イメージ</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                            @foreach($all_goods as $goods)
                                <tr>
                                    <td>{{$goods->id}}</td>
                                    <td>{{$goods->goods_code}}</td>
                                    <td>{{$goods->goods_name}}</td>
                                    <td>{{$goods->price}}円</td>
                                    <td>
                                        <!-- <a href="" class="btn btn-primary btn-sm">詳細</a> -->
                                        <!-- <a href="/admin/edit/{{$goods->id}}" class="btn btn-primary btn-sm">編集</a> -->
                                        @if($goods->image_name)
                                            <img src="{{ asset('storage/goods/' . $goods->id . '/' . $goods->image_name) }}" width="40" height="40" alt="no_goods_image" />
                                        @else
                                            <p>--------</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- page control -->
                    {{-- {!! $students->links() !!} --}}
                    {!! $all_goods->appends(['keyword'=>$keyword])->render() !!}
                </div>
                <div class="card-footer" style="text-align:right;"><a class="nav-link" href="{{ route('admin_login') }}">{{ __('Admin Login') }}</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
