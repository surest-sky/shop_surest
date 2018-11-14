<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Address;

class IsAddrExist implements Rule
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
        if( Address::where('id',$value)->count() ) {
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
        return '请检查收货地址';
    }
}
