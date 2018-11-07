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
            'description' => ['required','between:2,15'],
            'route' => ['required',new IsRoute]
        ];
    }

    public function attributes()
    {
        return [
            'route' => '路由'
        ];
    }
}
