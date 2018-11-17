<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\OrderRefundRequest;

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
            'refund_reason' => 'required|between:2,30',
            'id' => ['required','integer', new OrderRefundRequest]
        ];
    }

    public function messages()
    {
        return [
            'refund_reason.required' => '请输入退款理由',
            'refund_reason.between' => '退款理由字数在2-30之间',
            'id.required' => '退款异常',
            'id.integer' => '退款异常',
        ];
    }
}
