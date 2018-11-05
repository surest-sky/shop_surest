<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\checkAccount;

class RegisterRequest extends FormRequest
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
            'name' => 'required|unique:users|between:2,12',
            'key' =>  ['required',new checkAccount ],
            'password' => 'required|between:6,16|confirmed',
            'captcha' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '用户名',
            'password' => '密码',
            'captcha' => '验证码',
        ];
    }

    public function messages()
    {
        return [
            'key.required' => '验证码错误'
        ];
    }
}
