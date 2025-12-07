<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
    return [
        'name'  => 'required',
        'price' => 'required|numeric|min:0|max:10000',
        'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        'season_id' => 'required',
        'description' => 'required|max:120',
    ];
    }

public function messages()
    {
    return [
        // 商品名
        'name.required' => '商品名を入力してください',

        // 値段
        'price.required' => '値段を入力してください',
        'price.numeric'  => '数値で入力してください',
        'price.min'      => '0∼10000円以内で入力してください',
        'price.max'      => '0∼10000円以内で入力してください',

        // 画像
        'image.required' => '画像を登録してください',
        'image.mimes'    => '「.png」または「.jpg / .jpeg」形式でアップロードしてください',

        // 季節
        'season_id.required' => '季節を選択してください',

        // 説明
        'description.required' => '商品説明を入力してください',
        'description.max'      => '120文字以内で入力してください',
    ];
    }

}