<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Permission;

class IdIsRequired implements Rule
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
        $permissions = Permission::all()->pluck('id')->toArray();
        foreach ($value as $val) {
            if( !in_array($val, $permissions) ) {
                return false;
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
        return '错误：请检查权限是否存在';
    }
}
