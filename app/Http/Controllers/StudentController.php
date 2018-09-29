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



}
