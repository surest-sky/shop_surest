<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class IsEmailRule implements Rule
{
    protected $isCreate ;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($isCreate=true)
    {
        $this->isCreate = $isCreate;
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
        if( $value ) {
            if( !$this->isCreate ){
                if( !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',$value) ){
                    return false;
                }
            }else{
                if( !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',$value) || User::where('email',$value)->count() ){
                    return false;
                }
            }

        }
        return true;
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if( $this->isCreate ){
            return '邮箱格式错误或者邮箱已经存在';
        }else{
            return '邮箱格式错误';
        }
    }
}
