<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckGoodsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;        // 権限判定は特に行わない為、trueとする
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'goods_name'  => 'required|string|max:50',             // 必須|文字列|最大50文字
            'price'       => 'required|integer|min:1|digits_between:1,6',  // 必須|最小値:1|数値かつ1桁~6桁
            //'goods_image' => 'image',                            // 指定された拡張子(jpg,png)
            //'goods_image' => 'nullable|mimes:jpg,png',           // null可|指定された拡張子(jpg,png)
            'goods_image' => 'nullable', // null可|指定された拡張子(jpg,png)|最小縦横100px 最大縦横600px
            'goods_text'  => 'nullable|string|max:120',            // null可|文字長120文字以内
        ];
    }

    public function messages()
    {
        return [
            'required'       => '必須項目です。',
            'string'         => '文字を入力してください。',
            'integer'         => '数値を入力してください。',
            'max'            => '入力された文字数が制限を超えています。',
            'min'            => '最小価格は1円となっています。',
            //'image'          => '指定された拡張子のファイルをアップロードして下さい。',
            'mimes'          => '指定された拡張子のファイルをアップロードして下さい。',
            'dimensions'     => 'アップロード可能なファイルのサイズのは最小縦横100px、最大縦横600pxとなっています。',
            'digits_between' => '指定された桁数で値(半角)を入力してください。',
        ];
    }
}
