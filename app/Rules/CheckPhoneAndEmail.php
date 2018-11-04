<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPhoneAndEmail implements Rule
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
        if( $res = checkParamType($value) ){
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
        return '验证格式不匹配';
    }
}
