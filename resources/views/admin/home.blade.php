@extends('layouts.admin')

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
                <div class="card-header">Administrator Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

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
                            <tr style="text-align:right;">
                                <th>商品No</th>
                                <th>商品コード</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>opration</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:right;">
                            @foreach($all_goods as $goods)
                                <tr>
                                    <td>{{$goods->id}}</td>
                                    <td>{{$goods->goods_code}}</td>
                                    <td>{{$goods->goods_name}}</td>
                                    <td>{{$goods->price}}円</td>
                                    <td>
                                        <!-- <a href="" class="btn btn-primary btn-sm">詳細</a> -->
                                        <a href="/admin/goods/edit/{{$goods->id}}" class="btn btn-primary btn-sm">編集</a>
                                    </td>
                                    <td>
                                        <a id="upload_{{$goods->goods_code}}" name="upload_img" href="javascript:uploadImage({{$goods->id}})" class="btn btn-primary btn-sm" >画像</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin_goods_delete', $goods->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type=submit class="btn btn-danger btn-sm btn-dell" value="削除">
                                        </form>
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
<div class="modal fade" id="upload_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Goods Image Upload</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin_upload_image') }}" enctype='multipart/form-data'>
                    {{ csrf_field() }}
                    <input type="hidden" input="select_id" name="select_id" value="">

                    <div class="form-group row">
                        <label for="goods_image" class="col-md-3 col-form-label text-md-left">{{ __('イメージ') }}</label>

                        <div class="col-md-7">
                            <input type="file" class="" name="goods_image" value="{{ old('goods_image') }}" style="border:none;padding-left:0.0rem;" >
                            <small class="input_condidion">*jpg,png形式のみ</small></br>
                            <small class="input_condidion">*最小画像サイズ:縦横100px</small></br>
                            <small class="input_condidion">*最大画像サイズ:縦横600px</small>

                            @if ($errors->has('goods_image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('goods_image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-offset-3 text-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                        <input type="submit" class="btn btn-success" value="登録">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button> -->
            </div>
        </div>
    </div>
</div>
<script>

    function uploadImage(id){
        //$('li[id^="sample"]');
        //console.log("test");
        //$('#upload_modal').css('display','block');
        //$('#test').text(id);
        $('input[name=select_id]').val(id);

        $('#upload_modal').modal('show');
    }

    $(function(){
        $(".btn-dell").click(function(){
            if(confirm("本当に削除しますか？")){
                // そのまま削除を実行
            }
            else{
                return false;
            }
        });
    });

</script>

@endsection
