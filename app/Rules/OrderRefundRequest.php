<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Order;

class OrderRefundRequest implements Rule
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
        if( $order = Order::where('id',$value)->where('user_id',\Auth::id())->select('id','pay_status','refund_status')->first() ) {
            if( $order->pay_status == Order::PAY_STATUS_DELIVERED && $order->refund_status ==  Order::REFUND_STATUS_PENDING ) {
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
        return '退款异常';
    }
}
