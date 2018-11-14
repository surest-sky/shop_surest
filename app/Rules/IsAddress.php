<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsAddress implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if( checkAddress($value) ){
            return true;
        }

            return false;
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '收货地址不匹配：请满足条件 江西省/九江市/庐山区';
    }
}
