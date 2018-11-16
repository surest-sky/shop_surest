<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Admin\CheckOrderRule;

class ShipRequest extends FormRequest
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
            'id' => ['required','integer', new CheckOrderRule],
            'ship_no' => ['required','regex:/\w+/'],
            'serial' => ['required','regex:/\w+/']
        ];
    }

    public function messages()
    {
        return [
            'id.required' => '订单不存在',
            'id.integer' => '订单有问题',
            'ship.required' => '物流信息不存在',
            'ship.regex' => '物流不符合规则',
            'serial.required' => '请选择快递公司',
            'serial.regex' => '快递公司选择失败'
        ];
    }
}
