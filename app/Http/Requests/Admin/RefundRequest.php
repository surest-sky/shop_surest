<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Admin\RefundOrderRule;
use Illuminate\Validation\Rule;

class RefundRequest extends FormRequest
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
            'oid' => ['required','integer',new RefundOrderRule],
            'agreen' => ['required',Rule::in(['y','n'])]
        ];
    }

    public function messages()
    {
        return [
            'oid.required' => '操作异常1',
            'oid.integer' => '操作异常2',
            'agreen.integer' => '操作异常3'
        ];
    }
}
