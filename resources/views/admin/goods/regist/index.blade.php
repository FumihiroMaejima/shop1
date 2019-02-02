@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Administrator Edit Goods Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Input Goods Data!



                    <form>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr style="text-align:right;">
                                    <th>商品データ</th>
                                    <th>入力値</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:right;">
                                    <tr>
                                        <td>商品コード</td>
                                        <td><input type="text" name="goods_code" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>商品名</td>
                                        <td><input type="text" name="goods_name" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>価格</td>
                                        <td>¥<input type="text" name="price" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>イメージ</td>
                                        <td><input type="file" name="goods_image" value=""></td>
                                    </tr>
                            </tbody>
                        </table>
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
