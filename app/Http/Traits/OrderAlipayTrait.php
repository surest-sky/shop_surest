<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/16
 * Time: 9:32
 */

namespace App\Http\Traits;
use App\Exceptions\OrderException;
use App\Models\Order;

trait OrderAlipayTrait
{
    /**
     * 支付成功处理
     * @param $no
     * @param $apliy_no
     * @param $time
     * @throws OrderException
     */
    public static function apliy_success($no,$apliy_no,$time,$isWix=false)
    {
        try {
            $order = Order::where('no',$no)->first();
            $order->pay_status = Order::PAY_STATUS_DELIVERED;
            $order->pay_method = $isWix ? '微信' : '支付宝';
            $order->pay_no = $apliy_no;
            $order->closed = 1;
            $order->payed_at = $time;
            $order->save();

            # 邮件通知
            Order::sendInfo($order,'订单支付成功');

            # 给予用户登录的创建订单分数*4
            event(new \App\Events\ActiveUser($order->user_id,10));

            # 支付成功，重新写商品的缓存


            # 销量增加
            Order::incrCount($order);
            
        }catch (\Exception $exception) {

            throw new OrderException([
                'message' => '订单处理错误：no: '. $no . $exception->getMessage()
            ]);
        }
    }
}