<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/17
 * Time: 0:22
 */

namespace App\Http\Traits;

use App\Models\Order;

trait OrderToAdminTrait
{
    /**
     * 获取所有的商品数据
     * @param bool $page true = 分页数据获取 false = 获取全部数据
     */
    public static function getOrdersAll($page=true)
    {
        if( $page ) {
            $orders = self::getPageOrder();
        }else{
            $orders = self::getAllOrder();
        }
        return $orders;
    }

    /**
     * 后台管理模块
     * 分页数据获取订单数据
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getPageOrder()
    {
        $orders = Order::with(['user'])->orderBy('created_at','DESC')
            ->paginate(10);

        return $orders;
    }

    /**
     * 从缓存中获取所有的订单
     */
    public static function getAllOrder()
    {
        $orders = Order::with(['user'])->orderBy('created_at','DESC')->get();
        return $orders;
    }

}