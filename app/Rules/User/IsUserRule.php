<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class IsUserRule implements Rule
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
        try{
            if( User::find($value) ){
                return true;
            }
        }catch (\Exception $e){
            return false;
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
        return '用户不存在';
    }
}
