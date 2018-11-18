<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsRoute;

class PermissionRequest extends FormRequest
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
            'name' => ['required','between:2,15'],
            'description' => ['required'],
            'route' => ['required',new IsRoute]
        ];
    }

    public function messages()
    {
        return [
            'route' => '路由',
            'name.required' => '权限名称不符合规则',
            'name.between' => '权限名称不符合规则',
            'description.required' => '描述信息不符合规则'
        ];
    }
}
