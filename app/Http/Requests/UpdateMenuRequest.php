<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191',
            'content' => 'max:191',
        ];
    }

    public function messages()
    {
        return [
            'name:required' => 'メニュー名を入力してださい',
            'name:max' => 'メニュー名は191文字以内で入力してください',
            'content:max' => '説明は191文字以内で入力してください',
        ];
    }
}
