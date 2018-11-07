<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class IsPhoneRule implements Rule
{
    protected $isCreate ;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($isCreate=false)
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
            if( !$this->isCreate ) {
                if( !preg_match('/^1[34578]\d{9}$/',$value) ){
                    return false;
                }
            }else{
                if( !preg_match('/^1[34578]\d{9}$/',$value) || User::where('phone',$value)->count() ){
                    return false;
                }
            }

        }
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if( $this->isCreate ){
            return '手机号码格式错误或者手机已经被注册';
        }
        return '手机号码格式错误';
    }
}
