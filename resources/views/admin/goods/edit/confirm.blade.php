@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Administrator: Confirm New Goods Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Confirm New Goods Data!



                    <form method="POST" action="{{ route('admin_edit_input', $data['goods_id'] ) }}" aria-label="{{ __('admin_regist_input') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="goods_id" value="{{ $data['goods_id'] }}">
                        @foreach($data as $key => $goods_data)
                            @if(!($key == "_token") && !($key == "_method") && !($key == "goods_id"))
                                <input type="hidden" name="{{$key}}" value="{{$goods_data}}">
                                <div class="form-group row">
                                    <label for="{{$key}}" class="col-md-4 col-form-label text-md-right">
                            @endif
                            @switch($key)
                                @case('goods_name')
                                    {{ __('商品名:') }}
                                @break
                                @case('price')
                                    {{ __('価格:') }}
                                @break

                                @case('goods_image')
                                    {{ __('イメージ:') }}
                                @break
                                @case('goods_text')
                                    {{ __('説明文:') }}
                                @break
                                @default
                            @endswitch
                            @if(!($key == "_token") && !($key == "_method") && !($key == "goods_id"))
                                    </label>
                                    <label for="{{$key}}" class="col-md-8 col-form-label text-md-left">
                                        @if(isset($goods_data))
                                             <div class="">{{$goods_data}}</div>
                                        @else
                                             <div style="color:#ff0000">*入力されていません。</br>(未入力のまま登録出来ます。)</div>
                                        @endif
                                    </label>
                                </div>
                            @endif
                        @endforeach


                        <div class="col-md-offset-3 text-center">
                            <a class="btn btn-primary" href="/admin/goods/edit/{{ $data['goods_id'] }}">戻る</a>
                            <input type="submit" class="btn btn-success" value="登録する">
                        </div>
                    </form>
                </div>
                <div class="card-footer">Dashboard-footer</div>
            </div>
        </div>
    </div>
</div>
@endsection
