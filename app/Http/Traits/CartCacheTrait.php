<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/21
 * Time: 8:34
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\Redis;
use App\Models\Cart;
use Carbon\Carbon;

trait CartCacheTrait
{
    /**
     * 从redis中获取数据
     */
    public static function getCacheCart($id)
    {
        return self::getRedisCart($id);
    }

    /**
     * @param integer id 用户的id
     * 从redis中获取缓存
     */
    public static function getRedisCart($id)
    {
        # 获取所有用户购物车
        # 用户购物车数据包含字段 用户购物车id ， 用户购物车下关联的商品数量，用户购物车名称

        $carts = Redis::hget(Cart::key,$id);

        if( !$carts || empty($carts) ) {
            # 写数据
            $carts = self::setRedisCart($id);

        }

        $carts = call_user_func('collect',call_user_func('unserialize',$carts));

        return $carts;

    }

    /**
     * 设置redis缓存
     */
    public static function setRedisCart($id)
    {
        $carts = Cart::with(['productSku.image','productSku.product','productSku.product.category'])->where('user_id',$id)
            ->withOnly('productSku',['name','product_id','price','stock'])
            ->select('id','product_sku_id','user_id','amount')
            ->get();

        Redis::HSET(Cart::key,$id,serialize($carts));

        Redis::PEXPIRE(Cart::key,Carbon::now()->addDays(7)->timestamp);

        return Redis::HGET(Cart::key,$id);
    }

}