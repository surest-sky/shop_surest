<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/16
 * Time: 22:21
 */

namespace App\Http\Traits;

use App\Models\Order;
use App\Notifications\OrderToMail;
use App\Jobs\IncrProductCount;

trait OrderHanlerTrait
{

    /**
     * 邮件发送
     * @param $order
     */
    public static function sendInfo($order,$msg)
    {
        $user = $order->user;
        if( $user->email ) {
            # 发送给用户一个消息，支付成功
            $user->notify(new OrderToMail($order,$msg));
        }
    }

    # 推送到异步队列 ， 执行销量增加
    public function incrCount($order)
    {


        $productSkus = collect($order->extra['product_skus']);

        $ids = $productSkus->pluck('count','product_id');

        /**
            all: [
                1 => 432,
            ],
         *
         *  key = 商品的id
         *  value = 商品待增加的销量
         */

        # 推送到异步队列 实现异步增加销售量
        IncrProductCount::dispatch($ids);
    }
}