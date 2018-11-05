<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPhoneAndEmail;

class RegisterAccountRequest extends FormRequest
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
            'account' => ['required',new CheckPhoneAndEmail],
            'captcha' => ['captcha']
        ];
    }

    public function messages()
    {
        return [
            'account.required' => '手机号码或者邮箱不能为空',
            'captcha.captcha' => '验证码错误'
        ];
    }



}
