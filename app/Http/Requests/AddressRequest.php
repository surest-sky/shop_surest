<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\User\IsPhoneRule;
use App\Rules\IsAddress;

class AddressRequest extends FormRequest
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
            'name' => 'required|between:1,25',
            'phone' => ['required', new IsPhoneRule],
            'address' => ['required' , new IsAddress],
            'detail' => ['required','between:2,20']
        ];
    }
}
