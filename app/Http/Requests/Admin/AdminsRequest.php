<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsRoleExist;

class AdminsRequest extends FormRequest
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
            'name' => ['required','between:2,10'],
            'password' => ['required','between:6,33','confirmed'],
            'roles' => ['required','array', new IsRoleExist]
        ];
    }

    public function attributes()
    {
        return [
            'name' => '用户名',
            'roles' => '规则'
        ];
    }
}
