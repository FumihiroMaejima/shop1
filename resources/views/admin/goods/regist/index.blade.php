@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Administrator Regist New Goods Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Input New Goods Data!

                    <form method="POST" action="{{ route('admin_regist_confirm') }}" >
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="form-group row" style="margin-top:10px;">
                            <label for="goods_name" class="col-md-3 col-form-label text-md-left">{{ __('商品名') }}<small style="color:#ff0000;">【必須】</small></label>

                            <div class="col-md-7">
                                <input id="goods_name" type="text" class="form-control{{ $errors->has('goods_name') ? ' is-invalid' : '' }}" name="goods_name" value="{{ old('goods_name') }}" maxlength="50" required autofocus>
                                <small class="input_condidion">*最大50文字</small>

                                @if ($errors->has('goods_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('goods_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-3 col-form-label text-md-left">{{ __('価格') }}<small style="color:#ff0000;">【必須】</small></label>

                            <div class="col-md-7">
                                <input id="price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required autofocus>
                                <small class="input_condidion">*半角数字1~999999(円)以内</small>

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="goods_text" class="col-md-3 col-form-label text-md-left">{{ __('商品説明文') }}</label>

                            <div class="col-md-7">
                                <textarea class="form-control{{ $errors->has('goods_text') ? ' is-invalid' : '' }}" name="goods_text" rows="4" cols="30" maxlength="120" placeholder="説明文を入力してください。">{{ old('goods_text') }}</textarea>
                                <small class="input_condidion">*最大120文字</small>

                                @if ($errors->has('goods_text'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('goods_text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-offset-3 text-center">
                            <a class="btn btn-primary" href="/admin/home">戻る</a>
                            <input type="submit" class="btn btn-success" value="確認">
                        </div>
                    </form>
                </div>
                <div class="card-footer">Dashboard-footer</div>
            </div>
        </div>
    </div>
</div>
@endsection
