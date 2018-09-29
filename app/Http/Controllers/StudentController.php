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


}
