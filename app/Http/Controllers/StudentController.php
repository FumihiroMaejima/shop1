<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index(Request $rq)
    {
        // キーワード受け取り
        $keyword = $rq->input('keyword');

        // クエリ作成
        $query = \App\Models\Students::query();

        // キーワードがあるのなら
        if(!empty($keyword))
        {
            $query->where('email', 'like', '%' .$keyword. '%');
            $query->orWhere('name', 'like', '%' .$keyword. '%');
        }

        //ページネーション
        $students = $query->orderBy('id', 'desc')->paginate(10);
        return view('student.list')->with('students', $students)->with('keyword', $keyword);

    }

    public function insert()
    {
        return view('student.insert');
    }

    public function confirm(\App\Http\Requests\CheckStudentRequest $req)
    {
        $data = $req->all();
        return view('student.confirm')->with($data);
    }

    public function finish(Request $request)
    {
        // studentオブジェクトを作成
        $student = new \App\Models\Students;

        // 値の登録
        $student->name = $request->name;
        $student->email = $request->email;
        $student->tel = $request->tel;
        // 保存
        $student->save();

        // 一覧にリダイレクト
        return redirect()->to('student/list')->with('flashmessage', '登録が完了しました。');

    }

    // 編集処理
    public function edit($id)
    {
        // studentオブジェクトを作成
        $student = \App\Models\Students::findOrFail($id);
        return view('student.edit')->with('student', $student);
    }

    public function edit_confirm(\App\Http\Requests\CheckStudentRequest $req)
    {
        $data = $req->all();
        return view('student.edit_confirm')->with($data);
    }

    public function edit_finish(Request $request, $id)
    {
        // レコードを検索
        $student = \App\Models\Students::findOrFail($id);

        // 値の代入
        $student->name = $request->name;
        $student->email = $request->email;
        $student->tel = $request->tel;
        // 保存
        $student->save();

        // 一覧にリダイレクト
        return redirect()->to('student/list')->with('flashmessage', '更新が完了しました。');

    }

        // 削除処理
    public function delete($id)
    {
        // studentオブジェクトを作成
        $student = \App\Models\Students::find($id);

        $student->delete();
        return redirect()->to('student/list')->with('flashmessage', '削除が完了しました。');
    }


}
