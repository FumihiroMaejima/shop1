<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;           // 必ずtrueに変更する。
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email'=> 'required|email',
            //'tel' => 'required|numeric|digits_between:8,11'
            'tel' => 'required|regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/'
        ];
    }

    public function messages()
    {
        return [
            'required' => '必須項目です。',
            'email'=> 'アルファベット半角で入力してください。',
            'tel.regex' => '「000-0000-0000」の形式で入力してください。'
        ];
    }
}
