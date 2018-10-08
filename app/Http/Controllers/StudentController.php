<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index()
    {
    $query = \App\Models\Students::query();

    //全権取得&ページネーション
    $students = $query->orderBy('id', 'desc')->paginate(10);
    return view('student.list')->with('students', $students);

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
        return redirect()->to('student/list');

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
        return redirect()->to('student/list');

    }

        // 削除処理
    public function delete($id)
    {
        // studentオブジェクトを作成
        $student = \App\Models\Students::find($id);

        $student->delete();
        return redirect()->to('student/list');
    }


}
