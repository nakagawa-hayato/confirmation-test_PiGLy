<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_weight' => [
                'required',
                'max:9999',              // 整数部分4桁まで
                'regex:/^\d{1,4}(\.\d{1})?$/' // 小数点は1桁まで
            ],
            'target_weight' => [
                'required',
                'max:9999',
                'regex:/^\d{1,4}(\.\d{1})?$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            // current_weight
            'current_weight.required' => '現在の体重を入力してください',
            'current_weight.max'      => '4桁までの数字で入力してください',
            'current_weight.regex'    => '小数点は1桁で入力してください',

            // target_weight
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.max'      => '4桁までの数字で入力してください',
            'target_weight.regex'    => '小数点は1桁で入力してください',
        ];
    }
}