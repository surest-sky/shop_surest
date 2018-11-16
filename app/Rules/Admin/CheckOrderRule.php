<?php

namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;

class CheckOrderRule implements Rule
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
        if( $order = \App\Models\Order::find($value) ) {
            if( $order->pay_status == \App\Models\Order::PAY_STATUS_DELIVERED && $order->ship_status == \App\Models\Order::SHIP_STATUS_PENDING ) {
                return true;
            }
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
        return '你选择的订单有误';
    }
}
