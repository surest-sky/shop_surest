<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsInteger;
use App\Rules\IsAddrExist;

class OrderRequest extends FormRequest
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
            'pids' => ['required','array', new isInteger],
            'count' => ['required','array'],
            'address_id' => ['required','integer',new IsAddrExist]
        ];
    }

    public function messages()
    {
        return [
            'pids.required' => '您没有选择商品噢',
            'pids.array' => '订单出现异常',
            'count.array' => '商品数量出现异常',
            'count.required' => '商品数量出现异常',
            'address_id.required' => '请选择收货地址',
            'address_id.integer' => '请选择收货地址'
        ];
    }
}
