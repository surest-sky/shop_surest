<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/21
 * Time: 10:01
 */

namespace App\Observers;

use App\Models\Cart;

class CartObserver
{
    public function deleted(Cart $cart)
    {
        # 删除后则更新缓存
        $id = $cart->user_id;
        Cart::setRedisCart($id);
    }
}