@extends('layout.layout')
@section('title', 'Tutrial for beginner')
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
 <div class="page-header" style="margin-top:-30px;padding-bottom:0px;">
  <h1><small>受講生一覧</small></h1>
  <a href="/student/new" class="btn btn-warning btn-sm">新規追加</a>
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
  {!! $students->links() !!}
@endsection
