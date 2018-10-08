@extends('layout.layout')
@section('title', 'Tutrial for beginner')

@if(Session::has('flashmessage'))
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">受講生 APP</h4>
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

@section('script')
<script>
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
@section('content')
 <div class="row" style="margin-bottom:30px;">
     <div class="form-group">
         <form method="get" action="" class="form-inline">
             <div class="form-group">
                 <input type="text" name="keyword" class="form-control" value="{{$keyword}}" placeholder="検索キーワード">
             </div>
             <input type="submit" value="検索" class="btn btn-info">
         </form>
     </div>
     <div class="col-sm-2">
         <a href="/student/new" class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i>新規追加</a>
     </div>
</div>

  <table class="table table-striped table-hover">
  <thead>
  <tr>
  <th>No</th>
  <th>name</th>
  <th>email</th>
  <th>tel</th>
  <th>opration</th>
  </tr>
  </thead>
  <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->tel}}</td>
            <td>
                <!-- <a href="" class="btn btn-primary btn-sm">詳細</a> -->
                <a href="/student/edit/{{$student->id}}" class="btn btn-primary btn-sm">編集</a>
            </td>
            <td>
                <form action="/student/delete/{{$student->id}}" method="POST">
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
  {!! $students->appends(['keyword'=>$keyword])->render() !!}
@endsection
