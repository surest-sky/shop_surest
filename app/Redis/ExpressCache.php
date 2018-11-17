<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/17
 * Time: 15:00
 */

namespace App\Redis;

use Illuminate\Support\Facades\Redis;
use App\Models\Order;
use App\Handle\ExpressHandler;
use Carbon\Carbon;

class ExpressCache
{
    const key = 'order_';

    const expir = 15;

    /**
     * 传入订单获取相关快递缓存
     * @param $key integer 订单id
     */
    public static function getValue($id)
    {
        $key = self::key . $id;
//        $data = Redis::get($key);
//
//        if( !$data ) {
//            $data = self::setCacheValue($key,$id);
//        }else{
//            $data = call_user_func('unserialize',$data);
//        }
        $data = self::setCacheValue($key,$id);

        return $data;
    }

    /**
     * 设置一个缓存值
     * @param $key string 缓存键值
     * @param $id integer 订单id
     * @return bool
     */
    public static function setCacheValue($key,$id)
    {
        if( !$order = Order::find($id) ) {
            return false;
        }
        $data = $order->shipOrdata;
        $handler = new ExpressHandler();

        $result = $handler->getOrderTracesByJson($data['serial'],$data['no']);

//        $result_ser = call_user_func('serialize',$result['Traces']);
//
//        if( $result['Success'] ) {
//            Redis::set($key,$result_ser);
//            Redis::expire($key,Carbon::now()->addDays(15)->timestamp);
//        }

        return $result['Traces'];
    }


}