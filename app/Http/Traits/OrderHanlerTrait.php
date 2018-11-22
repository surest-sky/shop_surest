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
    public static function incrCount($order)
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

    public static function refundHandler($order)
    {
        $refund_no = Order::getOrderRefundNo();

        switch ($order->pay_method){
            case '支付宝' :
                $ret = app('alipay')->refund([
                    'out_trade_no' => $refund_no,
                    'trade_no' => $order->pay_no,
                    'refund_amount' => $order->total_price
                ]);

                # 退款成功 : https://docs.open.alipay.com/common/105806
                if( $ret['code'] && $ret['code'] == '10000' ) {
                    $order->refund_status = Order::REFUND_STATUS_SUCCESS;
                    $order->out_refund_no = $refund_no;
                    $order->save();
                    return true;
                }else{
                    $order->refund_status = Order::REFUND_STATUS_FAILED;
                    $order->refund_err = [
                        $ret['msg'],$ret['code']
                    ];
                    $order->save();
                    return false;
                }
            break;
            case '微信' :
                app('wechat')->refund([
                    'out_trade_no' => $order->no,
                    'total_fee' => $order->total_price * 100,
                    'refund_fee' => $order->total_price * 100,
                    'out_refund_no' => $refund_no,

                    // 这里是异步调用 ， 不会立即返回退款成功的信息
                    'notify_url' => return_notify_url()// 退款后的回调
                ]);

                // 将订单状态改成退款中
                $order->update([
                    'refund_no' => $refund_no,
                    'refund_status' => Order::REFUND_STATUS_PROCESSING,
                ]);

                return true;
                break;

        }
    }
}